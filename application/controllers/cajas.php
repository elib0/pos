<?php
 class Cajas extends CI_Controller
 {

    function __construct(){
        parent::__construct('cajas');
    }

     public function index($fastUserId = ''){
        $this->load->model('Caja');
        $tabular_data = array();
        $report_data = $this->Caja->getDetailsPayments();

        foreach($report_data as $row)
        {
            $tabular_data[] = array($row['payment_type'],to_currency($row['payment_amount']));
        }

        $data = array(
            "data" => $tabular_data,
            "headers" => $this->Caja->getDataColumns(),
            "summary_data" => $this->Caja->getCierreDetails(),
            "fastUser"=> $fastUserId
        );

        $this->load->view('caja/cierre_caja', $data);
     }
 }
?>
