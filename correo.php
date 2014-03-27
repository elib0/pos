<?php 
$response = array('status'=>0, 'msg'=>'Error sending to administrator.');

$body = '<p>Hola que hace</p>';


$email = 'skat0@hotmail.com';
$headers = 'From:pos@om-parts.com';
$subject = 'A message from Om Parts Inc. Corporate Web';

if (mail($email,$subject, $body, $headers)) {
    $response['status'] = 1;
    $response['msg'] = 'Email successfully sent al administrator!';
}

// echo $this->email->print_debugger();

die( json_encode($response) );
?>