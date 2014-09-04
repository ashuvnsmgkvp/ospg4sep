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
          <a href="#">Add Annual Expenses</a>
        </li>
      </ul>
      <div class="page-header">
        <h2>
          Adding Annual Expenses
        </h2>
      </div>
      <?php
      //flash messages
      if(isset($flash_message)){
        if($flash_message == TRUE)
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> new records created with success.';
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
      //print_r($aexp[0]);
      $attributes = array('class' => 'form-horizontal', 'id' => '');
      $options_houses = array('' => "Select");
      foreach ($houses as $row)
      {
        $options_houses[$row['house_id']] = $row['house_no'];
      }
	   $options_head = array('' => "Select");
      //$options_annual_head = array('' => "Select");
      foreach ($annual_head as $k => $v) {
          $options_annual_head[$k] = $v;
      }
      $options_annual_type = array('' => "Select");
      foreach ($annual_type as $k => $v) {
          $options_annual_type[$k] = $v;
      }
     
      //$options_amc_head = array('' => "Select");
      foreach ($amc_head as $k => $v) {
          $options_amc_head[$k] = $v;
      }
      $options_amc_type = array('' => "Select");

	   $options_head['Annual Expense']= $options_annual_head;
	   $options_head['AMC']= $options_amc_head;

      foreach ($amc_type as $k => $v) {
          $options_amc_type[$k] = $v;
      }
      //form validation
      echo validation_errors();
      
      echo form_open('admin/expense/updateannualexp/'.$aexp[0]['aexp_id'], $attributes);
     
      ?>
        <fieldset>
            <div class="control-group">
            <label for="inputError" class="control-label">House No.</label>
            <div class="controls">
               <?php 
                echo form_dropdown('house_id', $options_houses, $aexp[0]['house_id'], 'class="span2" id="house_id"'); ?>
            </div>
          </div>
            <div class="control-group">
            <label for="inputError" class="control-label">Expense / AMC</label>
            <div class="controls">
                <?php $options_exp_amc = array(''=>'--Select--' ,1=>'Annual Expense', 2=>'AMC' );                
                echo form_dropdown('exp_or_amc', $options_exp_amc, $aexp[0]['exp_or_amc'], 'class="span2" id="exp_or_amc"'); ?>
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Expense Head</label>
            <div class="controls">
                <?php //$options_head = $head;//array(''=>'--Select--' ,1=>'Internet', 2=>'Cable', 3=>'IGL', 4=>'Electricity Bill', 5=>'Telephone', 6=>'Mobile', 7=>'Garbage' );                
				echo form_dropdown('head', $options_head, $aexp[0]['head'], 'class="span2" id="head"');
                //echo form_dropdown('annual_head', $options_annual_head, set_value('annual_head'), 'class="span2"');
                //echo form_dropdown('amc_head', $options_amc_head, set_value('amc_head'), 'class="span2"'); ?>
            </div>
          </div> 
<!--          <div class="control-group">
            <label for="inputError" class="control-label">Expense Type</label>
            <div class="controls">
                <?php //$options_type = array(''=>'--Select--' ,1=>'Internet', 2=>'Cable', 3=>'IGL', 4=>'Electricity Bill', 5=>'Telephone', 6=>'Mobile', 7=>'Garbage' );                
                echo form_dropdown('annual_type', $options_annual_type, set_value('annual_type'), 'class="span2"');
                echo form_dropdown('amc_type', $options_amc_type, set_value('amc_type'), 'class="span2"');?>
            </div>
          </div> -->
            
          <div class="control-group">
            <label for="inputError" class="control-label">Period From </label>
            <div class="controls"><input type="text" id="period_from" name="period_from" value="<?php echo $aexp[0]['period_from'] ; ?>" >
              <!--<span class="help-inline">Cost Price</span>-->
            </div>
          </div>            


          <div class="control-group">
            <label for="inputError" class="control-label">Period To </label>
            <div class="controls">
                <input type="text" id="period_to" name="period_to" value="<?php echo $aexp[0]['period_to'] ; ?>" >    
              <!--<span class="help-inline">Cost Price</span>-->
            </div>
          </div>
            <div class="control-group">
            <label for="inputError" class="control-label">Paid Amount</label>
            <div class="controls">
              <input type="text" id="paid_amount" name="paid_amount" value="<?php echo $aexp[0]['paid_amount'] ; ?>">
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Payment Date</label>
            <div class="controls">
              <input type="text" id="payment_date" name="payment_date" value="<?php echo $aexp[0]['payment_date'] ; ?>">
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
           <div class="control-group">
            <label for="inputError" class="control-label">Balance Amount</label>
            <div class="controls">
              <input type="text" id="balance_amount" name="balance_amount" value="<?php echo $aexp[0]['balance_amount']  ; ?>">
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
                    $("#house_id").click(function(){ alert('You could not change house number.');
                           return false;
                       });
			var selectexporamc=$( "select#exp_or_amc option:selected" ).text();
                       
			$( "select#head" ).find('optgroup').each(function() {
				$(this).css('display', 'none');
				var lblhead= $(this).attr('label');
				if(lblhead==selectexporamc )
				$(this).css('display', 'block');
				else
				$(this).css('display', 'none');
			});

			$( "select#exp_or_amc" ).change(function() {
			var selectexporamc=$( "select#exp_or_amc option:selected" ).text();
			$("select#head").val('');  // reset head
			$( "select#head" ).find('optgroup').each(function() {
				var lblhead= $(this).attr('label');
				if(lblhead==selectexporamc )
				$(this).css('display', 'block');
				else
				$(this).css('display', 'none');
			});
			});

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