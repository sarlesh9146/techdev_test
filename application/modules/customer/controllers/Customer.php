<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once('./application/libraries/REST_Controller.php');

class Customer extends REST_Controller {

//----------------------------------------------------------------------------- 
  /**
  * created by @sarlesh
  * coustruct function
  */
  public function __construct()
  {
  	
  	parent::__construct();
  	$this->load->library(array('session','encrypt'));
  	$this->load->model('customer/customer_m');
  }
  

//----------------------------------------------------------------------------- 
  /**
  * created by @sarlesh
  * geting all customers details
  */
  public function viewCustomers_get(){
  	$customer_details=$this->customer_m->get_all_customer();
  	if($customer_details){
  		$this->response(array('status' => 'true', 'data' => $customer_details), 200);
  	}
  	else{
  		$this->response(array('status' => 'false', 'message' => "No data avariable"), 401);
  	}
  }

//-----------------------------------------------------------------------------	
  /**
  * created by @sarlesh
  * user details after user login
  */ 
  public function customerdetails_get(){
  	/*$customer_id=$this->session->userdata('customer_id');
  	if($user_id){
  		$userdata= $this->user_m->get($user_id);

  		$this->response(
  			array(
  				"Message"=>"success",
  				"Status_code"=>"201",
  				"data"=>$userdata
  				)
  			);
  	}
  	$this->response(
  		array(
  			"Message"=>"Access Denied",
  			"Status_code"=>"440",
  			)
  		);*/
  }
//-----------------------------------------------------------------------------	

}
?>
