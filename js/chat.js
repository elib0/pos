var userid='';
var username='';
var windowFocus = true;
var chatHeartbeatCount = 0;
var minChatHeartbeat = 2000;
var maxChatHeartbeat = 33000;
var chatHeartbeatTime = minChatHeartbeat;
var originalTitle;
var blinkOrder = 0;
var play=true;
var typing=new Array();
var chatboxFocus = new Array();
var newMessages = new Array();
var newMessagesWin = new Array();
var chatBoxes = new Array();
var jQ=window.$||window.jQuery;

jQ(function(){
	jQ.getJSON('index.php/chat/islogged',chat_init);
});

function chat_init(status){
	jQ('#chatMainContainer').show();
	updateChatMenu(status);
	listFriendsChat(1);
	jQ('body>#chat').on('click','.listUserChat',function(){
		chatWith(this.id,$(this).attr('u'));
	});
	originalTitle = document.title;
	jQ('#hideChat,#showChat').click(function(){
		var visible=jQ('#hideChat').is(":visible");
		jQ('.chatListContainer')[visible?'slideUp':'slideDown']();
		jQ('#showChat,#hideChat').toggle();
	});
	jQ('#enable,#disable').click(function(){
		changeStatus(this.id,this);
	});
	jQ([window,document]).blur(function(){
		windowFocus = false;
	}).focus(function(){
		windowFocus = true;
		document.title = originalTitle;
	});
	chatHeartbeat();
}

function listFriendsChat(p){
	if(p==1){
		if(jQ.trim(jQ('.chatListContainer').html())==''){
			jQ('.chatListContainer').html('<div id="loading"></div>');
			// p='?p='+p;
		}
	}else{
		p='';
	}
	jQ.ajax({
		cache: false,
		dataType: "json",
		url: 'index.php/chat/friendslist/'+p,
		success: formatFriendsList
	});
}

function formatFriendsList(data){
	if(data!=null){ 
		console.log(data);
		switch(data.a*1){
		case 1:
			salida='';
			jQ.each(data.f, function(i,item){ 
				if(item){
					salida+='<div id="'+item.c+'" u="'+item.u+'" status="'+item.s+'" title="'+item.s+'" class="listUserChat">';
					// salida+='<a href="javascript:void(0)" class="listChat" title="'+item.n+'">';
					//salida+='<img width="20" height="20" src="'+item.p+'" />'+item.s+'<div class="'+item.t+'">&nbsp;</div></a>';
					salida+=item.u+'</div>';
				}
			});
			jQ('.chatListContainer').html(salida);
		break;
		case 2: 
			//execute code block 2
		break;
		default:
			//code to be executed if n is different from case 1 and 2
			jQ('.chatListContainer').html('<div style="text-align:center;">Empty</div>');
		}
	}
}

function restructureChatBoxes(){
	align = 0;
	for(x in chatBoxes){
		chatboxusr = chatBoxes[x];
		if(jQ("#chatbox_"+chatboxusr).css('display') != 'none'){
			if(align==0){
				jQ("#chatbox_"+chatboxusr).css('right', '20px');
			} else {
				width = (align)*(225+7)+20;
				jQ("#chatbox_"+chatboxusr).css('right', width+'px');
			}
			align++;
		}
	}
}

function chatWith(chatuser,chatboxname) {
	createChatBox(chatuser,0,chatboxname);
	jQ("#chatbox_"+chatuser+" .chatboxtextarea").focus();
}

