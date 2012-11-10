<?php
/* Short and sweet */
define('WP_USE_THEMES', false);

global $wpdb, $wpc_client;

$id     = $_GET['id'];
$trusted_integer = (int) $id;
if(!$trusted_integer){
	die( __( 'Invalid file. Please try downloading again!', WPC_CLIENT_TEXT_DOMAIN ) );
}
/*$sql    = "SELECT * FROM ".$wpdb->prefix."wpc_client_files  WHERE id='$id'";
$result = mysql_query($sql);
$line   = mysql_fetch_array($result); */

$line   = $wpdb->get_row($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."wpc_client_files WHERE id = %s",$id), "ARRAY_A");
if(sizeof($line)<=0){
	die( __( 'Invalid file. Please try downloading again!', WPC_CLIENT_TEXT_DOMAIN ) );
}

$access = false;

if ( is_user_logged_in() ) {

    if ( current_user_can( 'wpc_client_staff' ) && !current_user_can( 'manage_network_options' ) )
        $user_id = get_user_meta(  $current_user->ID, 'parent_client_id', true );
    else
        $user_id = $current_user->ID;

    //checking access for file
    if( current_user_can( 'administrator' ) || current_user_can( 'wpc_manager' ) ) {
        //access for admin
        $access = true;
    } elseif ( $line['user_id'] == $user_id ) {
        //access for file owner
        $access = true;
    } else {
        //access for other clients
        $clients_id = explode( ',', str_replace( '#', '', $line['clients_id'] ) );
        if ( is_array( $clients_id ) && in_array( $user_id, $clients_id) ) {
            $access = true;
        } else {
            //access for clients in groups
            $groups_id = explode( ',', str_replace( '#', '', $line['groups_id'] ) );
            if (is_array( $groups_id ) && 0 < count( $groups_id ) ) {
                foreach( $groups_id as $group_id ) {
                    $clients_id = $wpc_client->get_group_clients_id( $group_id );
                    if ( is_array( $clients_id ) && in_array( $user_id, $clients_id) ) {
                        $access = true;
                        break;
                    }
                }
            }
        }
    }

}

if( $access ) {
    $uploads        = wp_upload_dir();
    $target_path    = $uploads['basedir'] . "/wpclient/$line[filename]";


    header("Content-type: application/octet-stream");
    header("Content-Disposition: attachment; filename=\"$line[name]\"");
    ob_clean();
    flush();

    readfile( $target_path );
} else {
    die( __( 'You do not have access to this file!', WPC_CLIENT_TEXT_DOMAIN ) );
}
exit;
?>