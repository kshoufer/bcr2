<?php

require_once( dirname(__FILE__) . '/wp-load.php' );

get_header();

?>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />    
<script src="./js/jquery-1.10.1.min.js"></script>
<script type="text/javascript" src="./js/gps-check.js"></script>
<script type="text/javascript" src="./js/validateform1.js"></script>

<link href="./style.css" rel="stylesheet" type="text/css" /><!-- calendar stuff --> 
<link href="./calendar/calendar-blue2.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="./calendar/calendar.js"></script>
<script type="text/javascript" src="./calendar/calendar-en.js"></script>
<script type="text/javascript" src="./calendar/calendar-setup.js"></script><!-- END calendar stuff -->
<link rel="stylesheet" type="text/css" href="./js/gps-style.css" />
<script type="text/javascript" src="./js/validate.js"></script>

<?php
//get form data and fill in form fields
$input = $_GET['post_id'];

$my_post_data = $wpdb->get_row( "SELECT * FROM wp_posts WHERE ID = $input" );
$my_report_data = $wpdb->get_row( "SELECT * FROM wp_add_report WHERE report_post_id = $input" );

$inputDate = $my_report_data->report_date;
$date = DateTime::createFromFormat('Y-m-d', $inputDate);
$outputDate =  $date->format('m/d/Y');

$post_id = $my_post_data->ID;
$report_post_id = $my_report_data->report_post_id;
$report_title = $my_report_data->report_title;
$report_gps_format = $my_report_data->report_gps_format;
$report_gps_lat_degree = $my_report_data->report_gps_lat_degree;
$report_gps_lat_minute = $my_report_data->report_gps_lat_minute;
$report_gps_lat_second = $my_report_data->report_gps_lat_second;
$report_gps_lat_direction = $my_report_data->report_gps_lat_direction;
$report_gps_lon_degree = $my_report_data->report_gps_lon_degree;
$report_gps_lon_minute = $my_report_data->report_gps_lon_minute;
$report_gps_lon_second = $my_report_data->report_gps_lon_second;
$report_gps_lon_direction = $my_report_data->report_gps_lon_direction;
$report_location = $my_report_data->report_location;
$report_state = $my_report_data->report_state;
$report_tags = $my_report_data->report_tags;
$report_condition = $my_report_data->report_condition;
$report_date = $outputDate;
$report_description = $my_report_data->report_description;
$report_image_name = $my_report_data->report_image_name;

?>


<div id="mainForm"><div id="formHeader"><h2 class="formInfo">Edit Report</h2>
    </div><!-- begin form -->
