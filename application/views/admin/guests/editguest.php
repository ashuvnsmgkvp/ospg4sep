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
            <a href="#">Edit Guest</a>
        </li>
    </ul>

    <div class="page-header">
        <h2>
            Editing <?php echo ucfirst($this->uri->segment(2)); ?> Guest
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
    $options_house = array('' => "--Select--");
    foreach ($houses as $row) {
        $options_house[$row['house_id']] = $row['house_no'];
    }
    
    //print_r( $share_types) ;
    $options_share_types = array();
    foreach ($share_types as $id=>$val) {
        $options_share_types[$id] = $val;
    }
    //print_r( $room_no) ;
    $options_room = array();
    foreach ($room_no as $room_id=>$room) {
        $options_room[$room_id] = $room;
    }
    
 //echo "<pre>"; 
 //print_r( $guest) ;//echo "</pre>";
    //form validation
    echo validation_errors();

    echo form_open_multipart('admin/guests/updateguest/'.$guest[0]['guest_id'], $attributes);
    ?>
    <fieldset>
        <div class="control-group">
            <label for="inputError" class="control-label">House No.</label>
            <div class="controls">
                <?php echo form_dropdown('house_id', $options_house, $guest[0]['house_id'], 'class="span2" id="house_id"'); ?>
            </div>
        </div>
        <div class="control-group">
            <label for="inputError" class="control-label">Sharing</label>
            <div class="controls">
<?php echo form_dropdown('share_type', $options_share_types, $guest[0]['share_type'], 'class="span2" id="share_type"');?>

              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
        </div>

        <div class="control-group">
            <label for="inputError" class="control-label">Room No.</label>
            <div class="controls">
<?php //$options_room = array('' => '--Select--', '1' => "101", '2' => "203");
echo form_dropdown('room_id', $options_room, $guest[0]['room_id'], 'class="span2" id="room_id"');
?>

              <!--<span class="help-inline">Cost Price</span>-->
            </div>
        </div>          
        
        
<!--        <div class="control-group">
            <label for="inputError" class="control-label">Status</label>
            <div class="controls">
                <input type="text" name="status" id="status" value="<?php echo set_value('status'); ?>">
                <span class="help-inline">OOps</span>
            </div>
        </div>-->
        <div class="control-group">
            <label for="inputError" class="control-label">Guest Name</label>
            <div class="controls">
                <input type="text" name="guest_name" value="<?php echo $guest[0]['guest_name']; ?>">
                <!--<span class="help-inline">OOps</span>-->
            </div>
        </div>
        <div class="control-group">
            <label for="inputError" class="control-label">Date of Birth</label>
            <div class="controls">
                <input type="text" name="dob" id="dob" value="<?php echo $guest[0]['dob']; ?>">
                <!--<span class="help-inline">OOps</span>-->
            </div>
        </div>
        <div class="control-group">
            <label for="inputError" class="control-label">Sex</label>
            <div class="controls">
                <input type="text" name="sex" id="sex" value="<?php echo $guest[0]['sex'] ?>">
                <!--<span class="help-inline">OOps</span>-->
            </div>
        </div>
        <div class="control-group">
            <label for="inputError" class="control-label">Mobile Number</label>
            <div class="controls">
                <input type="text" name="mobile" id="mobile" value="<?php echo $guest[0]['mobile']; ?>">
                <!--<span class="help-inline">OOps</span>-->
            </div>
        </div>
        <div class="control-group">
            <label for="inputError" class="control-label">Email ID</label>
            <div class="controls">
                <input type="text" name="email" id="email" value="<?php echo $guest[0]['email']; ?>">
                <!--<span class="help-inline">OOps</span>-->
            </div>
        </div>
        <div class="control-group">
            <label for="inputError" class="control-label">Father Name</label>
            <div class="controls">
                <input type="text" name="father_name" id="father_name" value="<?php echo $guest[0]['father_name']; ?>">
                <!--<span class="help-inline">OOps</span>-->
            </div>
        </div>
        <div class="control-group">
            <label for="inputError" class="control-label">Permanent Address</label>
            <div class="controls">
                <input type="text" name="parmanent_address" id="parmanent_address" value="<?php echo $guest[0]['parmanent_address']; ?>">
                <!--<span class="help-inline">OOps</span>-->
            </div>
        </div>
        <div class="control-group">
            <label for="inputError" class="control-label">House Mobile</label>
            <div class="controls">
                <input type="text" name="house_mobile" id="house_mobile" value="<?php echo $guest[0]['house_mobile']; ?>">
                <!--<span class="help-inline">OOps</span>-->
            </div>
        </div>
        <div class="control-group">
            <label for="inputError" class="control-label">House Landline</label>
            <div class="controls">
                <input type="text" name="house_landline" id="house_landline" value="<?php echo$guest[0]['house_landline']; ?>">
                <!--<span class="help-inline">OOps</span>-->
            </div>
        </div>
        <div class="control-group">
            <label for="inputError" class="control-label">Company / College Name</label>
            <div class="controls">
                <input type="text" name="comp_college" id="comp_college" value="<?php echo $guest[0]['comp_college']; ?>">
                <!--<span class="help-inline">OOps</span>-->
            </div>
        </div>
        <div class="control-group">
            <label for="inputError" class="control-label">Address</label>
            <div class="controls">
                <input type="text" name="address" id="address" value="<?php echo $guest[0]['address']; ?>">
                <!--<span class="help-inline">OOps</span>-->
            </div>
        </div>
