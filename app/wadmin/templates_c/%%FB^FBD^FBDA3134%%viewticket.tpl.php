<?php /* Smarty version 2.6.26, created on 2012-05-14 09:38:16
         compiled from v4/viewticket.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'v4/viewticket.tpl', 359, false),)), $this); ?>
<script type="text/javascript" src="../includes/jscript/jquerylq.js"></script>

<script language="javascript">
var ticketid = '<?php echo $this->_tpl_vars['ticketid']; ?>
';
var pagefilename = '<?php echo $_SERVER['PHP_SELF']; ?>
';
var ticketcontent = "";
var selectedTab;
<?php echo '
function doDeleteReply(id) {
    if (confirm("'; ?>
<?php echo $this->_tpl_vars['_ADMINLANG']['support']['delreplysure']; ?>
<?php echo '")) {
        window.location=pagefilename+\'?action=viewticket&id=\'+ticketid+\'&sub=del&idsd=\'+id;
    }
}
function doDeleteTicket() {
    if (confirm("'; ?>
<?php echo $this->_tpl_vars['_ADMINLANG']['support']['delticketsure']; ?>
<?php echo '")) {
        window.location=pagefilename+\'?sub=deleteticket&id=\'+ticketid;
    }
}
function doDeleteNote(id) {
    if (confirm("'; ?>
<?php echo $this->_tpl_vars['_ADMINLANG']['support']['delnotesure']; ?>
<?php echo '")) {
        window.location=pagefilename+\'?action=viewticket&id=\'+ticketid+\'&sub=delnote&idsd=\'+id;
    }
}
function quoteTicket(id,ids) {
    $(".tab").removeClass("tabselected");
    $("#tab0").addClass("tabselected");
    $(".tabbox").hide();
    $("#tab0box").show();
    $.post("supporttickets.php", { action: "getquotedtext", id: id, ids: ids },
    function(data){
        $("#replymessage").val(data+"\\n\\n"+$("#replymessage").val());
    });
    return false;
}
function selectpredefcat(catid) {
    $.post("supporttickets.php", { action: "loadpredefinedreplies", cat: catid },
    function(data){
        $("#prerepliescontent").html(data);
    });
}
function selectpredefreply(artid) {
    $.post("supporttickets.php", { action: "getpredefinedreply", id: artid },
    function(data){
        $("#replymessage").addToReply(data);
    });
    $("#prerepliescontainer").slideToggle();
}
function searchselectclient(userid) {
    $("#clientsearchval").val(userid);
	$("#ticketclientsearchresults").slideUp("slow");
    $("#clientsearchcancel").fadeOut();
}

$(document).ready(function(){

$(".tabbox").css("display","none");
$(".tab").click(function(){
    var elid = $(this).attr("id");
    if (elid != selectedTab) {
        $(".tab").removeClass("tabselected");
        $("#"+elid).addClass("tabselected");
        $(".tabbox").slideUp();
        $("#"+elid+"box").slideDown();
        $("#tab").val(elid.substr(3));
        selectedTab = elid;
    }
});
selectedTab = "tab0";
$("#tab0").addClass("tabselected");
$("#tab0box").css("display","");
$(".editbutton").click(function () {
    var butid = $(this).attr("id");
    ticketcontent = $("#"+butid+"_box").html();
    var browsername = navigator.appName;
    if (browsername == "Microsoft Internet Explorer") {
        var ticketcontentpassback = ticketcontent.replace(/<br>/gi, \'\\n\');
    } else {
        var ticketcontentpassback = ticketcontent.replace(/<br>/gi, \'\');
    }
    $("#"+butid+"_box").html("<textarea rows=\\"10\\" style=\\"width:99%\\" id=\\""+butid+"_box_text\\">"+ticketcontentpassback+"</textarea>");
    $(".editticketbuttons"+butid).toggle();
});
$(".savebutton").click(function () {
    var butid = $(this).attr("id");
    var newticketcontent = $("#"+butid+"_box_text").val();
    var ticketcontentpassback = newticketcontent.replace(/\\n/gi, \'<br>\');
    $("#"+butid+"_box").html(ticketcontentpassback);
    $.post("supporttickets.php", { action: "updatereply", text: newticketcontent, id: butid });
    $(".editticketbuttons"+butid).toggle();
});
$(".cancelbutton").click(function () {
    var butid = $(this).attr("id");
    $("#"+butid+"_box").html(ticketcontent);
    $(".editticketbuttons"+butid).toggle();
});
$("#replymessage").focus(function () {
	$.post("supporttickets.php", { action: "makingreply", id: ticketid },
	function(data){
        $("#replyingadmin").html(data);
    });
    return false;
});
$("#replyfrm").submit(function () {
	var status = $("#ticketstatus").val();
	var response = $.ajax({
		type: "POST",
		url: "supporttickets.php?action=checkstatus",
		data: "id="+ticketid+"&ticketstatus="+status,
		async: false
	}).responseText;
	if (response == "true") {
    	return true;
	} else {
		if (confirm("'; ?>
<?php echo $this->_tpl_vars['_ADMINLANG']['support']['statuschanged']; ?>
<?php echo '\\n\\n'; ?>
<?php echo $this->_tpl_vars['_ADMINLANG']['support']['stillsubmit']; ?>
<?php echo '")) {
	        return true;
	    }
	    return false;
	}
});

$(window).unload( function () {
    $.post("supporttickets.php", { action: "endreply", id: ticketid });
});
$("#insertpredef").click(function () {
    $("#prerepliescontainer").slideToggle();
    return false;
});
$("#addfileupload").click(function () {
    $("#fileuploads").append("<input type=\\"file\\" name=\\"attachments[]\\" size=\\"85\\"><br />");
    return false;
});
$("#ticketstatus").change(function () {
    $.post("supporttickets.php", { action: "changestatus", id: ticketid, status: this.options[this.selectedIndex].text });
});
$("#predefq").keyup(function () {
    var intellisearchlength = $("#predefq").val().length;
    if (intellisearchlength>2) {
    $.post("supporttickets.php", { action: "loadpredefinedreplies", predefq: $("#predefq").val() },
        function(data){
            $("#prerepliescontent").html(data);
        });
    }
});

$("#clientsearchval").keyup(function () {
	var ticketuseridsearchlength = $("#clientsearchval").val().length;
	if (ticketuseridsearchlength>2) {
	$.post("search.php", { ticketclientsearch: 1, value: $("#clientsearchval").val() },
	    function(data){
            if (data) {
                $("#ticketclientsearchresults").html(data);
                $("#ticketclientsearchresults").slideDown("slow");
                $("#clientsearchcancel").fadeIn();
            }
        });
	}
});
$("#clientsearchcancel").click(function () {
    $("#ticketclientsearchresults").slideUp("slow");
    $("#clientsearchcancel").fadeOut();
});

});
'; ?>

</script>

<?php echo $this->_tpl_vars['infobox']; ?>


<div id="replyingadmin">
<?php if ($this->_tpl_vars['replyingadmin']): ?><div class="errorbox"><?php echo $this->_tpl_vars['replyingadmin']['name']; ?>
 <?php echo $this->_tpl_vars['_ADMINLANG']['support']['viewedandstarted']; ?>
 @ <?php echo $this->_tpl_vars['replyingadmin']['time']; ?>
</div><?php endif; ?>
</div>

<h2>#<?php echo $this->_tpl_vars['tid']; ?>
 - <?php echo $this->_tpl_vars['subject']; ?>
 <select name="ticketstatus" id="ticketstatus" style="font-size:18px;">
<?php $_from = $this->_tpl_vars['statuses']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['statusitem']):
?>
<option<?php if ($this->_tpl_vars['statusitem']['title'] == $this->_tpl_vars['status']): ?> selected<?php endif; ?> style="color:<?php echo $this->_tpl_vars['statusitem']['color']; ?>
"><?php echo $this->_tpl_vars['statusitem']['title']; ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select></h2>

<p>Client: <?php if ($this->_tpl_vars['userid']): ?><a href="clientssummary.php?userid=<?php echo $this->_tpl_vars['userid']; ?>
"<?php if ($this->_tpl_vars['clientgroupcolour']): ?> style="background-color:<?php echo $this->_tpl_vars['clientgroupcolour']; ?>
"<?php endif; ?> target="_blank"><?php echo $this->_tpl_vars['clientname']; ?>
</a><?php else: ?><?php echo $this->_tpl_vars['_ADMINLANG']['support']['notregclient']; ?>
<?php endif; ?> | <?php echo $this->_tpl_vars['_ADMINLANG']['support']['lastreply']; ?>
: <?php echo $this->_tpl_vars['lastreply']; ?>
</p>

<div id="tabs">
    <ul>
        <li id="tab0" class="tab"><a href="javascript:;"><?php echo $this->_tpl_vars['_ADMINLANG']['support']['addreply']; ?>
</a></li>
        <li id="tab1" class="tab"><a href="javascript:;"><?php echo $this->_tpl_vars['_ADMINLANG']['support']['addnote']; ?>
</a></li>
        <li id="tab2" class="tab"><a href="javascript:;"><?php echo $this->_tpl_vars['_ADMINLANG']['setup']['customfields']; ?>
</a></li>
        <li id="tab3" class="tab"><a href="javascript:;"><?php echo $this->_tpl_vars['_ADMINLANG']['fields']['options']; ?>
</a></li>
        <li id="tab4" class="tab"><a href="javascript:;"><?php echo $this->_tpl_vars['_ADMINLANG']['clientsummary']['log']; ?>
</a></li>
    </ul>
</div>

<div id="tab0box" class="tabbox">
    <div id="tab_content">

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>
?action=viewticket&id=<?php echo $this->_tpl_vars['ticketid']; ?>
" enctype="multipart/form-data" name="replyfrm" id="replyfrm">

<textarea name="message" id="replymessage" rows="14" style="width:100%">


<?php echo $this->_tpl_vars['signature']; ?>
</textarea>

<br /><img src="images/spacer.gif" height="8" width="1" /><br />

<table class="form" width="100%" border="0" cellspacing="2" cellpadding="3">
<tr><td width="15%" class="fieldlabel"><?php echo $this->_tpl_vars['_ADMINLANG']['support']['postreply']; ?>
</td><td class="fieldarea"><select name="postaction">
<option value="return"><?php echo $this->_tpl_vars['_ADMINLANG']['support']['setansweredreturn']; ?>

<option value="answered"><?php echo $this->_tpl_vars['_ADMINLANG']['support']['setansweredremain']; ?>

<?php $_from = $this->_tpl_vars['statuses']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['statusitem']):
?>
<?php if ($this->_tpl_vars['statusitem']['id'] > 4): ?><option value="setstatus<?php echo $this->_tpl_vars['statusitem']['id']; ?>
"><?php echo $this->_tpl_vars['_ADMINLANG']['support']['setto']; ?>
 <?php echo $this->_tpl_vars['statusitem']['title']; ?>
 <?php echo $this->_tpl_vars['_ADMINLANG']['support']['andremain']; ?>
</option><?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
<option value="close"><?php echo $this->_tpl_vars['_ADMINLANG']['support']['closereturn']; ?>

<option value="note"><?php echo $this->_tpl_vars['_ADMINLANG']['support']['addprivatenote']; ?>

</select>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="#" onClick="window.open('supportticketskbarticle.php','kbartwnd','width=500,height=400,scrollbars=yes');return false"><?php echo $this->_tpl_vars['_ADMINLANG']['support']['insertkblink']; ?>
</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="#" id="insertpredef"><?php echo $this->_tpl_vars['_ADMINLANG']['support']['insertpredef']; ?>
</a>
</td></tr>
<tr><td class="fieldlabel"><?php echo $this->_tpl_vars['_ADMINLANG']['support']['attachments']; ?>
</td><td class="fieldarea"><input type="file" name="attachments[]" size="85"> <a href="#" id="addfileupload"><img src="images/icons/add.png" align="absmiddle" border="0" /> <?php echo $this->_tpl_vars['_ADMINLANG']['support']['addmore']; ?>
</a><br /><div id="fileuploads"></div></td></tr>
<?php if ($this->_tpl_vars['userid']): ?><tr><td class="fieldlabel"><?php echo $this->_tpl_vars['_ADMINLANG']['support']['addbilling']; ?>
</td><td class="fieldarea"><input type="text" name="billingdescription" size="60" value="<?php echo $this->_tpl_vars['_ADMINLANG']['support']['toinvoicedes']; ?>
" onfocus="if(this.value=='<?php echo $this->_tpl_vars['_ADMINLANG']['support']['toinvoicedes']; ?>
')this.value=''" /> @ <input type="text" name="billingamount" size="10" value="<?php echo $this->_tpl_vars['_ADMINLANG']['fields']['amount']; ?>
" /> <select name="billingaction">
<option value="3" /> <?php echo $this->_tpl_vars['_ADMINLANG']['billableitems']['invoiceimmediately']; ?>
</option>
<option value="0" /> <?php echo $this->_tpl_vars['_ADMINLANG']['billableitems']['dontinvoicefornow']; ?>
</option>
<option value="1" /> <?php echo $this->_tpl_vars['_ADMINLANG']['billableitems']['invoicenextcronrun']; ?>
</option>
<option value="2" /> <?php echo $this->_tpl_vars['_ADMINLANG']['billableitems']['addnextinvoice']; ?>
</option>
</select></td></tr><?php endif; ?>
</table>

<div id="prerepliescontainer" style="display:none;">
    <img src="images/spacer.gif" height="8" width="1" />
    <br />
    <div style="border:1px solid #DFDCCE;background-color:#F7F7F2;padding:5px;text-align:left;">
        <div style="float:right;">Search: <input type="text" id="predefq" size="25" /></div>
        <div id="prerepliescontent"><?php echo $this->_tpl_vars['predefinedreplies']; ?>
</div>
    </div>
</div>

<img src="images/spacer.gif" height="8" width="1" />
<br />
<div align="center"><input type="submit" value="<?php echo $this->_tpl_vars['_ADMINLANG']['support']['addresponse']; ?>
" name="postreply" class="button" id="postreplybutton" /></div>

</form>

    </div>
</div>
<div id="tab1box" class="tabbox">
    <div id="tab_content">

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>
?action=viewticket&id=<?php echo $this->_tpl_vars['ticketid']; ?>
">
<input type="hidden" name="postaction" value="note" />

<textarea name="message" id="replymessage" rows="14" style="width:100%"></textarea>

<br />
<img src="images/spacer.gif" height="8" width="1" />
<br />

<div align="center"><input type="submit" value="<?php echo $this->_tpl_vars['_ADMINLANG']['support']['addnote']; ?>
" class="button" name="postreply" /></div>

</form>

    </div>
</div>
<div id="tab2box" class="tabbox">
    <div id="tab_content">

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>
?action=viewticket&id=<?php echo $this->_tpl_vars['ticketid']; ?>
&sub=savecustomfields">

<?php if (! $this->_tpl_vars['numcustomfields']): ?>
<div align="center"><?php echo $this->_tpl_vars['_ADMINLANG']['support']['nocustomfields']; ?>
</div>
<?php else: ?>
<table class="form" width="100%" border="0" cellspacing="2" cellpadding="3">
<?php $_from = $this->_tpl_vars['customfields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['customfield']):
?>
<tr><td width="25%" class="fieldlabel"><?php echo $this->_tpl_vars['customfield']['name']; ?>
</td><td class="fieldarea"><?php echo $this->_tpl_vars['customfield']['input']; ?>
</td></tr>
<?php endforeach; endif; unset($_from); ?>
</table>
<img src="images/spacer.gif" height="10" width="1" /><br />
<div align="center"><input type="submit" value="<?php echo $this->_tpl_vars['_ADMINLANG']['global']['savechanges']; ?>
" class="button"></div>
</form>
<?php endif; ?>

    </div>
</div>
<div id="tab3box" class="tabbox">
    <div id="tab_content">

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>
?action=viewticket&id=<?php echo $this->_tpl_vars['ticketid']; ?>
">

<table class="form" width="100%" border="0" cellspacing="2" cellpadding="3">
<tr><td width="15%" class="fieldlabel"><?php echo $this->_tpl_vars['_ADMINLANG']['support']['department']; ?>
</td><td class="fieldarea"><select name="deptid">
<?php $_from = $this->_tpl_vars['departments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['department']):
?>
<option value="<?php echo $this->_tpl_vars['department']['id']; ?>
"<?php if ($this->_tpl_vars['department']['id'] == $this->_tpl_vars['deptid']): ?> selected<?php endif; ?>><?php echo $this->_tpl_vars['department']['name']; ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select></td><td width="15%" class="fieldlabel"><?php echo $this->_tpl_vars['_ADMINLANG']['fields']['clientid']; ?>
</td><td class="fieldarea"><input type="text" name="userid" size="15" id="clientsearchval" value="<?php echo $this->_tpl_vars['userid']; ?>
" /> <img src="images/icons/delete.png" alt="Cancel" class="absmiddle" id="clientsearchcancel" height="16" width="16"><div id="ticketclientsearchresults"></div></td></tr>
<tr><td class="fieldlabel"><?php echo $this->_tpl_vars['_ADMINLANG']['fields']['subject']; ?>
</td><td class="fieldarea"><input type="text" name="subject" value="<?php echo $this->_tpl_vars['subject']; ?>
" style="width:80%"></td><td class="fieldlabel"><?php echo $this->_tpl_vars['_ADMINLANG']['support']['flag']; ?>
</td><td class="fieldarea"><select name="flagto">
<option value="0"><?php echo $this->_tpl_vars['_ADMINLANG']['global']['none']; ?>
</option>
<?php $_from = $this->_tpl_vars['staff']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['staffmember']):
?>
<option value="<?php echo $this->_tpl_vars['staffmember']['id']; ?>
"<?php if ($this->_tpl_vars['staffmember']['id'] == $this->_tpl_vars['flag']): ?> selected<?php endif; ?>><?php echo $this->_tpl_vars['staffmember']['name']; ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select></td></tr>
<tr><td class="fieldlabel"><?php echo $this->_tpl_vars['_ADMINLANG']['fields']['status']; ?>
</td><td class="fieldarea"><select name="status">
<?php $_from = $this->_tpl_vars['statuses']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['statusitem']):
?>
<option<?php if ($this->_tpl_vars['statusitem']['title'] == $this->_tpl_vars['status']): ?> selected<?php endif; ?> style="color:<?php echo $this->_tpl_vars['statusitem']['color']; ?>
"><?php echo $this->_tpl_vars['statusitem']['title']; ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select></td><td class="fieldlabel"><?php echo $this->_tpl_vars['_ADMINLANG']['support']['priority']; ?>
</td><td class="fieldarea"><select name="priority">
<option value="High"<?php if ($this->_tpl_vars['priority'] == 'High'): ?> selected<?php endif; ?>><?php echo $this->_tpl_vars['_ADMINLANG']['status']['high']; ?>
</option>
<option value="Medium"<?php if ($this->_tpl_vars['priority'] == 'Medium'): ?> selected<?php endif; ?>><?php echo $this->_tpl_vars['_ADMINLANG']['status']['medium']; ?>
</option>
<option value="Low"<?php if ($this->_tpl_vars['priority'] == 'Low'): ?> selected<?php endif; ?>><?php echo $this->_tpl_vars['_ADMINLANG']['status']['low']; ?>
</option>
</select></td></tr>
<tr><td class="fieldlabel"><?php echo $this->_tpl_vars['_ADMINLANG']['support']['ccrecepients']; ?>
</td><td class="fieldarea"><input type="text" name="cc" value="<?php echo $this->_tpl_vars['cc']; ?>
" size="40"> (<?php echo $this->_tpl_vars['_ADMINLANG']['transactions']['commaseparated']; ?>
)</td><td class="fieldlabel"><?php echo $this->_tpl_vars['_ADMINLANG']['support']['mergeticket']; ?>
</td><td class="fieldarea"><input type="text" name="mergetid" size="10"> (<?php echo $this->_tpl_vars['_ADMINLANG']['support']['notocombine']; ?>
)</td></tr>
</table>

<img src="images/spacer.gif" height="10" width="1"><br>
<div align="center"><input type="submit" value="<?php echo $this->_tpl_vars['_ADMINLANG']['global']['savechanges']; ?>
" class="button"></div>
</form>

    </div>
</div>
<div id="tab4box" class="tabbox">
    <div id="tab_content">

<table cellspacing=1 bgcolor=#cccccc width=100%>
<tr style="background-color:#f2f2f2;font-weight:bold;text-align:center;"><td><?php echo $this->_tpl_vars['_ADMINLANG']['fields']['date']; ?>
</td><td><?php echo $this->_tpl_vars['_ADMINLANG']['permissions']['action']; ?>
</td></tr>
<?php $_from = $this->_tpl_vars['ticketlog']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['log']):
?>
<tr bgcolor="#ffffff"><td align=center width=160><?php echo $this->_tpl_vars['log']['date']; ?>
</td><td><?php echo $this->_tpl_vars['log']['action']; ?>
</td></tr>
<?php endforeach; endif; unset($_from); ?>
</table>

    </div>
</div>

<br />

<?php if ($this->_tpl_vars['numnotes']): ?>
<h2><?php echo $this->_tpl_vars['_ADMINLANG']['support']['privatestaffnote']; ?>
</h2>
<?php $_from = $this->_tpl_vars['notes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['note']):
?>
<div class="ticketstaffnotes">
<table class="ticketstaffnotestable">
<tr><td><strong><?php echo $this->_tpl_vars['note']['admin']; ?>
</strong></td><td align="right"><strong><?php echo $this->_tpl_vars['note']['date']; ?>
</strong></td><td width="16"><a href="#" onClick="doDeleteNote('<?php echo $this->_tpl_vars['note']['id']; ?>
');return false"><img src="images/delete.gif" alt="<?php echo $this->_tpl_vars['_ADMINLANG']['support']['deleteticketnote']; ?>
" border="0" align="absmiddle"></a></td></tr>
</table>
<?php echo $this->_tpl_vars['note']['message']; ?>

</div><br />
<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>

<?php if ($this->_tpl_vars['relatedservices']): ?>
<div class="tablebg">
<table class="datatable" width="100%" border="0" cellspacing="1" cellpadding="3">
<tr><th><?php echo $this->_tpl_vars['_ADMINLANG']['fields']['product']; ?>
</th><th><?php echo $this->_tpl_vars['_ADMINLANG']['fields']['amount']; ?>
</th><th><?php echo $this->_tpl_vars['_ADMINLANG']['fields']['billingcycle']; ?>
</th><th><?php echo $this->_tpl_vars['_ADMINLANG']['fields']['signupdate']; ?>
</th><th><?php echo $this->_tpl_vars['_ADMINLANG']['fields']['nextduedate']; ?>
</th><th><?php echo $this->_tpl_vars['_ADMINLANG']['fields']['status']; ?>
</th></tr>
<?php $_from = $this->_tpl_vars['relatedservices']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['relatedservice']):
?>
<tr<?php if ($this->_tpl_vars['relatedservice']['selected']): ?> class="rowhighlight"<?php endif; ?>><td><?php echo $this->_tpl_vars['relatedservice']['name']; ?>
</td><td><?php echo $this->_tpl_vars['relatedservice']['amount']; ?>
</td><td><?php echo $this->_tpl_vars['relatedservice']['billingcycle']; ?>
</td><td><?php echo $this->_tpl_vars['relatedservice']['regdate']; ?>
</td><td><?php echo $this->_tpl_vars['relatedservice']['nextduedate']; ?>
</td><td><?php echo $this->_tpl_vars['relatedservice']['status']; ?>
</td></tr>
<?php endforeach; endif; unset($_from); ?>
</table>
</div>
<?php endif; ?>

<br />

<table width=100% cellpadding=5 cellspacing=1 bgcolor="#cccccc" align=center>
<?php $_from = $this->_tpl_vars['replies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['reply']):
?>
<tr><td rowspan="2" bgcolor="<?php echo smarty_function_cycle(array('values' => "#F4F4F4,#F8F8F8"), $this);?>
" width="200" valign="top">

<?php if ($this->_tpl_vars['reply']['admin']): ?>

<strong><?php echo $this->_tpl_vars['reply']['admin']; ?>
</strong><br />
<?php echo $this->_tpl_vars['_ADMINLANG']['support']['staff']; ?>
<br />

<?php if ($this->_tpl_vars['reply']['rating']): ?>
<br />
<?php echo $this->_tpl_vars['_ADMINLANG']['support']['rating']; ?>
: <?php echo $this->_tpl_vars['reply']['rating']; ?>

<br />
<?php endif; ?>

<?php else: ?>

<strong><?php echo $this->_tpl_vars['reply']['clientname']; ?>
</strong><br />

<?php if ($this->_tpl_vars['reply']['userid']): ?>
<?php echo $this->_tpl_vars['_ADMINLANG']['fields']['client']; ?>
<br />
<?php else: ?>
<a href="mailto:<?php echo $this->_tpl_vars['reply']['clientemail']; ?>
"><?php echo $this->_tpl_vars['reply']['clientemail']; ?>
</a>
<br />
<input type="button" value="<?php echo $this->_tpl_vars['_ADMINLANG']['support']['blocksender']; ?>
" style="font-size:9px;" onclick="window.location='<?php echo $_SERVER['PHP_SELF']; ?>
?action=viewticket&id=<?php echo $this->_tpl_vars['ticketid']; ?>
&blocksender=true'"><br>
<?php endif; ?>

<?php endif; ?>

<?php if ($this->_tpl_vars['reply']['id']): ?>

<br />
<div class="editticketbuttons<?php echo $this->_tpl_vars['reply']['id']; ?>
"><input type="button" value="<?php echo $this->_tpl_vars['_ADMINLANG']['global']['edit']; ?>
" class="editbutton" id="<?php echo $this->_tpl_vars['reply']['id']; ?>
" /></div><div class="editticketbuttons<?php echo $this->_tpl_vars['reply']['id']; ?>
" style="display:none"><input type="button" value="<?php echo $this->_tpl_vars['_ADMINLANG']['global']['savechanges']; ?>
" class="savebutton" id="<?php echo $this->_tpl_vars['reply']['id']; ?>
" >&nbsp;<input type="button" value="<?php echo $this->_tpl_vars['_ADMINLANG']['global']['cancelchanges']; ?>
" class="cancelbutton" id="<?php echo $this->_tpl_vars['reply']['id']; ?>
" /></div>

<?php endif; ?>

</td><td bgcolor="#F4F4F4">

<?php if ($this->_tpl_vars['reply']['id']): ?>
<a href="#" onClick="doDeleteReply('<?php echo $this->_tpl_vars['reply']['id']; ?>
');return false">
<?php else: ?>
<a href="#" onClick="doDeleteTicket();return false">
<?php endif; ?>
<img src="images/icons/delete.png" alt="<?php echo $this->_tpl_vars['_ADMINLANG']['support']['deleteticket']; ?>
" align="right" border="0" hspace="5"></a>

<?php if ($this->_tpl_vars['reply']['id']): ?>
<a href="#" onClick="quoteTicket('','<?php echo $this->_tpl_vars['reply']['id']; ?>
')">
<?php else: ?>
<a href="#" onClick="quoteTicket('<?php echo $this->_tpl_vars['ticketid']; ?>
','')">
<?php endif; ?>
<img src="images/icons/quote.png" align="right" border="0"></a> <?php echo $this->_tpl_vars['reply']['date']; ?>


</td></tr>
<tr><td bgcolor="#F4F4F4"<?php if ($this->_tpl_vars['reply']['id']): ?> id="<?php echo $this->_tpl_vars['reply']['id']; ?>
_box"<?php endif; ?>>

<?php echo $this->_tpl_vars['reply']['message']; ?>


<?php if ($this->_tpl_vars['reply']['numattachments']): ?>
<p>
<b><?php echo $this->_tpl_vars['_ADMINLANG']['support']['attachments']; ?>
</b>
<br />
<?php $_from = $this->_tpl_vars['reply']['attachments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['attachment']):
?>
<img src="../images/article.gif"> <a href="../<?php echo $this->_tpl_vars['attachment']['dllink']; ?>
"><?php echo $this->_tpl_vars['attachment']['filename']; ?>
</a> <small><a href="<?php echo $this->_tpl_vars['attachment']['deletelink']; ?>
" style="color:#cc0000"><?php echo $this->_tpl_vars['_ADMINLANG']['support']['remove']; ?>
</a></small><br />
<?php endforeach; endif; unset($_from); ?>
</p>
<?php endif; ?>

</td></tr>
<?php endforeach; endif; unset($_from); ?>
</table>

<p align="center"><a href="supportticketsprint.php?id=<?php echo $this->_tpl_vars['ticketid']; ?>
" target="_blank"><?php echo $this->_tpl_vars['_ADMINLANG']['support']['viewprintable']; ?>
</a></p>