
jQuery(document).ready(function(){
        jQuery(".show_hide").click(function(){
            if (jQuery(".popup").is(':hidden'))
                jQuery(".popup").show();
            else{
                jQuery(".popup").hide();
            }
            return false;
        });

        jQuery('.popup').click(function(e) {
            e.stopPropagation();
        });
        jQuery(document).click(function() {
            jQuery('.popup').hide();
        });
    });


<script>

jQuery(document).ready(function(){
        jQuery(".show_hide").click(function(){
            if (jQuery(".popup").is(':hidden'))
                jQuery(".popup").show();
            else{
                jQuery(".popup").hide();
            }
            return false;
        });

        jQuery('.popup').click(function(e) {
            e.stopPropagation();
        });
        jQuery(document).click(function() {
            jQuery('.popup').hide();
        });
    });
</script>





/*
jQuery('.show_hide').blur(function(e) {
     if(jQuery(e.target).is('#flash, #flash *'))return;
            jQuery('.popup').slideToggle();
        });
*/


/*
jQuery("body").click
(
  function(e)
  {
    if(e.target.className !== "popup")
    {
      jQuery(".popup").hide();
    }
  }
);
*/


jQuery('.show_hide').qtip({
	content: jQuery('.popup')
});





jQuery('body').click(function() {
    // Hide all hidden content
    jQuery('.popup').hide();
});

//And then provide and exception for when you are clicking on the actually hidden content itself, and when you want to open it:

jQuery('.popup').click(function(e) { e.stopPropagation() });

jQuery('.openHide').click(function(e) {
    jQuery(this).next('.popup').toggle();
    // this stops the event from then being caught by the body click binding
    e.stopPropagation();
});



<script type="text/javascript">
 
jQuery(document).ready(function(){
 
        jQuery(".popup").hide();
        jQuery(".show_hide").show();
 
    jQuery('.show_hide').click(function(){
    jQuery(".popup").slideToggle();
    });
 
});
 
</script>





<a href="#" class="show_hide">Client Login</a>
<div class="ajaxlogin">
<a href="#" class="show_hide">Close</a></div>




<div id="client-login" class="clearfix">
<a href="#" class="show_hide">Client Login</a>
	<div class="popup">
	<?php login_with_ajax() ?>
	<a href="#" class="show_hide">Close</a>	
</div>
</div>




<div id="client-login" class="clearfix">
<a href="#" class="login_btn"><span>Login</span><div class="triangle"></div></a>
                <div id="login_box">
                    <div id="tab"><a href="..." class="login_btn"><span>Login</span><div class="triangle"></div></a></div>
                    <div id="login_box_content">
                    <?php login_with_ajax() ?>
                    </div>
                </div>
</div>



<script>
var mouse_is_inside = false;
 
jQuery(document).ready(function() {
    jQuery(".login_btn").click(function() {
        var loginBox = jQuery("#login_box");
        if (loginBox.is(":visible"))
            loginBox.fadeOut("fast");
        else
            loginBox.fadeIn("fast");
        return false;
    });
 
    jQuery("#login_box").hover(function(){ 
        mouse_is_inside=true; 
    }, function(){ 
        mouse_is_inside=false; 
    });
 
    jQuery("body").click(function(){
        if(! mouse_is_inside) jQuery("#login_box").fadeOut("fast");
    });
});
</script>