<!--        <div class="control-group">
            <label for="inputError" class="control-label">ID Proof</label>
            <div class="controls">
                <input type="text" name="id_proof" id="id_proof" value="<?php echo $guest[0]['id_proof']; ?>">
                <span class="help-inline">OOps</span>
            </div>
        </div>-->
<div class="control-group">
                <label for="inputError" class="control-label">ID Proof</label>
                <div class="controls">
                    <?php $attrimage = array('name' => 'id_proof', 'id' => 'id_proof', 'value' => set_value('id_proof'), 'class' => 'uploadlogo');
                    echo form_upload($attrimage);
                    ?>
                    <a href="#" class="import_image">Browse Image</a>
                    <?php if (isset($guest[0]['id_proof']) && $guest[0]['id_proof']!= '' && file_exists("./assets/img/house/documents/".$guest[0]['id_proof'])) { ?>
                        <img src="<?php echo site_url(); ?>assets/img/house/documents/<?php echo $guest[0]['id_proof']; ?>" style="position:absolute; padding-top: 10px;"  align="absmiddle" height="20px" width="20px" onerror="this.src='<?php echo site_url(); ?>assets/images/images.jpeg';" />
                        <?php } //echo form_error('uploadimage',"<span class='error'>","</span>");  ?>
                </div>
            </div>
<!--        <div class="control-group">
            <label for="inputError" class="control-label">Photo</label>
            <div class="controls">
                <input type="text" name="photo" id="photo" value="<?php echo $guest[0]['photo']; ?>">
                <span class="help-inline">OOps</span>
            </div>
        </div>-->
<div class="control-group">
                <label for="inputError" class="control-label">Photo</label>
                <div class="controls">
                    <?php $attrimage = array('name' => 'photo', 'id' => 'photo', 'value' => set_value('photo'), 'class' => 'uploadlogo');
                    echo form_upload($attrimage);
                    ?>
                    <a href="#" class="import_image">Browse Image</a>
                    <?php if (isset($guest[0]['photo']) && $guest[0]['photo']!= '' && file_exists("./assets/img/house/documents/".$guest[0]['photo'])) { ?>
                        <img src="<?php echo site_url(); ?>assets/img/house/documents/<?php echo $guest[0]['photo']; ?>" style="position:absolute; padding-top: 10px;"  align="absmiddle" height="20px" width="20px" onerror="this.src='<?php echo site_url(); ?>assets/images/images.jpeg';" />
                        <?php } //echo form_error('uploadimage',"<span class='error'>","</span>");  ?>
                </div>
            </div>
        <div class="control-group">
            <label for="inputError" class="control-label">Monthly Rent</label>
            <div class="controls">
                <input type="text" name="monthly_rent" id="monthly_rent" value="<?php echo $guest[0]['monthly_rent']; ?>">
                <!--<span class="help-inline">OOps</span>-->
            </div>
        </div>
        <div class="control-group">
            <label for="inputError" class="control-label">Joining Date</label>
            <div class="controls">
                <input type="text" name="joining_date" id="joining_date" value="<?php echo $guest[0]['joining_date']; ?>">
                <!--<span class="help-inline">OOps</span>-->
            </div>
        </div>
        <div class="control-group">
            <label for="inputError" class="control-label">Notice Date</label>
            <div class="controls">
                <input type="text" name="notice_date" id="notice_date" value="<?php echo $guest[0]['notice_date']; ?>">
                <!--<span class="help-inline">OOps</span>-->
            </div>
        </div>
