var disablelogs=false;
var nolog=/friendslist/gi;
var jQ=window.$||window.jQuery;
var chatcontrol='index.php/chat/';
var play=true;
var minChatHeartbeat=2000;
var maxChatHeartbeat=33000;
var windowFocus=true;
var chatHeartbeatCount=0;
var originalTitle;
var blinkOrder=0;
var chatpos=175;

jQ(function(){

var userid='';
var username='';
var chatHeartbeatTime=minChatHeartbeat;
var typing=new Array();
var chatBoxes=new Array();
var chatboxFocus=new Array();
var newMessages=new Array();
var newMessagesWin=new Array();

if(window.chatStarted) return;
if(window.matchMedia('screen').matches) chat_ajax(chatcontrol+'islogged',chat_init);

function chat_init(data){
	window.chatStarted=true;
	jQ('body').append(
		'<div id="chat">'+
			'<div id="chatmsgs"></div>'+
			'<div id="chatMainContainer">'+
				'<div class="chatListContainer"></div>'+
				'<div class="chatConfig">'+
					'<input type="button" id="enable" value="Show"/><input type="button" id="disable" value="Hide"/>'+
					'<span id="hideChat"></span><span id="showChat" style="display:none;"></span>'+
				'</div>'+
			'</div>'+
		'</div>'
	);
	jQ('#chatMainContainer').show();
	showChat(data.online);
	startChatSession();
	jQ('body>#chat').on('click','.listUserChat',function(){
		if(this.id!=userid){
			var chatbox=createChatBox(this.id,0,this.dataset.name,1);
			jQ('textarea',chatbox).focus();			
		}
	}).on('keyup','#chatmsgs textarea',function(event){
		checkChatBoxInputKey.call(this,event);
	}).on('click','.chatbox',function(){
		if(jQ('.chatboxcontent',this).is(':visible')){
			jQ('textarea',this).focus();
		}
	}).on('click','.chatbox .minimize',function(){
		toggleChatBoxGrowth(jQ(this).parents('.chatbox')[0].id);
	}).on('click','.chatboxoptions #close',function(){
		var chatbox=jQ(this).parents('.chatbox'),
			chatboxusr=chatbox[0].id;
		chatbox.css('display','none');
		//chatbox.remove();
		jQ('textarea',chatbox).val('');
		restructureChatBoxes();
		typing[chatboxusr]=false;
		jQ.post(chatcontrol+'stoptyping',{to:chatboxusr});
		jQ.post(chatcontrol+'closechat',{chatbox:chatboxusr},function(data){});
	});
	originalTitle=document.title;
	jQ('#hideChat,#showChat').click(function(){
		var visible=jQ('#hideChat').is(':visible');
		jQ('.chatListContainer')[visible?'slideUp':'slideDown']();
		jQ('#showChat,#hideChat').toggle();
	});
	jQ('#enable,#disable').click(function(){
		showChat(this.id);
		//changeStatus(this.id,this);
	});
	jQ([window,document]).blur(function(){
		windowFocus=false;
	}).focus(function(){
		windowFocus=true;
		document.title=originalTitle;
	});
}

function startChatSession(){
	chat_ajax({
		url:chatcontrol+'startchatsession',
		success:function(data){
			//console.log(['startchatsession',data]);
			var chatbox,content;
			userid=data.userid;
			username=data.username;
			jQ.each(data.items,function(i,item){
				if(item){//fix strange ie bug
					chatbox=jQ('.chatbox#'+item.f);
					if(chatbox.length<=0){
						chatbox=createChatBox(item.f,1,item.u,3);
					}
					if(item.s==1){
						item.f=userid;
						item.u=username;
					}
					if(item.s==2){
						jQ('.chatboxcontent',chatbox).append('<div class="chatboxmessage"><span class="chatboxinfo">'+emoticons(item.m)+'</span></div>');
					}else{
						jQ('.chatboxcontent',chatbox).append('<div class="chatboxmessage"><span class="chatboxmessagefrom">'+item.u+':&nbsp;&nbsp;</span><span class="chatboxmessagecontent">'+emoticons(item.m)+'</span></div>');
					}
				}
			});
			for(i=0;i<chatBoxes.length;i++){
				content=jQ('.chatboxcontent',chatBoxes[i]);
				content.scrollTop(content[0].scrollHeight);
				setTimeout(function(){
					content.scrollTop(content[0].scrollHeight);
				},100);//yet another strange ie bug
			}
			chatHeartbeat(1);
		}
	});
}

function checkChatBoxInputKey(event){
	if(this.value!=''&&!typing[this.id]){
		typing[this.id]=true;
		jQ.post(chatcontrol+'starttyping',{to:this.id});
	}
	if(this.value==''&&typing[this.id]){
		typing[this.id]=false;
		jQ.post(chatcontrol+'stoptyping',{to:this.id});
	}
	if(event.keyCode==13&&event.shiftKey==0){
		message=this.value;
		message=message.replace(/^\s+|\s+$/g,"");
		this.value='';
		jQ(this).focus().css('height','44px');
		if(message!=''){
			typing[this.id]=false;
			jQ.post(chatcontrol+'stoptyping',{to:this.id});
			//message=message.replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/\"/g,"&quot;").replace(/\'/g,"&apos;");
			message=linkify(message);
			var content=jQ(this).parents('.chatbox').find('.chatboxcontent');
			content.append('<div class="chatboxmessage"><span class="chatboxmessagefrom">'+username+': </span><span class="chatboxmessagecontent">'+emoticons(message)+'</span></div>')
				.scrollTop(content[0].scrollHeight);
			//console.log(message);
			jQ.post(chatcontrol+'sendchat',{to:this.id,message:message},function(data){
				//falta verificar error...
			});
		}
		chatHeartbeatTime=minChatHeartbeat;
		chatHeartbeatCount=1;
		return false;
	}
	var adjustedHeight=this.clientHeight;
	var maxHeight=94;
	if(maxHeight>adjustedHeight){
		adjustedHeight=Math.max(this.scrollHeight,adjustedHeight);
		if(maxHeight)
			adjustedHeight=Math.min(maxHeight,adjustedHeight);
		if(adjustedHeight > this.clientHeight)
			jQ(this).css('height',adjustedHeight+8+'px');
	}else{
		jQ(this).css('overflow','auto');
	}
}

function changeStatus(status,that){
	if(that) that.disabled=true;
	chat_ajax(chatcontrol+status,function(){
		showChat(status);
		startChatSession();
	}).always(function(){
		if(that) that.disabled=false;
	});
}

function showChat(enable){
	if(enable=='enable'||enable=='disable') enable=(enable!='disable');
	if(enable){
		jQ('.chatListContainer').slideDown();
		jQ('#chatmsgs').fadeIn();
		jQ('#chat #disable,#hideChat').show();
		jQ('#chat #enable,#showChat').hide(); 
		//play=true;
		//startChatSession();
	}else{
		jQ('.chatListContainer').slideUp();
		jQ('#chatmsgs').fadeOut();
		jQ('#chat #enable').show();
		jQ('#chat #disable,#showChat,#hideChat').hide();
		//play=false;
	}
}

var chbt;//chatheartbeat timeout var
function chatHeartbeat(p){
	if(chbt) return;
	var itemsfound=0,x;
	if(windowFocus==false){
		var blinkNumber=0;
		var titleChanged=0;
		for(x in newMessagesWin){
			if(newMessagesWin[x]==true){
				++blinkNumber;
				if(blinkNumber>=blinkOrder){
					document.title='(*)'+originalTitle;
					titleChanged=1;
					break;	
				}
			}
		}
		if(titleChanged==0){
			document.title=originalTitle;
			blinkOrder=0;
		}else{
			++blinkOrder;
		}
	}else{
		for(x in newMessagesWin){
			newMessagesWin[x]=false;
		}
	}
	for(x in newMessages){
		if(newMessages[x]==true){
			if(chatboxFocus[x]==false){
				//FIXME: add toggle all or none policy,otherwise it looks funny
				jQ('.chatbox#'+x+' .chatboxhead').toggleClass('chatboxblink');
			}
		}
	}
	var blink=jQ('#chatmsgs .chatboxblink').length>0;
	jQ('#chat .chatConfig')[blink?'addClass':'removeClass']('chatboxblink');
	data=null;
	chbt=true;
	chat_ajax({
		url:chatcontrol+'chatheartbeat',
		success:function(data){
			if(data){
				var chatbox;
				jQ.each(data.items,function(i,item){
					if(item){//fix strange ie bug
						chatbox=jQ('.chatbox#'+item.f);
						if(chatbox.length<=0){	
							chatbox=createChatBox(item.f,0,item.u,2);
						}
						if(chatbox.css('display')=='none'){
							chatbox.css('display','block');
							restructureChatBoxes();
						}
						if(item.s==1){
							item.f=userid;
							item.u=username;
						}
						if(item.s==2){
							jQ('.chatboxcontent',chatbox).append('<div class="chatboxmessage"><span class="chatboxinfo">'+emoticons(item.m)+'</span></div>');
						}else{
							newMessages[item.f]=true;
							newMessagesWin[item.f]=true;
							jQ('.chatboxcontent',chatbox).append('<div class="chatboxmessage"><span class="chatboxmessagefrom">'+item.u+':&nbsp;&nbsp;</span><span class="chatboxmessagecontent">'+emoticons(item.m)+'</span></div>');
						}
						jQ('.chatboxcontent',chatbox).scrollTop(jQ('.chatboxcontent',chatbox)[0].scrollHeight);
						itemsfound+=1;
					}
				});
				jQ.each(data.ty,function(i,item){
					if(item){// fix strange ie bug
						jQ('.chatbox#'+item.u+' .typing').css('display',item.s=='1'?'block':'none');
					}
				});
			}
			chatHeartbeatCount++;
			if(itemsfound>0){
				chatHeartbeatTime=minChatHeartbeat;
				chatHeartbeatCount=1;
			}else if(chatHeartbeatCount>=10){
				chatHeartbeatTime*=2;
				chatHeartbeatCount=1;
				if(chatHeartbeatTime>maxChatHeartbeat){
					chatHeartbeatTime=maxChatHeartbeat;
				}
			}
			if(play){
				listFriendsChat(p);
				setTimeout(chatHeartbeat,chatHeartbeatTime);
			}
		},
		complete:function(){
			chbt=false;
		}
	});
}

var lfc;
function listFriendsChat(p){
	if(lfc&&!p) return;
	if(p==1){
		if(jQ.trim(jQ('.chatListContainer').html())==''){
			jQ('.chatListContainer').html('<div id="loading"></div>');
			// p='?p='+p;
		}
	}else{
		p='';
	}
	lfc=true;
	chat_ajax({
		url:chatcontrol+'friendslist',
		data:{'update':p},
		success:function(data){
			if(data!=null){
				// console.log(data);
				switch(data.a*1){
				case 1:
					var el,me,salida='';
					jQ.each(data.f,function(i,item){
						if(item){
							me=(item.c==userid);
							el='<div id="'+item.c+'" data-name="'+item.u+'" data-status="'+item.t+'" '+(me?'':'title="'+item.t+'"')+' class="listUserChat'+(me?' me':'')+'"></div>';
							if(me)
								salida=el+salida;
							else
								salida+=el;
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
		},
		complete:function(){
			lfc=false;
		}
	});
}

function restructureChatBoxes(){
	align=0;
	for(var x in chatBoxes){
		chatbox=jQ(chatBoxes[x]);
		if(chatbox.css('display')!='none'){
			if(align==0){
				chatbox.css('right',chatpos+'px');
			}else{
				width=(align)*(225+7)+chatpos;
				chatbox.css('right',width+'px');
			}
			align++;
		}
	}
}

function createChatBox(chatboxusr,minimizeChatBox,chatboxname,tmp){
	//console.log([tmp,chatboxusr,chatboxname]);
	var chatbox=jQ('.chatbox#'+chatboxusr);
	if(chatbox.length > 0){
		if(chatbox.css('display')=='none'){
			chatbox.css('display','block');
			restructureChatBoxes();
		}
		jQ('textarea',chatbox).focus();
		return chatbox;
	}
	typing[chatboxusr]=false;
	chatbox=jQ('<div/>' ).addClass('chatbox').attr('id',chatboxusr)
	.html('<div class="chatboxhead"><div class="chatboxtitle">'+chatboxname+'</div><div class="minimize"></div><div class="chatboxoptions"> <a id="close" href="javascript:void(0)">X</a></div><br clear="all"/></div><div class="chatboxcontent"></div><div class="typing">'+chatboxname+' is typing...</div><div class="chatboxinput"><textarea id="'+chatboxusr+'" data-name="'+chatboxname+'" class="chatboxtextarea"></textarea></div>')
	.appendTo('#chatmsgs');
	chatbox.css('bottom','0px');
	chatBoxeslength=0;
	for(x in chatBoxes){
		if(jQ(chatBoxes[x]).css('display')!='none'){
			chatBoxeslength++;
		}
	}
	if(chatBoxeslength==0){
		chatbox.css('right',chatpos+'px');
	}else{
		width=(chatBoxeslength)*(225+7)+chatpos;
		chatbox.css('right',width+'px');
	}
	chatBoxes.push(chatbox[0]);
	if(minimizeChatBox!=0){
		minimizedChatBoxes=new Array();
		if(jQ.local('chatbox_minimized')){
			minimizedChatBoxes=jQ.local('chatbox_minimized').split(/\|/);
		}
		minimize=0;
		for(j=0;j<minimizedChatBoxes.length;j++){
			if(minimizedChatBoxes[j]==chatboxusr){
				minimize=1;
			}
		}
		if(minimize==1){
			jQ('.chatboxcontent,.chatboxinput',chatbox[0]).css('display','none');
		}
	}
	chatboxFocus[chatboxusr]=false;
	jQ('textarea',chatbox[0]).blur(function(){
		chatboxFocus[chatboxusr]=false;
		jQ(this).removeClass('chatboxtextareaselected');
	}).focus(function(){
		chatboxFocus[chatboxusr]=true;
		newMessages[chatboxusr]=false;
		jQ('.chatboxhead',chatbox[0]).removeClass('chatboxblink');
		jQ('.chatboxtextarea',chatbox[0]).addClass('chatboxtextareaselected');
	});
	chatbox.show();
	return chatbox;
}

function toggleChatBoxGrowth(chatboxusr){
	var chatbox=jQ('.chatbox#'+chatboxusr);
	if(jQ('.chatboxcontent',chatbox).css('display')=='none'){  
		var minimizedChatBoxes=new Array();
		if(jQ.local('chatbox_minimized')){
			minimizedChatBoxes=jQ.local('chatbox_minimized').split(/\|/);
		}
		var newLocal='';
		for(i=0;i<minimizedChatBoxes.length;i++){
			if(minimizedChatBoxes[i]!=chatboxusr){
				newLocal+=chatboxusr+'|';
			}
		}
		newLocal=newLocal.slice(0,-1)
		jQ.local('chatbox_minimized',newLocal);
		jQ('.chatboxcontent,.chatboxinput',chatbox).css('display','block');
		jQ('.chatboxcontent',chatbox).scrollTop(jQ('.chatboxcontent',chatbox)[0].scrollHeight);
	}else{
		var newLocal=chatboxusr;
		if(jQ.local('chatbox_minimized')){
			newLocal+='|'+jQ.local('chatbox_minimized');
		}
		jQ.local('chatbox_minimized',newLocal);
		jQ('.chatboxcontent,.chatboxinput',chatbox).css('display','none');
	}
}

function linkify(text){
	var inputText=text;//el.html();
	//URLs starting with http://,https://,or ftp://
	var replacePattern1=/(\b(https?|ftp):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/gim;
	var replacedText=inputText.replace(replacePattern1,"<a href=$1 target=_blank>$1</a>");
	//URLs starting with www. (without // before it,or it'd re-link the ones done above)
	var replacePattern2=/(^|[^\/])(www\.[\S]+(\b|$))/gim;
	replacedText=replacedText.replace(replacePattern2,"$1<a href=http://$2 target=_blank>$2</a>");
	//Change email addresses to mailto:: links
	var replacePattern3=/(\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,6})/gim;
	replacedText=replacedText.replace(replacePattern3,"<a href=mailto:$1>$1</a>");
	var replacePattern4=/(^|[^\/])(.*\.(net$|com$|org$))/gim;
	replacedText=replacedText.replace(replacePattern4,"$1<a href=http://$2 target=_blank>$2</a>");
	return replacedText;//el.html(replacedText);
}

function emoticons(text){
	var inputText=text;
	inputText=inputText.replace(/:-?\)/gim,		'<div class="em smile"></div>');
	inputText=inputText.replace(/:-?D/gim,		'<div class="em bigSmile"></div>');
	inputText=inputText.replace(/:-?\(/gim,		'<div class="em sad"></div>');
	inputText=inputText.replace(/:-?P/gim,		'<div class="em tongeOut"></div>');
	inputText=inputText.replace(/;-?\)/gim,		'<div class="em wink"></div>');
	inputText=inputText.replace(/:-?o/gim,		'<div class="em surprise"></div>');
	inputText=inputText.replace(/:-?s/gim,		'<div class="em sick"></div>');
	inputText=inputText.replace(/:'-?\(/gim,	'<div class="em crying"></div>');
	inputText=inputText.replace(/8-?\)/gim,		'<div class="em glasses"></div>');
	return inputText;
}

function chat_ajax(data,success){
	if(!data) data={};
	if(success) data={url:data,success:success};
	data.dataType='json';
	data.type=data.data?'post':'get';
	// data.cache=false;
	data.statusCode={
		500:function(){
			chat_ajax(data);
		}
	};
	var ajax=jQ.ajax(data);
	if(data.url.match(nolog)) return ajax;
	return ajax.done(function(d){
		console.log({'url':data.url,'post':data.data,'success':d});
	}).fail(function(jqXHR,textStatus,errorThrown){
		console.log({'url':data.url,'post':data.data,'error':['error',data.url,jqXHR,textStatus,errorThrown]});
	});
}

});
