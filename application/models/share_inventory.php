<?php
class Share_inventory extends CI_Model
{
    var $con;

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        //Seleccion de DB
        $db = $this->session->userdata('dblocation');
        if($db)
            $this->con = $this->load->database($db, true);
        else
            $this->con = $this->db;
    }

    public function getDataColumns()
    {
        return array($lang['reports_item_id'] = 'Id', $this->lang->line('reports_item'), $lang['reports_item_in_stock'] = 'In Stock', $lang['reports_comment_item'] = 'Quantity', $lang['reports_checked'] = 'Delete Item');
    }

    public function getData()
    {
        $this->con->select('item_id, name, sum(quantity) as quantity');
        $this->con->from('items');
        // $this->con->join('items', 'sales_items_temp.item_id = items.item_id');
        $this->con->where('quantity > 0');
        $this->con->where('deleted = 0');
        $this->con->group_by('item_id');
        $this->con->order_by('quantity DESC');

        return $this->con->get()->result_array();
    }

    public function save_dispatchs($tranfer_data, $transfer_items){
        $transfer_id = 0;
        
        if ($this->con->insert('transfers', $tranfer_data) ){
            $transfer_id = $this->con->insert_id();

            foreach ($transfer_items as $value) {
                $this->con->set('transfer_id', $transfer_id);
                $this->con->set($value);
                $this->con->insert('transfer_items');
            }
        }

        return $transfer_id;
    }

    public function set_reception_status($reception_id, $status = 1){
        $this->con->where('id', $reception_id);
        $this->con->update('transfers', array('status' => $status));
    }

    public function get_all_receptions(){
        $this->con->from('transfers');
        $this->con->where('receiver', $_SESSION['dblocation']);
        $this->con->order_by('date', 'desc');
        return $this->com->get();

    }

    public function get_reception_detail($reception_id){
        $this->con->from('sales_items');
        $this->con->join('sales', 'sales.sale_id = sales_items.sale_id');
        $this->con->where('sales_items.sale_id', $reception_id);
        $this->con->where('sales.mode', 2);
        $this->con->where('sales.status', 1);
        return $this->con->get();
    }

    public function get_reception_locations($reception_id){
        $this->con->select('receiver, sender');
        $this->con->from('transfers');
        $this->con->where('id', $reception_id);
        $this->con->limit(1);
        return $this->con->get();
    }

    function get_multiple_info($item_ids)
    {
        $this->con->from('items');
        $this->con->where_in('item_id',$item_ids);
        $this->con->order_by("item", "asc");
        return $this->con->get();
    }

    function search($search)
    {
        $this->con->from('items');
        $this->con->select('item_id, name, quantity');
        $this->con->where('item_id', $search);
        $this->con->where('deleted', 0);
        $this->con->limit(1);
        return $this->con->get();
    }

    function get_search_suggestion($search, $not_in = array(), $limit = 5){
        $suggestions = array();
        $this->con->from('items');
        $this->con->like('name', $search);
        $this->con->where('quantity > 5');
        $this->con->where('deleted',0);
        if ( count($not_in) > 0 ) {
            $this->con->where_not_in( 'item_id', $not_in );
        }
        $this->con->limit($limit);
        $this->con->order_by("quantity", "asc");
        $by_item_number = $this->con->get();
        foreach($by_item_number->result() as $row)
        {
            $suggestions[]="[$row->item_id]".$row->name.', Quantity: '.$row->quantity;
            // $suggestions[]=$row->name;
        }

        return $suggestions;
    }
}
?>
