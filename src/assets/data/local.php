<?php
//---------------------------------------------------------------------
// Main API Router for this WAMP Local Service
// Author:  Edward Honour
// Date: 01/18/22
//
//-- This simulates a local database allowing developers to work 
//-- locally without access to Oracle.
//--
//-- 
//---------------------------------------------------------------------

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
header('Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Authorization');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,PUT,POST,DELETE,PATCH,OPTIONS');
header('Content-type: application/json');

//----------------------------------------------------------------------
// This function reads JSON data and turns it into PHP arrays so it can 
// be presented back as JSON data.
//----------------------------------------------------------------------

function process_file($filename) {
	
	// Set the directory location where data files will come from.
	// Since it's windows, don't forget double backslash for directories.

	$path="C:\\wamp64\\www\\assets\data\\files\\";
	
    $file=$path.$filename;
    $json=file_get_contents($file);
    $output=json_decode($json,true);	
	return $output;
}

//------------------------------------------------------------------------------------------
// Get the Data from the POST.  Note:  This is not how PHP normally sends POST data. The 
// data from the angular post will be in a variable called data.
//------------------------------------------------------------------------------------------

$data = file_get_contents("php://input");
$data = json_decode($data, TRUE);

$output=array();

if (!isset($data['q'])) $data['q']="vertical-menu";
$aa=explode("/",$data['q']);

//-- a way to test the code without posting.
if (isset($_GET['q'])) $data['q']=$_GET['q'];


if (isset($aa[1])) {
     $data['q']=$aa[1];
     if (isset($aa[2])) {
         $data['id']=$aa[2]; 
	 }
     if (isset($aa[3])) {
         $data['id2']=$aa[3]; 
	 }		 
	 if (isset($aa[4])) {
         $data['id3']=$aa[4]; 
	 }		 
}
	
//--
//-- ROUTER based on q.
//--

	switch ($data['q']) {
        case 'list-template':
                $output=process_file('tbl_user.json');
                break;	
        case 'dashboard-template':
                $output=process_file('user-dashboard.json');
                break;		
        case 'form-template':
                $output=process_file('add-user.json');
                break;
        case 'post-edit-form':
				print_r($data);
                break;	
        case 'post-add-form':
		        $output=array();
				$output['error_code']=0;
				$output['error_message']="";
                break;				
        default:
                $output=process_file('tbl_user.json');
                break;
	}


$o=json_encode($output);
$o=stripcslashes($o);
$o=str_replace('null','""',$o);
echo $o;
?>