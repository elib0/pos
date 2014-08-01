$(document).ready(function(){
    $("#existingcust").click(function(){
        if ($(this).hasClass('active')!=true) {
            $(".signuptype").removeClass('active');
            $(this).addClass('active');
            $("#signupfrm").fadeToggle('fast',function(){
                $("#loginfrm").fadeToggle('fast');
            });
            $("#custtype").val("existing");
        }
    });
    $("#newcust").click(function(){
        if ($(this).hasClass('active')!=true) {
            $(".signuptype").removeClass('active');
            $(this).addClass('active');
            $("#loginfrm").fadeToggle('fast',function(){
                $("#signupfrm").fadeToggle('fast');
            });
            $("#custtype").val("new");
        }
    });
});

function showcats() {
    $("#categories").slideToggle();
}

function selproduct(num) {
    $('#productslider').slider("value", num);
    $(".product").hide();
    $("#product"+num).show();
    $(".sliderlabel").removeClass("selected");
    $("#prodlabel"+num).addClass("selected");
}

function recalctotals() {
    $.post("cart.php", 'ajax=1&a=confproduct&calctotal=true&'+$("#orderfrm").serialize(),
    function(data){
        $("#producttotal").html(data);
    });
}

function addtocart(gid) {
    $("#loading1").slideDown();
    $.post("cart.php", 'ajax=1&a=confproduct&'+$("#orderfrm").serialize(),
    function(data){
        if (data) {
            $("#configproducterror").html(data);
            $("#configproducterror").slideDown();
            $("#loading1").slideUp();
        } else {
            if (gid) window.location='cart.php?gid='+gid;
            else window.location='cart.php?a=checkout';
        }
    });
}

function domaincontactchange() {
    if ($("#domaincontact").val()=="addingnew") {
        $("#domaincontactfields").slideDown();
    } else {
        $("#domaincontactfields").slideUp();
    }
}

function showCCForm() {
    $("#ccinputform").slideDown();
}
function hideCCForm() {
    $("#ccinputform").slideUp();
}
function useExistingCC() {
    $(".newccinfo").hide();
}
function enterNewCC() {
    $(".newccinfo").show();
}