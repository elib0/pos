<!--  telesign_msg_red.tpl -->
<p align="center" style="font-weight: bold; color: red;">{$telesign_mess}</p>
<form method="post" action="{$formaction}?step=fraudcheck">
	<center><div id="pinnumber" align="center">{$LANG.telesignpin}<input type="text" name="pin" size="10"></div></center>
	<p align="center"><input type="submit" name="ver2" value="{$LANG.ordercontinuebutton}"></p>
	<input type="hidden" name="sub" value="1">
</form>