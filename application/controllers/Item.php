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
        $data = array (
            'name_item' => $this->input->get('inputA'),
            'unit' => $this->input->get('inputB'),
            'qty' => $this->input->get('inputC'),
            'price' => $this->input->get('inputD'),
            'img' => $this->input->get('inputE'),
        );
        $this->db->insert($this->tableItem, $data);
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
        $this->db->delete($this->tableItem, array('id_item' => $id)); 
        redirect($this->className);
    }
}
