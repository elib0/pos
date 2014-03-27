<?php
@session_start();
$_SESSION['person_id'] = $this->session->userdata('person_id');

?>
</div>
</div>
<div id="footer">
	Copyright &copy; Maog Host 2004 - <?=date('Y')?>. All Rights Reserved!&nbsp; 
	<a href="http://www.maoghost.com/" target="_blank">www.maoghost.com</a>
</div>
</body>
</html>