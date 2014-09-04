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
          Adding Room
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
        $option_house_no = array(''=>'--Select--');
      foreach ($houses as $row)
      {
        $option_house_no[$row['house_id']] = $row['house_no'].' - '.$row['house_address'];
      }

      //form validation
      echo validation_errors();
      
      echo form_open('admin/houses/addroom', $attributes);
      ?>
        <fieldset>
            <div class="control-group">
            <label for="inputError" class="control-label">House No.</label>
            <div class="controls">
              <?php $house_id = array(''=>'--Select--' ,'1'=>"House 1",'2'=>"House 2");
                echo form_dropdown('house_id', $option_house_no, set_value('house_id'), 'class="span2"'); ?>
     
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
            <label for="inputError" class="control-label">Room No.</label>
            <div class="controls">
              <input type="text" id="room_no" name="room_no" value="<?php echo set_value('stock'); ?>">
              <!--<span class="help-inline">Cost Price</span>-->
            </div>
          </div>          
          <div class="control-group">
            <label for="inputError" class="control-label">Floor</label>
            <div class="controls">
                <?php $floor = array(''=>'--Select--' ,'1'=>"Basement",'2'=>"Gnd",'3'=>'1st','4'=>'2nd','5'=>'3rd','6'=>'4th');
                echo form_dropdown('floor', $floor, set_value('floor'), 'class="span2"'); ?>
              
              <!--<span class="help-inline">Cost Price</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Sharing Type</label>
            <div class="controls">
              <?php $share_type = array(''=>'--Select--' ,'1'=>"Single",'2'=>"Double",'3'=>'Triple','4'=>'Four','5'=>'Five','6'=>'Six');
                echo form_dropdown('share_type', $share_type, set_value('share_type'), 'class="span2"'); ?>
       
            </div>
          </div>
           

          <div class="form-actions">
            <button class="btn btn-primary" type="submit">Save changes</button>
            <button class="btn" type="reset">Cancel</button>
          </div>
        </fieldset>

      <?php echo form_close(); ?>

    </div>
     