<?php
/*
 * function to handle array printing request.
 */

function pre( $array , $exit = 0 )
{
    echo '<pre>';
    print_r($array);
    echo '</pre>';

    if($exit == 1){
        exit();
    }
}



/*
 * file uploader helper function
 */

function uploader( $configArray )
{

    $config = $configArray;

    $CI =& get_instance();

    $CI->load->library('upload');     

    $CI->upload->initialize($config);


    if (!$CI->upload->do_upload()) {

        $upload_error = $CI->upload->display_errors();

        $res = json_encode($upload_error);

    } else {

        $file_info = $CI->upload->data();

        $res = json_encode($file_info);

    }
    
    return $res;
    exit;
}



function access_token( $length = 8 ){

    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    $randomString = '';

    for ($i = 0; $i < $length; $i++) {

        $randomString .= $characters[rand(0, strlen($characters) - 1)];

    }

    $randomString = str_shuffle($randomString);

    return $randomString;

}



function send_mail( $details = array() ){

	//pre($details);die;

    $CI =& get_instance();

    $CI->load->library('email'); // load library

     

    $config = Array(

        'protocol' => 'mail', //mail, sendmail, smtp

        //'smtp_host' => 'ssl://smtp.gmail.com',

        //'smtp_port' => 465,

        //'smtp_user' => 'aditya.arbsoft@gmail.com',

        //'smtp_pass' => 'P@ssw0rd1234',

        'mailtype'  => 'html', 

        'charset'   => 'utf-8' // utf-8, iso-8859-1

    );

    $CI->email->initialize($config);

    $CI->email->from( $details['from'], 'Take Rights' );

    $CI->email->to( $details['to'] ); 

    $CI->email->subject( $details['subject'] );

    $CI->email->message( $details['message'] );

    

    if ($CI->email->send()) {

        echo 'Your email was sent, thanks chamil.';

    } else {

        show_error($CI->email->print_debugger());
    }

    return true;

}



function country( $id = '' )
{

    $CI =& get_instance();    

    $CI->load->model( 'common_model' );

    if( $id == '' ){

        $res = $CI->common_model->get_list( 'country_master' );

    }else{

        $res = $CI->common_model->get_list( 'country_master', $id );

    }

    

    return $res;

}



function state( $id = '' )
{

    $CI =& get_instance();    

    $CI->load->model( 'common_model' );

    

    if( $id == '' ){

        $res = $CI->common_model->get_list( 'state_master' );

    }else{

        $res = $CI->common_model->get_list( 'state_master', $id );

    }

    return $res;

}





