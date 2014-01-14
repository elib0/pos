<?php
class Inventory_compare extends CI_Model
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
        return array($lang['reports_item_id'] = 'Id', $this->lang->line('reports_item'), $lang['reports_item_in_stock'] = 'In Stock', $lang['reports_comment_item'] = 'Comment', $lang['reports_checked'] = 'Checked');
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

    public function save(&$compare_data){
        $b = false;
        if($this->con->insert('items_report',$compare_data)) $b = true;
        return $b;
    }
}
?>
