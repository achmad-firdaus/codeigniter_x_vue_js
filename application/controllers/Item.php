<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends CI_Controller {

    private $tableItem = 'items';
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
            'getDataItem'   => $this->db->get($this->tableItem)->result_array(),
        );
		$this->load->view($this->className.'_View', $data);
	}

    public function insert()
    {

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
                    'name_item' => $this->input->post('inputA'),
                    'unit' => $this->input->post('inputB'),
                    'qty' => $this->input->post('inputC'),
                    'price' => $this->input->post('inputD'),
                    'img' => $data['file_name'],
                );

                $this->db->insert($this->tableItem, $data);

            } else {
                print_r($this->upload->display_errors());
            }
        }
        redirect($this->className);



        // $this->db->insert($this->tableItem, $data);
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
        $this->db->delete($this->tableItem, array('id_item' => $id)); 
        redirect($this->className);
    }
}