function upload_file($file,$section='Project',$flag='',$refference_id='',$reference_type='project')
{

		$CI =& get_instance();    

   		$CI->load->model( 'model_common' );

		

		//echo '<pre>';print_r($file);

		//echo $section;

		/////////////////////////////////////////////////////////////////

		$path = $_FILES['userfile']['name'];

		$mtypes = explode('/',$_FILES['userfile']['type']);

		$m_type=$mtypes[0];

		

		 if (!is_dir('assets/uploads/'.$section)) {

            mkdir('./assets/uploads/'.$section, 0777, true);

        }



		if($m_type=='image')

        {

			//echo 'image';

			$file_mime_type='images';

			$config['upload_path'] = 'assets/uploads/'.$section.'/';

			$config['allowed_types'] = '*';

			$config['overwrite'] = FALSE;

			$config['encrypt_name'] = TRUE;

			$config['file_name'] = $_FILES['userfile']['name'];

			$CI->load->library('upload'); //initialize

			$CI->upload->initialize($config);

			 

		if($CI->upload->do_upload()){

			$data = array('upload_data' => $CI->upload->data());

			//echo '<pre>';print_r($data);die;

			

			if($flag!='')

			{

											

											

			//echo '<pre>';print_r($data);die;

    										$CI -> load -> library('image_lib');

											$original_size = getimagesize($_FILES['userfile']['tmp_name']);

											

											$ratio = $original_size[0] / $original_size[1];

											

											//Thumb image cteate

											 if (!is_dir('assets/uploads/'.$section.'/thumb_200_296')) {

           										 mkdir('./assets/uploads/'.$section.'/thumb_200_296', 0777, true);

       											 }

											$new_width = 200;

											$new_height = (int)($new_width/$ratio);

											$file_name=$_FILES['userfile']['name'];

											$file_name=str_replace(" ","_",$file_name);

									  		$config['image_library'] = 'gd2';

											$config['source_image'] = $_FILES['userfile']['tmp_name'];

											$config['encrypt_name']=TRUE;

										$config['new_image'] = "assets/uploads/".$section."/thumb_200_296/".$data['upload_data']['file_name'];								$config['maintain_ratio'] = FALSE;

											$config['width'] = $new_width;

											$config['height'] = $new_height;

											

											

											$CI -> image_lib -> initialize($config);

											$CI -> image_lib -> resize();

											

											

											

											

											$original_size = getimagesize($_FILES['userfile']['tmp_name']);

											

											$ratio = $original_size[0] / $original_size[1];

											

											//Thumb image cteate

											 if (!is_dir('assets/uploads/'.$section.'/thumb_92_82')) {

           										 mkdir('./assets/uploads/'.$section.'/thumb_92_82', 0777, true);

       											 }

											$new_width = 92;

											$new_height = (int)($new_width/$ratio);

											$file_name=$_FILES['userfile']['name'];

											$file_name=str_replace(" ","_",$file_name);

									  		$config['image_library'] = 'gd2';

											$config['source_image'] = $_FILES['userfile']['tmp_name'];

											$config['encrypt_name']=TRUE;

										$config['new_image'] = "assets/uploads/".$section."/thumb_92_82/".$data['upload_data']['file_name'];							  $config['maintain_ratio'] = FALSE;

											$config['width'] = $new_width;

											$config['height'] = $new_height;

											

											

											$CI -> image_lib -> initialize($config);

											$CI -> image_lib -> resize();

			 }

			 

			 //////////////////////////data insert query//////////////////////////

				$new_data=array(

						 'refference_id'=>$refference_id,

						 'reference_type'=>$reference_type,

						 'file_mime_type'=>$file_mime_type,

						 'file_name'=>$data['upload_data']['file_name'],

						 'real_name'=>$data['upload_data']['orig_name']

						);

		

		// echo '<pre>';print_r($new_data);die;

				$rs=$CI->model_common->insert( 'tr_file_master', $new_data );

		

		///////////////////////////////////////////////////////////

		

				return $rs;

			 

			}

			else

			{

				return $rs=0;

			}

											

											

		}

       else

        {

			//pre($_FILES);die;

			$file_mime_type=end(explode('-',$_FILES['userfile']['name']));

			$config['upload_path'] = 'assets/uploads/'.$section.'/';

			$config['allowed_types'] = '*';

			$config['overwrite'] = FALSE;

			//$config['encrypt_name'] = TRUE;

			$config['file_name'] = $_FILES['userfile']['name'];

			$CI->load->library('upload'); //initialize

			$CI->upload->initialize($config);

			if($CI->upload->do_upload()){

    			//$CI->upload->data(); 

				$data = array('upload_data' => $CI->upload->data());

				//////////////////////////data insert query//////////////////////////

				$new_data=array(

						 'refference_id'=>$refference_id,

						 'reference_type'=>$reference_type,

						 'file_mime_type'=>$file_mime_type,

						 'file_name'=>$data['upload_data']['file_name'],

						 'real_name'=>$data['upload_data']['orig_name']

						);

		

		// echo '<pre>';print_r($new_data);die;

				$rs=$CI->model_common->insert( 'tr_file_master', $new_data );

		

		///////////////////////////////////////////////////////////

		

				return $rs;

				

				

				

				//////////////////////////data insert ends////////////////////////

			}

			else

			{

				return $rs=0;

			}

        }

		

		return 0;

		

	

}

















function days_left($date)

{

	$future = strtotime($date);

	$now = time();

	$timeleft = $future-$now;

	return $daysleft = round((($timeleft/24)/60)/60);

}





function day_diff_from_current($date1,$date2)

