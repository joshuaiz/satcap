<?php
/*
Template Name: Home Page
*/
?>

<?php get_header(); ?>
			
			<div id="content" class="clearfix row-fluid">
			
				<div id="main" class="span12 clearfix" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<div class="home-info">
					<h4 class="homeh4"><img src="http://satellitecap.com/wp-content/themes/satcap/img/sc_logo64.png">SATELLITE CAPITAL</h4>
					<p>1406 W Ohio #3<br />
					Chicago, IL 60642<br />
					<a href="mailto:info@satellitecap.com">Email</a> | Phone: 773-263-5320</p>
					</div>					
					<?php 
						// No comments on homepage
						//comments_template();
					?>
					
					<?php endwhile; ?>	
					
					<?php else : ?>
					
										
					<?php endif; ?>
			
				</div> <!-- end #main -->
    
				<?php //get_sidebar(); // sidebar 1 ?>
    
			</div> <!-- end #content -->

<?php get_footer(); ?>