function createChatBox(chatboxusr,minimizeChatBox,chatboxname){
	if (jQ("#chatbox_"+chatboxusr).length > 0){
		if (jQ("#chatbox_"+chatboxusr).css('display') == 'none'){
			jQ("#chatbox_"+chatboxusr).css('display','block');
			restructureChatBoxes();
		}
		jQ("#chatbox_"+chatboxusr+" .chatboxtextarea").focus();
		return;
	}
	typing[chatboxusr]=false;
	jQ("<div/>" ).attr("id","chatbox_"+chatboxusr)
	.addClass("chatbox")
	.html('<div class="chatboxhead"><div class="chatboxtitle">'+chatboxname+'</div><div class="minimize" onclick="javascript:toggleChatBoxGrowth(\''+chatboxusr+'\')"></div><div class="chatboxoptions"> <a href="javascript:void(0)" onclick="javascript:closeChatBox(\''+chatboxusr+'\')">X</a></div><br clear="all"/></div><div class="chatboxcontent"></div><div class="typing">'+chatboxname+' is typing...</div><div class="chatboxinput"><textarea class="chatboxtextarea" onkeyup="javascript:return checkChatBoxInputKey(event,this,\''+chatboxusr+'\',\''+chatboxname+'\');"></textarea></div>')
	.appendTo('body');
	jQ("#chatbox_"+chatboxusr).css('bottom','0px');
	chatBoxeslength = 0;
	for(x in chatBoxes){
		if(jQ("#chatbox_"+chatBoxes[x]).css('display') != 'none'){
			chatBoxeslength++;
		}
	}
	if (chatBoxeslength == 0) {
		jQ("#chatbox_"+chatboxusr).css('right', '20px');
	} else {
		width = (chatBoxeslength)*(225+7)+20;
		jQ("#chatbox_"+chatboxusr).css('right', width+'px');
	}
	chatBoxes.push(chatboxusr);
	if (minimizeChatBox == 1) {
		minimizedChatBoxes = new Array();
		if (jQ.cookie('chatbox_minimized')) {
			minimizedChatBoxes = jQ.cookie('chatbox_minimized').split(/\|/);
		}
		minimize = 0;
		for (j=0;j<minimizedChatBoxes.length;j++) {
			if (minimizedChatBoxes[j] == chatboxusr) {
				minimize = 1;
			}
		}
		if (minimize == 1) {
			jQ('#chatbox_'+chatboxusr+' .chatboxcontent').css('display','none');
			jQ('#chatbox_'+chatboxusr+' .chatboxinput').css('display','none');
		}
	}
	chatboxFocus[chatboxusr] = false;
	jQ("#chatbox_"+chatboxusr+" .chatboxtextarea").blur(function(){
		chatboxFocus[chatboxusr] = false;
		jQ("#chatbox_"+chatboxusr+" .chatboxtextarea").removeClass('chatboxtextareaselected');
	}).focus(function(){
		chatboxFocus[chatboxusr] = true;
		newMessages[chatboxusr] = false;
		jQ('#chatbox_'+chatboxusr+' .chatboxhead').removeClass('chatboxblink');
		jQ("#chatbox_"+chatboxusr+" .chatboxtextarea").addClass('chatboxtextareaselected');
	});
	jQ("#chatbox_"+chatboxusr).click(function() {
		if (jQ('#chatbox_'+chatboxusr+' .chatboxcontent').css('display') != 'none') {
			jQ("#chatbox_"+chatboxusr+" .chatboxtextarea").focus();
		}
	});
	jQ("#chatbox_"+chatboxusr).show();
}

function chatHeartbeat(p){
	var itemsfound = 0;
	if (windowFocus == false){
		var blinkNumber = 0;
		var titleChanged = 0;
		for (x in newMessagesWin) {
			if (newMessagesWin[x] == true) {
				++blinkNumber;
				if (blinkNumber >= blinkOrder) {
					document.title = '(*)'+originalTitle;
					titleChanged = 1;
					break;	
				}
			}
		}
		if (titleChanged == 0){
			document.title = originalTitle;
			blinkOrder = 0;
		} else {
			++blinkOrder;
		}
	} else {
		for (x in newMessagesWin) {
			newMessagesWin[x] = false;
		}
	}
	for(x in newMessages){
		if (newMessages[x] == true) {
			if (chatboxFocus[x] == false) {
				//FIXME: add toggle all or none policy, otherwise it looks funny
				jQ('#chatbox_'+x+' .chatboxhead').toggleClass('chatboxblink');
			}
		}
	}
	data=null;
	jQ.ajax({
		url: "index.php/chat/chatheartbeat",
		cache: false,
		dataType: "json",
		success: function(data){
			if(data!=null){
				jQ.each(data.items, function(i,item){
					if (item){ // fix strange ie bug
						chatboxusr = item.f;
						if (jQ("#chatbox_"+item.f).length <= 0) {	
							createChatBox(item.f,0,item.u);
						}
						if (jQ("#chatbox_"+item.f).css('display') == 'none'){
							jQ("#chatbox_"+item.f).css('display','block');
							restructureChatBoxes();
						}
						if (item.s == 1) {
							item.f = username;
						}
						if (item.s == 2) {
							jQ("#chatbox_"+item.f+" .chatboxcontent").append('<div class="chatboxmessage"><span class="chatboxinfo">'+item.m+'</span></div>');
						} else {
							newMessages[item.f] = true;
							newMessagesWin[item.f] = true;
							jQ("#chatbox_"+item.f+" .chatboxcontent").append('<div class="chatboxmessage"><span class="chatboxmessagefrom">'+item.u+':&nbsp;&nbsp;</span><span class="chatboxmessagecontent">'+item.m+'</span></div>');
						}
						jQ("#chatbox_"+item.f+" .chatboxcontent").scrollTop(jQ("#chatbox_"+item.f+" .chatboxcontent")[0].scrollHeight);
						itemsfound += 1;
					}
				});
				jQ.each(data.ty, function(i,item){
					if(item){// fix strange ie bug
						if(item.s == '1'){
							jQ("#chatbox_"+item.u+" .typing").css('display','block');
						}else{
							jQ("#chatbox_"+item.u+" .typing").css('display','none');
						}
					}
				});
			}
			chatHeartbeatCount++;
			if(itemsfound > 0){
				chatHeartbeatTime = minChatHeartbeat;
				chatHeartbeatCount = 1;
			}else if (chatHeartbeatCount >= 10){
				chatHeartbeatTime *= 2;
				chatHeartbeatCount = 1;
				if (chatHeartbeatTime > maxChatHeartbeat) {
					chatHeartbeatTime = maxChatHeartbeat;
				}
			}
			if(play){
				listFriendsChat(p);
				setTimeout('chatHeartbeat();',chatHeartbeatTime);
			}
		}
	});
}

