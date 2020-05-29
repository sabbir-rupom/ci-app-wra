<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
*/
$route['default_controller'] = 'Home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/**
 * Website Frontend Routes
 */
$route['home'] = 'Home/index';
$route['api/console'] = 'Console/index';
$route['project/documentation'] = 'Documentation/index';

/**
 * Admin Routes
 */
$route['login'] = 'Auth/login';
$route['logout'] = 'Auth/logout';

$route['admin/dashoard'] = 'admin/Dashboard/index';
$route['admin/settings'] = 'admin/Settings/index';
$route['admin/password/change']['POST'] = 'admin/Settings/changePassword';

$route['admin/user'] = 'admin/User/index';
$route['admin/user/list'] = 'admin/User/show';
$route['admin/user/(:any)'] = 'admin/User/$1';
$route['admin/item'] = 'admin/Item/index';
$route['admin/item/list'] = 'admin/Item/show';
$route['admin/item/(:any)'] = 'admin/Item/$1';

/**
 * REST API Routes
 */

$route['api/user/sign-up'] = 'rest/UserSignUp';
