
$('#btnWpLogin').click(function(event) {
    $(this).attr({disabled: 'disabled'});
    $(this).html('Enviando ...');
    $('#frmWpLogin').submit();
});

$('#frmWpLogin').ajaxForm({
    dataType: 'JSON',
    success : function(data){  console.log(data);
        if (data['title']=='ok' && data['message']=='ok'){
            redir(data['url']+'/content/body/listado-de-contenidos');
        }else{ 
            $('#contact-reveal h2').html(data['title']);
            $('#contact-reveal h5').append(data['message']);
            $('#contact-reveal').foundation('reveal', 'open');
            $('#btnWpLogin').removeAttr('disabled');
            $('#btnWpLogin').html('&nbsp;&nbsp;&nbsp;&nbsp;Enviar&nbsp;&nbsp;&nbsp;&nbsp;');
            $('#frmWpLogin').trigger("reset");
        }
    }
});

$('#frmWpLogin').on('invalid', function(event) {
    $('#btnWpLogin').removeAttr('disabled');
    $('#btnWpLogin').html('&nbsp;&nbsp;&nbsp;&nbsp;Enviar&nbsp;&nbsp;&nbsp;&nbsp;');
});