function closeChatBox(chatboxusr) {
	jQ('#chatbox_'+chatboxusr).css('display','none');
	//jQ('#chatbox_'+chatboxusr).remove();
	jQ('#chatbox_'+chatboxusr+' .chatboxtextarea').val('');
	restructureChatBoxes();
	typing[chatboxusr]=false;
	jQ.post("index.php/chat/stoptyping", {to: chatboxusr} );
	jQ.post("index.php/chat/closechat", { chatbox: chatboxusr} , function(data){	});
}

function toggleChatBoxGrowth(chatboxusr) {
	if (jQ('#chatbox_'+chatboxusr+' .chatboxcontent').css('display') == 'none') {  
		var minimizedChatBoxes = new Array();
		if (jQ.cookie('chatbox_minimized')) {
			minimizedChatBoxes = jQ.cookie('chatbox_minimized').split(/\|/);
		}
		var newCookie = '';
		for (i=0;i<minimizedChatBoxes.length;i++) {
			if (minimizedChatBoxes[i] != chatboxusr) {
				newCookie += chatboxusr+'|';
			}
		}
		newCookie = newCookie.slice(0, -1)
		jQ.cookie('chatbox_minimized', newCookie);
		jQ('#chatbox_'+chatboxusr+' .chatboxcontent').css('display','block');
		jQ('#chatbox_'+chatboxusr+' .chatboxinput').css('display','block');
		jQ("#chatbox_"+chatboxusr+" .chatboxcontent").scrollTop(jQ("#chatbox_"+chatboxusr+" .chatboxcontent")[0].scrollHeight);
	} else {
		var newCookie = chatboxusr;
		if (jQ.cookie('chatbox_minimized')) {
			newCookie += '|'+jQ.cookie('chatbox_minimized');
		}
		jQ.cookie('chatbox_minimized',newCookie);
		jQ('#chatbox_'+chatboxusr+' .chatboxcontent').css('display','none');
		jQ('#chatbox_'+chatboxusr+' .chatboxinput').css('display','none');
	}
}

function checkChatBoxInputKey(event,chatboxtextarea,chatboxusr,chatboxname) { 
	if(jQ(chatboxtextarea).val()!=''&&!typing[chatboxusr]){
		typing[chatboxusr]=true;
		jQ.post("index.php/chat/starttyping", {to: chatboxusr} );
	}
	if(jQ(chatboxtextarea).val()==''&&typing[chatboxusr]){
		typing[chatboxusr]=false;
		jQ.post("index.php/chat/stoptyping", {to: chatboxusr} );
	}
	if(event.keyCode == 13 && event.shiftKey == 0)  {
		message = jQ(chatboxtextarea).val();
		message = message.replace(/^\s+|\s+$/g,"");
		jQ(chatboxtextarea).val('').focus().css('height','44px');
		if (message != '') { 
			typing[chatboxusr]=false;
			jQ.post("index.php/chat/stoptyping", {to: chatboxusr} );
			message=message.replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/\"/g,"&quot;").replace(/\'/g,"&apos;");
			message=linkify(message);
			message=emoticons(message);
			jQ("#chatbox_"+chatboxusr+" .chatboxcontent")
				.append('<div class="chatboxmessage"><span class="chatboxmessagefrom">'+chatboxname+': </span><span class="chatboxmessagecontent">'+message+'</span></div>')
				.scrollTop(jQ("#chatbox_"+chatboxusr+" .chatboxcontent")[0].scrollHeight);
			jQ.post("index.php/chat/sendchat", {to: chatboxusr, message: message} , function(data){
				//falta verificar error...
			});
		}
		chatHeartbeatTime = minChatHeartbeat;
		chatHeartbeatCount = 1;
		return false;
	}
	var adjustedHeight = chatboxtextarea.clientHeight;
	var maxHeight = 94;
	if (maxHeight > adjustedHeight) {
		adjustedHeight = Math.max(chatboxtextarea.scrollHeight, adjustedHeight);
		if (maxHeight)
			adjustedHeight = Math.min(maxHeight, adjustedHeight);
		if (adjustedHeight > chatboxtextarea.clientHeight)
			jQ(chatboxtextarea).css('height',adjustedHeight+8 +'px');
	} else {
		jQ(chatboxtextarea).css('overflow','auto');
	}
}

