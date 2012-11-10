<?php
/*
Template Name: Client Page
*/
?>


<?php get_header(); ?>

<?php 

$username = ( $userdata->user_login ); 

?>

    <?php
$url =  $_SERVER['REQUEST_URI'];
$urlItemsArr = explode( '/', $url );

/*
print ('client-area/'.$userdata->user_nicename);
print '<br />';
print ($urlItemsArr[1].'/'.$urlItemsArr[2] );
print '<br />';
*/

if ( strcmp( 'clients/'.$userdata->user_nicename, $urlItemsArr[1].'/'.$urlItemsArr[2] ) == 0) {
	 print 'Allowed';
} else {
	header('Location:http://satellitecap.com/wp-admin/') ;
}

?>
			
			<div id="content" class="clearfix row-fluid">
			
				<div id="main" class="span8 clearfix" role="main">

					<?php $thetitle = strtolower(get_the_title());
		$shorttitle = str_replace(' ', '', $thetitle);
		$username = ( $userdata->user_login ) ?>

		<?php if ( current_user_can( 'level_10' ) || is_user_logged_in() && $username==$shorttitle )  { ?>

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<div class="clientcontent" id="post-<?php the_ID(); ?>">

				<h2><?php the_title(); ?></h2>

				<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>
				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

			</div>

			<?php endwhile; endif; ?>

		<?php } elseif ( is_user_logged_in()==false ) { ?>

			<div class="clientcontent">

			<h2>Sorry...</h2>

				<p>You must be <a href="http://jtwilcox.com/wp-login.php">logged in</a> to access this area.</p>

			</div>

		<?php } elseif ( is_user_logged_in() && $username!=$shorttitle ) { ?>

			<div class="clientcontent">

			<h2>Sorry...</h2>

				<p>You are not allowed to access this area.</p>

			</div>

		<?php } ?>			
				</div> <!-- end #main -->
    
				<?php get_sidebar(); // sidebar 1 ?>
    
			</div> <!-- end #content -->

<?php get_footer(); ?>