<!--        <div class="control-group">
            <label for="inputError" class="control-label">Rent Period from</label>
            <div class="controls">
                <input type="text" name="sell_price" value="<?php echo set_value('sell_price'); ?>">
                <span class="help-inline">OOps</span>
            </div>
        </div>
        <div class="control-group">
            <label for="inputError" class="control-label">Rent Period to</label>
            <div class="controls">
                <input type="text" name="sell_price" value="<?php echo set_value('sell_price'); ?>">
                <span class="help-inline">OOps</span>
            </div>
        </div>-->

        <div class="form-actions">
            <button class="btn btn-primary" type="submit">Save changes</button>
            <button class="btn" type="reset">Cancel</button>
        </div>
    </fieldset>

<?php echo form_close(); ?>

</div>

<script>$(document).ready(function() {
    //Get Share Type()
//    if($('#house_id').val()!=''){
//            $.ajax({
//            type: "POST",
//            url: "<?php echo site_url(); ?>admin/guests/getsharetypebyhouseid",
//            dataType: 'json',
//            data: {house_id: $('#house_id').val()}
//        }) .done(function(data) {
//            if (data.status == 1)
//            {
//                var options = '';
//                $.each(data.lists, function(i, list) {
//                    options += '<option value="' + i + '">' + list + '</option>';
//                });
//                $('#share_type').html(options);
                //$('#share_type').val('<?php echo $guest[0]['share_type'];?>');
//            }
//        })
//        }
        
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

//Get Room Number
//       if($('#house_id').val()!='' && $('#share_type').val()!=''){
//       $.ajax({
//            type: "POST",
//            url: "<?php echo site_url(); ?>admin/guests/getroomnobyhouseidandsharetype",
//            dataType: 'json',
//            data: {house_id: $('#house_id').val(),share_type: $('#share_type').val()}
//        }) .done(function(data) {
//            if (data.status == 1)
//            {
//                var options = '';
//                $.each(data.lists, function(i, list) {
//                    options += '<option value="' + i + '">' + list + '</option>';
//                });
//                $('#room_id').html(options);
//                $('#room_id').val('<?php echo $guest[0]['room_id'];?>');
//            }
//        })
//        }
    $('#share_type').change(function() {
        $.ajax({
            type: "POST",
            url: "<?php echo site_url(); ?>admin/guests/getroomnobyhouseidandsharetype",
            dataType: 'json',
            data: {house_id: $('#house_id').val(),share_type: $('#share_type').val()}
        }) .done(function(data) {
            if (data.status == 1)
            {
                var options = '';
                $.each(data.lists, function(i, list) {
                    options += '<option value="' + i + '">' + list + '</option>';
                });
                $('#room_id').html(options);
            }
        })
    });

        var nowTemp = new Date();
        var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

        var checkin1 = $('#dob').datepicker({
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
            $('#dob')[0].focus();
        }).data('datepicker');

        var checkout1 = $('#dob').datepicker({
            onRender: function(date) {
                return date.valueOf() <= checkin1.date.valueOf() ? 'disabled' : '';
            }
        }).on('changeDate', function(ev) {
            checkout1.hide();
        }).data('datepicker');
        
        //--------------------------
            var checkin2 = $('#joining_date').datepicker({
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
            $('#joining_date')[0].focus();
        }).data('datepicker');

        var checkout2 = $('#joining_date').datepicker({
            onRender: function(date) {
                return date.valueOf() <= checkin2.date.valueOf() ? 'disabled' : '';
            }
        }).on('changeDate', function(ev) {
            checkout2.hide();
        }).data('datepicker');
        
        //--------------------------
            var checkin3 = $('#notice_date').datepicker({
            onRender: function(date) {
                // return date.valueOf() < now.valueOf() ? 'disabled' : '';
            }
        }).on('changeDate', function(ev) {
            if (ev.date.valueOf() > checkout3.date.valueOf()) {
                var newDate = new Date(ev.date)
                newDate.setDate(newDate.getDate() + 1);
                checkout3.setValue(newDate);
            }

            checkin3.hide();
            $('#notice_date')[0].focus();
        }).data('datepicker');

        var checkout3 = $('#notice_date').datepicker({
            onRender: function(date) {
                return date.valueOf() <= checkin3.date.valueOf() ? 'disabled' : '';
            }
        }).on('changeDate', function(ev) {
            checkout3.hide();
        }).data('datepicker');
        
        

});
</script>