function linkify(text) {
    var inputText = text;//el.html();
    //URLs starting with http://, https://, or ftp://
    var replacePattern1 = /(\b(https?|ftp):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/gim;
    var replacedText = inputText.replace(replacePattern1, "<a href=$1 target=_blank>$1</a>");
    //URLs starting with www. (without // before it, or it'd re-link the ones done above)
    var replacePattern2 = /(^|[^\/])(www\.[\S]+(\b|$))/gim;
    replacedText = replacedText.replace(replacePattern2, "$1<a href=http://$2 target=_blank>$2</a>");
    //Change email addresses to mailto:: links
    var replacePattern3 = /(\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,6})/gim;
    replacedText = replacedText.replace(replacePattern3, "<a href=mailto:$1>$1</a>");
	var replacePattern4 = /(^|[^\/])(.*\.(net$|com$|org$))/gim;
    replacedText = replacedText.replace(replacePattern4, "$1<a href=http://$2 target=_blank>$2</a>");
    return replacedText;//el.html(replacedText);
}

function emoticons(text) {
    var inputText = text;//el.html();
    inputText = inputText.replace(/:-?\)/gim,		"<div class=smile></div>");
	inputText = inputText.replace(/:-?D/gim,		"<div class=bigSmile></div>");
	inputText = inputText.replace(/:-?\(/gim,		"<div class=sad></div>");
	inputText = inputText.replace(/:-?P/gim,		"<div class=tongeOut></div>");
	inputText = inputText.replace(/;-?\)/gim,		"<div class=wink></div>");
	inputText = inputText.replace(/:-?o/gim,		"<div class=surprise></div>");
	inputText = inputText.replace(/:-?s/gim,		"<div class=sick></div>");
	inputText = inputText.replace(/:&apos;-?\(/gim,	"<div class=crying></div>");
	inputText = inputText.replace(/8-?\)/gim,		"<div class=glasses></div>");
	return inputText;
}

function startChatSession(){
	jQ.ajax({
		url:"index.php/chat/startchatsession",
		cache:false,
		dataType:'json',
		success:function(data){
			username=data.username;
			userDisplay = data.userDisplay;
			jQ.each(data.items,function(i,item){
				if(item){//fix strange ie bug
					chatboxusr = item.f;
					if (jQ("#chatbox_"+chatboxusr).length <= 0) {
						createChatBox(chatboxusr,1,item.fu);
					}
					if (item.s == 1) {
						item.f = username;
					}
					if (item.s == 2) {
						jQ("#chatbox_"+chatboxusr+" .chatboxcontent").append('<div class="chatboxmessage"><span class="chatboxinfo">'+item.m+'</span></div>');
					}else{
						jQ("#chatbox_"+chatboxusr+" .chatboxcontent").append('<div class="chatboxmessage"><span class="chatboxmessagefrom">'+item.u+':&nbsp;&nbsp;</span><span class="chatboxmessagecontent">'+item.m+'</span></div>');
					}
				}
			});
			for(i=0;i<chatBoxes.length;i++){
				chatboxusr = chatBoxes[i];
				jQ("#chatbox_"+chatboxusr+" .chatboxcontent").scrollTop(jQ("#chatbox_"+chatboxusr+" .chatboxcontent")[0].scrollHeight);
				setTimeout('jQ("#chatbox_"+chatboxusr+" .chatboxcontent").scrollTop(jQ("#chatbox_"+chatboxusr+" .chatboxcontent")[0].scrollHeight);', 100); // yet another strange ie bug
			}
			setTimeout('chatHeartbeat();',chatHeartbeatTime);
		}
	});
}

function changeStatus(status,that){
	if(that) that.disabled=true;
	jQ.getJSON('index.php/chat/'+status,function(){
		updateChatMenu(status);
		listFriendsChat(1);
	}).always(function(){
		if(that) that.disabled=false;
	});
}
function updateChatMenu(status){
	if(status=='disable'){
		for (x in chatBoxes) {
			chatboxusr = chatBoxes[x];
			jQ('#chatbox_'+chatboxusr).css('display','none');
			jQ('#chatbox_'+chatboxusr+' .chatboxtextarea').val('');
		}
		jQ('#disable').hide(); 
		jQ('#enable').show();
		jQ('#showChat').hide(); 
		jQ('#hideChat').hide();
		jQ('.chatListContainer').slideUp();
		play=false;
	}else{
		jQ('#enable').hide(); 
		jQ('#disable').show();
		jQ('#showChat').hide(); 
		jQ('#hideChat').show();
		jQ('.chatListContainer').slideDown();
		play=true;
		startChatSession();
		chatHeartbeat(1);
	}
}
