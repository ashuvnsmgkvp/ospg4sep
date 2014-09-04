    <div class="container top">

      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("admin"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a> 
          <span class="divider">/</span>
        </li>
        <li class="active">
          Show Bank
        </li>
      </ul>

      <div class="page-header users-header">
        <h2>
            Show Monthly Expenses 
          <a  href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>/addmonthlyexp" class="btn btn-success">Add a new</a>
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
              echo form_input('search_string', $search_string_selected, 'style="width: 170px;
height: 26px;"');

              

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
                <th class="green header">Type</th>
                <th class="green header">Payment Date</th>
                
                <th class="green header">Paid Amount</th>
                <th class="green header">Action</th>
                
              </tr>
            </thead>
            <tbody>
              <?php
              $type = array(1=>'Internet', 2=>'Cable', 3=>'IGL', 4=>'Electricity Bill', 5=>'Telephone', 6=>'Mobile', 7=>'Garbage');
              foreach($mexp as $row)
              {
                echo '<tr>';
                echo '<td>'.$row['mexp_id'].'</td>';
                echo '<td>'.$row['house_no'].'</td>';
                echo '<td>'.$type[$row['type']].'</td>';
                echo '<td>'.$row['payment_date'].'</td>';
                echo '<td>'.$row['paid_amount'].'</td>';
             
                echo '<td class="crud-actions">
                  <a href="'.site_url("admin").'/expense/updatemonthlyexp/'.$row['mexp_id'].'" class="btn btn-info">view & edit</a>  
                  <a href="'.site_url("admin").'/expense/deletemonthlyexp/'.$row['mexp_id'].'" class="btn btn-danger">delete</a>
                </td>';
                echo '</tr>';
              }
              ?>      
            </tbody>
          </table>

          <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>

      </div>
    </div>