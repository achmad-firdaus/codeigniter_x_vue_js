<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

    private $tableCustomer = 'customers';
    public $className;
	public function __construct () 
    {
        parent::__construct();
        $this->className = get_class();
    }

	public function index()
	{
        $data = array (
            'pageJS'    => base_url().'assets/js/script/'.$this->className.'.js',
            'pageCss'   => base_url().'assets/css/'.$this->className.'.css',
            'getDataItem'   => $this->db->get($this->tableCustomer)->result_array(),
        );
		$this->load->view($this->className.'_View', $data);
	}

    public function insert()
    {
        $data = array (
            'name_customer' => $this->input->get('inputA'),
            'contact' => $this->input->get('inputB'),
            'email' => $this->input->get('inputC'),
            'address' => $this->input->get('inputD'),
            'diskon' => $this->input->get('inputE'),
            'type_diskon' => $this->input->get('inputF'),
        );
        
        // if(isset($this->db->get_where($this->tableCustomer, ['type_diskon'=> $this->input->get('inputF')])->row()->type_diskon)){
        //     $this->db->where('type_diskon', $data['type_diskon']);
        //     $this->db->update($this->tableCustomer, $data);
        //     if ($this->db->affected_rows() > 0) {
        //         return true;
        //     }else{
        //         return false;
        //     }   
        // }

        $this->db->insert($this->tableCustomer, $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }else{
            return false;
        }   
    }
    public function insertIMG() 
    {
        var_dump($this->input->post('data'));
    }

    public function delete($id) 
    {
        $this->db->delete($this->tableCustomer, array('id_customer' => $id)); 
        redirect($this->className);
    }
}