{

	//return $date1;

	$interval = $date1->diff($date2);

	//return $interval->h;die;

	

	//return pre($interval);die;

	if($interval->invert==1)

	{

		//return $interval->h;die;

	$diff=' ';

	if($interval->y!=0)

	{

		$diff.=$interval->y.' Yr ';

	}

	if($interval->m!=0)

	{

		$diff.=$interval->m.' mnth ';

	}

	if($interval->d!=0)

	{

		$diff.=$interval->d.' d ';

	}

	if($interval->h!=0)

	{

		$diff.=$interval->h.' h ';

	}

	if($interval->i!=0)

	{

		$diff.=$interval->i.' m ';

	}

	//if($interval->s!=0)

	//{

	//	$diff.=$interval->s.' sec ';

	//}

	

	

	return $diff;

	}

	else

	{

		

		$diff=' ';

if($interval->y!=0)

{

	$diff.=$interval->y.' Yr ';

}

if($interval->m!=0)

{

	$diff.=$interval->m.' mnth ';

}

if($interval->d!=0)

{

	$diff.=$interval->d.' d ';

}

if($interval->h!=0)

{

	$diff.=$interval->h.' h ';

}

if($interval->i!=0)

{

	$diff.=$interval->i.' m ';

}

//if($interval->s!=0)

//{

//	$diff.=$interval->s.' sec ';

//}





return $diff;

	}

}





///////////////////////////////////force dowload///////////////////////////////////////////
/*
function force_download( $filename = '', $data = '' )
{
	//echo $data;die;

    if( $filename == '' || $data == '' )
    {
        return false;
    }
    if( !file_exists( $data ) )
    {
        return false;
    }
    if( false === strpos( $filename, '.' ) )
    {
        return false;
    }
    // Grab the file extension
    $extension = strtolower( pathinfo( basename( $filename ), PATHINFO_EXTENSION ) );
    // our list of mime types
    $mime_types = array(

        'txt' => 'text/plain',
        'htm' => 'text/html',
        'html' => 'text/html',
        'php' => 'text/html',
        'css' => 'text/css',
        'js' => 'application/javascript',
        'json' => 'application/json',
        'xml' => 'application/xml',
        'swf' => 'application/x-shockwave-flash',
        // images
        'png' => 'image/png',
        'jpe' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'jpg' => 'image/jpeg',
        'gif' => 'image/gif',
        'bmp' => 'image/bmp',
        'ico' => 'image/vnd.microsoft.icon',
        'tiff' => 'image/tiff',
        'tif' => 'image/tiff',
        'svg' => 'image/svg+xml',
        'svgz' => 'image/svg+xml',
        // archives
        'zip' => 'application/zip',
        'rar' => 'application/x-rar-compressed',
        'exe' => 'application/x-msdownload',
        'msi' => 'application/x-msdownload',
        'cab' => 'application/vnd.ms-cab-compressed',
        // audio/video
        'mp3' => 'audio/mpeg',
        'qt' => 'video/quicktime',
        'mov' => 'video/quicktime',
        // adobe
        'pdf' => 'application/pdf',
        'psd' => 'image/vnd.adobe.photoshop',
        'ai' => 'application/postscript',
        'eps' => 'application/postscript',
        'ps' => 'application/postscript',
        // ms office
        'doc' => 'application/msword',
        'rtf' => 'application/rtf',
        'xls' => 'application/vnd.ms-excel',
        'ppt' => 'application/vnd.ms-powerpoint',
        // open office
        'odt' => 'application/vnd.oasis.opendocument.text',
        'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
    );

    // Set a default mime if we can't find it

    if( !isset( $mime_types[$extension] ) )
    {
        $mime = 'application/octet-stream';
    }
    else
    {
        $mime = ( is_array( $mime_types[$extension] ) ) ? $mime_types[$extension][0] : $mime_types[$extension];
    }

    // Generate the server headers

    if( strstr( $_SERVER['HTTP_USER_AGENT'], "MSIE" ) )
    {

        header( 'Content-Type: "'.$mime.'"' );

        header( 'Content-Disposition: attachment; filename="'.$filename.'"' );

        header( 'Expires: 0' );

        header( 'Cache-Control: must-revalidate, post-check=0, pre-check=0' );

        header( "Content-Transfer-Encoding: binary" );

        header( 'Pragma: public' );

        header( "Content-Length: ".filesize( $data ) );

    }
    else
    {

        header( "Pragma: public" );

        header( "Expires: 0" );

        header( "Cache-Control: must-revalidate, post-check=0, pre-check=0" );

        header( "Cache-Control: private", false );

        header( "Content-Type: ".$mime, true, 200 );

        header( 'Content-Length: '.filesize( $data ) );

        header( 'Content-Disposition: attachment; filename='.$filename);

        header( "Content-Transfer-Encoding: binary" );

    }

    readfile( $data );

    exit;

 

}

*/

