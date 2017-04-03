<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
defined('BASEPATH') OR exit('No direct script access allowed');
// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class ProductLogin extends REST_Controller{
     function __construct() {
             parent::__construct();

             if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
 
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
 
        exit(0);
    }
             
             		//$this->load->library('session');				
		$this->load->database();
                $this->load->helper('url'); 		
		$this->load->model('ProductLogin_model');		
	}

        function UserLoginDetails_post()
	{
            
            $postdata = file_get_contents("php://input");
//            print_r($postdata);
            if (isset($postdata)) {
            $request = json_decode($postdata);
//            print_r($request);
           $username = $request->u;
           $pass = $request->p;
           
           $types = $this->ProductLogin_model->loginDetails($username,$pass);
//		echo $u. $p.$e;
		return $this->set_response(array("status"=>"success","result"=>$types));
		
            }
//		$types = $this->ProductLogin_model->insert_login($u,$p);
//	
//		return $this->set_response(array("status"=>"success","message"=>"List of all  Data ","result"=>$types));
//		

		
	}
        function GetCoupons_post()
	{
            
            $postdata = file_get_contents("php://input");
            if (isset($postdata)) {
            $request = json_decode($postdata);
           $pid = $request->pid;
           
           $types = $this->ProductLogin_model->GetCoupons($pid);
//		echo $u. $p.$e;
		return $this->set_response(array("status"=>"success","result"=>$types));
		
            }
//		$types = $this->ProductLogin_model->insert_login($u,$p);
//	
//		return $this->set_response(array("status"=>"success","message"=>"List of all  Data ","result"=>$types));
//		

		
	}
        function UserRegisterDetails_post()
	{
//            echo "s,mdnf,snfsdn";
            $postdata = file_get_contents("php://input");
//            print_r($postdata);
            if (isset($postdata)) {
            $request = json_decode($postdata);
//            print_r($request);
           $username = $request->u;
           $pass = $request->p;
           $email = $request->e;
//           echo $email;
//           echo $pass;
//           echo $username."mfngf".$pass;
           
           $types = $this->ProductLogin_model->register_login($username,$pass,$email);
//		echo $u. $p.$e;
		return $this->set_response(array("status"=>"success","message"=>"List of all  Data ","result"=>$types));
		
            }
//		

		
	}
        function SaveProductDetails_post()
	{
            $postdata = file_get_contents("php://input");
            print_r($postdata);
            if (isset($postdata)) {
//            $request = json_decode($postdata);
//           $pname = $request->pname;
//           $price = $request->price;
          // $tmp_name =$config['upload_path'] = "./product_images";//$_FILES["file"]["tmp_name"];
            $name = $_FILES["file"]["name"];
            $tmp1 = explode(".", $_FILES["file"]["name"]);
            $newfilename = round(microtime(true)) . '.' . end($tmp1);
            if(move_uploaded_file($_FILES['file']['tmp_name'],"./product_images/".$newfilename))
            {   
//                echo $name;
//                 rename($name,);
                $pname=  $_POST['pname'];
            $price=  $_POST['price'];
            $imgname=  $newfilename;
            
            $types = $this->ProductLogin_model->SaveProduct($pname,$price,$imgname);
//		echo $u. $p.$e;
		return $this->set_response(array("status"=>"success","message"=>"List of all  Data ","result"=>$types));
		
            }
            //$postdata = var_dump($_POST);
            
            }
//		

		
	}
        function ProductDetails_post()
	{
          $postdata = file_get_contents("php://input");
//            print_r($postdata);
            $result = json_decode($postdata);
           $types = $this->ProductLogin_model->GetProductDetails($result->id);
		return $this->set_response(array("status"=>"success","message"=>"List of all  Data ","result"=>$types));
		

		
	}

}