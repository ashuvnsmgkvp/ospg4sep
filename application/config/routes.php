<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/
$route['default_controller'] = 'user/index';
$route['404_override'] = '';

/*admin*/
$route['admin'] = 'user/index';
$route['admin/signup'] = 'user/signup';
$route['admin/create_member'] = 'user/create_member';
$route['admin/login'] = 'user/index';
$route['admin/logout'] = 'user/logout';
$route['admin/login/validate_credentials'] = 'user/validate_credentials';

//$route['admin/products'] = 'admin_products/index';
//$route['admin/products/add'] = 'admin_products/add';
//$route['admin/products/update'] = 'admin_products/update';
//$route['admin/products/update/(:any)'] = 'admin_products/update/$1';
//$route['admin/products/delete/(:any)'] = 'admin_products/delete/$1';
//$route['admin/products/(:any)'] = 'admin_products/index/$1'; //$1 = page number

$route['admin/houses'] = 'admin_houses/index';// Show house
$route['admin/houses/addhouse'] = 'admin_houses/addhouse';
$route['admin/houses/updatehouse'] = 'admin_houses/updatehouse';
$route['admin/houses/updatehouse/(:any)'] = 'admin_houses/updatehouse/$1';
$route['admin/houses/deletehouse/(:any)'] = 'admin_houses/deletehouse/$1';
//$route['admin/houses/(:any)'] = 'admin_houses/index/$1'; //$1 = page number

$route['admin/houses/addrent'] = 'admin_houses/addrent';
$route['admin/houses/showrent'] = 'admin_houses/showrent';
$route['admin/houses/updaterent'] = 'admin_houses/updaterent';
$route['admin/houses/updaterent/(:any)'] = 'admin_houses/updaterent/$1';
$route['admin/houses/deleterent/(:any)'] = 'admin_houses/deleterent/$1';


$route['admin/houses/addroom'] = 'admin_houses/addroom';
$route['admin/houses/showroom'] = 'admin_houses/showroom';
$route['admin/houses/updateroom'] = 'admin_houses/updateroom';
$route['admin/houses/updateroom/(:any)'] = 'admin_houses/updateroom/$1';
$route['admin/houses/deleteroom/(:any)'] = 'admin_houses/deleteroom/$1';
//
//showroom
//
//$route['admin/guests'] = 'admin_guests/index';
$route['admin/guests/addguest'] = 'admin_guests/addguest';
$route['admin/guests/showguest'] = 'admin_guests/showguest';
$route['admin/guests/getsharetypebyhouseid'] = 'admin_guests/getsharetypebyhouseid';
$route['admin/guests/getroomnobyhouseidandsharetype'] = 'admin_guests/getroomnobyhouseidandsharetype';
$route['admin/guests/updateguest/(:any)'] = 'admin_guests/updateguest/$1';
$route['admin/guests/deleteguest/(:any)'] = 'admin_guests/deleteguest/$1';

$route['admin/guests/addguestrent'] = 'admin_guests/addguestrent';

$route['admin/guests/update'] = 'admin_guests/update';
$route['admin/guests/update/(:any)'] = 'admin_guests/update/$1';
$route['admin/guests/delete/(:any)'] = 'admin_guests/delete/$1';
$route['admin/guests/(:any)'] = 'admin_guests/index/$1'; //$1 = page number

//$route['admin/commons/showbank'] = 'admin_commons/index';
$route['admin/commons/addbank'] = 'admin_commons/addbank';
$route['admin/commons/showbank'] = 'admin_commons/showbank';
$route['admin/commons/updatebank'] = 'admin_commons/updatebank';
$route['admin/commons/updatebank/(:any)'] = 'admin_commons/updatebank/$1';
$route['admin/commons/deletebank/(:any)'] = 'admin_commons/deletebank/$1';
$route['admin/commons/getbankdetailbyhouseid'] = 'admin_commons/getbankdetailbyhouseid';


//$route['admin/commons/delete/(:any)'] = 'admin_commons/delete/$1';

