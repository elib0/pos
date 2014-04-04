<?php $this->load->view("partial/header"); ?>
<link rel="stylesheet" href="css/compare_stock.css" media="print">
<style>
    .compare-stock input{margin: 5px;}
    .compare-stock input[type=text] {width: 90%;}
    .compare-stock input[type=checkbox] {display: none;}
    .compare-stock input[type=checkbox] + label {
        background: #fff;
        display: inline-block;
        width: 16px;
        height: 16px;
        background: url(images/inputs/checkbox.png) 0px 0px no-repeat;
        text-indent: -1000em;
        cursor: pointer;
        margin: 5px;
    }
    .compare-stock input[type=checkbox]:checked + label {
        background: url(images/inputs/checkbox.png) 0px -16px no-repeat;
    }
   /* -webkit-border-top-left-radius:5px;
    -webkit-border-top-right-radius:5px;
    -webkit-border-bottom-right-radius:0;
    -webkit-border-bottom-left-radius:0;
    border-top-left-radius:5px;
    border-top-right-radius:5px;
    border-bottom-right-radius:0;
    border-bottom-left-radius:0;*/
</style>
<div id="page_title" style="margin-bottom:8px;"><?php echo $title ?></div>
<div id="page_subtitle" style="margin-bottom:8px;"><?php echo $subtitle ?></div>

<?=form_open('inventories_compare/save', array('id'=>'compare_form'))?>
<div id="table_holder" style="overflow: scroll;height: 450px;margin-bottom:5px;">
    <table class="tablesorter report compare-stock" id="sortable_table">
        <thead>
            <tr style="text-align: center;">
                <?php 
                    $size = count($headers);
                    $i = 0;
                    foreach ($headers as $header) { 
                        switch ($header) {
                            case 'Id': $style = ' style=" border-top-left-radius:5px;-webkit-border-top-left-radius:5px; width:5%; padding: 5px" '; 
                            break;  
                            case 'Item': $style = ' style=" width:55%; padding: 5px" '; 
                            break;
                            case 'In Stock': $style = ' style=" width:10%; padding: 5px" '; 
                            break;
                            case 'Comment': $style = ' style=" width:20%; padding: 5px" '; 
                            break;
                            case 'Checked': $style = ' style=" border-top-right-radius:5px;-webkit-border-top-right-radius:5px; width:10%; padding: 5px;" '; 
                            break;
                        }
                ?>
                <th <?php echo $style; ?> ><?php echo $header; ?></th>
                <?php $i++; } ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $row){ ?>
            <tr>
                <?php foreach ($row as $cell) { ?>
                <td><?php echo $cell; ?></td>
                <?php } ?>
                <td>
                    <?=form_input(array('id'=>'comment'.$row[0], 'name'=>'comment'.$row[0], 'type'=>'text','style'=>'border:1px solid #CCC; -webkit-border-radius: 5px;-moz-border-radius: 5px; border-radius: 5px;'))?>
                </td>
                <td>
                    <?=form_input(array('id'=>'check'.$row[0], 'name'=>'check'.$row[0], 'type'=>'checkbox'))?>
                    <?=form_label('','check'.$row[0]);?>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<div>
    <a class="linkPrint big_button" href="#">
        <span>Print</span>
    </a>
    <a id="btnSendToAdmin" class="big_button" href="index.php/inventories_compare/send_mail_to_admin">
        <span>Send to Administrator</span>
    </a>
</div>
<?=form_close()?>
<?php $this->load->view("partial/footer"); ?>
<script>
    $(document).ready(function() {
        $('#menubar_navigation').css('display','none');
        $('input[type=checkbox]').change(function(){
            var id = $(this).attr('id');
            id = id.slice(5, id.length);
            if( !$(this).is(':checked') ){
                $('#comment'+id).removeAttr('disabled').val('');
            }else{
                $('#comment'+id).attr('disabled', 'disabled').val('no comments');
            }
        });
        $('.linkPrint').click(function(){
            // imprimirEleHtml('#content_area');
            window.print();
            return false;
        });
        $('#btnSendToAdmin').click(function(){
            var array=$('#sortable_table input[type="text"]'),coment='';
            array.each(function(index) {
                 if ($(this).val()!='' && $(this).val()!='no comments'){ 
                    coment+='<li>'+$(this).attr('name').replace("comment","")+' - '+$(this).val()+'</li>';
                }
            });
            $.ajax({
                    url: $(this).attr('href'),
                    type: 'POST',
                    data: {'report': $('#sortable_table').html(),'obs':coment},
                    dataType: 'json',
                    success: function (data) {
                        console.log(data);
                        var type_msg = 'error';
                        if (data['status'] == 1){
                            $('#menubar_navigation').css('display','block');
                            type_msg='success';
                        } 
                        notif({
                            type: type_msg,
                            msg: data['msg'],
                            width: "all",
                            height: 100,
                            position: "center"
                        });
                    }
                });
            return false;
        });
    });
</script>
