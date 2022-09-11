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

$route['quotation-header'] 				    = 'QuotationHeader';
$route['add-quotation-header'] 	        = 'QuotationHeader/add';
$route['edit-quotation-header/(:any)'] 	    = 'QuotationHeader/edit/$1';
$route['delete-quotation-header/(:any)']    	= 'QuotationHeader/delete/$1';

$route['project-group'] 				    = 'ProjectGroup';
$route['add-project-group'] 	        = 'ProjectGroup/add';
$route['edit-project-group/(:any)'] 	    = 'ProjectGroup/edit/$1';
$route['delete-project-group/(:any)']    	= 'ProjectGroup/delete/$1';

$route['project'] 				    = 'Project';
$route['add-project'] 	        = 'Project/add';
$route['edit-project/(:any)'] 	    = 'Project/edit/$1';
$route['delete-project/(:any)']    	= 'Project/delete/$1';

$route['detail-project/(:any)'] 				    = 'Project/detail/$1';
$route['add-project-quotation/(:any)'] 	        = 'Project/add_project_quotation/$1';
$route['edit-project-quotation/(:any)'] 	    = 'Project/edit_project_quotation/$1';
$route['delete-project-quotation/(:any)']    	= 'Project/delete_project_quotation/$1';

$route['add-budget/(:any)'] 	        = 'Project/add_budget/$1';
$route['edit-budget/(:any)'] 	    = 'Project/edit_budget/$1';
$route['delete-budget/(:any)']    	= 'Project/delete_budget/$1';

$route['add-proposed-cost/(:any)'] 	        = 'Project/add_proposed_cost/$1';
$route['edit-proposed-cost/(:any)'] 	    = 'Project/edit_proposed_cost/$1';
$route['delete-proposed-cost/(:any)']    	= 'Project/delete_proposed_cost/$1';

$route['add-proposed-budget/(:any)'] 	        = 'Project/add_proposed_budget/$1';
$route['edit-proposed-budget/(:any)'] 	    = 'Project/edit_proposed_budget/$1';
$route['approve-proposed-budget/(:any)'] 	    = 'Project/approve_proposed_budget/$1';
$route['reject-proposed-budget/(:any)']    	= 'Project/reject_proposed_budget/$1';
$route['delete-proposed-budget/(:any)']    	= 'Project/delete_proposed_budget/$1';

$route['add-distribution-cost/(:any)'] 	        = 'Project/add_distribution_cost/$1';
$route['edit-distribution-cost/(:any)'] 	    = 'Project/edit_distribution_cost/$1';
$route['delete-distribution-cost/(:any)']    	= 'Project/delete_distribution_cost/$1';

$route['add-real-budget/(:any)'] 	        = 'Project/add_real_budget/$1';
$route['edit-real-budget/(:any)'] 	    = 'Project/edit_real_budget/$1';
$route['select-budget-real-budget/(:any)'] 	    = 'Project/select_budget_real_budget/$1';
$route['delete-real-budget/(:any)']    	= 'Project/delete_real_budget/$1';

$route['add-report-budget/(:any)'] 	        = 'Project/add_report_budget/$1';
$route['edit-report-budget/(:any)'] 	    = 'Project/edit_report_budget/$1';
$route['delete-report-budget/(:any)']    	= 'Project/delete_report_budget/$1';

$route['add-notes/(:any)'] 	        = 'Project/add_notes/$1';
$route['edit-notes/(:any)'] 	    = 'Project/edit_notes/$1';
$route['delete-notes/(:any)']    	= 'Project/delete_notes/$1';