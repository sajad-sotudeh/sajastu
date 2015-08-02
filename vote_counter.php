<?php
include_once($_SERVER['DOCUMENT_ROOT'].'wordpress/wp-config.php' );
include_once($_SERVER['DOCUMENT_ROOT'].'wordpress/wp-content/plugins/fjn-poll/fjn-poll.php' );
header('Content-Type: text/html; charset=utf-8');
get_header();
$post_id = $_GET['poll'];
$vote = $_GET['vote'];
$user_id = get_the_user_ip();

    if (user_check($user_id,$post_id)){
			echo "<script>alert('You have already voted, So your vote is not registered. You can just see the Results');</script>";
			global $wpdb;
			$findVotes = $wpdb->get_var( $wpdb->prepare( 
				"
					SELECT all_votes 
					FROM wp_polls 
					WHERE poll_id = %d
				", 
				$post_id
			) );
				$str1=get_post_field( 'post_content', $post_id );
				$choices = explode ('-',$str1);
				?>

			<h2> Results: <h3><?php
				for ($i=0 ; $i<count($choices) ; $i++){
					$result = $wpdb->get_results("SELECT ans_title,votes FROM wp_answers WHERE poll_id=$post_id AND ans_id=$i");
					?> <table border="1" style="width:70%">
						<tr>
						<td> <?php echo $result[0]->ans_title; ?> </td>
						<td><?php echo (100*round($result[0]->votes/($findVotes),4));?></td>
						</tr>
				</table><?php
				}
		}
	else{
			insert_users($user_id,$post_id);
			global $wpdb;

			$findVotes = $wpdb->get_var( $wpdb->prepare( 
				"
					SELECT all_votes 
					FROM wp_polls 
					WHERE poll_id = %d
				", 
				$post_id
			) );

			$findVotes = $findVotes + 1;

			$wpdb->query("UPDATE wp_polls SET all_votes=$findVotes WHERE poll_id=$post_id");

			$findvotes = $wpdb->get_var( 
				"
					SELECT votes 
					FROM wp_answers 
					WHERE poll_id = $post_id AND ans_id = $vote
				"
			 );
			 $findvotes=$findvotes + 1;
			$wpdb->query("UPDATE wp_answers SET votes=$findvotes WHERE poll_id=$post_id AND ans_id=$vote");

				$str1 = get_post_field('post_content', $post_id);
				$count = substr_count($str1, '-') + 1;
			?>
			<h2> Results: <h3><?php
				for ($i=0 ; $i<$count ; $i++){
					$result = $wpdb->get_results("SELECT ans_title,votes FROM wp_answers WHERE poll_id=$post_id AND ans_id=$i");
					?> <table border="1" style="width:70%">
						<tr>
						<td> <?php echo $result[0]->ans_title; ?> </td>
						<td><?php echo (100*round($result[0]->votes/($findVotes),4));?></td>
						</tr>
				</table><?php
				}
		}
?>