///////////////////////////////category listing/////////////////////////////////////////



function get_category()

{

	

	//$config = $configArray;

    

    $CI =& get_instance();

    

    $sql="select * from `tr_project_category` where status='1' and parent_id=0";

	$query=$CI->db->query($sql);

	

		 

		if($query->num_rows()> 0)

		{

			

			foreach($query->result_array() as $row)

			{

				$data[]=$row;

				$sql_sub_cat="select * from tr_project_category where status='1' and parent_id='".$row['cat_id']."'";

				$query_sub=$CI->db->query($sql_sub_cat);

				if($query_sub->num_rows()> 0)

				{

					foreach($query_sub->result_array() as $row1)

					{

						$data[]=$row1;

					}

				}

				

			}

			

			return $data;

			

		}

     

    //return $data;

    exit;

}





//////////////special function/////////////////////



/////////////////////////////////////////////////////////////

	//	Function to get perticular field from table

	/////////////////////////////////////////////////////////////

function get_perticular_field_value($tablename,$filedname,$where=""){

		$CI =& get_instance();	

		$str="select ".$filedname." from ".$tablename." where 1=1 ".$where;

		//echo $str."<br/>";

		$query=$CI->db->query($str);

		$record="";

		if($query->num_rows()>0){

			

			foreach($query->result_array() as $row){

				$field_arr=explode(" as ", $filedname);

				if(count($field_arr)>1){

					$filedname=$field_arr[1];

				}else{

					$filedname=$field_arr[0];

				}

				$record=$row[$filedname];

			}

			

		}

		return $record;

	

	}

	/////////////////////////////////////////////////////////////

	//	Function to get last  field  value from table 

	/////////////////////////////////////////////////////////////

function get_last_field_value($tablename,$filedname,$where=""){

		$CI =& get_instance();	

		$str="select ".$filedname." from ".$tablename." where 1=1 ".$where." order by id desc limit 1";

		$query=$CI->db->query($str);

		$record="";

		if($query->num_rows()>0){

			

			foreach($query->result_array() as $row){

				$record=$row[$filedname];

			}

			

		}

		return $record;

	

	}

	

	

	

	/////////////////////////////////////////////////////////////

	//	Function to get perticular field from table

	/////////////////////////////////////////////////////////////

function get_perticular_count($tablename,$where=""){

		$CI =& get_instance();	

		$str="select * from ".$tablename." where 1=1 ".$where;

		//echo $str;

		$query=$CI->db->query($str);

		$record=$query->num_rows();

		return $record;

	

	}


	function millisecsBetween($dateOne, $dateTwo, $abs = true) {

    $func = $abs ? 'abs' : 'intval';

    return $func(strtotime($dateOne) - strtotime($dateTwo)) * 1000;

}



///////////////////////////////////////////////////////////////////////////////

//////////////////////////NEW MAIL FUNCTION///////////////////////////////////

///////////////////////////////////////////////////////////////////////////////

function send_mail_notify( $details = array() ){

	//pre($details);die;

    $CI =& get_instance();

    $CI->load->library('email'); // load library

     

    $config = Array(

        'protocol' => 'mail', //mail, sendmail, smtp

        //'smtp_host' => 'ssl://smtp.gmail.com',

        //'smtp_port' => 465,

        //'smtp_user' => 'aditya.arbsoft@gmail.com',

        //'smtp_pass' => 'P@ssw0rd1234',

        'mailtype'  => 'html', 

        'charset'   => 'utf-8' // utf-8, iso-8859-1

    );

    $CI->email->initialize($config);

    

    $CI->email->from( $details['from'], 'Take Rights' );

    $CI->email->to( $details['to'] ); 

    $CI->email->subject( $details['subject'] );

    $CI->email->message( $details['message'] );

    

    if ($CI->email->send()) {

        echo 'Your email was sent, thanks chamil.';

    } else {

        show_error($CI->email->print_debugger());

    }

	

    return true;

}



