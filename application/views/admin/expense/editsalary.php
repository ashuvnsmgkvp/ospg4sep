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
          <a href="#">Edit Salary</a>
        </li>
      </ul>
      
      <div class="page-header">
        <h2>
          Editing Salary
        </h2>
      </div>
 
      <?php
      //flash messages
      if(isset($flash_message)){
        if($flash_message == TRUE)
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> Salry updated with success.';
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
      $house_id = array('' => "--Select--");
      foreach ($houses as $row)
      {
        $house_id[$row['house_id']] = $row['house_no'];
      }

      //form validation
      echo validation_errors();
      //echo "<pre>";print_r($salery[0]);echo "</pre>";
      echo form_open('admin/expense/updatesalary/'.$salery[0]['salary_id'], $attributes);
      ?>
        <fieldset>
            <div class="control-group">
            <label for="inputError" class="control-label">House No.</label>
            <div class="controls">
               <?php //$house_id = array(''=>'--Select--' ,'1'=>"House 1",'2'=>"House 2");
                echo form_dropdown('house_id', $house_id, $salery[0]['house_id'], 'class="span2"'); ?>
  
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
          </div>
<!--          <div class="control-group">
            <label for="inputError" class="control-label">House Address</label>
            <div class="controls">
              <input type="text" id="" name="description" value="<?php echo $salery[0]['house_id']; ?>" >
              <span class="help-inline">Woohoo!</span>
            </div>
          </div>-->
          <div class="control-group">
            <label for="inputError" class="control-label">Employee Name</label>
            <div class="controls"><input type="text" id="employee_name" name="employee_name" value="<?php echo $salery[0]['employee_name'] ; ?>" >
              <!--<span class="help-inline">Cost Price</span>-->
            </div>
          </div> 
            
          <div class="control-group">
            <label for="inputError" class="control-label">Function</label>
           <?php $function = array(''=>'--Select--' ,'1'=>'Cook','2'=>'House keeping', '3'=>'Maid', '4'=>'Sweeper', '5'=>'Driver', '6'=>'Manager', '7'=>'Electrician', '8'=>'Accountant', '9'=>'IT', '10'=>'Security Guard');
                echo form_dropdown('function', $function, $salery[0]['function'], 'class="span2"'); ?>
  
            </div>
        
          <div class="control-group">
            <label for="inputError" class="control-label">            Salary Amount</label>
            <div class="controls"><input type="text" id="salary_amount" name="salary_amount" value="<?php echo $salery[0]['salary_amount']; ?>" >
              <!--<span class="help-inline">Cost Price</span>-->
            </div>
          </div>            


          <div class="control-group">
            <label for="inputError" class="control-label">From date </label>
            <div class="controls">
                <input type="text" id="from_date" name="from_date" value="<?php echo substr($salery[0]['from_date'],0,10); ?>" >    
              <!--<span class="help-inline">Cost Price</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">To Date</label>
            <div class="controls">
              <input type="text" id="to_date" name="to_date" value="<?php echo substr($salery[0]['to_date'],0,10); ?>">
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
           <div class="control-group">
            <label for="inputError" class="control-label">Advance Paid</label>
            <div class="controls">
              <input type="text" id="advance_paid" name="advance_paid" value="<?php echo $salery[0]['advance_paid']; ?>">
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
            <div class="control-group">
            <label for="inputError" class="control-label"> Date</label>
            <div class="controls">
              <input type="text" id="advance_date" name="advance_date" value="<?php echo substr($salery[0]['advance_date'],0,10); ?>">
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
            <div class="control-group">
            <label for="inputError" class="control-label">Salary Paid</label>
            <div class="controls">
                <input type="text" id="salary_paid" name="salary_paid" value="<?php echo $salery[0]['salary_paid']; ?>">
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
            <div class="control-group">
            <label for="inputError" class="control-label">Salary Date</label>
            <div class="controls">
              <input type="text" id="salary_date" name="salary_date" value="<?php echo substr($salery[0]['salary_date'],0,10); ?>">
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
            
                        <div class="control-group">
            <label for="inputError" class="control-label">Next Due Date</label>
            <div class="controls">
              <input type="text" id="next_due_date" name="next_due_date" value="<?php echo substr($salery[0]['next_due_date'],0,10); ?>">
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
            <div class="control-group">
            <label for="inputError" class="control-label">Next Due Amount</label>
            <div class="controls">
              <input type="text"id="next_due_amount"  name="next_due_amount" value="<?php echo $salery[0]['next_due_amount']; ?>">
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
     