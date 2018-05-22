<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'login';
$route['404_override'] = 'login/show_404';
$route['translate_uri_dashes'] = FALSE;

$route['forgot_password'] = 'login/forgot_pwd';
$route['reset_password'] = 'login/reset_pwd';
$route['profile'] = 'login/user_profile';
$route['logout'] = 'login/logout';
$route['dashboard'] = 'dashboard';

// Tranaponder
$route['product/transponder'] = 'product/display_transponder';
$route['product/transponder/add'] = 'product/add_transponder';
$route['product/transponder/edit/(:any)'] = 'product/edit_transponder/$1';
$route['product/transponder/delete/(:any)'] = 'product/delete_transponder/$1';
$route['product/transponder/bulk_edit'] = 'product/bulk_edit_transponder';

// Administrator
$route['product/make'] = 'product/manage_make';
$route['product/make/delete/(:any)'] = 'product/delete_make/$1';
$route['product/model'] = 'product/manage_model';
$route['product/model/delete/(:any)'] = 'product/delete_model/$1';
$route['product/year'] = 'product/manage_year';
$route['product/year/delete/(:any)'] = 'product/delete_year/$1';

// Staff Members
$route['staff'] = 'staff/display_staff';
$route['staff/add'] = 'staff/add_staff';
$route['staff/edit/(:any)'] = 'staff/edit_staff/$1';
$route['staff/delete/(:any)'] = 'staff/delete_staff/$1';

// Inventory
$route['inventory/items'] = 'inventory/display_items';
$route['inventory/items/add'] = 'inventory/add_items';
$route['inventory/items/edit/(:any)'] = 'inventory/edit_items/$1';
$route['inventory/items/delete/(:any)'] = 'inventory/delete_items/$1';

$route['inventory/departments'] = 'inventory/display_departments';
$route['inventory/departments/add'] = 'inventory/add_departments';
$route['inventory/departments/edit/(:any)'] = 'inventory/edit_departments/$1';
$route['inventory/departments/delete/(:any)'] = 'inventory/delete_departments/$1';

$route['inventory/vendors'] = 'inventory/display_vendors';
$route['inventory/vendors/add'] = 'inventory/add_vendors';
$route['inventory/vendors/edit/(:any)'] = 'inventory/edit_vendors/$1';
$route['inventory/vendors/delete/(:any)'] = 'inventory/delete_vendors/$1';

$route['reports/transponder'] = 'reports/get_transponder_report';