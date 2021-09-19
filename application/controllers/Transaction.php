<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller {

    private $tableTransaction = 'sales';
    private $tableTransactionStagging = 'sales_stagging';
    private $tableCustomer = 'customers';
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
            'getDataTransaction'    => $this->db->get($this->tableTransaction)->result_array(),
            'getDataCustomer'       => $this->db->get($this->tableCustomer)->result_array(),
            'getDataItem'           => $this->db->get($this->tableItem)->result_array(),
            'getDataStagging'       => $this->db->select('a.total_harga, b.id_item, b.name_item, a.qty, c.id_customer, c.diskon')
                                    ->join('items b', 'a.id_item = b.id_item')
                                    ->join('customers c', 'a.id_customer = c.id_customer')
                                    ->get('sales_stagging a')->result_array(),
        );
		$this->load->view($this->className.'_View', $data);
	}

	public function index_stagging()
	{
        $data = array (
            'pageJS'    => base_url().'assets/js/script/'.$this->className.'.js',
            'pageCss'   => base_url().'assets/css/'.$this->className.'.css',
            'getDataTransaction'    => $this->db->get($this->tableTransaction)->result_array(),
            'getDataCustomer'       => $this->db->get($this->tableCustomer)->result_array(),
            'getDataItem'           => $this->db->get($this->tableItem)->result_array(),
            'getDataStagging'       => $this->db->select('a.total_harga, b.id_item, b.name_item, a.qty, c.id_customer, c.diskon')
                                    ->join('items b', 'a.id_item = b.id_item')
                                    ->join('customers c', 'a.id_customer = c.id_customer')
                                    ->get('sales_stagging a')->result_array(),
        );
		$this->load->view($this->className.'Stagging_View', $data);
	}

    public function checkQty()
    {
        if (!isset($this->db->get_where($this->tableItem, ['id_item'=>$this->input->get('inputB')])->row()->qty )) {
            echo 'false';
            return false;
        }
        if ($this->db->get_where($this->tableItem, ['id_item'=>$this->input->get('inputB')])->row()->qty >= $this->input->get('inputA')) {
            echo 'true';
            echo ' '.$this->db->get_where($this->tableItem, ['id_item'=>$this->input->get('inputB')])->row()->qty;
            return true;
        } else {
            $this->output
            ->set_status_header(201)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->_display();
            exit;
        }
    }

    public function insertStagging()
    {
        $data = array (
            'qty' => $this->input->get('inputA'),
            'id_item' => $this->input->get('inputB'),
            // 'total_harga' => (int)floatval($this->input->get('inputB')),
            'total_harga' => strval($this->db->get_where($this->tableItem, ['id_item'=>$this->input->get('inputB')])->row()->price) * strval($this->input->get('inputA')) ,
        );
        $this->db->insert($this->tableTransactionStagging, $data);
        // $this->db->where('id_item', null)->update($this->tableTransactionStagging, $data);
        
        $dataCustomer = array (
            'id_customer' => $this->db->get_where('sales_stagging',['id_customer !='=>NULL])->row()->id_customer
        );
        $this->db->where('id_customer', null)->update('sales_stagging', $dataCustomer);

        if ($this->db->affected_rows() > 0) {
            $data = array (
                'qty'   => strval($this->db->get_where($this->tableItem, ['id_item'=>$this->input->get('inputB')])->row()->qty) - strval($this->input->get('inputA')),
            );
            $this->db->where('id_item', $this->input->get('inputB') )->update($this->tableItem, $data);
            
            $this->index_stagging();
        }else{
            return false;
        }   
    }

    public function insertCustomer() 
    {
        $data = array (
            'id_customer' => $this->input->get('inputA')
        );
        $this->db->insert('sales_stagging', $data);
        $this->db->where('id_customer', null)->update('sales_stagging', $data);
    }

    public function totalHarga ()
    {
        $id_customer = $this->db->get_where('sales_stagging', ['id_customer != NULL'])->row()->id_customer;
        $totalharga= $this->db->select('SUM(total_harga) as total_harga')->get_where('sales_stagging')->row()->total_harga;
        $diskon =  $this->db->get_where('customers', ['id_customer'=> $id_customer])->row()->diskon;
        echo
        $totalharga * $diskon / 100;
    }

    public function insert()
    {
        $this->db->delete('sales_stagging', array('qty' => NULL));

        $id_customer = $this->db->get_where('sales_stagging', ['id_customer != NULL'])->row()->id_customer;
        $totalharga= $this->db->select('SUM(total_harga) as total_harga')->get_where('sales_stagging')->row()->total_harga;
        $diskon =  $this->db->get_where('customers', ['id_customer'=> $id_customer])->row()->diskon;
        $data = array(
            'code' => $this->input->post('dataA'),
            'date' => $this->input->post('dataB'),
            'customer' => $this->db->get_where('customers', ['id_customer'=> $id_customer])->row()->name_customer,
            'toatal_diskon' => $diskon,
            'total_harga' => $totalharga * $diskon / 100,
            'total_bayar' => $this->input->post('dataC'),
        );
        $this->db->insert('sales', $data);
        $qty = $this->db->get('sales_stagging')->row()->qty;
        $id_item = $this->db->get('sales_stagging')->row()->id_item;
        $data_sales_detail = array (
            'id_transaction' => $this->db->order_by('date DESC')->get('sales')->row()->id_transaction,
            'qty' => $qty,
            'id_item' =>  $id_item
        );
        $this->db->insert('sales_detail', $data_sales_detail);

        $this->db->delete('sales_stagging', array('id_customer !=' => NULL));
    }

    public function delete($id) 
    {
        $this->db->delete('sales_stagging', array('id_customer' => $id)); 
        redirect($this->className);
    }
}
