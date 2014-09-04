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
          <a href="#">Add Maintenance / Daily Expense</a>
        </li>
      </ul>
      
      <div class="page-header">
        <h2>
          Adding Maintenance / Daily Expense

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
               <?php $options_manufacture = array(''=>'--Select--' ,'1'=>"House 1",'2'=>"House 2");
                echo form_dropdown('manufacture_id', $options_manufacture, set_value('manufacture_id'), 'class="span2"'); ?>
  
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
            <label for="inputError" class="control-label">Expense Head</label>
            <div class="controls">
                <?php $options_manufacture = array(''=>'--Select--' ,1=>'Gas Cylinder', 
2=>'Mali',
3=>'Invertor',
4=>'Laundry',
5=>'Electricity',
6=>'Plumber',
7=>'Milk',
8=>'Mishtri',
9=>'Carpenter',
10=>'Boring Pump',
11=>'Painter',
12=>'Kitchen Material',
13=>'Rashan',
14=>'CCTV',
15=>'Invertor',
16=>'Chimney',
17=>'Stabilizer',
18=>'FAN',
19=>'Telephone Repair',
20=>'Reddy/Thela', 
21=>'Autorikshaw' );
                echo form_dropdown('manufacture_id', $options_manufacture, set_value('manufacture_id'), 'class="span2"'); ?>
  
              <!--<span class="help-inline">Cost Price</span>-->
            </div>
          </div> 
            
          
        
          <div class="control-group">
            <label for="inputError" class="control-label">Expense Type  </label>
            <div class="controls">
                <?php $options_manufacture = array(''=>'--Select--' ,'1'=>"Service Charges",'2'=>"Material Purchase");
                echo form_dropdown('manufacture_id', $options_manufacture, set_value('manufacture_id'), 'class="span2"'); ?>
  
              <!--<span class="help-inline">Cost Price</span>-->
            </div>
          </div>            


          <div class="control-group">
            <label for="inputError" class="control-label">Amount Paid </label>
            <div class="controls">
                <input type="text" id="" name="description" value="<?php echo set_value('description'); ?>" >    
              <!--<span class="help-inline">Cost Price</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Date</label>
            <div class="controls">
              <input type="text" name="sell_price" value="<?php echo set_value('sell_price'); ?>">
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
           <div class="control-group">
            <label for="inputError" class="control-label">Amount Balance</label>
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
     