CKEDITOR.replace('summary',
    {
        toolbar : getCkEditorToolbar()
    }
);

CKEDITOR.replace('body',
    {
        toolbar : getCkEditorToolbar(true)
    }
);

$('#btnSectionsSave').click(function(event) {
    $(this).attr({disabled: 'disabled'});
    $(this).html('Enviando ...');
    $('#frmSections').submit();
});

$('#frmSections').ajaxForm({
    dataType: 'json',
    success : function(data) {
        console.log(data);
        $('#contact-reveal h2').html(data['title']);
        $('#contact-reveal h5').append(data['message']);
        $('#contact-reveal').foundation('reveal', 'open');
        $('#btnWpLogin').removeAttr('disabled');
        $('#btnWpLogin').html('&nbsp;&nbsp;&nbsp;&nbsp;Enviar&nbsp;&nbsp;&nbsp;&nbsp;');
        if (data['out']=='ok'){
            setTimeout(function(){
                redirect(data['url']);
            }, 3000);
        }
    }
});

$('#frmSections').on('invalid', function(event) {alert('dsdsd');
    $('#btnWpLogin').removeAttr('disabled');
    $('#btnWpLogin').html('&nbsp;&nbsp;&nbsp;&nbsp;Enviar&nbsp;&nbsp;&nbsp;&nbsp;');
});