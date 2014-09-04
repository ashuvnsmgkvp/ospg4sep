    <div class="container top">
      
      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("admin"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a> 
          <span class="divider">/</span>
        </li>
        <li>
          <a href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>">
            <?php echo ucfirst($this->uri->segment(2));?>
          </a> 
          <span class="divider">/</span>
        </li>
        <li class="active">
          <a href="#">Edit</a>
        </li>
      </ul>
      
      <div class="page-header">
        <h2>
          Edit <?php echo ucfirst($this->uri->segment(2));?>
        </h2>
      </div>
 
            <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> House updated with success.';
          echo '</div>';       
        }else{
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
      $options_manufacture = array('' => "Select");
//      foreach ($manufactures as $row)
//      {
//        $options_manufacture[$row['id']] = $row['name'];
//      }

      //form validation
      echo validation_errors();

      echo form_open_multipart('admin/houses/updatehouse/'.$house[0]['house_id'], $attributes);
      ?>
        <fieldset>
            <div class="control-group">
            <label for="inputError" class="control-label">House No.</label>
            <div class="controls">
              <input type="text" id="house_no" name="house_no" value="<?php echo $house[0]['house_no']; ?>" >
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">House Address</label>
            <div class="controls">
              <input type="text" id="house_address" name="house_address" value="<?php echo $house[0]['house_address'];  ?>" >
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">No of Rooms</label>
            <div class="controls">
<!--              <input type="text" id="house_rooms" name="house_rooms" value="<?php echo $house[0]['house_rooms']; ?>">-->
             <?php $arr_room = array(''=>'--Select--');
              for($i=1;$i<=20;$i++){$arr_room[$i]=$i;}
              
                echo form_dropdown('house_rooms', $arr_room, $house[0]['house_rooms'], 'class="span2"'); ?>
              
            </div>
          </div>          
          <div class="control-group">
            <label for="inputError" class="control-label">Accommodation Type</label>
            <div class="controls">
                <?php $house_acco_type = array(''=>'--Select--' ,'boys'=>"Boys",'girls'=>"Girls");
                echo form_dropdown('house_acco_type', $house_acco_type, $house[0]['house_acco_type'], 'class="span2"'); ?>
              
              <!--<span class="help-inline">Cost Price</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Owner Name</label>
            <div class="controls">
              <input type="text" id="owner_name" name="owner_name" value="<?php echo $house[0]['owner_name'];  ?>">
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
           <div class="control-group">
            <label for="inputError" class="control-label">Address</label>
            <div class="controls">
              <input type="text" id="owner_address" name="owner_address" value="<?php echo $house[0]['owner_address'];  ?>">
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
            <div class="control-group">
            <label for="inputError" class="control-label">Email ID</label>
            <div class="controls">
              <input type="text" id="owner_email" name="owner_email" value="<?php echo $house[0]['owner_email'];  ?>">
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
            <div class="control-group">
            <label for="inputError" class="control-label">PAN Card</label>
            <div class="controls">
              <input type="text" id="owner_pan" name="owner_pan" value="<?php echo $house[0]['owner_pan'];  ?>">
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
            <div class="control-group">
            <label for="inputError" class="control-label">Mobile</label>
            <div class="controls">
              <input type="text" id="owner_mobile" name="owner_mobile" value="<?php echo$house[0]['owner_mobile'];  ?>">
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
            <div class="control-group">
            <label for="inputError" class="control-label">Mobile2</label>
            <div class="controls">
              <input type="text" id="owner_mobile2" name="owner_mobile2" value="<?php echo $house[0]['owner_mobile2'];  ?>">
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
            <div class="control-group">
            <label for="inputError" class="control-label">Landline</label>
            <div class="controls">
              <input type="text" id="owner_landline" name="owner_landline" value="<?php echo $house[0]['owner_landline'];  ?>">
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
            <div class="control-group">
            <label for="inputError" class="control-label">Landline2</label>
            <div class="controls">
              <input type="text" id="owner_landline2" name="owner_landline2" value="<?php echo $house[0]['owner_landline2'];  ?>">
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
            <div class="control-group">
            <label for="inputError" class="control-label">Property Acquisition Date</label>
            <div class="controls">
                <input type="text" id="acquisition_date" name="acquisition_date" value="<?php echo substr( $house[0]['acquisition_date'],0,10);  ?>">
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
            <div class="control-group">
            <label for="inputError" class="control-label">Rent Agreemet Period From</label>
            <div class="controls">
              <input type="text" id="agreement_from" name="agreement_from" value="<?php echo substr($house[0]['agreement_from'],0,10);  ?>">
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
            <div class="control-group">
            <label for="inputError" class="control-label">Rent Agreemet Period To</label>
            <div class="controls">
              <input type="text"id="agreement_to" name="agreement_to" value="<?php echo substr($house[0]['agreement_to'],0,10);  ?>">
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
            <div class="control-group">
            <label for="inputError" class="control-label">Rent Amount</label>
            <div class="controls">
              <input type="text" id="rent_amount" name="rent_amount" value="<?php echo $house[0]['rent_amount'];  ?>">
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
            <div class="control-group">
            <label for="inputError" class="control-label">Next Rent Agreement Date</label>
            <div class="controls">
              <input type="text" id="rent_date" name="rent_date" value="<?php echo substr($house[0]['rent_date'],0,10);  ?>">
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
<div class="control-group">
                <label for="inputError" class="control-label">Document Scan1</label>
                <div class="controls">
                    <?php $attrimage = array('name' => 'document1', 'id' => 'document1', 'value' => set_value('document1'), 'class' => 'uploadlogo');
                    echo form_upload($attrimage); 
                    ?>
                    <a href="#" class="import_image">Browse Image</a>
                    <?php if (isset($house[0]['document1']) && $house[0]['document1'] != '' && file_exists('./assets/img/house/documents/'.$house[0]['document1']) ) { ?>
                        <img src="<?php echo site_url(); ?>assets/img/house/documents/<?php echo $house[0]['document1']; ?>" style="position:absolute; padding-top: 10px;"  align="absmiddle" height="20px" width="20px" onerror="this.src='<?php echo site_url(); ?>assets/images/images.jpeg';" />
                        <?php } //echo form_error('uploadimage',"<span class='error'>","</span>");  ?>
                </div>
            </div>
             <div class="control-group">
                <label for="inputError" class="control-label">Document Scan2</label>
                <div class="controls">
                    <?php $attrimage = array('name' => 'document2', 'id' => 'document2', 'value' => set_value('document2'), 'class' => 'uploadlogo');
                    echo form_upload($attrimage);
                    ?>
                    <a href="#" class="import_image">Browse Image</a>
                    <?php if (isset($house[0]['document2']) && $house[0]['document2'] != '' && file_exists('./assets/img/house/documents/'.$house[0]['document2']) ) { ?>
                        <img src="<?php echo site_url(); ?>assets/img/house/documents/<?php echo $house[0]['document2']; ?>" style="position:absolute; padding-top: 10px;"  align="absmiddle" height="20px" width="20px" onerror="this.src='<?php echo site_url(); ?>assets/images/images.jpeg';" />
                        <?php } //echo form_error('uploadimage',"<span class='error'>","</span>");  ?>
                </div>
            </div>
             <div class="control-group">
                <label for="inputError" class="control-label">Document Scan3</label>
                <div class="controls">
                    <?php $attrimage = array('name' => 'document3', 'id' => 'document3', 'value' => set_value('document3'), 'class' => 'uploadlogo');
                    echo form_upload($attrimage);
                    ?>
                    <a href="#" class="import_image">Browse Image</a>
                    <?php if (isset($house[0]['document3']) && $house[0]['document3'] != '' && file_exists('./assets/img/house/documents/'.$house[0]['document3']) ) { ?>
                        <img src="<?php echo site_url(); ?>assets/img/house/documents/<?php echo $house[0]['document3']; ?>" style="position:absolute; padding-top: 10px;"  align="absmiddle" height="20px" width="20px" onerror="this.src='<?php echo site_url(); ?>assets/images/images.jpeg';" />
                        <?php } //echo form_error('uploadimage',"<span class='error'>","</span>");  ?>
                </div>
            </div>
             <div class="control-group">
                <label for="inputError" class="control-label">Document Scan4</label>
                <div class="controls">
                    <?php $attrimage = array('name' => 'document4', 'id' => 'document4', 'value' => set_value('document4'), 'class' => 'uploadlogo');
                    echo form_upload($attrimage);
                    ?>
                    <a href="#" class="import_image">Browse Image</a>
                    <?php if (isset($house[0]['document4']) && $house[0]['document4'] != '' && file_exists('./assets/img/house/documents/'.$house[0]['document4']) ) { ?>
                        <img src="<?php echo site_url(); ?>assets/img/house/documents/<?php echo $house[0]['document4']; ?>" style="position:absolute; padding-top: 10px;"  align="absmiddle" height="20px" width="20px" onerror="this.src='<?php echo site_url(); ?>assets/images/images.jpeg';" />
                        <?php } //echo form_error('uploadimage',"<span class='error'>","</span>");  ?>
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
        	$( document ).ready(function() {
    

var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
     
    var checkin1 = $('#acquisition_date').datepicker({
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
    $('#acquisition_date')[0].focus();
    }).data('datepicker');
    
    var checkout1 = $('#acquisition_date').datepicker({
    onRender: function(date) {
    return date.valueOf() <= checkin1.date.valueOf() ? 'disabled' : '';
    }
    }).on('changeDate', function(ev) {
    checkout1.hide();
    }).data('datepicker');


     
    var checkin2 = $('#agreement_from').datepicker({
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
    $('#agreement_from')[0].focus();
    }).data('datepicker');
    
    var checkout2 = $('#agreement_from').datepicker({
    onRender: function(date) {
    return date.valueOf() <= checkin2.date.valueOf() ? 'disabled' : '';
    }
    }).on('changeDate', function(ev) {
    checkout2.hide();
    }).data('datepicker');

     
    var checkin3 = $('#agreement_to').datepicker({
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
    $('#agreement_to')[0].focus();
    }).data('datepicker');
    
    var checkout3 = $('#agreement_to').datepicker({
    onRender: function(date) {
    return date.valueOf() <= checkin3.date.valueOf() ? 'disabled' : '';
    }
    }).on('changeDate', function(ev) {
    checkout3.hide();
    }).data('datepicker');

     
    var checkin4 = $('#rent_date').datepicker({
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
    $('#rent_date')[0].focus();
    }).data('datepicker');
    
    var checkout4 = $('#rent_date').datepicker({
    onRender: function(date) {
    return date.valueOf() <= checkin4.date.valueOf() ? 'disabled' : '';
    }
    }).on('changeDate', function(ev) {
    checkout4.hide();
    }).data('datepicker');
});

			
</script>