<?php
//---------------------------------------------------------------------
// Main API Router for this angular directory.
// Author:  Edward Honour
// Date: 07/18/2021
//---------------------------------------------------------------------

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
header('Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Authorization');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,PUT,POST,DELETE,PATCH,OPTIONS');
header('Content-type: application/json');

require_once('../../../lib/class.OracleDB.php');

$uid=$_COOKIE['uid'];

$X=new OracleDB();
$db=$X->connectACN();

// Require and initialize the class libraries necessary for this module. Code 
// specific for your application goes in here.

//=======================================================================================
// APPLICATION SPECIFIC CODE BELOW - CONNECT STRING CODE ABOVE
//=======================================================================================

require_once('class.users.php');

$A=new USERS();

//-- a way to test the code without posting.
if (isset($_GET['q'])) $data['q']=$_GET['q'];

// Get the Data from the POST.  Note:  This is not how PHP normally sends POST data. The 
// data from the angular post will be in a variable called data.

$data = file_get_contents("php://input");
$data = json_decode($data, TRUE);

$output=array();

if (!isset($data['q'])) $data['q']="vertical-menu";
$aa=explode("/",$data['q']);

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
                 $output=$A->getUsers($data);
                break;	
        case 'dashboard-template':
                $output=$A->getUserDashboard($data);
                break;		
        case 'form-template':
                $output=$A->getAddUserForm($data);
                break;	
        case 'post-edit-form':
		        $output=$A->postEditForm($data);
                break;
        case 'post-add-form':
				$output=$A->postAddForm($data);
                break;	
        default:
                $output=$A->getUsers($data);
                break;
				
}

$o=json_encode($output);
$o=stripcslashes($o);
$o=str_replace('null','""',$o);
echo $o;
?>