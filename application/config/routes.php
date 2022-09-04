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
$route['default_controller'] = 'Login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//pegawai
$route['administrator'] 				= 'Login';
$route['login'] 				= 'Login/proses';
$route['logout'] 				= 'Login/logout';
$route['dashboard']				= 'Dashboard';

//admin
$route['user'] 				    = 'User';
$route['add-user'] 	        = 'User/add';
$route['edit-user/(:any)'] 	    = 'User/edit/$1';
$route['delete-user/(:any)']    	= 'User/delete/$1';

$route['access-right'] 				    = 'User';
$route['add-access-right'] 	        = 'User/add_access';
$route['edit-access-right/(:any)'] 	    = 'User/edit_access/$1';
$route['delete-access-right/(:any)']    	= 'User/delete_access/$1';

$route['user-group'] 				    = 'User';
$route['add-user-group'] 	        = 'User/add_user_group';
$route['edit-user-group/(:any)'] 	    = 'User/edit_user_group/$1';
$route['delete-user-group/(:any)']    	= 'User/delete_user_group/$1';

$route['client'] 				    = 'Client';
$route['add-client'] 	        = 'Client/add';
$route['edit-client/(:any)'] 	    = 'Client/edit/$1';
$route['delete-client/(:any)']    	= 'Client/delete/$1';

$route['project-group'] 				    = 'ProjectGroup';
$route['add-project-group'] 	        = 'ProjectGroup/add';
$route['edit-project-group/(:any)'] 	    = 'ProjectGroup/edit/$1';
$route['delete-project-group/(:any)']    	= 'ProjectGroup/delete/$1';

$route['project'] 				    = 'Project';
$route['add-project'] 	        = 'Project/add';
$route['edit-project/(:any)'] 	    = 'Project/edit/$1';
$route['delete-project/(:any)']    	= 'Project/delete/$1';