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
          <a  href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>/addroom" class="btn btn-success">Add a new</a>
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

            echo form_open('admin/houses/showroom', $attributes);
     
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
                <th class="green header">Room No.</th>
                <th class="red header">Floor</th>
                <th class="red header">Sharing Type</th>              
                <th class="red header">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $arr_floor = array(''=>'--Select--' ,'1'=>"Basement",'2'=>"Gnd",'3'=>'1st','4'=>'2nd','5'=>'3rd','6'=>'4th');
              $share_type = array(''=>'--Select--' ,'1'=>"Single",'2'=>"Double",'3'=>'Triple','4'=>'Four','5'=>'Five','6'=>'Six');
              foreach($rooms as $row)
              {
                echo '<tr>';
                echo '<td>#</td>';
                echo '<td>'.$row['house_no'].'</td>';
                echo '<td>'.$row['room_no'].'</td>';
                echo '<td>'.$arr_floor[$row['floor']].'</td>';
                echo '<td>'.$share_type[$row['share_type']].'</td>';
                
                echo '<td class="crud-actions">
                  <a href="'.site_url("admin").'/houses/updateroom/'.$row['room_id'].'" class="btn btn-info">view & edit</a>  
                  <a href="'.site_url("admin").'/houses/deleteroom/'.$row['room_id'].'" class="btn btn-danger">delete</a>
                </td>';
                echo '</tr>';
              }
              ?>      
            </tbody>
          </table>

          <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>

      </div>
    </div>