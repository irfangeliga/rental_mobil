<?php 

require_once "koneksi.php";
if(function_exists($_GET['function'])) {
     $_GET['function']();
}

function getUser()
{
  global $connect;
  
   $data = null;
  $query ="SELECT * FROM register ";      
  $result = $connect->query($query);
  while($row = mysqli_fetch_object($result))
  {
     $data[] = $row;
  }
  if($data)
  {
     $response = array(
        'status' => 1,
        'data' => $data
     );               
  } else {
     $response=array(
        'status' => 0,
        'data' =>$data
     );
  }      
  header('Content-Type: application/json');
  echo json_encode($response);
}

function getUserId()
{
  global $connect;
  if (!empty($_GET["email"])) {
     $email = $_GET["email"];      
  }		
  if (!empty($_GET["password"])) {
     $password = $_GET["password"];   
     $password = md5($password);   
  }		
  
   $data = null;
  $query ="SELECT * FROM register WHERE password = '$password' AND email = '$email'";      
  $result = $connect->query($query);
  while($row = mysqli_fetch_object($result))
  {
     $data[] = $row;
  }
  if($data)
  {
     $response = array(
        'status' => 1,
        'data' => $data
     );               
  } else {
     $response=array(
        'status' => 0,
        'data' =>$data
     );
  }      
  header('Content-Type: application/json');
  echo json_encode($response);
}

function setUser()
{
   global $connect;
   $data = null;
   $password = $query = $type =  "";
   if (!empty($_GET["id"])) 	   $id 		   = $_GET["id"];      
   if (!empty($_GET["nama"]))    $nama 	   = $_GET["nama"];
   if (!empty($_GET["alamat"]))  $alamat 	   = $_GET["alamat"];
   if (!empty($_GET["email"]))   $email 	   = $_GET["email"];
   if (!empty($_GET["pwd"])) 	   $password   = $_GET["pwd"];
   if (!empty($_GET["telepon"])) $telepon 	= $_GET["telepon"];
   if (!empty($_GET["no_sim"]))  $no_sim   	= $_GET["no_sim"];
   if (!empty($_GET["status"]))  $status   	= $_GET["status"];
   if (!empty($_GET["type"]))    $type 		= $_GET["type"];
   
   if($type == 'insert' || $type == 'update') {
      if($nama && $email && $status) {
			if($type == 'insert' && $password){
            $password = md5($password);
            $query = "INSERT INTO register SET nama = '$nama', alamat = '$alamat', email = '$email', password = '$password', telepon = '$telepon', no_sim = '$no_sim', status = '$status'";
            $result = mysqli_query($connect, $query);
			}else{
            if($password) {
               $password = md5($password);
               $query = "UPDATE master_user SET password = '$password', nama = '$nama', cabang = '$cabang', level = '$level',
               grade = '$grade', status = '$status' , supervisor = '$supervisor', teamhead = '$teamhead' WHERE username = '$id'";
               $result = mysqli_query($connect, $query);
            } else {
               $query = "UPDATE master_user SET nama = '$nama', cabang = '$cabang', grade = '$grade', level = '$level', status = '$status' , supervisor = '$supervisor', teamhead = '$teamhead'
               WHERE username = '$id'";
               $result = mysqli_query($connect, $query);
            }	
         } 
         
         
         
			
         if($result)
         {
				$response=array(
                     'status' => 1,
                     'message' =>$type .' success'
                );
         } else {
				$response=array(
                     'status' => 0,
                     'message' =>$type .' failed.'
                );
         }
         
      } else {
         $response=array(
            'status' => "0",
            'message' =>'Wrong Parameter'
         );
      }
   }

   if($type == 'delete') {
      if($id) {

         global $connect;
         $query = "DELETE FROM master_user WHERE username = '$id'";
         $result = mysqli_query($connect, $query);
         
         if($result)
         {
            $response=array(
               'status' => "1",
               'message' =>$type .' success'
            );
         } else {
            $response=array(
               'status' => "0",
               'message' =>$type .' failed.'
            );
         }
      } else {
         $response=array(
            'status' => "0",
            'message' =>'Wrong Parameter'
         );
      }
   }
      header('Content-Type: application/json');
      echo json_encode($response);
}

function setInput()
   {
		global $connect;
      $id="";
      if (!empty($_GET["id"]))         $id         = $_GET["id"];      
      if (!empty($_GET["merk"]))       $merk       = $_GET["merk"];      
		if (!empty($_GET["model"]))      $model      = $_GET["model"];
		if (!empty($_GET["plat"]))       $plat       = $_GET["plat"];
		if (!empty($_GET["tarif"]))      $tarif      = $_GET["tarif"];
		if (!empty($_GET["foto"]))       $foto       = $_GET["foto"];
		if (!empty($_GET["type"]))       $type       = $_GET["type"];
		
      if(!empty($foto)){
         $image = ", foto = '$foto'";
      }else{
         $image ="";
      }
         if($type == 'insert' || $type == 'update') 
         {
            $query = "SELECT * FROM mobil WHERE id = '$id'";
            $result = mysqli_query($connect, $query);
            if(mysqli_fetch_object($result)) 
            {
               $query = "UPDATE mobil SET  merk = '$merk', model = '$model',  plat = '$plat', tarif = '$tarif'".$image." WHERE id = '$id'";
            } else {
               $query = "INSERT INTO mobil SET merk = '$merk', model = '$model',  plat = '$plat', tarif = '$tarif'".$image;
            }
         } 

      if($type == 'delete') 
      {
         $query = "DELETE FROM mobil WHERE id = '$id'";
      } 
         
      $result = mysqli_query($connect, $query);

      if($result)
      {
         $response=array(
            'status' => 1,
            'message' =>$type .' success'
         );
      } else {
         $response=array(
            'status' => 0,
            'message' =>$type .' failed.'
         );
      }
      header('Content-Type: application/json');
      echo json_encode($response);
   }


function getInput()
{
  global $connect;
  
   $data = null;
  $query ="SELECT * FROM mobil ";      
  $result = $connect->query($query);
  while($row = mysqli_fetch_object($result))
  {
     $data[] = $row;
  }
  if($data)
  {
     $response = array(
        'status' => 1,
        'data' => $data
     );               
  } else {
     $response=array(
        'status' => 0,
        'data' =>$data
     );
  }      
  header('Content-Type: application/json');
  echo json_encode($response);
}

function getInputId()
{
  global $connect;
  
   $data = null;

   if (!empty($_GET["id"]))         $id         = $_GET["id"];   

  $query ="SELECT * FROM mobil where id = $id ";      
  $result = $connect->query($query);
  while($row = mysqli_fetch_object($result))
  {
     $data[] = $row;
  }
  if($data)
  {
     $response = array(
        'status' => 1,
        'data' => $data
     );               
  } else {
     $response=array(
        'status' => 0,
        'data' =>$data
     );
  }      
  header('Content-Type: application/json');
  echo json_encode($response);
}

?>