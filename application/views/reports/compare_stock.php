<?php
$this->load->view("partial/header");
?>
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
</style>
<?=form_open('inventories_compare/save', array('id'=>'compare_form'))?>
<div id="page_title" style="margin-bottom:8px;"><?php echo $title ?></div>
<div id="page_subtitle" style="margin-bottom:8px;"><?php echo $subtitle ?></div>
<div id="table_holder">
    <table class="tablesorter report compare-stock" id="sortable_table">
        <thead>
            <tr>
                <?php foreach ($headers as $header) { ?>
                <th><?php echo $header; ?></th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($data as $row){
            ?>
            <tr>
                <?php foreach ($row as $cell) { ?>
                <td><?php echo $cell; ?></td>
                <?php } ?>
                <td>
                    <?=form_input(array('id'=>'comment'.$row[0], 'name'=>'comment'.$row[0], 'type'=>'text'))?>
                </td>
                <td>
                    <?=form_input(array('id'=>'check'.$row[0], 'name'=>'check'.$row[0], 'type'=>'checkbox'))?>
                    <?=form_label('', 'check'.$row[0]);?>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <a class="linkPrint" href="#">
        <div class="big_button" style="float: left;"><span>Print</span></div>
    </a>
    <a id="btnSendToAdmin" href="index.php/inventories_compare/send_mail_to_admin">
        <div class="big_button" style="float: left;"><span>Send to Administrator</span></div>
    </a>
</div>
<?=form_close()?>
<?php
$this->load->view("partial/footer");
?>
<script>
    $(document).ready(function() {
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
            $.ajax({
                    url: $(this).attr('href'),
                    type: 'POST',
                    data: {'report': $('#compare_form').html()},
                    success: function (data) {
                        console.log(data);
                        var type_msg = 'error';

                        if (data.status == 1) type_msg='success';

                        notif({
                            type: type_msg,
                            msg: data.msg,
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
