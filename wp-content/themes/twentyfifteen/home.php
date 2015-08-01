<meta charset="UTF-8" />

<?php get_header();
	  get_sidebar();	?>

<html>
<?php
    $args = array(
	'post_type' => 'poll',
	'posts_per_page' => 1,
	);
	$new = new WP_Query( $args );
		while ($new->have_posts()) : $new->the_post();
		?> <h2><?php $question = get_the_title();?><h2>
		<?php 	$str = get_the_content();
				$choices = explode('-',$str);
		endwhile;
	?>
<?php $post_ID = get_the_ID();
	?>
<body>
	<div id="poll">
		<h3><?php echo $question; ?> </h3>
			<form action="wp-content/themes/twentyfifteen/vote_counter.php" method="GET">
				<?php for ($i=0 ; $i<count($choices);$i++){
				echo $choices[$i];
				?><input type="radio" name="vote" value="<?php echo $i?>" >
				<br><?php 
				}?>
				<input type="hidden" name="post_id" value="<?php echo $post_ID; ?>">
		    	<input type="button" value="Submit" onclick="sendVote()" />
			</form>
	</div>
	<br><br>
	
</body>
<script>
function getCheckedRadio(name) {
	var radios = document.getElementsByName(name);
	for (var i=0, j=radios.length; i<j; i++)
		if (radios[i].checked)
			return radios[i];
	return false;
}
 
function sendVote() {
	var poll_id = "<?php echo $post_ID ?>";
	var radio = getCheckedRadio('vote'); // <input type=radio name=vote>
	if (radio == false)
		alert('no radio checked!');
	else
		window.location.href = "vote_counter.php?poll=" + poll_id +"&vote="+radio.value; 
		
}
</script>
</html>