<?php

if(isset($_POST['update_settings1'])) {
    update_option("hub_template",$_POST['hub_template']);
    echo '<div id="message" class="updated fade"><p> '. __( 'Settings updated Successfully.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>';
}

if(isset($_POST['update_settings2'])) {
    update_option("client_template",$_POST['client_template']);
    echo '<div id="message" class="updated fade"><p>' . __( 'Settings updated Successfully.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>';

}

if ( isset( $_POST['update_settings3']) ) {
    update_option('sender_name',$_POST['sender_name']);
    update_option('sender_email',$_POST['sender_email']);
    update_option( 'wpc_templates', $_POST['wpc_templates'] );


    //do_action( "wp_settings_update", $_POST['settings );
    echo '<div id="message" class="updated fade"><p>' . __( 'Settings updated Successfully.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>';
}

$wpc_templates      = get_option( 'wpc_templates' );

$hub_template       = get_option("hub_template");
$client_template    = get_option("client_template");

$hub_template       = html_entity_decode($hub_template);
$client_template    = html_entity_decode($client_template);

$sender_name        = get_option("sender_name");
$sender_email       = get_option("sender_email");

?>

<style type="text/css">
    input[type="text"]{
        width: 800px!important;
    }
    .clear{
        clear: both;
        height: 0;
        visibility: hidden;
        display: block;
    }
    a{
        text-decoration: none;
    }
    /******* GENERAL RESET *******/

    /******* MENU *******/
    #container23{

        width: 99%;
    }
    #container23 ul{
        list-style: none;
        list-style-position: outside;
    }
    #container23 ul.menu li{
        float: left;
        margin-right: 5px;
        margin-bottom: -1px;
    }
    #container23 ul.menu li{
        font-weight: 700;
        display: block;
        padding: 5px 10px 5px 10px;
        background: #efefef;
        margin-bottom: -1px;
        border: 1px solid #d0ccc9;
        border-width: 1px 1px 1px 1px;
        position: relative;
        color: #898989;
        cursor: pointer;
    }
    #container23 ul.menu li.active{
        background: #fff;
        top: 1px;
        border-bottom: 0;
        color: #5f95ef;
    }
    /******* /MENU *******/
    /******* CONTENT *******/
    .content23{
        margin: 0pt auto;
        background: #efefef;
        background: #fff;
        border: 1px solid #d0ccc9;
        text-align: left;
        padding: 10px;
        padding-bottom: 20px;
        font-size: 11px;
    }
    .content23 h1{
        line-height: 1em;
        vertical-align: middle;
        height: 48px;
        padding: 10px 10px 10px 52px;
        font-size: 32px;
    }
    /******* /CONTENT *******/
    /******* NEWS *******/
    .content23.news h1{
        background: transparent url(images/news.jpg) no-repeat scroll left top;
    }
    .content23.news{
        display: block;
    }
    /******* /NEWS *******/
    /******* TUTORIALS *******/
    .content23.tutorials h1{
        background: transparent url(images/tuts.jpg) no-repeat scroll left top;
    }
    .content23.tutorials{
        display: none;
    }
    /******* /TUTORIALS *******/
    /******* LINKS *******/
    .content23.links h1{
        background: transparent url(images/links.jpg) no-repeat scroll left top;
    }
    .content23.links{
        display: none;
    }
    .content23.links a{
        color: #5f95ef;
    }
    /******* /LINKS *******/
</style>

<script type="text/javascript" language="javascript">

    jQuery(document).ready(function(){
        jQuery(".menu > li").click(function(e){
            switch(e.target.id){
                case "news":
                    //change status & style menu
                    jQuery("#news").addClass("active");
                    jQuery("#tutorials").removeClass("active");
                    jQuery("#links").removeClass("active");
                    //display selected division, hide others
                    jQuery("div.news").fadeIn();
                    jQuery("div.tutorials").css("display", "none");
                    jQuery("div.links").css("display", "none");
                break;
                case "tutorials":
                    //change status & style menu
                    jQuery("#news").removeClass("active");
                    jQuery("#tutorials").addClass("active");
                    jQuery("#links").removeClass("active");
                    //display selected division, hide others
                    jQuery("div.tutorials").fadeIn();
                    jQuery("div.news").css("display", "none");
                    jQuery("div.links").css("display", "none");
                break;
                case "links":
                    //change status & style menu
                    jQuery("#news").removeClass("active");
                    jQuery("#tutorials").removeClass("active");
                    jQuery("#links").addClass("active");
                    //display selected division, hide others
                    jQuery("div.links").fadeIn();
                    jQuery("div.news").css("display", "none");
                    jQuery("div.tutorials").css("display", "none");
                break;
            }
            //alert(e.target.id);
            return false;
        });
    });

