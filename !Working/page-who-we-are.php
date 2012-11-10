<?php
/*
Template Name: Who We Are
*/
?>


<?php get_header(); ?>
			
			<div id="content" class="clearfix row-fluid">
			
				<div id="main" class="span12 clearfix" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
						
						<header>
							
							<div class="page-header"><h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1></div>
						
						</header> <!-- end article header -->
					
						<section class="post_content clearfix" itemprop="articleBody">
							<?php the_content(); ?>
					
						</section> <!-- end article section -->
						
						<footer>
			
							<?php the_tags('<p class="tags"><span class="tags-title">' . __("Tags","bonestheme") . ':</span> ', ', ', '</p>'); ?>
							
						</footer> <!-- end article footer -->
					
					</article> <!-- end article -->
					
					
					<?php endwhile; ?>		
					
					<?php else : ?>
					
					<article id="post-not-found">
					    <header>
					    	<h1><?php _e("Not Found", "bonestheme"); ?></h1>
					    </header>
					    <section class="post_content">
					    	<p><?php _e("Sorry, but the requested resource was not found on this site.", "bonestheme"); ?></p>
					    </section>
					    <footer>
					    </footer>
					</article>
					
					<?php endif; ?>
					
					<div id="line"></div>
					
					<div id="linkswrap">
					
					<div id="cme" class="links">
					
					<div class="colorblock">
					<span class="headingserif"><a id="booth2" target="_blank" href="http://www.chicagobooth.edu/news/2012-04-13-fund-competition.aspx">CME Group 2012 Electronic Trading Challenge</a></span>
					<p>&nbsp;</p>
					<a id="booth2" target="_blank" href="http://www.chicagobooth.edu/news/2012-04-13-fund-competition.aspx"><img class="newsimg" src="http://satellitecap.com/wp-content/themes/satcap/img/chicagobooth.jpg"></a><br />
					</div>
					<img src="http://satellitecap.com/wp-content/themes/satcap/img/cme.png">
					
					
					</div>
					
					<div id="cnbc" class="links">
					<div class="colorblock">
					<span class="headingserif"><a id="booth1" target="_blank" href="http://www.chibus.com/news/competitions/booth-wins-the-cnbc-mba-face-off-million-dollar-portfolio-challenge-1.2736512#.UEvKQKnM_1F">CNBC Million Dollar Portfolio Challenge</a></span>
					<p>&nbsp;</p>
					<a id="booth1" target="_blank" href="http://www.chibus.com/news/competitions/booth-wins-the-cnbc-mba-face-off-million-dollar-portfolio-challenge-1.2736512#.UEvKQKnM_1F"><img class="newsimg" src="http://satellitecap.com/wp-content/themes/satcap/img/chicagobusiness.jpg"></a><br />
					</div>
					<img src="http://satellitecap.com/wp-content/themes/satcap/img/cnbc.png">
					</div>
					</div>
				</div> <!-- end #main -->
    
				    
			</div> <!-- end #content -->
			


<?php get_footer(); ?>

