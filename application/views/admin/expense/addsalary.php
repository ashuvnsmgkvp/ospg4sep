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
          <a href="#">Add Salary</a>
        </li>
      </ul>
      
      <div class="page-header">
        <h2>
          Adding Salary
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
      foreach ($houses as $row)
      {
        $options_houses[$row['house_id']] = $row['house_no'];
      }
      $options_emp = array('' => "Select");
      foreach ($employees as $row)
      {
        $options_emp[$row['emp_name']] = $row['emp_name'];
      }
      

      //form validation
      echo validation_errors();
      
      echo form_open('admin/expense/addsalary', $attributes);
      ?>
        <fieldset>
            <div class="control-group">
            <label for="inputError" class="control-label">House No.</label>
            <div class="controls">
               <?php echo form_dropdown('house_id', $options_houses, set_value('house_id'), 'class="span2"'); ?>
  
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
          </div>
<!--          <div class="control-group">
            <label for="inputError" class="control-label">House Address</label>
            <div class="controls">
              <input type="text" id="" name="description" value="<?php echo set_value('description'); ?>" >
              <span class="help-inline">Woohoo!</span>
            </div>
          </div>-->
          <div class="control-group">
            <label for="inputError" class="control-label">Employee Name</label>
            <div class="controls">
<!--                <input type="text" id="employee_name" name="employee_name" value="<?php echo set_value('description'); ?>" >-->
                    <?php echo form_dropdown('employee_name', $options_emp, set_value('employee_name'), 'class="span2"'); ?>
            </div>
          </div> 
            
          <div class="control-group">
            <label for="inputError" class="control-label">Function</label>
           <?php $function = array(''=>'--Select--' ,'1'=>'Cook','2'=>'House keeping', '3'=>'Maid', '4'=>'Sweeper', '5'=>'Driver', '6'=>'Manager', '7'=>'Electrician', '8'=>'Accountant', '9'=>'IT', '10'=>'Security Guard');
                echo form_dropdown('function', $function, set_value('function'), 'class="span2"'); ?>
  
            </div>
        
          <div class="control-group">
            <label for="inputError" class="control-label">            Salary Amount</label>
            <div class="controls"><input type="text" id="salary_amount" name="salary_amount" value="<?php echo set_value('description'); ?>" >
              <!--<span class="help-inline">Cost Price</span>-->
            </div>
          </div>            


          <div class="control-group">
            <label for="inputError" class="control-label">From Date </label>
            <div class="controls">
                <input type="text" id="from_date" name="from_date" value="<?php echo set_value('description'); ?>" >    
              <!--<span class="help-inline">Cost Price</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">To Date</label>
            <div class="controls">
              <input type="text" id="to_date" name="to_date" value="<?php echo set_value('sell_price'); ?>">
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
           <div class="control-group">
            <label for="inputError" class="control-label">Advance Paid</label>
            <div class="controls">
              <input type="text" id="advance_paid" name="advance_paid" value="<?php echo set_value('sell_price'); ?>">
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
            <div class="control-group">
            <label for="inputError" class="control-label"> Advance Date</label>
            <div class="controls">
              <input type="text" id="advance_date" name="advance_date" value="<?php echo set_value('sell_price'); ?>">
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
            <div class="control-group">
            <label for="inputError" class="control-label">Salary Paid</label>
            <div class="controls">
                <input type="text" id="salary_paid" name="salary_paid" value="<?php echo set_value('sell_price'); ?>">
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
            <div class="control-group">
            <label for="inputError" class="control-label">Salary Date</label>
            <div class="controls">
              <input type="text" id="salary_date" name="salary_date" value="<?php echo set_value('sell_price'); ?>">
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
            
<!--          <div class="control-group">
            <label for="inputError" class="control-label">Next Due Date</label>
            <div class="controls">
              <input type="text" id="next_due_date" name="next_due_date" value="<?php echo set_value('sell_price'); ?>">
              <span class="help-inline">OOps</span>
            </div>
          </div>
            <div class="control-group">
            <label for="inputError" class="control-label">Next Due Amount</label>
            <div class="controls">
              <input type="text"id="next_due_amount"  name="next_due_amount" value="<?php echo set_value('sell_price'); ?>">
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
     <script>
        	$( document ).ready(function() {

			

    var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
     
    var checkin4 = $('#from_date').datepicker({
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
    $('#from_date')[0].focus();
    }).data('datepicker');
    
    var checkout4 = $('#from_date').datepicker({
    onRender: function(date) {
    return date.valueOf() <= checkin4.date.valueOf() ? 'disabled' : '';
    }
    }).on('changeDate', function(ev) {
    checkout4.hide();
    }).data('datepicker');
    
    //-------------------
    var checkin3 = $('#to_date').datepicker({
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
    $('#to_date')[0].focus();
    }).data('datepicker');
    
    var checkout3 = $('#to_date').datepicker({
    onRender: function(date) {
    return date.valueOf() <= checkin3.date.valueOf() ? 'disabled' : '';
    }
    }).on('changeDate', function(ev) {
    checkout3.hide();
    }).data('datepicker');
    //-----------------------
    var checkin2 = $('#advance_date').datepicker({
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
    $('#advance_date')[0].focus();
    }).data('datepicker');
    
    var checkout2 = $('#advance_date').datepicker({
    onRender: function(date) {
    return date.valueOf() <= checkin2.date.valueOf() ? 'disabled' : '';
    }
    }).on('changeDate', function(ev) {
    checkout2.hide();
    }).data('datepicker');
    
     //-----------------------
    var checkin1 = $('#salary_date').datepicker({
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
    $('#salary_date')[0].focus();
    }).data('datepicker');
    
    var checkout1 = $('#salary_date').datepicker({
    onRender: function(date) {
    return date.valueOf() <= checkin1.date.valueOf() ? 'disabled' : '';
    }
    }).on('changeDate', function(ev) {
    checkout1.hide();
    }).data('datepicker');
    
    
    });
//------
        	

			
</script>