</script>

<div class="wpc_logo"></div>
<hr />

<div class="clear"></div>

<div id="container23">

    <ul class="menu">
        <li id="news" class="active"><?php _e( 'Hub Page Templates', WPC_CLIENT_TEXT_DOMAIN ) ?></li>
        <li id="tutorials"><?php _e( 'Client Page Templates', WPC_CLIENT_TEXT_DOMAIN ) ?></li>
        <li id="links"><?php _e( 'Email Templates', WPC_CLIENT_TEXT_DOMAIN ) ?></li>
    </ul>
    <span class="clear"></span>

    <div class="content23 news">
        <!-- HUB PAGE TEMPLATES -->
        <style type="text/css">
        .wrap input[type=text] {
            width:400px;
        }
        .wrap input[type=password] {
            width:400px;
        }
        </style>

        <div class='wrap'>
            <div class="icon32" id="icon-link-manager"></div>
            <h2><?php _e( 'Hub Page Template', WPC_CLIENT_TEXT_DOMAIN ) ?></h2>
            <p><?php _e( 'From here you can edit the template of the newly created hub pages.', WPC_CLIENT_TEXT_DOMAIN ) ?></p>

            <form action="" method="post">
                <h4>
                    <div style="float: left;"><label for="hub_template"><?php _e( 'New hub page template', WPC_CLIENT_TEXT_DOMAIN ) ?>:&nbsp;</label></div>
                </h4>

                <?php wp_print_scripts( 'quicktags' ); ?>

                <script type="text/javascript">edToolbar();</script>

                <textarea id="hub_template" name="hub_template" rows="10" cols="150"><?php echo stripslashes($hub_template);?></textarea><br/>

                <br /><br />

                <input type='submit' name='update_settings1' id="update_settings1" class='button-primary' value='<?php _e( 'Update', WPC_CLIENT_TEXT_DOMAIN ) ?>' />
            </form>
        </div>
        <!--END HUB PAGE TEMPLATES -->
    </div>


    <div class="content23 tutorials">

        <div class='wrap'>
            <div class="icon32" id="icon-link-manager"></div>
            <h2><?php _e( 'Client Page Template', WPC_CLIENT_TEXT_DOMAIN ) ?></h2>
            <p><?php _e( 'From here you can edit the template of the newly created client pages.', WPC_CLIENT_TEXT_DOMAIN ) ?></p>

            <form action="" method="post">
                <h4>
                    <div style="float: left;"><label for="client_template"><?php _e( 'New client page template', WPC_CLIENT_TEXT_DOMAIN ) ?>:&nbsp;</label></div>
                </h4>

                <?php wp_print_scripts( 'quicktags' ); ?>

                <script type="text/javascript">edToolbar();</script>

                <textarea id="client_template" name="client_template" rows="10" cols="150"><?php echo stripslashes($client_template);?></textarea><br/>

                <br /><br />

                <input type='submit' name='update_settings2' id="update_settings2" class='button-primary' value='<?php _e( 'Update', WPC_CLIENT_TEXT_DOMAIN ) ?>' />
            </form>
        </div>
    </div>


    <div class="content23 links">

        <div class='wrap'>
            <div class="icon32" id="icon-link-manager"></div>
            <h2><?php _e( 'WP Client Emails Settings', WPC_CLIENT_TEXT_DOMAIN ) ?></h2>
            <p><?php _e( 'From here you can edit the emails templates and settings.', WPC_CLIENT_TEXT_DOMAIN ) ?></p>

            <form action="" method="post">
                <div class="postbox">
                    <h3 class='hndle'><span><?php _e( 'Sender Information', WPC_CLIENT_TEXT_DOMAIN ) ?></span></h3>
                    <div class="inside">
                        <table class="form-table">
                            <tr valign="top">
                                <th scope="row">
                                    <label for="sender_name"><?php _e( 'Sender Name', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                                </th>
                                <td>
                                    <input type="text" name="sender_name" id="sender_name" value="<?php echo $sender_name; ?>" />
                                </td>
                            </tr>

                            <tr valign="top">
                                <th scope="row">
                                    <label for="sender_email"><?php _e( 'Sender Email', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                                </th>
                                <td>
                                    <input type="text" name="sender_email" id="sender_email" value="<?php echo $sender_email; ?>" />
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>


                <div class="postbox">
                    <h3 class='hndle'><span><?php _e( 'New Client Created by Admin', WPC_CLIENT_TEXT_DOMAIN ) ?></span></h3>
                    <span class="description"><?php _e( 'This email will be sent to Client (if checked "Send Password")', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                    <div class="inside">
                        <table class="form-table">
                            <tr valign="top">
                                <th scope="row">
                                    <label for="wpc_templates_new_client_password_subject"><?php _e( 'Email Subject', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                                </th>
                                <td>
                                    <input type="text" size="80" name="wpc_templates[emails][new_client_password][subject]" id="wpc_templates_new_client_password_subject" value="<?php echo $wpc_templates['emails']['new_client_password']['subject']; ?>" />
                                </td>
                            </tr>

                            <tr valign="top">
                                <th scope="row">
                                    <label for="wpc_templates_new_client_password_body"><?php _e( 'Email Body', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                                </th>
                                <td>
                                    <?php wp_print_scripts( 'quicktags' ); ?>
                                    <script type="text/javascript">edToolbar();</script>
                                    <textarea id="wpc_templates_new_client_password_body" name="wpc_templates[emails][new_client_password][body]" rows="10" cols="150"><?php echo stripslashes($wpc_templates['emails']['new_client_password']['body']);?></textarea><br/>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>


                <div class="postbox">
                    <h3 class='hndle'><span><?php _e( 'Client Password Updated', WPC_CLIENT_TEXT_DOMAIN ) ?></span></h3>
                    <span class="description"><?php _e( 'This email will be sent to Client (if checked "Send Password")', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                    <div class="inside">
                        <table class="form-table">
                            <tr valign="top">
                                <th scope="row">
                                    <label for="wpc_templates_client_updated_subject"><?php _e( 'Email Subject', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                                </th>
                                <td>
                                    <input type="text" name="wpc_templates[emails][client_updated][subject]" id="wpc_templates_client_updated_subject" value="<?php echo $wpc_templates['emails']['client_updated']['subject']; ?>" />
                                </td>
                            </tr>

                            <tr valign="top">
                                <th scope="row">
                                    <label for="wpc_templates_new_client_password_body"><?php _e( 'Email Body', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                                </th>
                                <td>
                                    <?php wp_print_scripts( 'quicktags' ); ?>
                                    <script type="text/javascript">edToolbar();</script>
                                    <textarea id="wpc_templates_client_updated_body" name="wpc_templates[emails][client_updated][body]" rows="10" cols="150"><?php echo stripslashes($wpc_templates['emails']['client_updated']['body']);?></textarea><br/>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>


                <div class="postbox">
                    <h3 class='hndle'><span><?php _e( 'New Client registers using Self-Registration Form', WPC_CLIENT_TEXT_DOMAIN ) ?></span></h3>
                    <span class="description"><?php _e( 'This email will be sent to Admin after a new Client registers with client registration form', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                    <div class="inside">
                        <table class="form-table">
                            <tr valign="top">
                                <th scope="row">
                                    <label for="wpc_templates_new_client_registered_subject"><?php _e( 'Email Subject', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                                </th>
                                <td>
                                    <input type="text" name="wpc_templates[emails][new_client_registered][subject]" id="wpc_templates_new_client_registered_subject" value="<?php echo $wpc_templates['emails']['new_client_registered']['subject']; ?>" />
                                    <br>
                                    <script type="text/javascript">var edCanvas = document.getElementById('wpc_templates_new_client_registered_subject');</script>

                                </td>
                            </tr>

                            <tr valign="top">
                                <th scope="row">
                                    <label for="wpc_templates_new_client_registered_body"><?php _e( 'Email Body', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                                </th>
                                <td>

                                    <script type="text/javascript">edToolbar();</script>
                                    <textarea id="wpc_templates_new_client_registered_body" name="wpc_templates[emails][new_client_registered][body]" rows="10" cols="150"><?php echo stripslashes( $wpc_templates['emails']['new_client_registered']['body'] );?></textarea><br/>
                                    <span class="description"><?php _e( '{site_title} and {approve_url} will not be change as these placeholders will be used in the email.', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                                    <script type="text/javascript">var edCanvas = document.getElementById('wpc_templates_new_client_registered_body');</script>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>


                <div class="postbox">
                    <h3 class='hndle'><span><?php _e( 'Staff Created by website Admin', WPC_CLIENT_TEXT_DOMAIN ) ?></span></h3>
                    <span class="description"><?php _e( 'This email will be sent to Staff (if checked "Send Password")', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                    <div class="inside">
                        <table class="form-table">
                            <tr valign="top">
                                <th scope="row">
                                    <label for="wpc_templates_staff_created_subject"><?php _e( 'Email Subject', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                                </th>
                                <td>
                                    <input type="text" name="wpc_templates[emails][staff_created][subject]" id="wpc_templates_staff_created_subject" value="<?php echo $wpc_templates['emails']['staff_created']['subject']; ?>" />
                                </td>
                            </tr>

                            <tr valign="top">
                                <th scope="row">
                                    <label for="wpc_templates_staff_created_body"><?php _e( 'Email Body', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                                </th>
                                <td>
                                    <?php wp_print_scripts( 'quicktags' ); ?>
                                    <script type="text/javascript">edToolbar();</script>
                                    <textarea id="wpc_templates_staff_created_body" name="wpc_templates[emails][staff_created][body]" rows="10" cols="150"><?php echo stripslashes($wpc_templates['emails']['staff_created']['body']);?></textarea><br/>
                                    <span class="description"><?php _e( '{contact_name}, {user_name}, {password} and {admin_url} will not be changed as these placeholders will be used in the email.', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>


                <div class="postbox">
                    <h3 class='hndle'><span><?php _e( 'Staff Registered by Client', WPC_CLIENT_TEXT_DOMAIN ) ?></span></h3>
                    <span class="description"><?php _e( 'This email will be sent to Staff after Client registered him (if checked "Send Password")', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                    <div class="inside">
                        <table class="form-table">
                            <tr valign="top">
                                <th scope="row">
                                    <label for="wpc_templates_staff_registered_subject"><?php _e( 'Email Subject', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                                </th>
                                <td>
                                    <input type="text" name="wpc_templates[emails][staff_registered][subject]" id="wpc_templates_staff_registered_subject" value="<?php echo $wpc_templates['emails']['staff_registered']['subject']; ?>" />
                                </td>
                            </tr>

                            <tr valign="top">
                                <th scope="row">
                                    <label for="wpc_templates_staff_created_body"><?php _e( 'Email Body', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                                </th>
                                <td>
                                    <?php wp_print_scripts( 'quicktags' ); ?>
                                    <script type="text/javascript">edToolbar();</script>
                                    <textarea id="wpc_templates_staff_registered_body" name="wpc_templates[emails][staff_registered][body]" rows="10" cols="150"><?php echo stripslashes($wpc_templates['emails']['staff_registered']['body']);?></textarea><br/>
                                    <span class="description"><?php _e( '{contact_name}, {user_name}, {password} and {admin_url} will not be changed as these placeholders will be used in the email.', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>


                <div class="postbox">
                    <h3 class='hndle'><span><?php _e( 'Manager Created', WPC_CLIENT_TEXT_DOMAIN ) ?></span></h3>
                    <span class="description"><?php _e( 'This email will be sent to Manager (if checked "Send Password")', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                    <div class="inside">
                        <table class="form-table">
                            <tr valign="top">
                                <th scope="row">
                                    <label for="wpc_templates_manager_created_subject"><?php _e( 'Email Subject', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                                </th>
                                <td>
                                    <input type="text" name="wpc_templates[emails][manager_created][subject]" id="wpc_templates_manager_created_subject" value="<?php echo $wpc_templates['emails']['manager_created']['subject']; ?>" />
                                </td>
                            </tr>

                            <tr valign="top">
                                <th scope="row">
                                    <label for="wpc_templates_manager_created_body"><?php _e( 'Email Body', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                                </th>
                                <td>
                                    <?php wp_print_scripts( 'quicktags' ); ?>
                                    <script type="text/javascript">edToolbar();</script>
                                    <textarea id="wpc_templates_manager_created_body" name="wpc_templates[emails][manager_created][body]" rows="10" cols="150"><?php echo stripslashes($wpc_templates['emails']['manager_created']['body']);?></textarea><br/>
                                    <span class="description"><?php _e( '{contact_name}, {user_name}, {password} and {admin_url} will not be changed as these placeholders will be used in the email.', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>


                <div class="postbox">
                    <h3 class='hndle'><span><?php _e( 'Client Page Updated ', WPC_CLIENT_TEXT_DOMAIN ) ?></span></h3>
                    <span class="description"><?php _e( 'This email will be sent to Client (if checked "Send Update to selected Client(s)") when Client Page updating', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                    <div class="inside">
                        <table class="form-table">
                            <tr valign="top">
                                <th scope="row">
                                    <label for="wpc_templates_client_page_updated_subject"><?php _e( 'Email Subject', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                                </th>
                                <td>
                                    <input type="text" name="wpc_templates[emails][client_page_updated][subject]" id="wpc_templates_client_page_updated_subject" value="<?php echo $wpc_templates['emails']['client_page_updated']['subject']; ?>" />
                                    <br>
                                    <span class="description"><?php _e( '{contact_name}, {user_name}, {password} and {page_id} will not be changed as these placeholders will be used in the email.', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                                    <script type="text/javascript">var edCanvas = document.getElementById('wpc_templates_client_page_updated_subject');</script>

                                </td>
                            </tr>

                            <tr valign="top">
                                <th scope="row">
                                    <label for="wpc_templates_client_page_updated_body"><?php _e( 'Email Body', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                                </th>
                                <td>

                                    <script type="text/javascript">edToolbar();</script>
                                    <textarea id="wpc_templates_client_page_updated_body" name="wpc_templates[emails][client_page_updated][body]" rows="10" cols="150"><?php echo stripslashes( $wpc_templates['emails']['client_page_updated']['body'] );?></textarea><br/>
                                    <span class="description"><?php _e( '{contact_name} and {page_id} will not be change as these placeholders will be used in the email.', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                                    <script type="text/javascript">var edCanvas = document.getElementById('wpc_templates_client_page_updated_body');</script>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>


                <div class="postbox">
                    <h3 class='hndle'><span><?php _e( 'Admin uploads new file for Client', WPC_CLIENT_TEXT_DOMAIN ) ?></span></h3>
                    <span class="description"><?php _e( 'This email will be sent to Client and his Staff when Admin or Manager will upload new file for Client.', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                    <div class="inside">
                        <table class="form-table">
                            <tr valign="top">
                                <th scope="row">
                                    <label for="wpc_templates_new_file_for_client_staff_subject"><?php _e( 'Email Subject', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                                </th>
                                <td>
                                    <input type="text" name="wpc_templates[emails][new_file_for_client_staff][subject]" id="wpc_templates_new_file_for_client_staff_subject" value="<?php echo $wpc_templates['emails']['new_file_for_client_staff']['subject']; ?>" />
                                    <br>
                                    <script type="text/javascript">var edCanvas = document.getElementById('wpc_templates_new_file_for_client_staff_subject');</script>

                                </td>
                            </tr>

                            <tr valign="top">
                                <th scope="row">
                                    <label for="wpc_templates_new_file_for_client_staff_body"><?php _e( 'Email Body', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                                </th>
                                <td>

                                    <script type="text/javascript">edToolbar();</script>
                                    <textarea id="wpc_templates_new_file_for_client_staff_body" name="wpc_templates[emails][new_file_for_client_staff][body]" rows="10" cols="150"><?php echo stripslashes( $wpc_templates['emails']['new_file_for_client_staff']['body'] );?></textarea><br/>
                                    <span class="description"><?php _e( '{site_title} and {login_url} will not be change as these placeholders will be used in the email.', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                                    <script type="text/javascript">var edCanvas = document.getElementById('wpc_templates_new_file_for_client_staff_body');</script>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>


                <div class="postbox">
                    <h3 class='hndle'><span><?php _e( 'Client Uploads new file', WPC_CLIENT_TEXT_DOMAIN ) ?></span></h3>
                    <span class="description"><?php _e( "This email will be sent to Admin and Client's Manager when Client will upload file(s)", WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                    <div class="inside">
                        <table class="form-table">
                            <tr valign="top">
                                <th scope="row">
                                    <label for="wpc_templates_client_uploaded_file_subject"><?php _e( 'Email Subject', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                                </th>
                                <td>
                                    <input type="text" name="wpc_templates[emails][client_uploaded_file][subject]" id="wpc_templates_client_uploaded_file_subject" value="<?php echo $wpc_templates['emails']['client_uploaded_file']['subject']; ?>" />
                                    <br>
                                    <script type="text/javascript">var edCanvas = document.getElementById('wpc_templates_client_uploaded_file_subject');</script>

                                </td>
                            </tr>

                            <tr valign="top">
                                <th scope="row">
                                    <label for="wpc_templates_client_uploaded_file_body"><?php _e( 'Email Body', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                                </th>
                                <td>

                                    <script type="text/javascript">edToolbar();</script>
                                    <textarea id="wpc_templates_client_uploaded_file_body" name="wpc_templates[emails][client_uploaded_file][body]" rows="10" cols="150"><?php echo stripslashes( $wpc_templates['emails']['client_uploaded_file']['body'] );?></textarea><br/>
                                    <span class="description"><?php _e( '{user_name}, {site_title} and {admin_file_url} will not be change as these placeholders will be used in the email.', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                                    <script type="text/javascript">var edCanvas = document.getElementById('wpc_templates_client_uploaded_file_body');</script>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>


                <div class="postbox">
                    <h3 class='hndle'><span><?php _e( 'Private Message: Notify Message To Client', WPC_CLIENT_TEXT_DOMAIN ) ?></span></h3>
                    <span class="description"><?php _e( 'This email will be sent to Client when Admin/Manager sent private message (if selected option "Receive email notification of private messages from admin" in plugin settings).', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                    <div class="inside">
                        <table class="form-table">
                            <tr valign="top">
                                <th scope="row">
                                    <label for="wpc_templates_notify_client_about_message_subject"><?php _e( 'Email Subject', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                                </th>
                                <td>
                                    <input type="text" name="wpc_templates[emails][notify_client_about_message][subject]" id="wpc_templates_notify_client_about_message_subject" value="<?php echo $wpc_templates['emails']['notify_client_about_message']['subject']; ?>" />
                                    <br>
                                    <script type="text/javascript">var edCanvas = document.getElementById('wpc_templates_notify_client_about_message_subject');</script>

                                </td>
                            </tr>

                            <tr valign="top">
                                <th scope="row">
                                    <label for="wpc_templates_notify_client_about_message_body"><?php _e( 'Email Body', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                                </th>
                                <td>

                                    <script type="text/javascript">edToolbar();</script>
                                    <textarea id="wpc_templates_notify_client_about_message_body" name="wpc_templates[emails][notify_client_about_message][body]" rows="10" cols="150"><?php echo stripslashes( $wpc_templates['emails']['notify_client_about_message']['body'] );?></textarea><br/>
                                    <span class="description"><?php _e( '{user_name}, {site_title} and {login_url} will not be change as these placeholders will be used in the email.', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                                    <script type="text/javascript">var edCanvas = document.getElementById('wpc_templates_notify_client_about_message_body');</script>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>


                <div class="postbox">
                    <h3 class='hndle'><span><?php _e( 'Private Message: Notify Message To Admin/Manager', WPC_CLIENT_TEXT_DOMAIN ) ?></span></h3>
                    <span class="description"><?php _e( 'This email will be sent to Admin/Manager when Client sent private message (if selected option "Receive email notification of private messages from clients" in plugin settings).', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                    <div class="inside">
                        <table class="form-table">
                            <tr valign="top">
                                <th scope="row">
                                    <label for="wpc_templates_notify_admin_about_message_subject"><?php _e( 'Email Subject', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                                </th>
                                <td>
                                    <input type="text" name="wpc_templates[emails][notify_admin_about_message][subject]" id="wpc_templates_notify_admin_about_message_subject" value="<?php echo $wpc_templates['emails']['notify_admin_about_message']['subject']; ?>" />
                                    <br>
                                    <script type="text/javascript">var edCanvas = document.getElementById('wpc_templates_notify_admin_about_message_subject');</script>

                                </td>
                            </tr>

                            <tr valign="top">
                                <th scope="row">
                                    <label for="wpc_templates_notify_admin_about_message_body"><?php _e( 'Email Body', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                                </th>
                                <td>

                                    <script type="text/javascript">edToolbar();</script>
                                    <textarea id="wpc_templates_notify_admin_about_message_body" name="wpc_templates[emails][notify_admin_about_message][body]" rows="10" cols="150"><?php echo stripslashes( $wpc_templates['emails']['notify_admin_about_message']['body'] );?></textarea><br/>
                                    <span class="description"><?php _e( '{user_name}, {site_title}, {message} and {login_url} will not be change as these placeholders will be used in the email.', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                                    <script type="text/javascript">var edCanvas = document.getElementById('wpc_templates_notify_admin_about_message_body');</script>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <input type='submit' name='update_settings3' id="update_settings3" class='button-primary' value='<?php _e( 'Update', WPC_CLIENT_TEXT_DOMAIN ) ?>' />
            </form>
        </div>
    </div>

</div>