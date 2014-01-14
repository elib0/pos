<?php
 
include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR."modules.php";
include dirname(__FILE__).DIRECTORY_SEPARATOR."lang/en.php";
if (file_exists(dirname(__FILE__).DIRECTORY_SEPARATOR."lang/".$lang.".php")) {
	include dirname(__FILE__).DIRECTORY_SEPARATOR."lang/".$lang.".php";
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $m_language[0];?></title>
<meta name="viewport" id="viewport" content="width=device-width,height=device-height,initial-scale=1.0,user-scalable=no" />
<style type="text/css" media="screen">@import "css/cometchat.css";</style>
<script type="text/javascript" charset="utf-8" src="../cometchatjs.php?callbackfn=m&1"></script>
<script type="text/javascript" src="js/m.php"></script>

</head>
<body>
<div id="whosonline">
	<div id="header" class="header">
		<div id="menu" class="title"><img src="../../app/img/home.png" onclick="document.location='../../app/timeline.html'" /><h1 >Chat</h1></div>
	</div>
	<div id="wrapper">
		<div id="scroller">
			<ul id="permanent"></ul>
			<ul id="wolist"></ul>
			<div id="endoftext"></div>
		</div>
	</div>
</div>
<div id="chatwindow">
</div>
</body>
</html>