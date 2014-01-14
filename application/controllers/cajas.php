<?php
 class Cajas extends CI_Controller
 {

    function __construct(){
        parent::__construct('cajas');
    }

     public function index($fastUserId = ''){
        $this->load->model('Caja');
        $model = $this->Caja;
        $tabular_data = array();
        $report_data = $model->getDetailsPayments();

        foreach($report_data as $row)
        {
            $tabular_data[] = array($row['payment_type'],to_currency($row['payment_amount']));
        }

        $data = array(
            "data" => $tabular_data,
            "headers" => $model->getDataColumns(),
            "summary_data" => $model->getCierreDetails(),
            "fastUser"=> $fastUserId
        );

        $this->load->view('caja/cierre_caja', $data);
     }
 }
?>
