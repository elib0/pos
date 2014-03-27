<?php
require_once ("secure_area.php");
class Inventories_compare extends Secure_area
{

    function __construct()
    {
        parent::__construct('invetories_compare');
    }

    public function index(){
        $this->load->model('reports/Inventory_compare');
        $model = $this->Inventory_compare;
        $tabular_data = array();
        $report_data = $model->getData();

        foreach($report_data as $row)
        {
            $tabular_data[] = array($row['item_id'], character_limiter($row['name'], 16), $row['quantity']);
        }

        $data = array(
            "title" => $this->lang->line('reports_items_summary_report'),
            "subtitle" => 'Compare items stock '.date("m/d/Y"),
            "headers" => $model->getDataColumns(),
            "data" => $tabular_data
            // "summary_data" => $model->getSummaryData( array('sale_type' => '0') )
        );

        $this->load->view("reports/compare_stock",$data);
    }

    public function save(&$compare_data){
        $today = date('Y-m-d');
        $compare_data = array(
            'date' => $today
        );
    }

    function send_mail_to_admin(){
        $response = array('status'=>0, 'msg'=>'Error sending to administrator.');
        $this->load->library('email');

        $body = $this->input->post('report');

        $email = $this->Appconfig->get('email');
        $this->email->from($email, 'Fast I Repair');
        $this->email->to('reports@fastirepair.com');

        $this->email->subject('Report Inventory Stock');
        $this->email->message($body);

        if ($this->email->send()) {
            $response['status'] = 1;
            $response['msg'] = 'Email successfully sent al administrator!';
        }

        // echo $this->email->print_debugger();

        die( json_encode($response) );
    }
}
?>
