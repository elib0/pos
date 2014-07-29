<?php
@session_start();
$_SESSION['person_id'] = $this->session->userdata('person_id');

?>
</div>
</div>
<div id="footer">
	Copyright &copy; Tagbum 2004 - <?=date('Y')?>. All Rights Reserved!&nbsp; 
	<a href="http://www.tagbum.com.com/" target="_blank">www.tagbum.com</a>
</div>
</body>
</html>