<?php

require_once 'Mysql.php';

$db  = new Mysql();

if(isset($_POST['action'])&&!empty($_POST['action'])){
	$data['action']=$_POST['action'];	
}


switch($data['action']){
	case 'get_city':
	
		  $sql   = "SELECT * FROM city ";
		  
		  $result=$db->select($sql);
		  if(is_array($result)){
		  $responce=json_encode(array('msg'=>'OK','result'=>$result));
		 
		 }else{
			 $responce=json_encode(array('msg'=>'NOK'));
		 }
		  echo $responce;
	break;
	case 'save':
	
			$data['firstname']=isset($_POST['firstname'])? $_POST['firstname']:$_GET['firstname'];
			$data['lastname']=isset($_POST['lastname'])? $_POST['lastname']:$_GET['lastname'];
			$data['email']=isset($_POST['email'])? $_POST['email']:$_GET['email'];
			$data['age']=isset($_POST['age']) && intval($_POST['age'])!="" ? intval($_POST['age']):0;
			$data['city']=isset($_POST['city']) && intval($_POST['city'])!=0 ? intval($_POST['city']):1;
			
			
			$sql   = "INSERT INTO jeux (Id,FirstName,LastName, Email,Age,city_id) VALUES (null,'".$data['firstname']."','".$data['lastname']."','".$data['email']."',".$data['age'].",".$data['city'].")";
			
			$idjeux=$db->insert($sql);
			if($idjeux>0){
				header('Location: success.php');
			}
	break;
	default:
		header('Location: index.php');
	break;
	
}

