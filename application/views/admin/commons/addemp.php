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
          <a href="#">New Employee Details</a>
        </li>
      </ul>
      
      <div class="page-header">
        <h2>
          Adding Employee Details
        </h2>
      </div>
 
      <?php
      //flash messages
      if(isset($flash_message)){
        if($flash_message == TRUE)
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> new product created with success.';
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
       $options_houses = array('' => "Select");
//      foreach ($houses as $row)
//      {
//        $options_houses[$row['house_id']] = $row['house_no'];
//      }
      //form validation
      echo validation_errors();
      
      echo form_open('admin/commons/addemp', $attributes);
      ?>
        <fieldset>
            
           
          <div class="control-group">
            <label for="inputError" class="control-label">Employee Name</label>
            <div class="controls">
              <input type="text" id="emp_name" name="emp_name" value="<?php echo set_value('emp_name'); ?>" >
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">DOJ</label>
            <div class="controls">
              <input type="text" id="emp_doj" name="emp_doj" value="<?php echo set_value('emp_doj'); ?>" >
              <!--<span class="help-inline">Cost Price</span>-->
            </div>
          </div>          
          <div class="control-group">
            <label for="inputError" class="control-label">Resign Date</label>
            <div class="controls">
              <input type="text" id="emp_dol" name="emp_dol" value="<?php echo set_value('emp_dol'); ?>">
              <!--<span class="help-inline">Cost Price</span>-->
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
    var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
     
    //-----------------------
    var checkin1 = $('#emp_dol').datepicker({
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
    $('#emp_dol')[0].focus();
    }).data('datepicker');
    
    var checkout1 = $('#emp_dol').datepicker({
    onRender: function(date) {
    return date.valueOf() <= checkin1.date.valueOf() ? 'disabled' : '';
    }
    }).on('changeDate', function(ev) {
    checkout1.hide();
    }).data('datepicker');
    //-----------------------
    var checkin2 = $('#emp_doj').datepicker({
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
    $('#emp_doj')[0].focus();
    }).data('datepicker');
    
    var checkout2 = $('#emp_doj').datepicker({
    onRender: function(date) {
    return date.valueOf() <= checkin2.date.valueOf() ? 'disabled' : '';
    }
    }).on('changeDate', function(ev) {
    checkout2.hide();
    }).data('datepicker');
</script>