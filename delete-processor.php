<?php

//require_once( 'ABSPATH' . '/wp-load.php'); 
require_once( dirname(__FILE__) . '/wp-load.php' );

$where_form_is="http://".$_SERVER['SERVER_NAME'].strrev(strstr(strrev($_SERVER['PHP_SELF']),"/"));
    
$post_id = $_GET['post_id'];

$image_entry = $wpdb->get_col("SELECT report_image_name FROM wp_add_report WHERE report_post_id = $post_id");


$child_atts = $wpdb->get_col("SELECT ID FROM {$wpdb->posts} WHERE post_parent = $post_id AND post_type = 'attachment'");

foreach ( $child_atts as $id )
      wp_delete_attachment($id);

wp_delete_post( $post_id );

//do it again to remove all revisions
$child_atts = $wpdb->get_col("SELECT ID FROM {$wpdb->posts} WHERE post_parent = $post_id AND post_type = 'revision'");

foreach ( $child_atts as $id )
      wp_delete_attachment($id);

wp_delete_post( $post_id );

$image_entry = $wpdb->get_col("SELECT report_image_name FROM wp_add_report WHERE report_post_id = $post_id");

$filename="/wp-content/uploads" . $image_entry[0];
unlink($filename);

$image_entry = $wpdb->query("DELETE FROM wp_add_report WHERE report_post_id = $post_id");
          
wp_redirect( home_url()); 

//ken shoufer - end
//}
?>