<form action="./edit-processor.php" enctype="multipart/form-data" method="post" onsubmit="return validatePage1();">
        <ul class="mainForm">
            <li class="mainForm" id="fieldBox_title">
                <label class="formFieldQuestion">Title: *</label>
                <input class="mainForm" id="field_title" type="text" name="field_title" size="40" value="<?php echo $report_title; ?>" />
            </li>
            <li class="mainForm" id="fieldBox_GPS">
                <div>
                <label>GPS Input Format:</label>
                
                <select id="ddlFormat" name="ddlFormat" size="1">
                    <option value="1">In degrees</option>
                    <option value="2">In degrees minutes</option>
                    <option value="3">In degrees minutes seconds</option>
                </select>
                <script type="text/javascript">
                      $("#ddlFormat").val(<?php echo $report_gps_format; ?>);
                </script>
            </div>
            <br />
            <div id="d">
                Latitude: 
                <a class="info" href="#"><img alt="" src="./imgs/tip_small.png" border="0" /><span class="infobox">example: 44.12345</span></a>
                <br />
                <input type="text" id="txtLatDeg1" name="txtLatDeg1" class="floatBoxEdit" value="<?php echo $report_gps_lat_degree?>" />&#176<br />
                Longitude: 
                <a class="info" href="#"><img alt="" src="./imgs/tip_small.png" border="0" /><span class="infobox">example: -118.12345</span></a>
                <br />
                <input type="text" id="txtLonDeg1" name="txtLonDeg1" class="floatBoxEdit" value="<?php echo $report_gps_lon_degree?>" />&#176<br />
            </div>
            <div id="dm">
                Latitude: 
                <a class="info" href="#"><img alt="" src="./imgs/tip_small.png" border="0" /><span class="infobox">example: degrees 44, minutes 12.345</span></a>
                <br />
                <input type="text" id="txtLatDeg2" name="txtLatDeg2" class="intBoxEdit" value="<?php echo $report_gps_lat_degree?>" />&#176
                <input type="text" id="txtLatMin2" name="txtLatMin2" class="floatBoxEdit" value="<?php echo $report_gps_lat_minute?>" />' 
                <select size="1" id="txtLatDir2" name="txtLatDir2" class="dirDropdownEdit" ><option value="n">N</option><option value="s">S</option></select>
                <script type="text/javascript">
                      $("#txtLatDir2").val('<?php echo $report_gps_lat_direction; ?>');
                </script>                
                <br />
                Longitude: 
                <a class="info" href="#"><img alt="" src="./imgs/tip_small.png" border="0" /><span class="infobox">example: degrees -118, minutes 12.345</span></a>
                <br />
                <input type="text" id="txtLonDeg2" name="txtLonDeg2" class="intBoxEdit" value="<?php echo $report_gps_lon_degree?>" />&#176
                <input type="text" id="txtLonMin2" name="txtLonMin2" class="floatBoxEdit" value="<?php echo $report_gps_lon_minute?>" />' 
                <select size="1" id="txtLonDir2" name="txtLonDir2" class="dirDropdownEdit" ><option value="e">E</option><option value="w">W</option></select>
                <script type="text/javascript">
                      $("#txtLonDir2").val('<?php echo $report_gps_lon_direction; ?>');
                </script>                
            </div>
            <div id="dms">
                Latitude: 
                <a class="info" href="#"><img alt="" src="./imgs/tip_small.png" border="0" /><span class="infobox">example: degrees 44, minutes 12, seconds 345</span></a>
                <br />
                <input type="text" id="txtLatDeg3" name="txtLatDeg3" class="intBoxEdit" value="<?php echo $report_gps_lat_degree?>" />&#176
                <input type="text" id="txtLatMin3" name="txtLatMin3" class="intBoxEdit" value="<?php echo $report_gps_lat_minute?>" />'
                <input type="text" id="txtLatSec3" name="txtLatSec3" class="floatBoxBoxEdit" value="<?php echo $report_gps_lat_second?>" />" 
                <select size="1" id="txtLatDir3" name="txtLatDir3" class="dirDropdownEdit"><option value="n">N</option><option value="s">S</option></select>
                <script type="text/javascript">
                      $("#txtLatDir3").val('<?php echo $report_gps_lat_direction; ?>');
                </script>                

                <br />
                Longitude: 
                <a class="info" href="#"><img alt="" src="./imgs/tip_small.png" border="0" /><span class="infobox">example: degrees -118, minutes 12, seconds 345</span></a>
                <br />
                <input type="text" id="txtLonDeg3" name="txtLonDeg3" class="intBoxEdit" value="<?php echo $report_gps_lon_degree?>" />&#176
                <input type="text" id="txtLonMin3" name="txtLonMin3" class="intBoxEdit" value="<?php echo $report_gps_lon_minute?>" />'
                <input type="text" id="txtLonSec3" name="txtLonSec3" class="floatBoxBoxEdit" value="<?php echo $report_gps_lon_second?>" />" 
                <select size="1" id="txtLonDir3" name="txtLonDir3" class="dirDropdownEdit"><option value="e">E</option><option value="w">W</option></select>
                <script type="text/javascript">
                      $("#txtLonDir3").val('<?php echo $report_gps_lon_direction; ?>');
                </script>                
            </div>

            <div type="hidden" id="mapLinkdiv">
                <input type="hidden" value="mapLink" id="mapLink" name="mapLink" class="mainForm" /> 
            </div>
            

            </li>                        

            <li class="mainForm" id="fieldBox_location">
                <label class="formFieldQuestion">Location: *</label>
                <input class="mainForm" id="field_location" type="text" name="field_location" size="40" value="<?php echo $report_location; ?>" />
            </li>

