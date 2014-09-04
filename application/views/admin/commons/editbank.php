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
          <a href="#">Update Bank Details</a>
        </li>
      </ul>
      
      <div class="page-header">
        <h2>
          Updating Bank Details
        </h2>
      </div>
 
      <?php
      //flash messages
      if(isset($flash_message)){
        if($flash_message == 'updated')
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
      
      echo form_open('admin/commons/updatebank/'.$bank[0]['bank_id'], $attributes);
      //print_r($bank);
      ?>
        <fieldset>
            <div class="control-group">
            <label for="inputError" class="control-label">House No.</label>
            <div class="controls">
               <?php 
                echo form_dropdown('house_id', $options_houses,  $bank[0]['house_id'], 'class="span2" id="house_id"'); ?>
            </div>
          </div>
            <div class="control-group">
            <label for="inputError" class="control-label">Type</label>
            <div class="controls">
              <?php $type = array(''=>'--Select--' ,'1'=>"Bank Account",'2'=>"Credit Card");
                echo form_dropdown('type', $type, $bank[0]['type'], 'class="span2"'); ?>

              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Bank Name</label>
            <div class="controls">
              <input type="text" id="bank_name" name="bank_name" value="<?php echo $bank[0]['bank_name']; ?>" >
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Account Holder Name</label>
            <div class="controls">
              <input type="text" id="account_holder" name="account_holder" value="<?php echo $bank[0]['account_holder']; ?>" >
              <!--<span class="help-inline">Cost Price</span>-->
            </div>
          </div>          
          <div class="control-group">
            <label for="inputError" class="control-label">Account Number</label>
            <div class="controls">
              <input type="text" id="account_no" name="account_no" value="<?php echo $bank[0]['account_no']; ?>" readonly="readonly">
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
        	$( document ).ready(function() {
                    
                    
                    $("#house_id").click(function(){ alert('You could not change house number.');
                        $("#house_id").defaultSelected;
                           return false;
                       });
                });
                                </script>