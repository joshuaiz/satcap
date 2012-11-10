<?php
global $wpdb;
$page_slug  = 'wpclients';
$edit_slug  = 'edit_client';
$msg = "";

if( isset($_GET['msg'] ))
{
  $msg = $_GET['msg'];
}

if ( isset( $_POST['import'] ) ) {
    $target_path = wp_upload_dir();;
    $target_path = $target_path['basedir']."/";
    $target_path = $target_path . basename( $_FILES['file']['name']);
	$ext = strtolower(end(explode('.', $_FILES['file']['name'])));

	if($ext === 'csv')
	{
		if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path))
		{
			$row = 1;
			if (($handle = fopen($target_path, "r")) !== FALSE)
			{
				while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
				{
					$row++;
					$userdata = array(
						'user_login' => esc_attr( trim( $data[0] ) ),
						'user_pass' => esc_attr ( $data[1] ),
						'nickname' => esc_attr( trim( $data[2] ) ),
						'first_name' => esc_attr( trim( $data[3] ) ),
						'user_email' => esc_attr( $data[4] ),
						'role' => 'wpc_client',
						'contact_phone' => esc_attr( $data[5] ),
						'send_password' => esc_attr( $data[6] ),
					);
					do_action('wp_clients_update', $userdata );
				}
				fclose($handle);
			}
			else
			{
				$msg = "uf";
			}
		}
		else
		{
			$msg = "uf";
		}
	}
	else
	{
		$msg = "uf";
	}
}


