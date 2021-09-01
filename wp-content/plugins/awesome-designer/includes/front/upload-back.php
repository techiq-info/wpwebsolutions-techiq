<?php

include('../wordpress_env.php');

if (isset($_GET) && is_array($_GET)){
    foreach ($_GET as $key => $value){
        $GET_secured[$key] = htmlentities($value, ENT_QUOTES);
    }
}


if (isSet($GET_secured) and ctype_alnum($GET_secured["id_fold"])) {
	
	require("../image-uploader.php");
	

	if (!empty($_FILES)) {	
		$tempFile = $_FILES['myfile']['tmp_name'];
		
		if ($tempFile !='') {
		
			$imageUploader = new THE_AWE_DES_Image_Uploader();
			
			$path_array  = wp_upload_dir();
			$path =  $path_array['basedir'].'/the-awe-des-awesome-upload/'.$GET_secured["id_fold"];
			$imageUploader->setPath($path);  
			$imageUploader->setMinFileSize(get_option( 'min_up_awesome_designer' )*1000);
			$imageUploader->setMaxFileSize(get_option( 'max_up_awesome_designer' )*1000);
			$name =  uniqid().rand(1,100);			
			
			try {
				$url_final = $imageUploader->upload($_FILES['myfile'],$name);
				$result['success']=true;
				$result['url']=$url_final;				
				
			} catch(Exception $e){
				$result['success']=false;
				$result['url']=$e->getMessage();
			}

		}
	}
} 

$json = json_encode($result);

header('content-type: application/json; charset=utf-8');
echo $json;

?>