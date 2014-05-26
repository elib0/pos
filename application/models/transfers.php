<?php
class Transfers extends CI_Model
{
    var $con = false;
    private $dbgroup = 'centralized';

    function __construct()
    {
        parent::__construct();

        //Verifica grupo de conexion para transacciones
        include('application/config/database.php');
        if (isset( $db[$this->dbgroup] )){
            $this->con = $this->load->database($this->dbgroup, true); //Unica base de dato centralizada
        }else{
            show_error('Please set the Connection group and database transactions');
        }
    }

    function save($items,$customer_id,$employee_id,$comment,$payments,$sale_id=false)
    {
        if(count($items)==0)
            return -1;

        //Alain Multiple payments
        //Build payment types string
        $payment_types='';
        foreach($payments as $payment_id=>$payment)
        {
            $payment_types=$payment_types.$payment['payment_type'].': '.to_currency($payment['payment_amount']).'<br />';
        }

        $transfer_data = array(
            'sender'=>$this->session->userdata('dblocation'),
            'receiver'=>$customer_id,
            'date' => date('Y-m-d H:i:s'),
            'payment_type'=>$payment_types,
            'comment'=>$comment,
        );

        //Run these queries as a transaction, we want to make sure we do all or nothing
        $this->con->trans_start();

        $this->con->insert('transfers',$transfer_data);
        $transfer_id = $this->con->insert_id();

        foreach($items as $line=>$item)
        {
            $cur_item_info = $this->Item->get_info($item['item_id']);

            $sales_items_data = array
            (
                'transfer_id'=>$transfer_id,
                'item_id'=>$item['item_id'],
                'quantity_purchased'=>$item['quantity'],
                'description'=>$item['description'],
                'serialnumber'=>$item['serialnumber'],
                'line'=>$item['line'],
                'item_cost_price' => $cur_item_info->cost_price,
                'item_unit_price'=>$item['price'],
                'discount_percent'=>$item['discount']
            );

            $this->con->insert('transfer_items',$sales_items_data);
        }

        $this->con->trans_complete();

        if ($this->con->trans_status() === FALSE)
        {
            return -1;
        }

        return $transfer_id;
    }

    public function complete_reception($reception_id, $status = 0){
        $this->con->where('transfer_id', $reception_id);
        $this->con->update('transfers', array('status' => $status));
    }

    public function get_my_reception_detail($reception_id = 0){
        $this->con->from('transfer_items');
        $this->con->join('transfers', 'transfers.transfer_id = transfer_items.transfer_id');
        
        //Si no hay ID devulve todos las transacciones
        if ($reception_id > 0) {
            $this->con->where('transfers.transfer_id', $reception_id);
        }

        $this->con->where('transfers.status', 1);
        $this->con->where('transfers.receiver', $this->session->userdata('dblocation'));
        $this->db->limit(1);
        return $this->con->get();
    }

    public function transfers_receivable(){
        $tranfer_table = $this->db->dbprefix('transfers');
        $tranfer_item_table = $this->db->dbprefix('transfer_items');
        $query = "SELECT $tranfer_table.transfer_id AS receiving_id,$tranfer_table.date AS receiving_date,COUNT($tranfer_item_table.id) AS items_purchased,$tranfer_table.receiver AS supplier_name,
            SUM($tranfer_item_table.item_unit_price*$tranfer_item_table.quantity_purchased) AS total,
            $tranfer_table.payment_type AS payment_type 
        FROM $tranfer_table 
        JOIN $tranfer_item_table ON $tranfer_table.transfer_id = $tranfer_item_table.transfer_id
        WHERE $tranfer_table.sender = '".$this->session->userdata('dblocation')."' GROUP BY ospos_transfers.transfer_id;";

        $result = $this->db->query($query);
        if ($result->num_wors() > 0)  {
            return $result;
        }

        return false;
    }

    public function get_my_reception(){
        $this->con->from('transfers');
        $this->con->where('receiver', $this->session->userdata('dblocation'));
        $this->con->where('status', 1);
        $this->con->order_by('date', 'desc');
        return $this->con->get()->result_array();
    }

    public function available(){
        $this->load->dbutil();

        return $this->dbutil->database_exists('possp_'.$this->dbgroup) && $this->con;
    }
}
?>