<!-- removing country drop-down box for now
            <li class="mainForm" id="fieldBox_country">
                <label class="formFieldQuestion">Country: *</label>
                <select class="mainForm" id="field_country" name="field_country" style="max-width: 300px;">
                    <option value="">Select Country</option>
                    <option value="Abkhazia">Abkhazia</option>
                    <option value="Afghanistan">Afghanistan</option>
                    <option value="Aland">Aland</option><option value="Albania">Albania</option>
                    <option value="Algeria">Algeria</option>
                    <option value="American Samoa">American Samoa</option>
                    <option value="Andorra">Andorra</option>
                    <option value="Angola">Angola</option>
                    <option value="Anguilla">Anguilla</option>
                    <option value="Antarctica">Antarctica</option>
                    <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                    <option value="Argentina">Argentina</option>
                    <option value="Armenia">Armenia</option>
                    <option value="Aruba">Aruba</option>
                    <option value="Ascension">Ascension</option>
                    <option value="Ashmore and Cartier Islands">Ashmore and Cartier Islands</option>
                    <option value="Australia">Australia</option>
                    <option value="Australian Antarctic Territory">Australian Antarctic Territory</option>
                    <option value="Austria">Austria</option>
                    <option value="Azerbaijan">Azerbaijan</option>
                    <option value="Bahamas, The">Bahamas, The</option>
                    <option value="Bahrain">Bahrain</option>
                    <option value="Baker Island">Baker Island</option>
                    <option value="Bangladesh">Bangladesh</option>
                    <option value="Barbados">Barbados</option>
                    <option value="Belarus">Belarus</option>
                    <option value="Belgium">Belgium</option>
                    <option value="Belize">Belize</option>
                    <option value="Benin">Benin</option>
                    <option value="Bermuda">Bermuda</option>
                    <option value="Bhutan">Bhutan</option>
                    <option value="Bolivia">Bolivia</option>
                    <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                    <option value="Botswana">Botswana</option>
                    <option value="Bouvet Island">Bouvet Island</option>
                    <option value="Brazil">Brazil</option>
                    <option value="British Antarctic Territory">British Antarctic Territory</option>
                    <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                    <option value="British Sovereign Base Areas">British Sovereign Base Areas</option>
                    <option value="British Virgin Islands">British Virgin Islands</option>
                    <option value="Brunei">Brunei</option>
                    <option value="Bulgaria">Bulgaria</option>
                    <option value="Burkina Faso">Burkina Faso</option>
                    <option value="Burundi">Burundi</option>
                    <option value="Cambodia">Cambodia</option>
                    <option value="Cameroon">Cameroon</option>
                    <option value="Canada">Canada</option>
                    <option value="Cape Verde">Cape Verde</option>
                    <option value="Cayman Islands">Cayman Islands</option>
                    <option value="Central African Republic">Central African Republic</option>
                    <option value="Chad">Chad</option>
                    <option value="Chile">Chile</option>
                    <option value="China, People's Republic of">China, People's Republic of</option>
                    <option value="China, Republic of (Taiwan)">China, Republic of (Taiwan)</option>
                    <option value="Christmas Island">Christmas Island</option>
                    <option value="Clipperton Island">Clipperton Island</option>
                    <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                    <option value="Colombia">Colombia</option>
                    <option value="Comoros">Comoros</option>
                    <option value="Congo, Democratic Republic of the (Congo  Kinshasa)">Congo, Democratic Republic of the (Congo Kinshasa)</option>
                    <option value="Congo, Republic of the (Congo  Brazzaville)">Congo, Republic of the (Congo Brazzaville)</option>
                    <option value="Cook Islands">Cook Islands</option>
                    <option value="Coral Sea Islands">Coral Sea Islands</option>
                    <option value="Costa Rica">Costa Rica</option>
                    <option value="Cote d'Ivoire (Ivory Coast)">Cote d'Ivoire (Ivory Coast)</option>
                    <option value="Croatia">Croatia</option>
                    <option value="Cuba">Cuba</option>
                    <option value="Cyprus">Cyprus</option>
                    <option value="Czech Republic">Czech Republic</option>
                    <option value="Denmark">Denmark</option>
                    <option value="Djibouti">Djibouti</option>
                    <option value="Dominica">Dominica</option>
                    <option value="Dominican Republic">Dominican Republic</option>
                    <option value="Ecuador">Ecuador</option>
                    <option value="Egypt">Egypt</option>
                    <option value="El Salvador">El Salvador</option>
                    <option value="Equatorial Guinea">Equatorial Guinea</option>
                    <option value="Eritrea">Eritrea</option>
                    <option value="Estonia">Estonia</option>
                    <option value="Ethiopia">Ethiopia</option>
                    <option value="Falkland Islands (Islas Malvinas)">Falkland Islands (Islas Malvinas)</option>
                    <option value="Faroe Islands">Faroe Islands</option>
                    <option value="Fiji">Fiji</option>
                    <option value="Finland">Finland</option>
                    <option value="France">France</option>
                    <option value="French Guiana">French Guiana</option>
                    <option value="French Polynesia">French Polynesia</option>
                    <option value="French Scattered Islands in the Indian Ocean">French Scattered Islands in the Indian Ocean</option>
                    <option value="French Southern and Antarctic Lands">French Southern and Antarctic Lands</option>
                    <option value="Gabon">Gabon</option>
                    <option value="Gambia, The">Gambia, The</option>
                    <option value="Georgia">Georgia</option>
                    <option value="Germany">Germany</option>
                    <option value="Ghana">Ghana</option>
                    <option value="Gibraltar">Gibraltar</option>
                    <option value="Greece">Greece</option>
                    <option value="Greenland">Greenland</option>
                    <option value="Grenada">Grenada</option>
                    <option value="Guadeloupe">Guadeloupe</option>
                    <option value="Guam">Guam</option>
                    <option value="Guatemala">Guatemala</option>
                    <option value="Guernsey">Guernsey</option>
                    <option value="Guinea">Guinea</option>
                    <option value="Guinea-Bissau">Guinea-Bissau</option>
                    <option value="Guyana">Guyana</option>
                    <option value="Haiti">Haiti</option>
                    <option value="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option>
                    <option value="Honduras">Honduras</option>
                    <option value="Hong Kong">Hong Kong</option>
                    <option value="Howland Island">Howland Island</option>
                    <option value="Hungary">Hungary</option>
                    <option value="Iceland">Iceland</option>
                    <option value="India">India</option>
                    <option value="Indonesia">Indonesia</option>
                    <option value="Iran">Iran</option>
                    <option value="Iraq">Iraq</option>
                    <option value="Ireland">Ireland</option>
                    <option value="Isle of Man">Isle of Man</option>
                    <option value="Israel">Israel</option>
                    <option value="Italy">Italy</option>
                    <option value="Jamaica">Jamaica</option>
                    <option value="Japan">Japan</option>
                    <option value="Jarvis Island">Jarvis Island</option>
                    <option value="Jersey">Jersey</option>
                    <option value="Johnston Atoll">Johnston Atoll</option>
                    <option value="Jordan">Jordan</option>
                    <option value="Kazakhstan">Kazakhstan</option>
                    <option value="Kenya">Kenya</option>
                    <option value="Kingman Reef">Kingman Reef</option>
                    <option value="Kiribati">Kiribati</option>
                    <option value="Korea, Democratic People's Republic of (North Korea)">Korea, Democratic People's Republic of (North Korea)</option>
                    <option value="Korea, Republic of  (South Korea)">Korea, Republic of (South Korea)</option>
                    <option value="Kosovo">Kosovo</option>
                    <option value="Kuwait">Kuwait</option>
                    <option value="Kyrgyzstan">Kyrgyzstan</option>
                    <option value="Laos">Laos</option>
                    <option value="Latvia">Latvia</option>
                    <option value="Lebanon">Lebanon</option>
                    <option value="Lesotho">Lesotho</option>
                    <option value="Liberia">Liberia</option>
                    <option value="Libya">Libya</option>
                    <option value="Liechtenstein">Liechtenstein</option>
                    <option value="Lithuania">Lithuania</option>
                    <option value="Luxembourg">Luxembourg</option>
                    <option value="Macau">Macau</option>
                    <option value="Macedonia">Macedonia</option>
                    <option value="Madagascar">Madagascar</option>
                    <option value="Malawi">Malawi</option>
                    <option value="Malaysia">Malaysia</option>
                    <option value="Maldives">Maldives</option>
                    <option value="Mali">Mali</option>
                    <option value="Malta">Malta</option>
                    <option value="Marshall Islands">Marshall Islands</option>
                    <option value="Martinique">Martinique</option>
                    <option value="Mauritania">Mauritania</option>
                    <option value="Mauritius">Mauritius</option>
                    <option value="Mayotte">Mayotte</option>
                    <option value="Mexico">Mexico</option>
                    <option value="Micronesia">Micronesia</option>
                    <option value="Midway Islands">Midway Islands</option>
                    <option value="Moldova">Moldova</option>
                    <option value="Monaco">Monaco</option>
                    <option value="Mongolia">Mongolia</option>
                    <option value="Montenegro">Montenegro</option>
                    <option value="Montserrat">Montserrat</option>
                    <option value="Morocco">Morocco</option>
                    <option value="Mozambique">Mozambique</option>
                    <option value="Myanmar (Burma)">Myanmar (Burma)</option>
                    <option value="Nagorno-Karabakh">Nagorno-Karabakh</option>
                    <option value="Namibia">Namibia</option>
                    <option value="Nauru">Nauru</option>
                    <option value="Navassa Island">Navassa Island</option>
                    <option value="Nepal">Nepal</option>
                    <option value="Netherlands">Netherlands</option>
                    <option value="Netherlands Antilles">Netherlands Antilles</option>
                    <option value="New Caledonia">New Caledonia</option>
                    <option value="New Zealand">New Zealand</option>
                    <option value="Nicaragua">Nicaragua</option>
                    <option value="Niger">Niger</option>
                    <option value="Nigeria">Nigeria</option>
                    <option value="Niue">Niue</option>
                    <option value="Norfolk Island">Norfolk Island</option>
                    <option value="Northern Cyprus">Northern Cyprus</option>
                    <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                    <option value="Norway">Norway</option>
                    <option value="Oman">Oman</option>
                    <option value="Pakistan">Pakistan</option>
                    <option value="Palau">Palau</option>
                    <option value="Palestine">Palestine</option>
                    <option value="Palmyra Atoll">Palmyra Atoll</option>
                    <option value="Panama">Panama</option>
                    <option value="Papua New Guinea">Papua New Guinea</option>
                    <option value="Paraguay">Paraguay</option>
                    <option value="Peru">Peru</option>
                    <option value="Peter I Island">Peter I Island</option>
                    <option value="Philippines">Philippines</option>
                    <option value="Pitcairn Islands">Pitcairn Islands</option>
                    <option value="Poland">Poland</option>
                    <option value="Portugal">Portugal</option>
                    <option value="Pridnestrovie (Transnistria)">Pridnestrovie (Transnistria)</option>
                    <option value="Puerto Rico">Puerto Rico</option>
                    <option value="Qatar">Qatar</option>
                    <option value="Queen Maud Land">Queen Maud Land</option>
                    <option value="Reunion">Reunion</option>
                    <option value="Romania">Romania</option>
                    <option value="Ross Dependency">Ross Dependency</option>
                    <option value="Russia">Russia</option>
                    <option value="Rwanda">Rwanda</option>
                    <option value="Saint Helena">Saint Helena</option>
                    <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                    <option value="Saint Lucia">Saint Lucia</option>
                    <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                    <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                    <option value="Samoa">Samoa</option>
                    <option value="San Marino">San Marino</option>
                    <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                    <option value="Saudi Arabia">Saudi Arabia</option>
                    <option value="Senegal">Senegal</option>
                    <option value="Serbia">Serbia</option>
                    <option value="Seychelles">Seychelles</option>
                    <option value="Sierra Leone">Sierra Leone</option>
                    <option value="Singapore">Singapore</option>
                    <option value="Slovakia">Slovakia</option>
                    <option value="Slovenia">Slovenia</option>
                    <option value="Solomon Islands">Solomon Islands</option>
                    <option value="Somalia">Somalia</option>
                    <option value="Somaliland">Somaliland</option>
                    <option value="South Africa">South Africa</option>
                    <option value="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option>
                    <option value="South Ossetia">South Ossetia</option>
                    <option value="Spain">Spain</option>
                    <option value="Sri Lanka">Sri Lanka</option>
                    <option value="Sudan">Sudan</option>
                    <option value="Suriname">Suriname</option>
                    <option value="Svalbard">Svalbard</option>
                    <option value="Swaziland">Swaziland</option>
                    <option value="Sweden">Sweden</option>
                    <option value="Switzerland">Switzerland</option>
                    <option value="Syria">Syria</option>
                    <option value="Tajikistan">Tajikistan</option>
                    <option value="Tanzania">Tanzania</option>
                    <option value="Thailand">Thailand</option>
                    <option value="Timor-Leste (East Timor)">Timor-Leste (East Timor)</option>
                    <option value="Togo">Togo</option><option value="Tokelau">Tokelau</option>
                    <option value="Tonga">Tonga</option>
                    <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                    <option value="Tristan da Cunha">Tristan da Cunha</option>
                    <option value="Tunisia">Tunisia</option>
                    <option value="Turkey">Turkey</option>
                    <option value="Turkmenistan">Turkmenistan</option>
                    <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                    <option value="Tuvalu">Tuvalu</option>
                    <option value="U.S. Virgin Islands">U.S. Virgin Islands</option>
                    <option value="Uganda">Uganda</option>
                    <option value="Ukraine">Ukraine</option>
                    <option value="United Arab Emirates">United Arab Emirates</option>
                    <option value="United Kingdom">United Kingdom</option>
                    <option value="United States">United States</option>
                    <option value="Uruguay">Uruguay</option>
                    <option value="Uzbekistan">Uzbekistan</option>
                    <option value="Vanuatu">Vanuatu</option>
                    <option value="Vatican City">Vatican City</option>
                    <option value="Venezuela">Venezuela</option>
                    <option value="Viet Nam">Viet Nam</option>
                    <option value="Wake Island">Wake Island</option>
                    <option value="Wallis and Futuna">Wallis and Futuna</option>
                    <option value="Western Sahara">Western Sahara</option>
                    <option value="Yemen">Yemen</option>
                    <option value="Zambia">Zambia</option>
                    <option value="Zimbabwe">Zimbabwe</option>
                </select>
            </li>     

