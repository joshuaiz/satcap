					
		</div> <!-- end #container -->
	<div id="footer-wrap">
		<div class="container-fluid">
			<footer role="contentinfo">
				
					<div id="inner-footer" class="clearfix">
			          <p>&nbsp;</p>
			          <div id="widget-footer" class="clearfix row-fluid">
			            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer1') ) : ?>
			            <?php endif; ?>
			            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer2') ) : ?>
			            <?php endif; ?>
			            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer3') ) : ?>
			            <?php endif; ?>
			          </div>
						
						<nav class="clearfix">
							<?php bones_footer_links(); // Adjust using Menus in Wordpress Admin ?>
						</nav>
						
						
				
						<p class="attribution">&copy; <?php echo date('Y');?>&nbsp;<?php bloginfo('name'); ?>. All rights reserved.</p>
					
					</div> <!-- end #inner-footer -->
					
				</footer> <!-- end footer -->
		</div><!-- end #container -->
	</div><!-- end .footer-wrap -->

		
		<!-- scripts are now optimized via Modernizr.load -->	
		<script src="<?php echo get_template_directory_uri(); ?>/library/js/scripts.js"></script>
		
		<!--[if lt IE 7 ]>
  			<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
  			<script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
		<![endif]-->
		
		
<script>
jQuery(document).ready(function(){
        jQuery(".showhide").click(function(){
            if (jQuery("#notify").is(':hidden'))
                jQuery("#notify").show();
            else{
                jQuery("#notify").hide();
            }
            return false;
        });

        jQuery('#notify').click(function(e) {
            e.stopPropagation();
        });
        jQuery(document).click(function() {
            jQuery('#notify').hide();
        });
    });
</script>
		
		<?php wp_footer(); // js scripts are inserted using this function ?>
		
		

	</body>

</html>