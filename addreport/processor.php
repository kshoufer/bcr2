<?php

//require_once( 'ABSPATH' . '/wp-load.php'); 
require_once( dirname(__FILE__) . '/wp-load.php' );

$where_form_is="http://".$_SERVER['SERVER_NAME'].strrev(strstr(strrev($_SERVER['PHP_SELF']),"/"));

// Checkbox handling
//$field_3_opts = $_POST['field_3'][0].",". $_POST['field_3'][1];

//ken shoufer - begin

if( 'POST' == $_SERVER['REQUEST_METHOD'] || !empty( $_POST['action'] )) {
 
            //***handle uploaded file****
            $file_attachment = $_POST['field_11'];
            
            if ($_FILES["field_11"]["error"] > 0)
            {
            $file_error = $_FILES["field_11"]["error"];
            }
            else
            {
            $file_name = $_FILES["field_11"]["name"];
            $file_type = $_FILES["field_11"]["type"];
            $file_size = ($_FILES["field_11"]["size"] / 1024);
            $file_location = $_FILES["field_11"]["tmp_name"];
            
                        
            $upload_dir = wp_upload_dir();
            
            $filetype = wp_check_filetype( basename( $file_name ), null );
            $filetitle = preg_replace('/\.[^.]+$/', '', basename( $file_name ) );
            $filename = $upload_dir['url'] . '/' . $filetitle . '.' . $filetype['ext'];
            
            $attachment = array(
            'post_mime_type' => $filetype['type'],
            'post_title' => $filetitle,
            'post_content' => '',
            'post_status' => 'inherit'
            );
            
            
            if ( !is_writeable( $upload_dir['path'] ) ) {
                $this->msg_e('Unable to write to directory %s. Is this directory writable by the server?');
            }
            
            $success = move_uploaded_file($file_location, $upload_dir['path']. '/' . $file_name);

            
            }
            //****end handle uploaded file
	$title =  $_POST['field_1'];
        $description = "";
        $category = wp_strip_all_tags($_POST['field_4']);
        $tags = wp_strip_all_tags($_POST['field_5']);
        
   
	// Add the content of the form to $post as an array
	$post = array(
                'post_title'    => wp_strip_all_tags($title),
		'post_content'	=> $description,
		'post_category'	=> array($category),  // Usable for custom taxonomies too
		'tags_input'	=> wp_strip_all_tags($tags),
		'post_status'	=> 'draft',			// Choose: publish, preview, future, etc.
		'post_type'	=> 'post'  // Use a custom post type if you want to
	);
	$post_id = wp_insert_post($post);  // Pass  the value of $post to WordPress the insert function
        
        $attach_id = wp_insert_attachment( $attachment, $filename, $post_id );
        require_once( ABSPATH . "wp-admin" . '/includes/image.php' );
        $attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
        wp_update_attachment_metadata( $attach_id,  $attach_data );
        $updated_file_url = wp_get_attachment_image_src($attach_id);

        do_action('wp_insert_post', 'wp_insert_post'); 
        
							// http://codex.wordpress.org/Function_Reference/wp_insert_post
	//wp_redirect( home_url() );
} // end IF


