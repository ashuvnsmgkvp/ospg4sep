    <div class="container top">

      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("admin"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a> 
          <span class="divider">/</span>
        </li>
        <li class="active">
          <?php echo ucfirst($this->uri->segment(2));?>
        </li>
      </ul>

      <div class="page-header users-header">
        <h2>
          <?php echo ucfirst($this->uri->segment(2));?> 
          <a  href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>/addguest" class="btn btn-success">Add a new</a>
        </h2>
      </div>
      
      <div class="row">
        <div class="span12 columns">
          <div class="well">
           
            <?php
           
              $attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');
           
            $options_manufacture = array(0 => "all");
//            foreach ($manufactures as $row)
//            {
//              $options_manufacture[$row['id']] = $row['name'];
//            }
            //save the columns names in a array that we will use as filter         
            $options_products = array();    
//            foreach ($products as $array) {
//              foreach ($array as $key => $value) {
//                $options_products[$key] = $key;
//              }
//              break;
//            }

            echo form_open('admin/expense', $attributes);
     
              echo form_label('Search:', 'search_string');
              echo form_input('search_string', $search_string_selected, 'style="width: 170px;height: 26px;"');

              

              $data_submit = array('name' => 'mysubmit', 'class' => 'btn btn-primary', 'value' => 'Go');

              
              echo form_submit($data_submit);

            echo form_close();
            ?>

          </div>

          <table class="table table-striped table-bordered table-condensed">
            <thead>
              <tr>
                <th class="header">#</th>
                <th class="yellow header headerSortDown">House No.</th>
                <th class="green header">Room No.</th>
                
                <th class="green header">Sharing Type</th>
                <th class="red header">Guest Name</th>
                <th class="red header">Mobile</th>
                <th class="red header">Email</th>
                <th class="red header">Monthly Rent</th>
                <th class="red header">Joining Date</th>
                <th class="red header">Company/College</th>
                <th class="red header">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $share_type = array(''=>'--Select--' ,'1'=>"Single",'2'=>"Double",'3'=>'Triple','4'=>'Four','5'=>'Five','6'=>'Six');
              foreach($guests as $row)
              {
                echo '<tr>';
                echo '<td>'.$row['guest_id'].'</td>';
                echo '<td>'.$row['house_no'].'</td>';
                echo '<td>'.$row['room_no'].'</td>';
                echo '<td>'.$share_type[$row['share_type']].'</td>';
                echo '<td>'.$row['guest_name'].'</td>';
                echo '<td>'.$row['mobile'].'</td>';
                echo '<td>'.$row['email'].'</td>';
                echo '<td>'.$row['monthly_rent'].'</td>';
                echo '<td>'.$row['joining_date'].'</td>';
                echo '<td>'.$row['comp_college'].'</td>';
                echo '<td class="crud-actions">
                  <a href="'.site_url("admin").'/guests/updateguest/'.$row['guest_id'].'" class="btn btn-info">view & edit</a>  
                  <a href="'.site_url("admin").'/guests/deleteguest/'.$row['guest_id'].'" class="btn btn-danger">delete</a>
                </td>';
                echo '</tr>';
              }
              ?>      
            </tbody>
          </table>

          <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>

      </div>
    </div>