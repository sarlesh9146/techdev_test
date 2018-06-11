<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer_m extends CI_Model
{
    public $table = 'customer';

//-----------------------------------------------------------------------------  
  /**
  * created by @sarlesh
  * getting all Customers
  */ 
    public function get_all_customer()
    {
        return $this->db->get($this->table)->result();
    }

//-----------------------------------------------------------------------------  
  /**
  * created by @sarlesh
  * get a customer by id
  */ 
    public function get($id)
    {
        return $this->db->where('customer_id', $id)->get($this->table)->row();
    }


//-----------------------------------------------------------------------------  
  /**
  * created by @sarlesh
  * Add new customer
  */     
	public function add($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }


//-----------------------------------------------------------------------------

/**
  * created by @sarlesh
 * update customer details and return true or false
*/

    public function update_data($id, $data)
    {
        //print_r($data);exit();
        return $this->db->where('customer_id', $id)->update($this->table, $data);
    }

//-----------------------------------------------------------------------------	
}