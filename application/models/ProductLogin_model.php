<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class productLogin_model extends CI_Model{
        public function loginDetails($u,$p){

            $sql = "select * from UserDetails where userName ='".$u."'and password ='".$p."'";	
			$qparent = $this->db->query($sql);
                        $result = $qparent->result();
//			 
			return $result;
                  }
        public function GetCoupons($pid){

            $sql = "select * from Coupons where Product_ID =".$pid." and Coupons_Status =1";	
			$qparent = $this->db->query($sql);
                        $result = $qparent->result();
//			 
			return $result;
                  }
        public function register_login($u,$p,$e){
            $n =0;
            $sql = "insert into UserDetails (userName,password,email,isAdmin) values ('".$u."','".$p."','".$e."',".$n.")";	
			$qparent = $this->db->query($sql);
			 $insert_id = $this->db->insert_id();
                         $result = array();
                         array_push($result, array("id" =>$insert_id,"username"=>$u,"isAdmin"=>0));
			return $result;
                  }
                  
                   public function GetProductDetails($id){
                 $sql1="SELECT isAdmin FROM UserDetails WHERE id=".$id;
//                 echo $sql1;
                 $qparent1 = $this->db->query($sql1);
                        $result1 = $qparent1->result();
//			print_r($result1[0]);
//                        echo ;
                $sql = "select * from Product where 1=1";	
			$qparent = $this->db->query($sql);
                        $result = $qparent->result();
                        $resarr = array();
                        $i =0;
                        foreach ($result as $row){
                            $resarr[$i]['id'] =$row->PID;
                            $resarr[$i]['Description'] =$row->Description;
                            $resarr[$i]['Image'] =URL_STORAGE_ROOT_URL.$row->Image;
                            $resarr[$i]['Price'] =$row->Price;
                            $resarr[$i]['isadmin'] =$result1[0]->isAdmin;
                            $i++;
                        }
                     return $resarr;
                  }
                  
                  public function SaveProduct($product,$price,$imgname){
            $sql = "insert into Product (Description,Image,Price) values ('".$product."','". $imgname."',".$price.")";	
			$qparent = $this->db->query($sql);
			 $insert_id = $this->db->insert_id();
                         if($insert_id == 0){
                             return "error";
                         }else
			return URL_STORAGE_ROOT_URL.$imgname;
                  }
       
    }
       