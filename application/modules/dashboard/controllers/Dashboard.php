<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once('./application/libraries/REST_Controller.php');

class Dashboard extends REST_Controller {

//----------------------------------------------------------------------------- 
  /**
  * created by @sarlesh
  * coustruct function
  */
	public function __construct()
	{
		
	    parent::__construct();
		  $this->load->library(array('session','encrypt'));
	    $this->load->model('register/user_m');
	}
	
//-----------------------------------------------------------------------------	
  /**
  * created by @sarlesh
  * user details based on user id
  */ 
	public function getuserdetails_get(){
		$user_id=$this->uri->segment(3);
		if($user_id){
			$userdata= $this->user_m->get($user_id);

			$this->response($userdata);
		}
	}

//-----------------------------------------------------------------------------
/**
 * Active or inactive status
 * created By @sarlesh
*/ 
    public function changestatus_post()
    {
        $userid=$this->uri->segment(3);

        $user=$this->user_m->get($userid);
        if($user->status=="1"){
        $data=array(
                "status"=> "0"
            );
        }
        else{
           $data=array(
                "status"=> "1"
            ); 
        }
        if ($succes_status = $this->user_m->update_data($userid,$data)){
            if($user->status=="1"){
            $this->response(
                    array(
                        'Status_code' => "201",
                        'Message' => "User Deactivated"
                        )
                    );
            }
            else{
            $this->response(
                    array(
                        'Status_code' => "201",
                        'Message' => "User Activated"
                        )
                    );   
            }
        }
        else
        {
            $this->response(
                    array(
                    'Status_code' => "401",
                    'Message' => "ops something went wrong"
                    )
                );           
        }
    }


//-----------------------------------------------------------------------------
/**
 * Update user details
 * Created By @sarlesh
*/ 
    public function updateUserDetails_post()
    {
        $userid=$this->post('user_id');
        if($this->post('password')!=""){
        	$password=md5($this->post('password'));
        }
        else{
        	$password=$this->post('user_pwd');
        }
       $data=array(
            "first_name"=> $this->post('first_name'),
            "last_name"=> $this->post('last_name'),
            "user_email"=> $this->post('user_email'),
            "user_pwd"=> $password,
        ); 
    	if ($succes_status = $this->user_m->update_data($userid,$data)){
        $this->response(
                array(
                    'Status_code' => "201",
                    'Message' => "User Updated"
                    )
                );
        }
        else{
        $this->response(
                array(
                    'Status_code' => "201",
                    'Message' => "User not update"
                    )
                );   
        }
	}

//-----------------------------------------------------------------------------
}
?>
