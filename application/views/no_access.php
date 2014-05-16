<?php
$this->load->view("partial/header");
echo $this->lang->line('error_no_permission_module').' '.$module_name; 
$this->load->view("partial/footer");
?> 