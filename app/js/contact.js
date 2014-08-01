$("#map").gMap({
    markers: [{
        latitude: 10.217966,
        longitude: -68.009740,
        html: "<p style='margin:10px'>Websarrollo, C.A</p>",
        popup: true,
        scrollwheel: false,
        infowindowanchor: [8, 4],
        icon: {
            iconsize: [24, 24],
        },
    }],
    zoom: 17,
});

$('#btnContactSave').click(function(event) {
    $(this).attr({disabled: 'disabled'});
    $(this).html('Enviando ...');
    $('#frmContact').submit();
});

$('#frmContact').ajaxForm({
    dataType: 'JSON',
    success : function(data) { 
        $('#contact-reveal h2').html(data['title']);
        $('#contact-reveal h5').append(data['message']);
        $('#contact-reveal').foundation('reveal', 'open');
        $('#btnContactSave').removeAttr('disabled');
        $('#btnContactSave').html('Enviar');
        $('#frmContact').trigger("reset");
    }
});

$('#frmContact').on('invalid', function(event) {
    $('#btnContactSave').removeAttr('disabled');
    $('#btnContactSave').html('Enviar');
});