<?php

//value for $user_id - from wpc_client_shortcode_comments() function

ob_start();

if(isset($_POST['submit'])) {


    $sent_from  = get_current_user_id();

    $sent_to    = get_user_meta( $user_id, 'admin_manager', true );
    if ( 1 > $sent_to )
        $sent_to = 0;

    $wpdb->query( $wpdb->prepare(
        "INSERT INTO {$wpdb->base_prefix}wpc_client_comments SET user_id = %d, page_id = %d, time=%d, comment='%s', sent_from=%d, sent_to=%d, new_flag=1"
        , $user_id
        , $post->ID
        , time()
        , $_POST['comment']
        , $sent_from
        , $sent_to
    ) );

    $notify_message = get_option("wpc_notify_message");

    if($notify_message == "yes") {
        $sender_name    = get_option("sender_name");
        $sender_email   = get_option("sender_email");
        $nickname       = get_user_meta($current_user->ID, 'first_name', true);
        $admin_url      = get_admin_url() . "admin.php?page=wpclients_messages&user_id=" . $sent_from . "&from_id=" . $sent_from . "&to_id=" . $sent_to;

        $headers = "From: " . get_option("sender_name") . " <" . get_option("sender_email") . "> \r\n";
        $headers .= "Reply-To: " . get_option("admin_email") . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

        //get email template
        $wpc_templates = get_option( 'wpc_templates' );

        $subject = str_replace('{user_name}',  $username, $wpc_templates['emails']['notify_admin_about_message']['subject'] );
        $subject = str_replace('{site_title}',   get_bloginfo('name'), $subject );

        $message = stripslashes( $wpc_templates['emails']['notify_admin_about_message']['body'] );
        $message = str_replace('{user_name}',  $username, $message );
        $message = str_replace('{message}',  nl2br( htmlspecialchars( $_POST['comment'] ) ), $message );
        $message = str_replace('{admin_url}', $admin_url, $message );

        //send notify
        $manager_id = get_user_meta( $user_id, 'admin_manager', true );
        if ( 0 < $manager_id ) {
            //send notify message to client manager
            $manager_email = get_userdata( $manager_id )->get( 'user_email' );
            wp_mail( $manager_email, $subject, $message, $headers );
        } else {
            //send notify message to admin
            wp_mail( get_option('admin_email'), $subject, $message, $headers );
        }



    }

    do_action( 'wp_client_redirect', wpc_client_get_hub_link() );
}




//Set date format
if ( get_option( 'date_format' ) ) {
    $time_format = get_option( 'date_format' );
} else {
    $time_format = 'm/d/Y';
}
if ( get_option( 'time_format' ) ) {
    $time_format .= ' ' . get_option( 'time_format' );
} else {
    $time_format .= ' g:i:s A';
}



$messages = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM {$wpdb->base_prefix}wpc_client_comments WHERE user_id=%d ORDER BY time DESC ", $user_id ), "ARRAY_A" );


?>

<form action="" method="post" class="wpc_client_message_form">
    <textarea style="width: 90%;" name="comment" placeholder="<?php _e( 'Type your private message here', WPC_CLIENT_TEXT_DOMAIN ) ?>"></textarea>
    <div style="clear: both; height:10px;"></div>
    <input type="submit" name="submit" id="submit" class='button-primary' value="<?php _e( 'Send private message', WPC_CLIENT_TEXT_DOMAIN ) ?>"/>
</form>


<table class="wpc_client_messages">
    <?php
    if ( is_array( $messages ) && 0 < count( $messages ) )
        foreach ( $messages as $message ) {
    ?>
    <tr>
        <td>
        <span class="wpc_client_message_time">
            <?php echo $wpc_client->date_timezone( $time_format, $message['time']); ?>
        </span>
        -
        <span class="wpc_client_message_author">
            <strong>
            <?php
            if ( $current_user->ID == $message['sent_from'] )
                _e( 'You', WPC_CLIENT_TEXT_DOMAIN );
            elseif ( 0 == $message['sent_from'] )
                _e( 'Administrator', WPC_CLIENT_TEXT_DOMAIN );
            else
                echo get_user_meta( $message['sent_from'], 'nickname', true );
            ?>
            </strong>
        </span>
        </td>
    </tr>
    <tr>
        <td>
            <span class="wpc_client_message"><?php echo $text1 = nl2br( htmlspecialchars( $message['comment'] ) ); ?></span>
        </td>
    </tr>
    <?php
    }
    ?>
</table>

<?php

$out2 = ob_get_contents();

ob_end_clean();

return $out2;

?>