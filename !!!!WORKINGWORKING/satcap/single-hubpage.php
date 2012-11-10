<?php get_header(); ?>
			
			<div id="content" class="clearfix row-fluid">
			
				<div id="main" class="span8 clearfix" role="main">
					<div class="hub-wrap">
						<div class="hub-header-wrap">
							<div class="client-hub-header">
							<h3>Welcome to your Satellite Capital Client Portal</h3>
							<p>Here you will find links to your Client Page, reports and your messages.</p>
							</div>
						</div>	
							<div class="client-hub-content">
							
							<section class="client-hub" id="client-pages">
							<h5>Your Client Pages</h5><br />
							<?php echo do_shortcode('[wpc_client_pagel][/wpc_client_pagel]'); ?>
							</section>
							<hr>
							
							<section class="client-hub" id="client-files">
							<h5>Your Reports</h5><br />
							<?php echo do_shortcode('[wpc_client_filesla][/wpc_client_filesla]'); ?>
							</section>
							<hr>
							
							<section class="client-hub" id="client-files">
							<h5>Your Messages</h5><br />
							<?php echo do_shortcode('[wpc_client_com][/wpc_client_com]'); ?>
							</section>
							<hr>
							</div>
					</div>		
				</div> <!-- end #main -->
    
				<?php get_sidebar(); // sidebar 1 ?>
    
			</div> <!-- end #content -->

<?php get_footer(); ?>