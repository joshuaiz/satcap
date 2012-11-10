<?php
/*
Template Name: Humble Test
*/
?>
<script type="text/javascript" src="http://satellitecap.com/js/envision.min.js"></script>

<?php get_header(); ?>
			
			<div id="content" class="clearfix row-fluid">
			
				<div id="main" class="span8 clearfix" role="main">
					<div class="embed-container">
					<section class="chart">
					<script src="https://s3.amazonaws.com/tradingview/tv.js" type="text/javascript"></script>
					<script type="text/javascript">

var tradingview_widget_options = {};
/*
tradingview_widget_options.width = 800;
tradingview_widget_options.height = 500;
*/
tradingview_widget_options.symbol = 'INDEX:SPX';
tradingview_widget_options.interval = 'D';
tradingview_widget_options.toolbar_bg = 'E4E8EB';
tradingview_widget_options.allow_symbol_change = true;
new TradingView.widget(tradingview_widget_options);

</script>
					
					
					
					</section>
					</div>
									</div> <!-- end #main -->
    
				<?php get_sidebar(); // sidebar 1 ?>
    
			</div> <!-- end #content -->

<?php get_footer(); ?>

<script>
function adjustIframes()
{
  jQuery('iframe').each(function(){
    var
    $this       = $(this),
    proportion  = $this.data( 'proportion' ),
    w           = $this.attr('width'),
    actual_w    = $this.width();
    
    if ( ! proportion )
    {
        proportion = $this.attr('height') / w;
        $this.data( 'proportion', proportion );
    }
  
    if ( actual_w != w )
    {
        $this.css( 'height', Math.round( actual_w * proportion ) + 'px' );
    }
  });
}
$(window).on('resize load',adjustIframes);
</script>