function Get_LatLng_From_Google_Maps($address) {

//https://maps.googleapis.com/maps/api/geocode/json?address=Holy%20Child%20SchoolKalna%20RdBurdwan,%20West%20Bengal

	$Address=str_replace(' ','%20',$address);

    $url = "http://maps.googleapis.com/maps/api/geocode/json?address=$Address&sensor=false";



    // Make the HTTP request

    $data = @file_get_contents($url);

    // Parse the json response

    $jsondata = json_decode($data,true);



    // If the json data is invalid, return empty array

    if (!check_status($jsondata))   return array();



    $LatLng = array(

        'lat' => $jsondata["results"][0]["geometry"]["location"]["lat"],

        'lng' => $jsondata["results"][0]["geometry"]["location"]["lng"],

    );



    return $LatLng;

}	

	

function check_status($jsondata) {

    if ($jsondata["status"] == "OK") return true;

    return false;

}	

		

////////////////////////////////////////////////////////////Password Generation//////////////////////////////////////////


/*
function generate_password_string($access_token, $raw_password )
{
	$divider = '_';
	$raw_string = $access_token.$divider.$raw_password;
	$encrypted_password = md5($raw_string);
	return $encrypted_password;
}
*/
function generate_password_string($raw_password )
{
	$divider1 = '_';
	$divider2 = '_';

	$raw_string = $divider1.$raw_password.$divider2;
	$encrypted_password = md5($raw_string);
	return $encrypted_password;
}


function clear_cache()

{

	$CI =& get_instance();

  	$CI->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");

  	$CI->output->set_header("Pragma: no-cache");

}



function lang($line, $id = '')

 {

  $CI =& get_instance();

  $line = $CI->lang->line($line);



  $args = func_get_args();



  if(is_array($args)) array_shift($args);



  if(is_array($args) && count($args))

  {

      foreach($args as $arg)

      {

          $line = str_replace_first('%s', $arg, $line);

      }

  }



  if ($id != '')

  {

   $line = '<label for="'.$id.'">'.$line."</label>";

  }



  return $line;

 }

 

function url($uri='')

{

	$url_array = explode('/',site_url($uri));

	$x = count($url_array);

	$url = '';

	for ($i=3; $i<$x; $i++){

		$url.= '/'.$url_array[$i];

	}

	return $url;

}



function str_replace_first($search_for, $replace_with, $in)

{

   $pos = strpos($in, $search_for);

   if($pos === false)

   {

	   return $in;

   }

   else

   {

	   return substr($in, 0, $pos) . $replace_with . substr($in, $pos + strlen($search_for), strlen($in));

   }

}



function get_controller()

{

	 $ci =& get_instance(); 

	 return $ci->router->fetch_class();

}



function get_function()

{

	 $ci =& get_instance(); 

	 return $ci->router->fetch_method();

}

function get_is_page($page)

{

	 $CI =& get_instance(); 

	 $str="select `is_page` from li_cms where `is_page` = 1";

		$query=$CI->db->query($str);

		$record="";

		if($query->num_rows()>0){

			

			foreach($query->result_array() as $row){

				$record=$row[$filedname];

			}

			

		}

		return $record;

	 return $ci->router->fetch_method();

}
function get_title() 
{
    $ci &= get_instance();
    return $ci->header_title;
}

function header_menu($site_lang)
{
		if($site_lang=='en')
		{
			$site_lang=1;
		}
		if($site_lang=='fr')
		{
			$site_lang=2;
		}
		//echo $site_lang;
		$CI =& get_instance(); 

		$header_menu = $CI->common_model->get_data('menu', array('menu.menu_group_id' => '1' ,'menu.menu_status' => '1', 'menu.language_id' => $site_lang), array('menu_position' => 'ASC'), '', array('menu_name','cms_url'));
		return $header_menu;

}

function get_language($site_lang)
{

		$CI =& get_instance(); 

		$lang_data = $CI->common_model->get_data('language', array('language_id' => $site_lang));

		return $lang_data[0]->language_shortcode;

}





function footer_menu($site_lang)
{		

		$CI =& get_instance(); 

		$footer_menu = $CI->common_model->get_data('menu', array('menu_group_id' => '2' ,'menu_status' => '1', 'language_id' => $site_lang), array('menu_position' => 'ASC'), '', array('menu_name','cms_url'));

		return $footer_menu;

}