$route['admin/expense'] = 'admin_expense/index';
$route['admin/expense/addsalary'] = 'admin_expense/addsalary';
$route['admin/expense/addsocietyexp'] = 'admin_expense/addsocietyexp';
$route['admin/expense/addwaterexp'] = 'admin_expense/addwaterexp';
$route['admin/expense/addroexp'] = 'admin_expense/addroexp';
$route['admin/expense/addrefrigratorexp'] = 'admin_expense/addrefrigratorexp';
$route['admin/expense/addwashingmachineexp'] = 'admin_expense/addwashingmachineexp';
$route['admin/expense/addwatercoolerexp'] = 'admin_expense/addwatercoolerexp';
$route['admin/expense/addacexp'] = 'admin_expense/addacexp';
$route['admin/expense/addwatersoftnerexp'] = 'admin_expense/addwatersoftnerexp';
$route['admin/expense/addchimneyexp'] = 'admin_expense/addchimneyexp';
$route['admin/expense/addinvertorexp'] = 'admin_expense/addinvertorexp';
$route['admin/expense/addbattoryexp'] = 'admin_expense/addbattoryexp';
$route['admin/expense/addgyserexp'] = 'admin_expense/addgyserexp';
$route['admin/expense/addvehicleinsuranceexp'] = 'admin_expense/addvehicleinsuranceexp';
$route['admin/expense/addcctvexp'] = 'admin_expense/addcctvexp';

$route['admin/expense/addmonthlyexp'] = 'admin_expense/addmonthlyexp';
$route['admin/expense/showmonthlyexp'] = 'admin_expense/showmonthlyexp';
$route['admin/expense/updatemonthlyexp'] = 'admin_expense/updatemonthlyexp';
$route['admin/expense/updatemonthlyexp/(:any)'] = 'admin_expense/updatemonthlyexp/$1';
$route['admin/expense/deletemonthlyexp/(:any)'] = 'admin_expense/deletemonthlyexp/$1';

$route['admin/expense/adddailyexp'] = 'admin_expense/adddailyexp';
$route['admin/expense/showdailyexp'] = 'admin_expense/showdailyexp';
$route['admin/expense/updatedailyexp'] = 'admin_expense/updatedailyexp';
$route['admin/expense/updatedailyexp/(:any)'] = 'admin_expense/updatedailyexp/$1';
$route['admin/expense/deletedailyexp/(:any)'] = 'admin_expense/deletedailyexp/$1';

$route['admin/expense/addinventory'] = 'admin_expense/addinventory';
$route['admin/expense/showinventory'] = 'admin_expense/showinventory';
$route['admin/expense/updateinventory'] = 'admin_expense/updateinventory';
$route['admin/expense/updateinventory/(:any)'] = 'admin_expense/updateinventory/$1';
$route['admin/expense/deleteinventory/(:any)'] = 'admin_expense/deleteinventory/$1';

$route['admin/expense/addannualexp'] = 'admin_expense/addannualexp';
$route['admin/expense/showannualexp'] = 'admin_expense/showannualexp';
$route['admin/expense/updateannualexp'] = 'admin_expense/updateannualexp';
$route['admin/expense/updateannualexp/(:any)'] = 'admin_expense/updateannualexp/$1';
$route['admin/expense/deleteannualexp/(:any)'] = 'admin_expense/deleteannualexp/$1';


$route['admin/expense/addsalary'] = 'admin_expense/addsalary';
$route['admin/expense/showsalary'] = 'admin_expense/showsalary';
$route['admin/expense/updatesalary'] = 'admin_expense/updatesalary';
$route['admin/expense/updatesalary/(:any)'] = 'admin_expense/updatesalary/$1';
$route['admin/expense/deletesalary/(:any)'] = 'admin_expense/deletesalary/$1';

$route['admin/expense/addmaintenanceexp'] = 'admin_expense/addmaintenanceexp';
$route['admin/expense/addpurchaseyexp'] = 'admin_expense/addpurchaseyexp';
$route['admin/expense/addcharityexp'] = 'admin_expense/addcharityexp';
$route['admin/expense/addfoodexp'] = 'admin_expense/addfoodexp';
$route['admin/expense/addvehicleexp'] = 'admin_expense/addvehicleexp';







$route['admin/manufacturers'] = 'admin_manufacturers/index';
$route['admin/manufacturers/add'] = 'admin_manufacturers/add';
$route['admin/manufacturers/update'] = 'admin_manufacturers/update';
$route['admin/manufacturers/update/(:any)'] = 'admin_manufacturers/update/$1';
$route['admin/manufacturers/delete/(:any)'] = 'admin_manufacturers/delete/$1';
$route['admin/manufacturers/(:any)'] = 'admin_manufacturers/index/$1'; //$1 = page number



/* End of file routes.php */
/* Location: ./application/config/routes.php */