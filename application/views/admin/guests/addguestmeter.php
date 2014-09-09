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
        if ($flash_message == 1) {
            echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> new product created with success.';
            echo '</div>';
        }elseif($flash_message == 'file_size_excide')
        {
          echo '<div class="alert alert-error">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> File size cannot be greter than 2Mb.';
          echo '</div>';       
        }else {
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
    $options_house = array('' => "Select");
    foreach ($houses as $row) {
        $options_house[$row['house_id']] = $row['house_no'];
    }

    //form validation
    echo validation_errors();

    echo form_open_multipart('admin/guests/addguestmeter', $attributes);
    ?>
    <fieldset>
        <div class="control-group">
            <label for="inputError" class="control-label">House No.</label>
            <div class="controls">
                <?php echo form_dropdown('house_id', $options_house, set_value('house_id'), 'class="span2" ID="house_id"'); ?>

              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
        </div>
         <div class="control-group">
            <label for="inputError" class="control-label">Room No.</label>
            <div class="controls">
                <?php
                $options_room = array('' => '--Select--', '1' => "101", '2' => "203");
                echo form_dropdown('room_id', $options_room, set_value('room_id'), 'class="span2" id="room_id"');
                ?>
            </div>
        </div>
    
        <div class="control-group">
            <label for="inputError" class="control-label">From Date</label>
            <div class="controls">
                <input type="text" name="from_date" id="from_date" value="<?php echo set_value('from_date'); ?>">
                <!--<span class="help-inline">OOps</span>-->
            </div>
        </div>
        <div class="control-group">
            <label for="inputError" class="control-label">To Date</label>
            <div class="controls">
                <input type="text" name="to_date" id="to_date" value="<?php echo set_value('to_date'); ?>">
                <!--<span class="help-inline">OOps</span>-->
            </div>
        </div>
        <div class="control-group">
            <label for="inputError" class="control-label">Electricity Unit</label>
            <div class="controls">
                <input type="text" name="unit" id="unit" value="<?php echo set_value('unit'); ?>">
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

<script>$(document).ready(function() {

    //Get Share Type()
    if($('#house_id').val()!=''){
        $.ajax({
            type: "POST",
            url: "<?php echo site_url(); ?>admin/guests/getsharetypebyhouseid",
            dataType: 'json',
            data: {house_id: $('#house_id').val()}
        }) .done(function(data) {
            if (data.status == 1)
            {
                var options = '';
                $.each(data.lists, function(i, list) {
                    options += '<option value="' + i + '">' + list + '</option>';
                });
                $('#share_type').html(options);
            }
        })
    }
    $('#house_id').change(function() {
        $.ajax({
            type: "POST",
            url: "<?php echo site_url(); ?>admin/guests/getsharetypebyhouseid",
            dataType: 'json',
            data: {house_id: $('#house_id').val()}
        }) .done(function(data) {
            if (data.status == 1)
            {
                var options = '';
                $.each(data.lists, function(i, list) {
                    options += '<option value="' + i + '">' + list + '</option>';
                });
                $('#share_type').html(options);
            }
        })
    });


    var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

    var checkin1 = $('#from_date').datepicker({
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
        $('#from_date')[0].focus();
    }).data('datepicker');

    var checkout1 = $('#from_date').datepicker({
        onRender: function(date) {
            return date.valueOf() <= checkin1.date.valueOf() ? 'disabled' : '';
        }
    }).on('changeDate', function(ev) {
        checkout1.hide();
    }).data('datepicker');
        
    //--------------------------
    var checkin2 = $('#to_date').datepicker({
        onRender: function(date) {
            // return date.valueOf() < now.valueOf() ? 'disabled' : '';
        }
    }).on('changeDate', function(ev) {
        if (ev.date.valueOf() > checkout2.date.valueOf()) {
            var newDate = new Date(ev.date)
            newDate.setDate(newDate.getDate() + 1);
            checkout2.setValue(newDate);
        }

        checkin2.hide();
        $('#to_date')[0].focus();
    }).data('datepicker');

    var checkout2 = $('#to_date').datepicker({
        onRender: function(date) {
            return date.valueOf() <= checkin2.date.valueOf() ? 'disabled' : '';
        }
    }).on('changeDate', function(ev) {
        checkout2.hide();
    }).data('datepicker');

});
</script>