// Do some minor form validation to make sure there is content
//******begin description*********//        
	if (isset ($_POST['field_1'])) {
		$title =  $_POST['field_1'];
                $description = $description . "<table>";
                $description = $description . "<tr>";
                $description = $description . "<th>";
                $description = $description . "Entry Name";
                $description = $description . "</th>";
                $description = $description . "<th>";
                $description = $description . "Content";
                $description = $description . "</th>";
                $description = $description . "</tr>";

	} else {
		//echo 'Please enter a title';
	}
	if (isset ($_POST['field_2'])) {
                $description = $description . "<tr>";
                $description = $description . "<td>";
		$description = $description . "GPS Coordinates";
                $description = $description . "</td>";
                $description = $description . "<td>";
		$description = $description . wp_strip_all_tags($_POST['field_2']);
                $description = $description . "</td>";
                $description = $description . "</tr>";

	} else {
		//echo 'Please enter the content';
	}
        if (isset ($_POST['field_3'])) {
            $description = $description . "<tr>";
            $description = $description . "<td>";
            $description = $description . "Location";
            $description = $description . "</td>";
            $description = $description . "<td>";
            $description = $description . wp_strip_all_tags($_POST['field_3']);
            $description = $description . "</td>";
            $description = $description . "</tr>";
	} else {
		//echo 'Please enter the location';

	}
                if (isset ($_POST['field_9'])) {
            $description = $description . "<tr>";
            $description = $description . "<td>";
            $description = $description . "Country";
            $description = $description . "</td>";
            $description = $description . "<td>";
            $description = $description . wp_strip_all_tags($_POST['field_9']);
            $description = $description . "</td>";
            $description = $description . "</tr>";
	} else {
		//echo 'Please enter the location';

	}
                if (isset ($_POST['field_10'])) {
            $description = $description . "<tr>";
            $description = $description . "<td>";
            $description = $description . "State";
            $description = $description . "</td>";
            $description = $description . "<td>";
            $description = $description . wp_strip_all_tags($_POST['field_10']);
            $description = $description . "</td>";
            $description = $description . "</tr>";
	} else {
		//echo 'Please enter the location';

	}
                if (isset ($_POST['field_4'])) {
            $description = $description . "<tr>";
            $description = $description . "<td>";
            $description = $description . "Category";
            $description = $description . "</td>";
            $description = $description . "<td>";
            $description = $description . wp_strip_all_tags($_POST['field_4']);
            $description = $description . "</td>";
            $description = $description . "</tr>";
	} else {
		//echo 'Please enter the location';

	}
                if (isset ($_POST['field_5'])) {
            $description = $description . "<tr>";
            $description = $description . "<td>";
            $description = $description . "Tags";
            $description = $description . "</td>";
            $description = $description . "<td>";
            $description = $description . wp_strip_all_tags($_POST['field_5']);
            $description = $description . "</td>";
            $description = $description . "</tr>";
	} else {
		//echo 'Please enter the location';

	}
                if (isset ($_POST['field_6'])) {
            $description = $description . "<tr>";
            $description = $description . "<td>";
            $description = $description . "Condition";
            $description = $description . "</td>";
            $description = $description . "<td>";
            $description = $description . wp_strip_all_tags($_POST['field_6']);
            $description = $description . "</td>";
            $description = $description . "</tr>";
	} else {
		//echo 'Please enter the location';

	}

                if (isset ($_POST['field_7'])) {
            $description = $description . "<tr>";
            $description = $description . "<td>";
            $description = $description . "Date";
            $description = $description . "</td>";
            $description = $description . "<td>";
            $description = $description . wp_strip_all_tags($_POST['field_7']);
            $description = $description . "</td>";
            $description = $description . "</tr>";
	} else {
		//echo 'Please enter the location';

	}
        
                if (isset ($_POST['field_8'])) {
            $description = $description . "<tr>";
            $description = $description . "<td>";
            $description = $description . "Description";
            $description = $description . "</td>";
            $description = $description . "<td>";
            $description = $description . wp_strip_all_tags($_POST['field_8']);
            $description = $description . "</td>";
            $description = $description . "</tr>";
	} else {
		//echo 'Please enter the location';

	}

            
            ///***************needs to be in updated post
            $description = $description . "<tr>";
            $description = $description . "<td>";
            $description = $description . "Image";
            $description = $description . "</td>";
            $description = $description . "<td>";
            $description = $description . "<img src=\"";
            $description = $description . $updated_file_url[0];
            $description = $description . "\" height=\"100\" width=\"100\">";
            $description = $description . "</td>";
            $description = $description . "</tr>";

            ///**************
            
        
        $description = $description . "</table>";
//******end description*********//        


	$post_update = array(
                'post_title'    => wp_strip_all_tags($title),
		'post_content'	=> $description,
		'post_category'	=> array($category),  // Usable for custom taxonomies too
		'tags_input'	=> wp_strip_all_tags($tags),
		'post_status'	=> 'draft',			// Choose: publish, preview, future, etc.
		'post_type'	=> 'post',  // Use a custom post type if you want to
                'ID'       => $post_id
	);


// Update the post into the database
  wp_update_post( $post_update );
  
  get_currentuserinfo();
  
    $Headers  = "MIME-Version: 1.0\n";
    $Headers .= "Content-type: text/html; charset=iso-8859-1\n";
    $Headers .= "From: Ken". "\n";
    $Headers .= "Reply-To: Ken" ."\n";
    $Headers .= "X-Sender: <" . $current_user->user_email . ">\n";
    $Headers .= "X-Mailer: PHP\n"; 
    $Headers .= "X-Priority: 1\n"; 
    $Headers .= "Return-Path: <". $current_user->user_email .">\n";           
  
  $message = file_get_contents('test1.html');
  
  wp_mail( 'kshoufer@gmail.com', $title, $description, $Headers);//, $description);//, $headers, $attachments );
          
  wp_redirect( home_url()); 

//ken shoufer - end


?>