-->
            <li class="mainForm" id="fieldBox_state">
                <label class="formFieldQuestion">State: *</label>
               <select class="mainForm" id="field_state" name="field_state">
                   <option value="<?php echo $report_state; ?>"><?php echo $report_state; ?></option>
                   <option value="Alabama">Alabama</option>
                   <option value="Alaska">Alaska</option>
                   <option value="Arizona">Arizona</option>
                   <option value="Arkansas">Arkansas</option>
                   <option value="California">California</option>
                   <option value="Colorado">Colorado</option>
                   <option value="Connecticut">Connecticut</option>
                   <option value="Delaware">Delaware</option>
                   <option value="Florida">Florida</option>
                   <option value="Georgia">Georgia</option>
                   <option value="Hawaii">Hawaii</option>
                   <option value="Idaho">Idaho</option>
                   <option value="Illinois">Illinois</option>
                   <option value="Indiana">Indiana</option>
                   <option value="Iowa">Iowa</option>
                   <option value="Kansas">Kansas</option>
                   <option value="Kentucky">Kentucky</option>
                   <option value="Louisiana">Louisiana</option>
                   <option value="Maine">Maine</option>
                   <option value="Maryland">Maryland</option>
                   <option value="Massachusetts">Massachusetts</option>
                   <option value="Michigan">Michigan</option>
                   <option value="Minnesota">Minnesota</option>
                   <option value="Mississippi">Mississippi</option>
                   <option value="Missouri">Missouri</option>
                   <option value="Montana">Montana</option>
                   <option value="Nebraska">Nebraska</option>
                   <option value="Nevada">Nevada</option>
                   <option value="New Hampshire">New Hampshire</option>
                   <option value="New Jersey">New Jersey</option>
                   <option value="New Mexico">New Mexico</option>
                   <option value="New York">New York</option>
                   <option value="North Carolina">North Carolina</option>
                   <option value="North Dakota">North Dakota</option>
                   <option value="Ohio">Ohio</option>
                   <option value="Oklahoma">Oklahoma</option>
                   <option value="Oregon">Oregon</option>
                   <option value="Pennsylvania">Pennsylvania</option>
                   <option value="Rhode Island">Rhode Island</option>
                   <option value="South Carolina">South Carolina</option>
                   <option value="South Dakota">South Dakota</option>
                   <option value="Tennessee">Tennessee</option>
                   <option value="Texas">Texas</option>
                   <option value="Utah">Utah</option>
                   <option value="Vermont">Vermont</option>
                   <option value="Virginia">Virginia</option>
                   <option value="Washington">Washington</option>
                   <option value="West Virginia">West Virginia</option>
                   <option value="Wisconsin">Wisconsin</option>
                   <option value="Wyoming">Wyoming</option>
               </select>
            </li>

