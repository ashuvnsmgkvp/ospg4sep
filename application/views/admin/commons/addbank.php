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
          <a href="#">New Bank Details</a>
        </li>
      </ul>
      
      <div class="page-header">
        <h2>
          Adding Bank Details
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
      
      echo form_open('admin/commons/addbank', $attributes);
      ?>
        <fieldset>
            <div class="control-group">
            <label for="inputError" class="control-label">House No.</label>
            <div class="controls">
               <?php 
                echo form_dropdown('house_id', $options_houses, set_value('house_id'), 'class="span2"'); ?>
            </div>
          </div>
            <div class="control-group">
            <label for="inputError" class="control-label">Type</label>
            <div class="controls">
              <?php $type = array(''=>'--Select--' ,'1'=>"Bank Account",'2'=>"Credit Card");
                echo form_dropdown('type', $type, set_value('type'), 'class="span2"'); ?>

              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Bank Name</label>
            <div class="controls">
              <input type="text" id="bank_name" name="bank_name" value="<?php echo set_value('description'); ?>" >
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Account Holder Name</label>
            <div class="controls">
              <input type="text" id="account_holder" name="account_holder" value="<?php echo set_value('description'); ?>" >
              <!--<span class="help-inline">Cost Price</span>-->
            </div>
          </div>          
          <div class="control-group">
            <label for="inputError" class="control-label">Account Number</label>
            <div class="controls">
              <input type="text" id="account_no" name="account_no" value="<?php echo set_value('cost_price'); ?>">
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
     