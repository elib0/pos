<div id="chatMainContainer">
	<div class="chatListContainer" style="<?=''//$_SESSION['ws-tags']['ws-user'][status_chat]!='1' ?'display:none;':''?>"></div>
	<div class="chatConfig">
		<input type="button" id="enable" value="Enable" style="<?=''//$_SESSION['ws-tags']['ws-user'][status_chat]!='1' ?'':'display:none;' ?> "/>
		<input type="button" id="disable" value="Disable" style="<?='display:none;'//$_SESSION['ws-tags']['ws-user'][status_chat]!='1' ?'display:none;':'' ?> "/>  
		<span src="img/ninimize.png" id="hideChat" style="<?=''//$_SESSION['ws-tags']['ws-user'][status_chat]!='1'?'display:none;':''?>"></span>
		<span src="img/maximize.png" id="showChat" style="display:none;" ></span>
	</div>
</div>
