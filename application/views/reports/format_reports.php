<?php
	$this->load->view("partial/header");
	$last=count($data)-1;
	$data[0]['first']=true;
	$data[$last]['last']=true;
	for($i=0;$i<=$last;$i++) {
		$this->load->view($view,$data[$i]);
	}
	$this->load->view("partial/footer");
?>