function captcha()
{

     $original_string = array_merge(range(0,9), range('a','z'), range('A', 'Z'));

     $original_string = implode("", $original_string);

     $captcha = substr(str_shuffle($original_string), 0, 5);

		$vals = array(

        'word'          => $captcha,

        'img_path'      => 'assets/themes/front/captcha/image',

        'img_url'       => base_url().'assets/themes/front/captcha/image',

        'font_path'     => 'assets/themes/front/captcha/font/Walkway rounded.ttf',

        'img_width'     => '170',

        'img_height'    => 60,

        'expiration'    => 7200,

        'word_length'   => 8,

        'font_size'     => 12,

        'img_id'        => 'Imageid',

        'colors'        => array(

                'background' => array(54 , 77 , 255),

                'border' => array(0, 0, 0),

                'text' => array(255, 40, 40),

                'grid' => array(0, 0, 0)

        )

   );

$cap = create_captcha($vals);

return $cap;	

}

function RandomString()

{

    $characters = "0123456789abcdefghijklmnopqrstuvwxyz";

    $randstring = "";

    for ($i = 0; $i < 10; $i++) {

        $randstring .= $characters[rand(0, strlen($characters) - 1)];

    }

    return $randstring;

}

function email_exist($mail_id)
{
	$CI =& get_instance();
	$CI->load->model('common_model');
	$flag = $CI->common_model->get_data('users',array('email' => $mail_id));
	$count = count($flag);
	
	return $count;
}


function get_all_notification($tablename,$filedname,$where="")
{
		
		$CI =& get_instance();	
		$added_data = $where['added_date'];

		$str = "select ".$filedname." from ".$tablename." where `added_date` LIKE '%".$added_data."%'";
		$res = $CI->db->query($str);
		
		return $res->result();
		
}


function get_date_time($date,$time)
{
		
		$CI =& get_instance();	
		$added_data = $where['added_date'];

		$str = "select ".$filedname." from ".$tablename." where `added_date` LIKE '%".$added_data."%'";
		$res = $CI->db->query($str);
		
		return $res->result();
		
}



function check_is_location_airport($latlng)
{
	$airport_lat="43.67771760000001";
	$airport_lng="-79.62481969999999";
	
	if($latlng!=null)
	{
		$partsOfStr1 =explode(",",$latlng);
		
		$lat = $partsOfStr1[0];
		$lng = $partsOfStr1[1];
		
		if($lat==$airport_lat && $lng==$airport_lng)
		{
			return "1";	
		}
		else 
		{
			return "0";	
		}
	
				
	}	
}


function get_booking_status($status)
{    
$data = "";                
switch ($status) {
    case 0:
        $data = "<span style='color:red'>Confirmed</span>";
        break;
    case 1:
        $data = "<span style='color:blue'>Approved</span>";
        break;
    case 2:
        $data = "<span style='color:green'>Assigned</span>";
        break;
    case 3:
        $data = "<span style='color:blue'>Approved</span>";
        break;
    case 4:
        $data = "<span style='color:#AC0BFF'>Online</span>";
        break;
    case 5:
        $data = "<span style='color:green'>Assigned</span>";
        break;			
    case 6:
        $data = "<span style='color:#8F8383'>Complete</span>";
        break;	
    case 7:
        $data = "<span style='color:red'>Cancelled</span>";
        break;		
			
	}
	
	return 	$data;
	

}




function get_ride_url($booking_id,$status)
{    
$data = "";                
switch ($status) {
    case 0:
        $data = '<a href="'.base_url().'dashboard/booking_details/'.$booking_id.'" class="details_button">Details</a>';
        break;
    case 1:
        $data = '<a href="'.base_url().'dashboard/booking_details/'.$booking_id.'" class="details_button">Details</a>';
        break;
    case 2:
        $data = '<a href="'.base_url().'dashboard/booking_details/'.$booking_id.'" class="details_button">Details</a>';
        break;
    case 3:
        $data = '<a href="'.base_url().'dashboard/booking_details/'.$booking_id.'" class="details_button">Details</a>';
        break;
    case 4:
        $data = '<a href="'.base_url().'dashboard/tracking_details/'.$booking_id.'" class="track_button">Tracking</a>';
        break;
    case 5:
        $data = '<a href="'.base_url().'dashboard/booking_details/'.$booking_id.'" class="details_button">Details</a>';
        break;			
    case 6:
        $data = '<a href="'.base_url().'dashboard/past_booking_details/'.$booking_id.'" class="details_button">Details</a>';
        break;
    case 7:
        $data = '<a href="'.base_url().'dashboard/past_booking_details/'.$booking_id.'" class="details_button">Details</a>';
        break;			
				
	}
	
	return $data;
	
}

