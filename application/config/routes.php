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
|	$route['default_controller'] = "welcome";
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

//ADMINS route
$route['orders'] = "admins/orders";
$route['add_product'] = "admins/add_product";
$route['search'] = "admins/search";
$route['admin'] = "admins";
$route['admin_login'] = "admins/login";

//CUSTOMER
$route['showproduct/(:any)/(:any)'] = "customers/show_product/$1/$2";
$route['cart'] = "customers/cart";
$route['home'] = "customers/home";
$route['addtocart'] = "cart/addtocart";
$route['register'] = "customers/register_customer";
$route['login'] = "customers/login_customer";
$route['logoff'] = "customers/logoff_customer";
$route['myaccount'] = "customers/myaccount";
$route['to_login'] = "customers/login_customer";
$route['cancel_cart/(:any)'] = "cart/delete_cart_items/$1";
$route['checkout'] = "cart/checkout";
$route['review'] = "cart/review";
$route["edit_billing/(:any)"] = "cart/edit_billing_address/$1";
$route['handlePayment'] = "cart/handlePayment";
//switch
// $route['switchpage'] = "customers/switch_page";
// $route['search'] = "customers/search_category";
// $route['search_prod'] = "customers/search_prodname";

$route['default_controller'] = "customers";
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
