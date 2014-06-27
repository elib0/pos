<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends CI_Model {

	public $con = false;
    private $dbgroup = 'centralized';

	public function __construct()
	{
		parent::__construct();

		include('application/config/database.php');
        if (isset( $db[$this->dbgroup] )){
            $this->con = $this->load->database($this->dbgroup, true); //Unica base de dato centralizada
        }else{
            show_error('Please set the Connection group and load database "ospos_centralized"');
        }
	}

	public function save($order_data, $order_items_data){
		if ($this->con->insert('orders', $order_data)) {
			$order_id = $this->db->insert_id();
			foreach ($order_items_data as $item) {
				$this->con->insert('order_items', array_merge( $item, array('id_order'=>$order_id) ));
			}
			return true;
		}

		return false;
	}

	public function get_info($oder_id = false){
		$order = array('info'=>false, 'items'=>false);
		$this->con->from('orders');
		$this->con->where('order_id', $order_id);
		$this->con->limit(1);
		$order['info'] = $this->con->get();

		if ($order['info']->num_rows() > 0) {
			$this->con->from('order_items');
			$this->con->where('order_id', $order_id);
			$order['items'] = $this->con->get();

			return $order;
		}

		return false;
	}

	public function available(){
        $this->load->dbutil();

        return $this->dbutil->database_exists('possp_'.$this->dbgroup) && $this->con;
    }

}

/* End of file order.php */
/* Location: ./application/models/order.php */