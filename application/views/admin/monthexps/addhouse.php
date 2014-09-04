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
          <a href="#">New</a>
        </li>
      </ul>
      
      <div class="page-header">
        <h2>
          Adding <?php echo ucfirst($this->uri->segment(2));?>
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
      $options_manufacture = array('' => "Select");
//      foreach ($manufactures as $row)
//      {
//        $options_manufacture[$row['id']] = $row['name'];
//      }

      //form validation
      echo validation_errors();
      
      echo form_open('admin/products/add', $attributes);
      ?>
        <fieldset>
            <div class="control-group">
            <label for="inputError" class="control-label">House No.</label>
            <div class="controls">
              <input type="text" id="" name="description" value="<?php echo set_value('description'); ?>" >
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">House Address</label>
            <div class="controls">
              <input type="text" id="" name="description" value="<?php echo set_value('description'); ?>" >
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">No of Rooms</label>
            <div class="controls">
              <input type="text" id="" name="stock" value="<?php echo set_value('stock'); ?>">
              <!--<span class="help-inline">Cost Price</span>-->
            </div>
          </div>          
          <div class="control-group">
            <label for="inputError" class="control-label">Accommodation Type</label>
            <div class="controls">
                <?php $options_manufacture = array(''=>'--Select--' ,'boys'=>"Boys",'girls'=>"Girls");
                echo form_dropdown('manufacture_id', $options_manufacture, set_value('manufacture_id'), 'class="span2"'); ?>
              
              <!--<span class="help-inline">Cost Price</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Owner Name</label>
            <div class="controls">
              <input type="text" name="sell_price" value="<?php echo set_value('sell_price'); ?>">
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
           <div class="control-group">
            <label for="inputError" class="control-label">Address</label>
            <div class="controls">
              <input type="text" name="sell_price" value="<?php echo set_value('sell_price'); ?>">
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
            <div class="control-group">
            <label for="inputError" class="control-label">Email ID</label>
            <div class="controls">
              <input type="text" name="sell_price" value="<?php echo set_value('sell_price'); ?>">
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
            <div class="control-group">
            <label for="inputError" class="control-label">PAN Card</label>
            <div class="controls">
              <input type="text" name="sell_price" value="<?php echo set_value('sell_price'); ?>">
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
            <div class="control-group">
            <label for="inputError" class="control-label">Mobile</label>
            <div class="controls">
              <input type="text" name="sell_price" value="<?php echo set_value('sell_price'); ?>">
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
            <div class="control-group">
            <label for="inputError" class="control-label">Mobile2</label>
            <div class="controls">
              <input type="text" name="sell_price" value="<?php echo set_value('sell_price'); ?>">
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
            <div class="control-group">
            <label for="inputError" class="control-label">Landline</label>
            <div class="controls">
              <input type="text" name="sell_price" value="<?php echo set_value('sell_price'); ?>">
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
            <div class="control-group">
            <label for="inputError" class="control-label">Landline2</label>
            <div class="controls">
              <input type="text" name="sell_price" value="<?php echo set_value('sell_price'); ?>">
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
            <div class="control-group">
            <label for="inputError" class="control-label">Property Acquisition Date</label>
            <div class="controls">
              <input type="text" name="sell_price" value="<?php echo set_value('sell_price'); ?>">
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
            <div class="control-group">
            <label for="inputError" class="control-label">Rent Agreemet Period From</label>
            <div class="controls">
              <input type="text" name="sell_price" value="<?php echo set_value('sell_price'); ?>">
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
            <div class="control-group">
            <label for="inputError" class="control-label">Rent Agreemet Period To</label>
            <div class="controls">
              <input type="text" name="sell_price" value="<?php echo set_value('sell_price'); ?>">
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
            <div class="control-group">
            <label for="inputError" class="control-label">Rent Amount</label>
            <div class="controls">
              <input type="text" name="sell_price" value="<?php echo set_value('sell_price'); ?>">
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
            <div class="control-group">
            <label for="inputError" class="control-label">Next Rent Agreement Date</label>
            <div class="controls">
              <input type="text" name="sell_price" value="<?php echo set_value('sell_price'); ?>">
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
            <div class="control-group">
            <label for="inputError" class="control-label">Document Scan</label>
            <div class="controls">
              <input type="text" name="sell_price" value="<?php echo set_value('sell_price'); ?>">
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
     