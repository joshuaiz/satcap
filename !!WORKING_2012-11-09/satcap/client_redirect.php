<?php
/*
Template Name: _ClientRedirect_DONOTUSE
*/
?>

<?php 

$username = ( $userdata->user_login ) ?>

<?php 

if (current_user_can( 'level_10' ) || is_user_logged_in())  {
	if($username == "admin"){
    	//list all client pages
		get_header();
		include("breadcrumb.php");
		echo '<div><h1>Client Pages</h1><ul>';
		wp_list_pages('title_li=&child_of=60&title_li=');
		echo '</ul></div>';
	}
	else{
		//user is logged in so re-direct to their page
		header('Location:http://satellitecap.com/clients/' . $username);
	}

} elseif ( is_user_logged_in()==false ) {
	//user not logged in so re-direct to login page
	header('Location:http://satellitecap.com/wp-admin/');

} elseif ( is_user_logged_in() && $username!=$shorttitle ) {
	//user logged in - redirect to their page
	header('Location:http://satellitecap.com/wp-admin/');

} 

?>