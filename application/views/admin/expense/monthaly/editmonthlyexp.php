    <div class="container top">
      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("admin"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a> 
          <span class="divider">/</span>
        </li>
        <li>
          <a href="<?php echo site_url("admin").'/'.$this->uri->segment(2).'/showmonthlyexp'; ?>">
            <?php echo ucfirst($this->uri->segment(2));?>
          </a> 
          <span class="divider">/</span>
        </li>
        <li class="active">
          <a href="#">Edit Monthly Expenses</a>
        </li>
      </ul>
      <div class="page-header">
        <h2>
          Edit Monthly Expenses
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

      //form validation
      echo validation_errors();
      
      echo form_open('admin/expense/updatemonthlyexp/'.$mexp[0]['mexp_id'], $attributes);
      ?>
        <fieldset>
            <div class="control-group">
            <label for="inputError" class="control-label">House No.</label>
            <div class="controls">
               <?php 
                echo form_dropdown('house_id', $options_houses, $mexp[0]['house_id'], 'class="span2"'); ?>
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Type</label>
            <div class="controls">
                <?php $options_type = array(''=>'--Select--' ,1=>'Internet', 2=>'Cable', 3=>'IGL', 4=>'Electricity Bill', 5=>'Telephone', 6=>'Mobile', 7=>'Garbage' );                
                echo form_dropdown('type', $options_type, $mexp[0]['type'], 'class="span2"'); ?>
            </div>
          </div> 
            
          <div class="control-group">
            <label for="inputError" class="control-label">Period From </label>
            <div class="controls"><input type="text" id="period_from" name="period_from" value="<?php echo $mexp[0]['period_from']; ?>" >
              <!--<span class="help-inline">Cost Price</span>-->
            </div>
          </div>            


          <div class="control-group">
            <label for="inputError" class="control-label">Period To </label>
            <div class="controls">
                <input type="text" id="period_to" name="period_to" value="<?php echo $mexp[0]['period_to']; ?>" >    
              <!--<span class="help-inline">Cost Price</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Payment Date</label>
            <div class="controls">
              <input type="text" id="payment_date" name="payment_date" value="<?php echo $mexp[0]['payment_date']; ?>">
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
           <div class="control-group">
            <label for="inputError" class="control-label">Paid Amount</label>
            <div class="controls">
              <input type="text" id="paid_amount" name="paid_amount" value="<?php echo $mexp[0]['paid_amount']; ?>">
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
            <div class="control-group">
            <label for="inputError" class="control-label">Balance Amount</label>
            <div class="controls">
              <input type="text" id="balance_amount" name="balance_amount" value="<?php echo $mexp[0]['balance_amount']; ?>">
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
        	$( document ).ready(function() {
    

    var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
     
    var checkin4 = $('#period_from').datepicker({
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
    $('#period_from')[0].focus();
    }).data('datepicker');
    
    var checkout4 = $('#period_from').datepicker({
    onRender: function(date) {
    return date.valueOf() <= checkin4.date.valueOf() ? 'disabled' : '';
    }
    }).on('changeDate', function(ev) {
    checkout4.hide();
    }).data('datepicker');
    
    //-------------------
    var checkin3 = $('#period_to').datepicker({
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
    $('#period_to')[0].focus();
    }).data('datepicker');
    
    var checkout3 = $('#period_to').datepicker({
    onRender: function(date) {
    return date.valueOf() <= checkin3.date.valueOf() ? 'disabled' : '';
    }
    }).on('changeDate', function(ev) {
    checkout3.hide();
    }).data('datepicker');
    //-----------------------
    var checkin2 = $('#payment_date').datepicker({
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
    $('#payment_date')[0].focus();
    }).data('datepicker');
    
    var checkout2 = $('#payment_date').datepicker({
    onRender: function(date) {
    return date.valueOf() <= checkin2.date.valueOf() ? 'disabled' : '';
    }
    }).on('changeDate', function(ev) {
    checkout2.hide();
    }).data('datepicker');
    
    
    
    });
//------


			
</script>