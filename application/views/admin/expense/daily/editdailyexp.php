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
          <a href="#">Add Daily Expenses</a>
        </li>
      </ul>
      <div class="page-header">
        <h2>
          Adding Daily Expenses
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
      $attributes = array('class' => 'form-horizontal', 'id' => '');
      $options_houses = array('' => "Select");
      foreach ($houses as $row)
      {
        $options_houses[$row['house_id']] = $row['house_no'];
      }
      $options_head = array('' => "Select");
      foreach ($head as $k => $v) {
          $options_head[$k] = $v;
      }
      $options_type = array('' => "Select");
      foreach ($type as $k => $v) {
          $options_type[$k] = $v;
      }
      //form validation
      echo validation_errors();
      
      echo form_open('admin/expense/updatedailyexp/'.$dexp[0]['dexp_id'], $attributes);
  
      ?>
        <fieldset>
            <div class="control-group">
            <label for="inputError" class="control-label">House No.</label>
            <div class="controls">
               <?php 
                echo form_dropdown('house_id', $options_houses, $dexp[0]['house_id'], 'class="span2"'); ?>
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Expense Head</label>
            <div class="controls">
                <?php //$options_head = $head;//array(''=>'--Select--' ,1=>'Internet', 2=>'Cable', 3=>'IGL', 4=>'Electricity Bill', 5=>'Telephone', 6=>'Mobile', 7=>'Garbage' );                
                echo form_dropdown('head', $options_head, $dexp[0]['head'], 'class="span2" id="head"'); ?>
            </div>
          </div> 
          <div class="control-group">
            <label for="inputError" class="control-label">Expense Type</label>
            <div class="controls">
                <?php //$options_type = array(''=>'--Select--' ,1=>'Internet', 2=>'Cable', 3=>'IGL', 4=>'Electricity Bill', 5=>'Telephone', 6=>'Mobile', 7=>'Garbage' );                
                echo form_dropdown('type', $options_type, $dexp[0]['type'], 'class="span2" id="type"'); ?>
            </div>
          </div> 
            
          
          <div class="control-group">
            <label for="inputError" class="control-label">Payment Date</label>
            <div class="controls">
              <input type="text" id="payment_date" name="payment_date" value="<?php echo $dexp[0]['payment_date']; ?>">
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
           <div class="control-group">
            <label for="inputError" class="control-label">Paid Amount</label>
            <div class="controls">
              <input type="text" id="paid_amount" name="paid_amount" value="<?php echo $dexp[0]['paid_amount']; ?>">
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
            
          <div class="form-actions">
            <button class="btn btn-primary" type="submit">Save changes</button>
            <button class="btn" type="reset">Cancel</button>
          </div>
        </fieldset>
        <input type="hidden" id="type_val" value="<?php  echo $dexp[0]['type'];?>">
      <?php echo form_close(); ?>

    </div>

<script>
        	$( document ).ready(function() {
    
                    var selectexporamc=$( "select#head option:selected" ).closest('optgroup').attr('label');
                        
			$("select#type").val($("input#type_val").val());  // reset head
			$( "select#type" ).find('optgroup').each(function() {
				var lblhead= $(this).attr('label');
				if(lblhead==selectexporamc )
				$(this).css('display', 'block');
				else
				$(this).css('display', 'none');
			});

			$( "select#head" ).change(function() {
			var selectexporamc=$( "select#head option:selected" ).closest('optgroup').attr('label');
                       
			$("select#type").val('');  // reset head
			$( "select#type" ).find('optgroup').each(function() {
				var lblhead= $(this).attr('label');
				if(lblhead==selectexporamc )
				$(this).css('display', 'block');
				else
				$(this).css('display', 'none');
			});
			});
                        
    var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
     
    
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