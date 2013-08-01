<?php

//require_once( 'ABSPATH' . '/wp-load.php'); 
require_once( dirname(__FILE__) . '/wp-load.php' );

$where_form_is="http://".$_SERVER['SERVER_NAME'].strrev(strstr(strrev($_SERVER['PHP_SELF']),"/"));

// Checkbox handling
//$field_location_opts = $_POST['field_location'][0].",". $_POST['field_location'][1];

//ken shoufer - begin

//begin table insert logic


if( 'POST' == $_SERVER['REQUEST_METHOD'] || !empty( $_POST['action'] )) {
    
foreach ($_POST as $param_name => $param_val) {
    if ($param_name != 'mapLink') {
        $param_val_input = wp_strip_all_tags($_POST[$param_name]);
    }
 else {
        $param_val_input = $_POST[$param_name];    
    }
    $param_val = stripslashes($param_val_input);
    $_POST[$param_name] = $param_val;
    //echo "Param: $param_name; New Param Value: $_POST[$param_name]<br />\n";
}


            //***handle uploaded file****
            if ($_FILES["field_upload"]["error"] > 0)
            {
            $file_error = $_FILES["field_upload"]["error"];
            echo 'file_error: ' . $file_error;
            }
            else
            {
            $file_name = $_FILES["field_upload"]["name"];
            $file_type = $_FILES["field_upload"]["type"];
            $file_size = ($_FILES["field_upload"]["size"] / 1024);
            $file_location = $_FILES["field_upload"]["tmp_name"];
            
                        
            $upload_dir = wp_upload_dir();
            
            $filetype = wp_check_filetype( basename( $file_name ), null );
            $filetitle = preg_replace('/\.[^.]+$/', '', basename( $file_name ) );
            $filetitle_url = rawurlencode ($filetitle);
            $filename = $upload_dir['url'] . '/' . $filetitle_url . '.' . $filetype['ext'];
            
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
	$title = $_POST['field_title'];
        $description = "";
        //$category = wp_strip_all_tags($_POST['field_category']);
        $category = '6';
        $tags = $_POST['field_tags'];
   
	// Add the content of the form to $post as an array
	$post = array(
                //'post_title'    => wp_strip_all_tags($title),
                'post_title'    => 'test insert',
		'post_content'	=> $description,
		'post_category'	=> array($category),  // Usable for custom taxonomies too
		'tags_input'	=> wp_strip_all_tags($tags),
		'post_status'	=> 'draft',			// Choose: publish, preview, future, etc.
		'post_type'	=> 'post'  // Use a custom post type if you want to
	);
	
        $post_id = wp_insert_post($post);  // Pass  the value of $post to WordPress the insert function
        
        if (!$file_error > 0)
        {
        $attach_id = wp_insert_attachment( $attachment, $filename, $post_id );
        require_once( ABSPATH . "wp-admin" . '/includes/image.php' );
        $attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
        wp_update_attachment_metadata( $attach_id,  $attach_data );
        $updated_file_url = wp_get_attachment_image_src($attach_id);
        
        //begin edit image
        $max_w = 1800;
        $max_h = 1800;
        $quality = 60;
        
        $upload_dir = wp_upload_dir();
        
        $image = wp_get_image_editor('wp-content/uploads' . $upload_dir['subdir'] . "/" . $file_name);
        if ( ! is_wp_error( $image ) ) {
            $image->resize( $max_w, $max_h, $crop = false );
            $image->set_quality( $quality );
            $image->save('wp-content/uploads' . $upload_dir['subdir'] . "/" . $file_name);
        }
        //end edit image
        }//end file error check


} // end IF


// Do some minor form validation to make sure there is content
//******begin description*********//        
	if (isset ($_POST['field_title'])) {
                $description = $description . $_POST['field_title'];
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
	if (isset ($_POST['field_GPS'])) {
                $description = $description . "<tr>";
                $description = $description . "<td>";
		$description = $description . "GPS Coordinates";
                $description = $description . "</td>";
                $description = $description . "<td>";
                $description = $_POST['field_GPS'];
                $description = $description . "</td>";
                $description = $description . "</tr>";

	} else {
		//echo 'Please enter the content';
	}
        if (isset ($_POST['field_location'])) {
            $description = $description . "<tr>";
            $description = $description . "<td>";
            $description = $description . "Location";
            $description = $description . "</td>";
            $description = $description . "<td>";
            $description = $description . $_POST['field_location'];
            $description = $description . "</td>";
            $description = $description . "</tr>";
	} else {
		//echo 'Please enter the location';

	}
                if (isset ($_POST['field_country'])) {
            $description = $description . "<tr>";
            $description = $description . "<td>";
            $description = $description . "Country";
            $description = $description . "</td>";
            $description = $description . "<td>";
            $description = $description . $_POST['field_country'];
            $description = $description . "</td>";
            $description = $description . "</tr>";
	} else {
		//echo 'Please enter the location';

	}
                if (isset ($_POST['field_state'])) {
            $description = $description . "<tr>";
            $description = $description . "<td>";
            $description = $description . "State";
            $description = $description . "</td>";
            $description = $description . "<td>";
            $description = $description . $_POST['field_state'];
            $description = $description . "</td>";
            $description = $description . "</tr>";
	} else {
		//echo 'Please enter the location';

	}
                if (isset ($_POST['field_category'])) {
            $description = $description . "<tr>";
            $description = $description . "<td>";
            $description = $description . "Category";
            $description = $description . "</td>";
            $description = $description . "<td>";
            $description = $description . $_POST['field_category'];
            $description = $description . "</td>";
            $description = $description . "</tr>";
	} else {
		//echo 'Please enter the location';

	}
                if (isset ($_POST['field_tags'])) {
            $description = $description . "<tr>";
            $description = $description . "<td>";
            $description = $description . "Tags";
            $description = $description . "</td>";
            $description = $description . "<td>";
            $description = $description . $_POST['field_tags'];
            $description = $description . "</td>";
            $description = $description . "</tr>";
	} else {
		//echo 'Please enter the location';

	}
                if (isset ($_POST['field_condition'])) {
            $description = $description . "<tr>";
            $description = $description . "<td>";
            $description = $description . "Condition";
            $description = $description . "</td>";
            $description = $description . "<td>";
            $description = $description . $_POST['field_condition'];
            $description = $description . "</td>";
            $description = $description . "</tr>";
	} else {
		//echo 'Please enter the location';

	}

                if (isset ($_POST['field_date'])) {
            $description = $description . "<tr>";
            $description = $description . "<td>";
            $description = $description . "Date";
            $description = $description . "</td>";
            $description = $description . "<td>";
            $description = $description . $_POST['field_date'];
            $description = $description . "</td>";
            $description = $description . "</tr>";
	} else {
		//echo 'Please enter the location';

	}
        
                if (isset ($_POST['field_description'])) {
            $description = $description . "<tr>";
            $description = $description . "<td>";
            $description = $description . "Description";
            $description = $description . "</td>";
            $description = $description . "<td>";
            $description = $description . $_POST['field_description'];
            $description = $description . "</td>";
            $description = $description . "</tr>";
	} else {
		//echo 'Please enter the location';

	}
                if (isset ($_POST['mapLink'])) {
            $description = $description . "<tr>";
            $description = $description . "<td>";
            $description = $description . "Map Link";
            $description = $description . "</td>";
            $description = $description . "<td>";
            $description = $description . $_POST['mapLink'];
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
            $description = $description . "<a href=\"" . $updated_file_url[0] . "\"> ";
            $description = $description . "<img src=\"";
            $description = $description . $updated_file_url[0];
            $description = $description . "\" height=\"100\" width=\"100\">";
            $description = $description . "</a>";
            $description = $description . "</td>";
            $description = $description . "</tr>";

            ///**************
            
        
        $description = $description . "</table>";
//******end description*********//        


	$post_update = array(
                'post_title'    => $title,
		'post_content'	=> $description,
		'post_category'	=> array($category),  // Usable for custom taxonomies too
		'tags_input'	=> $tags,
		'post_status'	=> 'draft',			// Choose: publish, preview, future, etc.
		'post_type'	=> 'post',  // Use a custom post type if you want to
                'ID'       => $post_id
	);


// Update the post into the database
wp_update_post( $post_update );
  
  get_currentuserinfo();
  
    $Headers  = "MIME-Version: 1.0\n";
    $Headers .= "Content-type: text/html; charset=iso-8859-1\n";
    $Headers .= "From: " . $current_user->user_email . "\n";
    $Headers .= "Reply-To: Ken" ."\n";
    $Headers .= "X-Mailer: PHP\n"; 
    $Headers .= "X-Priority: 1\n"; 
    $Headers .= "Return-Path: <". $current_user->user_email .">\n";           
  
    $title = $title . " - Confirmation of Report Submission";
  
    $description = $description . "<br /><h2>Thank you for your submission!<br />Your post will appear shortly.</h2>";
  
    mail( $current_user->user_email, $title, $description, $Headers);
    
    
$input = $_POST['field_date'];
$date = DateTime::createFromFormat('m/d/Y', $input);
$outputDate =  $date->format('Y-m-d');
$file_name = $_FILES["field_upload"]["name"];

$current_user = wp_get_current_user();
$filename_url = rawurlencode ($file_name);

$ddlFormat = $_POST['ddlFormat'];

switch ($ddlFormat) {
    case "1":
        //store lat and lon decimal format
        $txtLatDeg = $_POST['txtLatDeg1'];
        $txtLonDeg = $_POST['txtLonDeg1'];
        break;
    case "2":
        //store lat and lon decimal and minutes
        $txtLatDeg = $_POST['txtLatDeg2'];
        $txtLatMin = $_POST['txtLatMin2'];
        $txtLatDir = $_POST['txtLatDir2'];
        $txtLonDeg = $_POST['txtLonDeg2'];
        $txtLonMin = $_POST['txtLonMin2'];
        $txtLonDir = $_POST['txtLonDir2'];
        break;
    case "3":
        //store lat and lon decimal, minute and seconds
        $txtLatDeg = $_POST['txtLatDeg3'];
        $txtLatMin = $_POST['txtLatMin3'];
        $txtLatSec = $_POST['txtLatSec3'];
        $txtLatDir = $_POST['txtLatDir3'];
        $txtLonDeg = $_POST['txtLonDeg3'];
        $txtLonMin = $_POST['txtLonMin3'];
        $txtLonSec = $_POST['txtLonSec3'];
        $txtLonDir = $_POST['txtLonDir3'];
        break;
}


$wpdb->insert( 
	'wp_add_report', 
	array( 
                'report_post_id' => $post_id,
		'report_title' => $_POST['field_title'], 
                'report_user_id' => $current_user->ID,
                'report_user_logon' => $current_user->user_login,
                'report_gps_format' => $ddlFormat,
		'report_gps_lat_degree' => $txtLatDeg,
		'report_gps_lat_minute' => $txtLatMin, 
		'report_gps_lat_second' => $txtLatSec, 
                'report_gps_lat_direction' => $txtLatDir, 
                'report_gps_lon_degree' => $txtLonDeg,
		'report_gps_lon_minute' => $txtLonMin, 
		'report_gps_lon_second' => $txtLonSec, 
                'report_gps_lon_direction' => $txtLonDir, 
		'report_location' => $_POST['field_location'],
		'report_country' => $_POST['field_country'],
		'report_state' => $_POST['field_state'],
		'report_category' => $_POST['field_category'],
		'report_tags' => $_POST['field_tags'],
		'report_condition' => $_POST['field_condition'],
		'report_date' => $outputDate,
		'report_description' => $_POST['field_description'],
		'report_image_name' => $upload_dir['subdir'] . "/" . $filename_url
	)
);

//end table inserting logic

wp_redirect( home_url()); 

//ken shoufer - end


?>

