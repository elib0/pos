<?php
if(isset($_GET['read'])||isset($_GET['nowrite'])){
	$db['test']='probando';

	$encrypt=base64_encode(json_encode($db));

	$content=<<<EOD
<?php
\$db=json_decode(base64_decode('$encrypt')); 
EOD;

	file_put_contents('security.php',$content);
	unset($db,$encrypt,$content);
}

echo 'Testing security file. Content:<br/>';
include 'security.php';
echo '<pre>';
var_dump($db);
echo '</pre>';