//to delete client
if ( isset( $_GET['action'] ) && 'delete' == $_GET['action'] ) {
	$client_id  = $_GET['id'];
	$t_name     = $wpdb->prefix . "wpc_client_login_redirects";
	$user_data  = get_userdata( $client_id );

    //delete redirect rules for client
    //$wpdb->query( "DELETE FROM $t_name WHERE rul_value='" . $user_data->user_login . "'" );
	 $wpdb->query($wpdb->prepare("DELETE FROM $t_name WHERE rul_value=%s",$user_data->user_login));

    //find client files and remome access
    $files = $wpdb->get_results($wpdb->prepare("SELECT * FROM {$wpdb->base_prefix}wpc_client_files WHERE clients_id LIKE '%#$client_id,%'"), "ARRAY_A" );
    if ( is_array( $files ) && 0 < count( $files ) ) {
        foreach( $files as $file ) {
            $new_access = str_replace( "#$client_id,", '', $file['clients_id'] );
            $wpdb->query( $wpdb->prepare( "UPDATE {$wpdb->base_prefix}wpc_client_files SET clients_id='%s' WHERE id=%d ", $new_access, $file['id'] ) );
        }
    }

    //delete client from group
    $wpdb->query( $wpdb->prepare( "DELETE FROM {$wpdb->base_prefix}wpc_client_group_clients WHERE client_id=%d ", $client_id ) );


    //get client's clientpages
    $clientpages_id = $wpdb->get_results($wpdb->prepare(
        "SELECT $wpdb->posts.ID FROM $wpdb->posts
        INNER JOIN $wpdb->postmeta ON $wpdb->postmeta.post_id = $wpdb->posts.ID
        WHERE
        $wpdb->posts.post_type = 'clientspage' AND
        $wpdb->postmeta.meta_key = 'user_ids' AND
        $wpdb->postmeta.meta_value like '%\"$client_id\"%'
        ")
    );

    //remove access for clientpages
    if ( is_array( $clientpages_id ) && 0 < count( $clientpages_id ) ) {
        foreach( $clientpages_id as $clientpage_id ) {
            $user_ids = get_post_meta( $clientpage_id->ID, 'user_ids', true );
            $user_ids = array_flip( $user_ids );
            unset( $user_ids[$client_id] );
            $user_ids = array_flip( $user_ids );
            update_post_meta( $clientpage_id->ID, 'user_ids', $user_ids );
        }
    }

    //unassign staff
    $args = array(
            'role'          => 'wpc_client_staff',
            'meta_key'      => 'parent_client_id',
            'meta_value'    => $client_id,
            'fields'        => 'ID',
        );

    $client_staff_ids = get_users( $args );
    if ( is_array( $client_staff_ids ) && 0 < count( $client_staff_ids ) )
        foreach( $client_staff_ids as $client_staff_id ) {
            update_user_meta( $client_staff_id, 'parent_client_id', '' );
        }

    //delete HUB
    $user = get_user_meta( $client_id, 'first_name' );
    $page = get_page_by_title( $user[0], object, 'hubpage' );
    if ( isset( $page->ID ) )
        wp_delete_post( $page->ID );


    //delete client
	wp_delete_user( $client_id );

    //do_action('wp_client_redirect', get_admin_url(). 'admin.php?page=wpclients&msg=d');
    //exit;
	$msg = "d";
}

if ( !class_exists( 'pagination' ) )
    include_once( 'pagination.php' );

$items = count_users();
$items = ( isset( $items['avail_roles']['wpc_client'] ) ) ? $items['avail_roles']['wpc_client'] : 0;

$p = new pagination;
$p->items($items);
$p->limit(25);
$p->target("admin.php?page=$page_slug");
$p->calculate();
$p->parameterName('p');
$p->adjacents(2);

if(!isset($_GET['p'])) {
	$p->page = 1;
} else {
	$p->page = $_GET['p'];
}


$not_approved_clients = get_users( array( 'role' => 'wpc_client', 'meta_key' => 'to_approve', 'fields' => 'ID', ) );


$args = array(
    'role'      => 'wpc_client',
    'orderby'   => 'ID',
    'order'     => 'ASC',
    'exclude'   => $not_approved_clients,
    'offset'    => ($p->page - 1) * $p->limit,
    'number'    => $p->limit,

);

$rows = get_users( $args );

?>

<div style="" class='wrap'>

    <script type="text/javascript">
        jQuery(document).ready(function(){

	        jQuery(".over").hover(function(){
		        jQuery(this).css("background-color","#bcbcbc");
		        },function(){
		        jQuery(this).css("background-color","transparent");
		    });

        });
		function checkform(){
			if(document.getElementById('file').value == ""){
				alert("<?php _e( 'Please select a valid csv file to import.', WPC_CLIENT_TEXT_DOMAIN ) ?>")
				return false;
			}
			return true;
		}

    </script>

    <div class="wpc_logo"></div>
    <hr />

    <div class="clear"></div>
    <?php
	if($msg != ""){
		switch($msg) {
            case 'a':
                echo '<div id="message" class="updated fade"><p>' . __( 'Client <strong>Added</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>';
                break;
            case 'u':
                echo '<div id="message" class="updated fade"><p>' . __( 'Client <strong>Updated</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>';
                break;
            case 'd':
                echo '<div id="message" class="updated fade"><p>' . __( 'Client <strong>Deleted</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>';
                break;
			case 'uf':
                echo '<div id="message" class="updated fade"><p>' . __( 'There was an error uploading the file, please try again!', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>';
                break;
        }
	}

    ?>

    <div id="container23">
        <ul class="menu">
            <?php echo $this->gen_tabs_menu( 'clients' ) ?>
        </ul>
        <span class="clear"></span>
        <div class="content23 news">

            <div>
                <p><span style="color: #800000;"><em><span style="font-size: small;"><span style="line-height: normal;"><?php _e( 'Import Clients', WPC_CLIENT_TEXT_DOMAIN ) ?></span></span></em></span></p><form action="?page=wpclients" method="post" enctype="multipart/form-data"><table><tr><td>CSV File</td><td><input type="file" name="file" id="file" /></td><td><input type="submit" class='button-primary' name="import" value="Import !" onclick="return checkform();" /></td></tr></table></form><form action="" method="post"></form>
            </div>

            <hr />

            <table class="widefat">
                <thead>
                    <tr>
                        <th>&nbsp;</th>
                        <th><?php _e( 'Username', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
                        <th><?php _e( 'Contact Name', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
                        <th><?php _e( 'Business Name', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
                        <th><?php _e( 'Email', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
                        <th style="width:75px;"><?php _e( 'Action', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>&nbsp;</th>
                        <th><?php _e( 'Username', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
                        <th><?php _e( 'Contact Name', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
                        <th><?php _e( 'Business Name', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
                        <th><?php _e( 'Email', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
                        <th><?php _e( 'Action', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
                    </tr>
                </tfoot>
                <tbody>
            <?php
            foreach ( $rows as $author ) :
                $author = get_userdata( $author->ID );
                echo "
                <tr class='over'>
                    <td><input type='checkbox'></td>
                    <td>$author->user_login</td>
                    <td>$author->nickname</td>
                    <td>$author->first_name</td>
                    <td>$author->user_email</td>
                    <td>
                    <a href='admin.php?page=wpclients_files&filter=$author->ID'>" . __( 'Files', WPC_CLIENT_TEXT_DOMAIN ) . "</a> /
                    <a href='admin.php?page=wpclients_messages&id=$author->ID'>" . __( 'Messages', WPC_CLIENT_TEXT_DOMAIN ) . "</a> /
                    <a href='admin.php?page=$edit_slug&id=$author->ID'>" . __( 'Edit', WPC_CLIENT_TEXT_DOMAIN ) . "</a> /

                    <a onclick='return confirm(\"" .__( 'Are you sure to delete this Client? ', WPC_CLIENT_TEXT_DOMAIN ) . "\");' href='admin.php?page=$page_slug&action=delete&id=$author->ID'>" . __( 'Delete', WPC_CLIENT_TEXT_DOMAIN ) . "</a>
                    </td>
                </tr>";
            endforeach;
            ?>
                </tbody>
            </table>
            <div class="tablenav">
                <div class='tablenav-pages'>
                    <?php echo $p->show(); ?>
                </div>
            </div>

        </div>
    </div>

</div>