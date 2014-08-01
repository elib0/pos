function redir(url){
	var hash=document.location.pathname==''&&location.search.substring(1)=='';
	if(url.substr(0,1)=='#'){
		if(hash)
			document.location.hash=url.substr(1);
		else
			document.location='./'+url;
	}else
		document.location=url;
}

function redirect(url, op){
	if(op){
		window.open(url);
	}else if(url.substr(0,1)=='#'){
		document.location.hash=url.substr(1);
	}else{
		document.location=url;
	}
}

function goToScroll(anchor){
	$('html, body').animate({
    	scrollTop: $(anchor).offset().top-63
	}, 2000);
}
 
function newsletters (){
	$('#frmNewsletters').ajaxForm({
		dataType: 'JSON',
		success : function(data) {
			$('#newsletters-reveal h2').html(data['title']);
			$('#newsletters-reveal h5').html(data['message']);
			$('#newsletters-reveal').foundation('reveal', 'open');
			$('#btnSaveNewsletters').removeAttr('disabled');
			$('#btnSaveNewsletters').html('Suscribirme');
			$('#frmNewsletters').trigger("reset");
		}
	});

	$('#btnSaveNewsletters').click(function(event) {
		$(this).attr({disabled: 'disabled'});
		$(this).html('Enviando ...');
		$('#frmNewsletters').submit();
	});

	$('#frmNewsletters').on('invalid', function(event) {
		$('#btnSaveNewsletters').removeAttr('disabled');
		$('#btnSaveNewsletters').html('Suscribirme');
	});
}

function getCkEditorToolbar(advanced){
	
	var full =
		[
			{ name: 'document', items : [ 'Source','-','Save','NewPage','DocProps','Preview','Print','-','Templates' ] },
			{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
			{ name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' ] },
			{ name: 'colors', items : [ 'TextColor','BGColor' ] },
			{ name: 'tools', items : [ 'Maximize', 'ShowBlocks' ] },
			'/',
			{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
			{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv',
			'-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ] },
			{ name: 'links', items : [ 'Link','Unlink','Anchor' ] },
			{ name: 'insert', items : [ 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe' ] },
			{ name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] }
		];

	var basic = 
		[
			['Source','-','Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink']
		];

	return advanced ? full : basic;	
}

function deleteRecord(url, layer, title){
	$('#confirm-reveal h5').append('<strong>'+title+'</strong> ?');
	$('#confirm-reveal').foundation('reveal', 'open');
	$( "#delete" ).click(function() {
		$.ajax({
			url: url,
			type:  'POST',
			dataType: 'JSON',
			success:  function (data) {
				if (data['out']=='ok'){
					$(layer).fadeOut( "slow", function() {
				    	$('#confirm-reveal').foundation('reveal', 'close');
				    });
			    }
			}
		});
	});	
}

function showLayer(layer){
	
  		$(layer).fadeIn('slow');
	
}