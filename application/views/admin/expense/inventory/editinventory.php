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
            <a href="#">Edit Inventory </a>
        </li>
    </ul>
    <div class="page-header">
        <h2>
            Editing Inventory 
        </h2>
    </div>
    <?php
    //flash messages
    if (isset($flash_message)) {
        if ($flash_message == TRUE) {
            echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> new records created with success.';
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
    //print_r($aexp[0]);
    $attributes = array('class' => 'form-horizontal', 'id' => '');
    $options_houses = array('' => "Select");
    foreach ($houses as $row) {
        $options_houses[$row['house_id']] = $row['house_no'];
    }
    $options_item = array('' => "Select");


    foreach ($inventory_items as $k => $v) {
        $options_item[$k] = $v;
    }
    //form validation
    echo validation_errors();

    echo form_open('admin/expense/updateinventory/' . $inventory[0]['inv_id'], $attributes);
    //print_r($inventory[0]);
    ?>
    <fieldset>
        <div class="control-group">
            <label for="inputError" class="control-label">House No.</label>
            <div class="controls">
<?php echo form_dropdown('house_id', $options_houses, $inventory[0]['house_id'], 'class="span2" id="house_id"'); ?>
            </div>
        </div>
        <div class="control-group">
            <label for="inputError" class="control-label">Items</label>
            <div class="controls">
<?php echo form_dropdown('inv_item', $options_item, $inventory[0]['inv_item'], 'class="span2" id="inv_item" id="inv_item"'); ?>
            </div>
        </div>
        <div class="control-group">
            <label for="inputError" class="control-label">Make</label>
            <div class="controls">
                <input type="text" id="make" name="make" value="<?php echo $inventory[0]['make']; ?>" >
            </div>
        </div> 
        <div class="control-group">
            <label for="inputError" class="control-label">Model</label>
            <div class="controls">
                <input type="text" id="model" name="model" value="<?php echo $inventory[0]['model']; ?>" >
            </div>
        </div> 

        <div class="control-group">
            <label for="inputError" class="control-label">Purchase Date </label>
            <div class="controls">
                <input type="text" id="purchase_date" name="purchase_date" value="<?php echo $inventory[0]['purchase_date']; ?>" >
              <!--<span class="help-inline">Cost Price</span>-->
            </div>
        </div>            


        <div class="control-group">
            <label for="inputError" class="control-label">Purchase Amount </label>
            <div class="controls">
                <input type="text" id="purchase_amount" name="purchase_amount" value="<?php echo $inventory[0]['purchase_amount']; ?>" >    
              <!--<span class="help-inline">Cost Price</span>-->
            </div>
        </div>
        <div class="control-group">
            <label for="inputError" class="control-label">Vendor Name</label>
            <div class="controls">
                <input type="text" id="vendor_name" name="vendor_name" value="<?php echo $inventory[0]['vendor_name']; ?>">
                <!--<span class="help-inline">OOps</span>-->
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
        $("#house_id").click(function() {
            alert('You could not change house number.');
            return false;
        });
        $("#inv_item").click(function() {
            alert('You could not change Items.');
            return false;
        });
        var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
     
    var checkin4 = $('#purchase_date').datepicker({
    onRender: function(date) {
   // return date.valueOf() < now.valueOf() ? 'disabled' : '';
    }
    }).on('changeDate', function(ev) {
    if (ev.date.valueOf() > checkout4.date.valueOf()) {
    var newDate = new Date(ev.date)
    newDate.setDate(newDate.getDate() + 1);
    checkout4.setValue(newDate);
    }
    
    checkin4.hide();
    $('#purchase_date')[0].focus();
    }).data('datepicker');
    
    var checkout4 = $('#purchase_date').datepicker({
    onRender: function(date) {
    return date.valueOf() <= checkin4.date.valueOf() ? 'disabled' : '';
    }
    }).on('changeDate', function(ev) {
    checkout4.hide();
    }).data('datepicker');
    });

</script>