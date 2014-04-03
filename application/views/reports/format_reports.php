<?php
if(!isset($export_excel)) $export_excel=0;
if($export_excel == 1){
	ob_start();
	$this->load->view("partial/header_excel");
}else{
	$this->load->view("partial/header");
}

if(isset($list)){
	$last=count($list)-1;
	$list[0]['first']=true;
	$list[$last]['last']=true;
	for($i=0;$i<=$last;$i++) {
		$this->load->view($view,$list[$i]);
	}
}else{
	$this->load->view($view,$data);
}

if($export_excel == 1){
	$this->load->view("partial/footer_excel");
	$content = ob_end_flush();
	$filename = trim($filename);
	$filename = str_replace(array(' ', '/', '\\'), '', $title);
	$filename .= "_Export.xls";
	header('Content-type: application/ms-excel');
	header('Content-Disposition: attachment; filename='.$filename);
	echo $content;
	die();
}else{
?>
	<br/><br/>
	<a class="linkBack big_button" href="#"><span>Back</span></a>
	<br/><br/>
<?php
	$this->load->view("partial/footer");
}
?>
