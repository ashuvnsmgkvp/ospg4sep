    <div class="container top">

      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("admin"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a> 
          <span class="divider">/</span>
        </li>
        <li class="active">
          Rent <?php //echo ucfirst($this->uri->segment(2));?>
        </li>
      </ul>

      <div class="page-header users-header">
        <h2>
          <?php echo ucfirst($this->uri->segment(2));?> 
          <a  href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>/addrent" class="btn btn-success">Add a new</a>
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

            echo form_open('admin/houses/showrent', $attributes);
     
              echo form_label('Search:', 'search_string');
              echo form_input('search_string', $search_string_selected, 'style="width: 170px;
height: 26px;"');

//              echo form_label('Filter by House:', 'manufacture_id');
//              echo form_dropdown('manufacture_id', $options_manufacture, $manufacture_selected, 'class="span2"');

//              echo form_label('Order by:', 'order');
//              echo form_dropdown('order', $options_products, $order, 'class="span2"');

              $data_submit = array('name' => 'mysubmit', 'class' => 'btn btn-primary', 'value' => 'Go');

//              $options_order_type = array('Asc' => 'Asc', 'Desc' => 'Desc');
//              echo form_dropdown('order_type', $options_order_type, $order_type_selected, 'class="span1"');

              echo form_submit($data_submit);

            echo form_close();
            ?>

          </div>

          <table class="table table-striped table-bordered table-condensed">
            <thead>
              <tr>
                <th class="header">#</th>
                <th class="yellow header headerSortDown">House No.</th>
                <th class="yellow header headerSortDown">Payment Mode</th>
                <th class="green header">Amount</th>
                <th class="red header">Rent Date</th>
                <th class="red header">Details</th>
<!--                <th class="red header">Cheque No</th>
                <th class="red header">Bank Name</th>
                <th class="red header">Account Holder Name</th>-->
                
                <th class="red header">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              //print_r($rents);
              foreach($rents as $row)
              {
                  if($row['pay_mode']=='cheque'){$detaiks= "Cheque No.-".$row['cheque_no']."<br>Account Holder-".$row['account_holder']."<br>Bank-".$row['bank_name']; }
                  else{$detaiks= "";}
                echo '<tr>';
                echo '<td>'.$row['house_id'].'</td>';
                echo '<td>'.$row['house_no'].'</td>';
                 echo '<td>'.$row['pay_mode'].'</td>';
                echo '<td>'.$row['amount'].'</td>';
                echo '<td>'.$row['rent_date'].'</td>';
                 echo '<td>'.$detaiks.'</td>';
//                echo '<td>'.$row['cheque_no'].'</td>';
//                echo '<td>'.$row['bank_name'].'</td>';
//                echo '<td>'.$row['account_holder'].'</td>';
                
                echo '<td class="crud-actions">
                  <a href="'.site_url("admin").'/houses/updaterent/'.$row['houserent_id'].'" class="btn btn-info">view & edit</a>  
                  <a href="'.site_url("admin").'/houses/deleterent/'.$row['houserent_id'].'" class="btn btn-danger">delete</a>
                </td>';
                echo '</tr>';
              }
              ?>      
            </tbody>
          </table>

          <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>

      </div>
    </div>