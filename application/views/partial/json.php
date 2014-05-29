<?php
header('Content-type: application/json');
if(isset($json)){
	die(json_encode($json));
}else{
	die('0');
}
