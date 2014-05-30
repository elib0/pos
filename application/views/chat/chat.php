<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">

	<title>CodeIgniter Demo - Chat</title>

	<script type="text/javascript" src="../js/jquery-1.10.2.min.js"></script>

	<link type="text/css" rel="stylesheet" media="all" href="http://demo.webexplorar.com/codeigniter/application/css/screen.css" />

	<!--[if lte IE 7]>
	<link type="text/css" rel="stylesheet" media="all" href="http://demo.webexplorar.com/codeigniter/application/css/screen_ie.css" />
	<![endif]-->

</head>
<body>

<div id="container">

	<h2>Online Users</h2>

	<table width="45%" cellspacing="1" cellpadding="2" class="tableContent" style="margin-left:0px !important;">
	<tbody>
		<tr style="background-color:#9EB0E9;font-size:13px;font-weight:bold;color:#fff;">
			<th>Status</th>
			<th>User Id</th>
			<th>User Name</th>
			<th>Location</th>
		</tr>

		<?php

		if(isset($listOfUsers))
		{
			foreach($listOfUsers->result() as $res)
			{
		?>

		<tr style="background-color:#efefef;">
			<td><?=$res->status_name?></td>
			<td><?=$res->chat_id?></td>
			<td><?php if($user->person_id==$res->user_id && $user->location==$res->location) { ?>
					<a href="#" style="text-decoration:none">
				<?php } else { ?>
					<!-- <a href="javascript:void(0)" onClick="javascript:chatWith(<?=$res->chat_id?>,'<?=$res->username?>');"> -->
					<span class="chatUser" onClick="javascript:chatWith(<?=$res->chat_id?>,'<?=$res->username?>');">
				<?php } ?>
						<?=$res->username?>
					</a>
			</td>
			<td><?=$res->location?></td>
		</tr>
		<?php
			} // end foreach loop
		} // end if condition
		?>

		</tbody>
	</table>

</div>
</body>
</html>