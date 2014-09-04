<!DOCTYPE html> 
<html lang="en-US">
    <head>
        <title>OSPG</title>
        <meta charset="utf-8">
        	<script src="<?php echo base_url(); ?>assets/js/jquery-1.7.1.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/admin.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
        <link href="<?php echo base_url(); ?>assets/css/admin/global.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>assets/css/admin/datepicker.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="brand"></a>
                    <ul class="nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Houses <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li <?php if ($this->uri->segment(2) == 'houses') { echo 'class="active"';} ?>>
                                    <a href="<?php echo base_url(); ?>admin/houses">Manage Houses</a>
                                </li>
                                <li <?php if ($this->uri->segment(2) == 'houses') {echo 'class="active"';} ?>>
                                    <a href="<?php echo base_url(); ?>admin/houses/showrent">Manage House Rent</a>
                                </li>
                                <li <?php if ($this->uri->segment(2) == 'houses') { echo 'class="active"';} ?>>
                                    <a href="<?php echo base_url(); ?>admin/houses/showroom">Manage Room</a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Guest <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li <?php if ($this->uri->segment(2) == 'guests') {echo 'class="active"';} ?>>
                                    <a href="<?php echo base_url(); ?>admin/guests/showguest">Manage Guest Details</a>
                                </li>
                                <li <?php if ($this->uri->segment(2) == 'guests') {echo 'class="active"';} ?>>
                                    <a href="<?php echo base_url(); ?>admin/guests/addguestrent">Manage Guest Rent</a>
                                </li></ul>
                        </li>
                        <li <?php if ($this->uri->segment(2) == 'banks') { echo 'class="active"';} ?>>
                            <a href="<?php echo base_url(); ?>admin/commons/showbank">Bank Details</a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Report <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li <?php if ($this->uri->segment(2) == 'report') { echo 'class="active"';} ?>>
                                    <a href="<?php echo base_url(); ?>admin/report/rentreport">Rent Report</a>
                                </li>

                                <li <?php if ($this->uri->segment(2) == 'report') { echo 'class="active"';} ?>>
                                    <a href="<?php echo base_url(); ?>admin/report/vacantseats">Vacant Seats Report</a>
                                </li></ul>
                        </li>
                        <li <?php if ($this->uri->segment(2) == 'expense') { echo 'class="active"';} ?>>
                            <a href="<?php echo base_url(); ?>admin/expense/showsalary">Salary</a>
                        </li>
                        <li <?php if ($this->uri->segment(2) == 'expense') {    echo 'class="active"';} ?>>
                            <a href="<?php echo base_url(); ?>admin/expense/showinventory">Inventory</a>
                        </li>

                         <li <?php if ($this->uri->segment(2) == 'expense') {    echo 'class="active"';} ?>>
                            <a href="<?php echo base_url(); ?>admin/expense/showannualexp">Annual Expenses</a>
                        </li>
                        <li <?php if ($this->uri->segment(2) == 'expense') {    echo 'class="active"';} ?>>
                            <a href="<?php echo base_url(); ?>admin/expense/showmonthlyexp">Monthly Expenses</a>
                        </li>
                        
                        <li <?php if ($this->uri->segment(2) == 'expense') {    echo 'class="active"';} ?>>
                            <a href="<?php echo base_url(); ?>admin/expense/showdailyexp">Daily Expenses</a>
                        </li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">System <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="<?php echo base_url(); ?>admin/logout">Logout</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>	
