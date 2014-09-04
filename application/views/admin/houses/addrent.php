<div class="container top">

    <ul class="breadcrumb">
        <li>
            <a href="<?php echo site_url("admin"); ?>">
                <?php echo ucfirst($this->uri->segment(1)); ?>
            </a> 
            <span class="divider">/</span>
        </li>
        <li>
            <a href="<?php echo site_url("admin") . '/' . $this->uri->segment(2); ?>">
                <?php echo ucfirst($this->uri->segment(2)); ?>
            </a> 
            <span class="divider">/</span>
        </li>
        <li class="active">
            <a href="#">Add Rent</a>
        </li>
    </ul>

    <div class="page-header">
        <h2>
            Adding <?php echo ucfirst($this->uri->segment(2)); ?> Rent
        </h2>
    </div>

    <?php
    //flash messages
    if (isset($flash_message)) {
        if ($flash_message == TRUE) {
            echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> new product created with success.';
            echo '</div>';
        } else {
            echo '<div class="alert alert-error">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
            echo '</div>';
        }
    }
    ?>

    <?php
    //form data
    $attributes = array('class' => 'form-horizontal', 'id' => '');
    $option_house_no = array('' => '--Select--');
    foreach ($houses as $row) {
        $option_house_no[$row['house_id']] = $row['house_no'] . ' - ' . $row['house_address'];
    }

    //form validation
    echo validation_errors();

    echo form_open('admin/houses/addrent', $attributes);
    ?>
    <fieldset>
        <div class="control-group">
            <label for="inputError" class="control-label">House No.</label>
            <div class="controls" style="">
                <?php echo form_dropdown('house_id', $option_house_no, set_value('house_id'), 'class="span2" id="house_id"'); ?>
                <img id="ajax_loader1" style="display: none;" src="<?php echo site_url(); ?>assets/img/admin/ajax-loader.gif"/> 
            </div>
        </div>
        <div class="control-group">
            <label for="inputError" class="control-label">Payment Mode</label>
            <div class="controls" style="">
                <?php
                $option_pay_mode = array('' => '--Select Mode--', 'cash' => 'Cash', 'cheque' => 'Cheque', 'tds' => 'TDS');
                echo form_dropdown('pay_mode', $option_pay_mode, set_value('pay_mode'), 'class="span2" id="pay_mode" ');
                ?>

            </div>
        </div>


        <div class="control-group">
            <label for="inputError" class="control-label">Amout</label>
            <div class="controls">
                <input type="text" id="amount" name="amount" value="<?php echo set_value('amount'); ?>" >
     <!--<span class="help-inline">Cost Price</span>-->
            </div>
        </div>
        <div class="control-group">
            <label for="inputError" class="control-label">Date</label>
            <div class="controls">
                <input type="text" id="rent_date" name="rent_date" value="<?php echo set_value('rent_date'); ?>">
                <!--<span class="help-inline">OOps</span>-->
            </div>
        </div>
        <div id="div_cheque" style="display:none " >
            <div class="control-group">
                <label for="inputError" class="control-label">Cheque No</label>
                <div class="controls">
                    <input type="text" id="cheque_no" name="cheque_no" value="<?php echo set_value('cheque_no'); ?>">
                    <!--<span class="help-inline">OOps</span>-->
                </div>
            </div>
            <div class="control-group">
                <label for="inputError" class="control-label">Bank Name</label>
                <div class="controls">
                    <input type="text" id="bank_name" name="bank_name" value="<?php echo set_value('bank_name'); ?>"> 


                </div>
            </div>
            <div class="control-group">
                <label for="inputError" class="control-label">Account Holder</label>
                <div class="controls">
                    <input type="text" id="account_holder" name="account_holder" value="<?php echo set_value('account_holder'); ?>">
                    <!--<span class="help-inline">OOps</span>-->
                </div>
            </div>
        </div>
        <div class="form-actions">
            <button class="btn btn-primary" type="submit">Save changes</button>
            <button class="btn" type="reset">Cancel</button>
        </div>
    </fieldset>

<?php echo form_close(); ?>

</div>
<script>
    $(document).ready(function() {


        var nowTemp = new Date();
        var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

        var checkin1 = $('#rent_date').datepicker({
            onRender: function(date) {
                // return date.valueOf() < now.valueOf() ? 'disabled' : '';
            }
        }).on('changeDate', function(ev) {
            if (ev.date.valueOf() > checkout1.date.valueOf()) {
                var newDate = new Date(ev.date)
                newDate.setDate(newDate.getDate() + 1);
                checkout1.setValue(newDate);
            }

            checkin1.hide();
            $('#rent_date')[0].focus();
        }).data('datepicker');

        var checkout1 = $('#rent_date').datepicker({
            onRender: function(date) {
                return date.valueOf() <= checkin1.date.valueOf() ? 'disabled' : '';
            }
        }).on('changeDate', function(ev) {
            checkout1.hide();
        }).data('datepicker');

        $('#pay_mode').change(function() {
            if ($('#pay_mode').val() == 'cheque'){
                $('#div_cheque').css('display', 'block');
            }else{
                $('#div_cheque').css('display', 'none');
            }
        });

        $('#house_id').change(function() {
            if ($('#house_id').val() == '') {
                $('#bank_name').val('');
                $('#account_holder').val('');
            }
            $("#ajax_loader").css('display', 'block');
            $.ajax({
                type: "POST",
                url: "<?php echo site_url(); ?>admin/commons/getbankdetailbyhouseid",
                dataType: 'json',
                data: {house_id: $('#house_id').val()}
            })
                    .done(function(msg) {
                $("#ajax_loader").css('display', 'none');
                $('#bank_name').val(msg.bank.bank_name);
                $('#account_holder').val(msg.bank.account_holder);

            })
        });
    });
</script>