function get_payment_settings_info()
{
	echo 'hii'; die;
	$CI =& get_instance();
	$CI->load->model('common_model');

	$settings_data = $CI->common_model->get_data('li_payment_gateway_settings');
	return $settings_data;
	
}

function get_log_time()
{
	$CI =& get_instance();	
	$log_time = $CI->session->userdata('log_time');	
	return $log_time;
}

function get_user_id()
{
	$CI =& get_instance();	
	$user_id = $CI->session->userdata('user_id');
	$user_type_id = $CI->session->userdata('user_type_id');	
	return $user_id;
}

function get_user_type_id()
{
	$CI =& get_instance();	
	$user_type_id = $CI->session->userdata('user_type_id');	
	return $user_type_id;
}

function get_user_details()
{
	$CI =& get_instance();	
	$user_id = $CI->session->userdata('user_id');
	$user_type_id = $CI->session->userdata('user_type_id');	
	$user_details = $CI->Common_model->get_data('users',array('users.user_id' => $user_id, 'users.user_type' => $user_type_id),'','','', array('user_details'=>'user_details.user_id = users.user_id'));
	
	return $user_details;	
}

function is_email_new($email)
{

	
	$CI =& get_instance();	
	$email_id = $email;
	$count_email = $CI->Common_model->get_count('users',array('user_email' => $email_id));
	if($count_email > 0)
	{
		return FALSE;
	}
	else
	{
		return TRUE;
	}

}

function db_date_format($date){
	
	$data = explode('/', $date);
	$month= $data[0];
	$day= $data[1];
	$year= $data[2];
	$arr = array($year,$month,$day);
	$dat = implode('-', $arr);
	return $dat;
	
}

function view_date_format($date){
	
	$data = explode('-',$date);
	 $year= $data[0];
	 $month= $data[1];
	 $day= $data[2];
	
	$arr = array($day,$month,$year);
	$dat = implode('/', $arr);
	return $dat;
}

function get_superadmin_id()
{
	$CI =& get_instance();	
	$superadmin_id_arr = $CI->Common_model->get_data('users',array('user_type' => 1),'','','user_id');	
	
	return $superadmin_id_arr[0]->user_id;
}

function get_hr_id()
{
	$CI =& get_instance();	
	$hr_id_arr = $CI->Common_model->get_data('users',array('user_type' => 4),'','','user_id');	
	
	return $hr_id_arr[0]->user_id;
}

function get_main_task_list_by_id($project_id){
	$CI =& get_instance();
	$task_ids = $CI->Common_model->get_data('task_main',array('project_id' => $project_id,));
	return $task_ids;
}

function get_default_task_list_by_id($project_id){
	$CI =& get_instance();
	$task_ids = $CI->Common_model->get_data('task_main',array('project_id' => $project_id,));
	return $task_ids;
}


function get_task_list_by_id($project_id, $task_main_id="", $user_id=""){
	$CI =& get_instance();
	//echo $task_date;
	$query = "";
	$date = $CI->input->post('datefilter');
	if( !empty($date))
	{
		
		$date_range = $CI->input->post('datefilter');
		$from_arr = explode("-", $date_range);
		$from = $from_arr[0];
		$to = $from_arr[1];
		
		$frm_arr = explode('/',$from);
		$fromdt = $frm_arr[2]."-".$frm_arr[1]."-".$frm_arr[0];
		
		$to_arr = explode('/',$to);
		$todt = $to_arr[2]."-".$to_arr[1]."-".$to_arr[0];
		
		$from_dt = db_date_format($from);
		$to_dt = db_date_format($to);
		
		$query .= " AND `task`.`task_date`>='$fromdt' AND `task`.`task_date`<='$todt'";
	
	}
	
	//$task_data['task_end_time'] = $this->input->post('end_time');

	$user_id = $CI->input->post('employee_id');
	if( !empty($user_id))
	{
		$query .=" AND `user_details`.`user_id`=$user_id";
	}
	
	$status_id = $CI->input->post('status_id');
	if( !empty($status_id))
	{
		$query .=" AND `task`.`task_status`=$status_id";
	}
	
	if( !empty($task_main_id))
	{
		$query .=" AND `task`.`task_main_id`=$task_main_id";
	}
	if( !empty($project_id))
	{
		$query .=" AND `projects`.`project_id`=$project_id";
	}
	
	$last_query = "SELECT * FROM `projects` INNER JOIN `task` ON `task`.`project_id`=`projects`.`project_id` INNER JOIN `user_details` ON `user_details`.`user_id`=`task`.`user_id` WHERE `projects`.`project_status`>0".$query."  ORDER BY `task`.`task_id` DESC";
	
	//echo $last_query; die;
	$query = $CI->db->query($last_query);
	
	$latest_project = $query->result_object($query);
	//$this->data['employee'] = $userid;	

	//echo $last_query; 
	
	
		
	//$task_ids = $CI->Common_model->get_data('task_main',array('project_id' => $project_id,));
	return $latest_project;
}