<!-- remove this selection for now
            <li class="mainForm" id="fieldBox_category">
                <label class="formFieldQuestion">Category: *</label>
                <select class="mainForm" id="field_category" name="field_category">
                    <option value="">Select Category</option>
                    <option value="6">Trail Report</option>
                    <option value="10">Trip Guide</option>
                </select>
            </li>
-->

            <li class="mainForm" id="fieldBox_tags">
                <label class="formFieldQuestion">Tags: * <a class="info" href="#"><img alt="" src="./imgs/tip_small.png" border="0" /><span class="infobox">separate tags by commas</span></a></label>
                <input class="mainForm" id="field_tags" type="text" name="field_tags" size="40" value="<?php echo $report_tags; ?>" />
            </li>
            <li class="mainForm" id="fieldBox_condition">
                <label class="formFieldQuestion">Condition: * <a class="info" href="#"><img alt="" src="./imgs/tip_small.png" border="0" /><span class="infobox">Example: cloudy, dry, hot</span></a></label>
                <input class="mainForm" id="field_condition" type="text" name="field_condition" size="40" value="<?php echo $report_condition; ?>" />
            </li>
            <li class="mainForm" id="fieldBox_date"><label class="formFieldQuestion">Date: *<a class="info" href="#"><img alt="" src="./imgs/tip_small.png" border="0" /><span class="infobox">Enter date in mm/dd/yyyy format.</span></a></label>
                <input id="field_date" type="text" name="field_date" value="<?php echo $report_date; ?>" />
                <button class="calendarStyle" id="fieldDateTrigger_7" type="reset"></button>
                <script type="text/javascript">
                    Calendar.setup({                                 inputField     :    "field_date",                                    ifFormat       :    "%m/%d/%Y",                                    showsTime      :    false,                                           button         :    "fieldDateTrigger_7",                                 singleClick    :    true,                                            step           :    1                                                 });
                </script>
            </li>
            <li class="mainForm" id="fieldBox_description">
                <label class="formFieldQuestion">Description: * <a class="info" href="#"><img alt="" src="./imgs/tip_small.png" border="0" /><span class="infobox">Anything else you want to say.</span></a>
                </label>
                    <textarea class="mainForm" id="field_description" cols="20" name="field_description" rows="5" type="textarea" value=""><?php echo $report_description; ?></textarea>
            </li>
            <li class="mainForm" id="fieldBox_upload">
                <label class="formFieldQuestion">Image Upload:</label>
                <input class="mainForm" id="field_upload" type="file" name="field_upload" value="" />
                <input class="mainForm" id="field_upload_txt" type="hidden" name="field_upload_txt" value="<?php echo $report_image_name; ?>" />
            </li>
        </ul><!-- end of this page -->
        
        <ul class="mainForm" id="mainForm_1">
