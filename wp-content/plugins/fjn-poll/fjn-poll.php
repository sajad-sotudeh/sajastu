<?php
/*
Plugin Name: fenjoonPolls
Plugin URI: http://fenjoon.net
Description: Fenjoon Web Design Team
Version: 1.0.0
Author: Fenjoon
Author URI: http://fenjoon.net
*/
/* =================================================================== */

//******************************************
// Add polls table to database
//******************************************
function fjn_add_polls_table_to_db(){
	global $wpdb;
	$charset_collate = $wpdb->get_charset_collate();
	$polls_table = $wpdb->prefix. 'polls';
	if( $wpdb->get_var( "SHOW TABLES LIKE '{$polls_table}'" ) != $polls_table ){
		$query =
			"CREATE TABLE {$polls_table} (
			poll_id BIGINT(20) UNSIGNED ZEROFILL PRIMARY KEY,
			title VARCHAR(128),
			author_id TINYINT(4) ,
			all_votes BIGINT(20) DEFAULT 0
			) $charset_collate;";
		require_once( ABSPATH. 'wp-admin/includes/upgrade.php' );
		dbDelta( $query );
	}
}
register_activation_hook(__FILE__, 'fjn_add_polls_table_to_db');
//******************************************
// Add answers table to database
//******************************************
function fjn_add_answers_table_to_db(){
	global $wpdb;
	$a = $wpdb->get_charset_collate();
	$answers_table = $wpdb->prefix. 'answers';
	if( $wpdb->get_var( "SHOW TABLES LIKE '{$answers_table}'" ) != $answers_table ){
		$query =
			"CREATE TABLE {$answers_table} (
			poll_id BIGINT(20),
			ans_id BIGINT(20),
			ans_title VARCHAR(32),
			votes BIGINT(20),
			PRIMARY KEY (poll_id,ans_id)
		) $a;";
		require_once( ABSPATH. 'wp-admin/includes/upgrade.php' );
		dbDelta( $query );
	}
}
register_activation_hook(__FILE__, 'fjn_add_answers_table_to_db');

//******************************************
// Add  table to database
//******************************************
function fjn_add_users_table_to_db(){
	global $wpdb;
	$voters_table = $wpdb->prefix. 'voters';
	if( $wpdb->get_var( "SHOW TABLES LIKE '{$voters_table}'" ) != $voters_table ){
		$query =
			"CREATE TABLE {$voters_table} (
				user_id VARCHAR(32),
				poll_id INT(20),
				PRIMARY KEY(user_id,poll_id)
			);";
		require_once( ABSPATH. 'wp-admin/includes/upgrade.php' );
		dbDelta( $query );
	}
}
register_activation_hook(__FILE__, 'fjn_add_users_table_to_db');


//******************************************
// CPT - poll
//******************************************
function cpt_poll(){
	$labels = array(
		'name'                => 'poll',
		'singular_name'       =>  'poll' ,
		'menu_name'           =>  'poll' ,
		'parent_item_colon'   =>  'Parent poll' ,
		'all_items'           =>  'All poll',
		'view_item'           =>  'View poll',
		'add_new_item'        =>  'Add New poll' ,
		'add_new'             =>  'Add New',
		'edit_item'           =>  'Edit poll',
		'update_item'         =>  'Update poll',
		'search_items'        =>  'Search poll',
		'not_found'           =>  'Not found',
		'not_found_in_trash'  =>  'Not found in Trash',
	);
	$args = array(
		'label'               =>  'poll',
		'description'         =>  'poll information for the site',
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'			  => 'dashicons-chart-bar',
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
	);
	register_post_type( 'poll', $args );
}
add_action( 'init', 'cpt_poll', 0 );


function add_records_to_db(){
	global $wpdb;
	global $post;
	$pid=get_the_ID();
	$ptitle=get_the_title();
	$aid=$post->post_author;
	$wpdb->insert( 
	'wp_polls', 
	array( 
		'poll_id' => $pid , 
		'title' => $ptitle,
		'author_id' => $aid,
		'all_votes' => "",
	), 
	array( 
		'%d', 
		'%s',
		'%d',
		'%d'
	)
);

	$str1 = get_post_field('post_content', $pid);
	$choices1 = explode ('-',$str1);
	
	for ($i=0 ; $i<count($choices1);$i++){	
	$wpdb->insert( 
	'wp_answers', 
	array( 
		'poll_id' => $pid , 
		'ans_id' => $i,
		'ans_title' => $choices1[$i],
		'votes' => "",
	), 
	array( 
		'%d', 
		'%d',
		'%s',
		'%d'
	) 
);
	}
}
add_action( 'save_post_poll', 'add_records_to_db');

function insert_users($uid,$pid){
	global $wpdb;
	$wpdb->insert( 
	'wp_voters', 
	array( 
		'user_id' => $uid,
		'poll_id' => $pid,
	), 
	array( 
		'%s', 
		'%d'
	) 
);
}

function user_check($uid,$pid){
	global $wpdb;
	$result = $wpdb->get_results("SELECT * FROM wp_voters WHERE user_id = '$uid' AND poll_id=$pid");
	if (count($result) > 0) {
	return true;
	} else {
		return false;
		}	
}

function add_vote_metabox(){
	if( is_admin() ){
		global $pagenow;
		if( 'post.php' == $pagenow ){
			add_meta_box( 
				'displayvotes',
				'Vote Results',
				'displayvotes',
				'poll',
				'advanced',
				'core'
			); 
		}
	}
}

add_action( 'add_meta_boxes', 'add_vote_metabox', 0 );

function displayvotes(){		
	$post_id=get_the_ID();
	global $wpdb;
			$findVotes = $wpdb->get_var( $wpdb->prepare( 
				"
					SELECT all_votes 
					FROM wp_polls 
					WHERE poll_id = %d
				", 
				$post_id
			) );
			
		if ($findVotes==0){
			echo "Nobody Vote until Now!";
		}
			else{
				$str1=get_post_field( 'post_content', $post_id );
				$choices = explode ('-',$str1);
				
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
}
?>