function get_all_task_by_id($main_task_id, $user_id=''){
	$CI =& get_instance();
	if(!empty($user_id)){	
	$task_ids = $CI->Common_model->get_data('task',array('task.task_main_id' => $main_task_id,'task.user_id'=>$user_id),'','','',array('user_details'=>'user_details.user_id = task.user_id'));
	}
	else{
		$task_ids = $CI->Common_model->get_data('task',array('task.task_main_id' => $main_task_id),'','','',array('user_details'=>'user_details.user_id = task.user_id'));
	}
	return $task_ids;
}

function get_total_time_by_id($main_task_id="", $project_id)
{
	$CI =& get_instance();	
	
	$query = "";
	$date = $CI->input->post('datefilter');
	
	//print_r($date); die;
	
	if( !empty($date))
	{
		
		$date_range = $date;
		$from_arr = explode("-", $date_range);
		$from = $from_arr[0];
		$to = $from_arr[1];
		
		$frm_arr = explode('/',$from);
		$fromdt = $frm_arr[2]."-".$frm_arr[1]."-".$frm_arr[0];
		
		$to_arr = explode('/',$to);
		$todt = $to_arr[2]."-".$to_arr[1]."-".$to_arr[0];
		
		$from_dt = db_date_format($from);
		$to_dt = db_date_format($to);
		
		$query .= " AND `task`.`task_date`>='$fromdt' AND `task`.`task_date`<='$todt'";
	
	}
	$user_id = $CI->input->post('employee_id');
	if( !empty($user_id))
	{
		$query .=" AND `user_details`.`user_id`=$user_id";
	}

	$status_id = $CI->input->post('status_id');
	if( !empty($status_id))
	{
		$query .=" AND `task`.`task_status`=$status_id";
	}
	
	if( !empty($project_id))
	{
		$query .=" AND `projects`.`project_id`=$project_id";
	}
	if( !empty($main_task_id))
	{
		$query .=" AND `task`.`task_main_id`=$main_task_id";
	}	
	
	
	$last_query = "SELECT * FROM `projects` INNER JOIN `task` ON `task`.`project_id`=`projects`.`project_id` INNER JOIN `user_details` ON `user_details`.`user_id`=`task`.`user_id` WHERE `projects`.`project_status`>0".$query." ORDER BY `task`.`task_id` DESC";
	
	//echo $last_query; die;
	$query = $CI->db->query($last_query);
	
	$task_ids = $query->result_object($query);

	//echo "<pre>";print_r($task_ids); die;
	//echo $last_query;
	/*if($i = 2)
	{
		echo $last_query; die;
	}*/
	
	
	$total_time = 0;
	foreach($task_ids as $task){
		$time = $task->calc_task_time;
		$total_time = $total_time + $time;
	}
	
	return $total_time;
	
	
	/*if(!empty($task_id)){
		//$this->db->where($user_id);
		$task_ids = $CI->Common_model->get_data('task',array('task_main_id' => $main_task_id, 'task_id'=>$task_id));
	}
	else{
		$task_ids = $CI->Common_model->get_data('task',array('task_main_id' => $main_task_id));
	}
	
	$total_time = 0;
	foreach($task_ids as $task){
		$time = $task->calc_task_time;
		$total_time = $total_time + $time;
	}
	return $total_time;*/
}