<!--
        <li class="mainForm">
            <label class="formFieldQuestion" id="fieldBox_captcha"> Type the following: *
                <a class="info" href="#">
                <img alt="" src="./imgs/tip_small.png" border="0" /><span class="infobox">For security purposes, please type the letters in the image.</span></a> 
                <img alt="" src="./CaptchaSecurityImages.php" /> 
            </label> 
            <input class="mainForm" id="captchaForm" type="text" name="security_code" />
        </li>
-->


        <input class="mainForm" id="field_hpot" type="hidden" name="field_hpot" size="40" value="" />
        <input class="mainForm" id="post_id" type="hidden" name="post_id" size="40" value="<?php echo $input ?>" />
        
        <li class="mainForm">
            <input class="button" id="btnSaveForm" type="submit" value="Submit" />
        </li>
        <li class="mainForm">
            <input class="button" id="cancelForm" type="button" value="Cancel" name="cancelForm" onclick="window.location = 'my-posts/index.php' " />
        </li>
        <li class="mainForm">
        <script>
        function handleSubmit() {
            if (confirm('Are you sure you want to delete this report?')) {
                // handle delete request
                window.location.assign("/delete-processor.php?post_id=<?php echo $input ?>");
            } 
            else {
                // Do nothing!
            }
        }
        </script>

        <input class="button" onclick="handleSubmit()" value="Delete Report" name="deletePostID" type="button" />
        </li>

    </ul>

</form><!-- end of form --> <!-- close the display stuff for this page -->
</div>



<div id="footer">
<p class="footer"><a class="footer" href="http://phpformgen.sourceforge.net">Generated by phpFormGenerator</a></p>


</div>

<?php
get_sidebar();

get_footer(); 
?>  