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
        // $data = array (
        //     'name_customer' => $this->input->get('inputA'),
        //     'contact' => $this->input->get('inputB'),
        //     'email' => $this->input->get('inputC'),
        //     'address' => $this->input->get('inputD'),
        //     'diskon' => $this->input->get('inputE'),
        //     'type_diskon' => $this->input->get('inputF'),
        // );
        
		$config = [
            'upload_path' => 'assets/img/upload/',
            'allowed_types' => 'gif|jpg|png',
            'amax_size' => '5000',
            'file_name' => round(microtime(date('dY')))
            // 'encrypt_name'  => true
        ];
        $this->load->library('upload', $config);

		// UPLOAD FOTO 
		$dataFile = $this->upload->data();

        if (empty($dataFile['file_name'])){
		} else {
			// if data photo already exist
            if ($this->upload->do_upload('photoUser')) {
				// print_r($this->upload->data());
                $data = $this->upload->data();

                $data = array (
                    'name_customer' => $this->input->post('inputA'),
                    'contact' => $this->input->post('inputB'),
                    'email' => $this->input->post('inputC'),
                    'address' => $this->input->post('inputD'),
                    'diskon' => $this->input->post('inputE'),
                    'type_diskon' => $this->input->post('inputF'),
                    'img_ktp' => $data['file_name'],
                );

                $this->db->insert($this->tableCustomer, $data);

            } else {
                print_r($this->upload->display_errors());
            }
        }
        redirect($this->className);
        
        // if(isset($this->db->get_where($this->tableCustomer, ['type_diskon'=> $this->input->get('inputF')])->row()->type_diskon)){
        //     $this->db->where('type_diskon', $data['type_diskon']);
        //     $this->db->update($this->tableCustomer, $data);
        //     if ($this->db->affected_rows() > 0) {
        //         return true;
        //     }else{
        //         return false;
        //     }   
        // }

        // $this->db->insert($this->tableCustomer, $data);
        // if ($this->db->affected_rows() > 0) {
        //     return true;
        // }else{
        //     return false;
        // }   
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
