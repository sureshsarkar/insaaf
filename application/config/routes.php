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
| When you set this option to TRUE, it will replace ALL dashes with
| underscores in the controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = "index";
$route['404_override'] = 'error_page';
$route['translate_uri_dashes'] = FALSE;


$route['admin'] = 'admin/dashboard';
$route['client'] = 'client/dashboard';
$route['lawyer'] = 'lawyer/dashboard';




$route['terms-condition'] = 'index/turms';
$route['client-terms-conditions'] = 'signup_ajax/client_term';
$route['lawyer-terms-conditions'] = 'signup_ajax/lawyer_term';
$route['student-corner/blog'] = 'blogs';
$route['student-corner/blog/(:any)'] = 'blogs/blog_details/$1';
$route['student-corner'] = 'index/student';
$route['student-corner/dictionay'] = 'index/dictionay';
$route['student-corner/study-materials'] = 'index/study_materials';
$route['student-corner/bare-acts'] = 'bare_acts';
$route['student-corner/bare-acts/(:any)'] = 'bare_acts/act_sub_type/$1';
$route['student-corner/bare-acts/detail/(:any)'] = 'bare_acts/section_detail/$1';


$route['bare-acts/indian-panel-code'] = 'bare_acts/indian_panel_code';
$route['bare-acts/criminal-procedure-code'] = 'bare_acts/criminal_procedure';
$route['bare-acts/civil-procedure-code'] = 'bare_acts/civil_procedure';
$route['bare-acts/domestic-voilence-act'] = 'bare_acts/domestic_voilence';
$route['bare-acts/motor-vehicle-act'] = 'bare_acts/motor_vehicle';
$route['all-news'] = 'index/allnews';
$route['privacy-policy'] = 'index/policy';
$route['refund-policy'] = 'index/refund';
$route['about-us'] = 'about';
$route['talk-to-lawyer'] = 'ppc';
$route['property-lawyers'] = 'ppc';
$route['criminal-lawyers'] = 'ppc';
$route['legal-notices'] = 'ppc';
$route['expert-lawyers'] = 'ppc';
$route['hire-a-lawyer'] = 'ppc';
$route['family-lawyers'] = 'ppc';
$route['divorce-lawyers'] = 'ppc';
$route['domestic-violence'] = 'ppc';

$route['talk-to-lawyer/submit'] = 'ppc/submit';
$route['contact-us'] = 'Contact';

$route['login'] = 'signup/login';
$route['new_user'] = 'legal-advice';
$route['legal-advice'] = 'new_user';
$route['lawyer-account/forgot'] = 'Lawyer_account/forgot';
// $route['client/registration'] = 'signup_ajax/register1';
$route['certificare/book-now'] = 'certificare/book_now';
$route['specialization'] = 'practice_area';
$route['specialization/(:any)'] = 'practice_area/detail/$1';
$route['all-services'] = 'practice_area/all_services';
$route['lawyer-list'] = 'lawyerlist';
$route['lawyer-details'] = 'lawyerlist/lawyer_details';

$route['specialization/start-up/(:any)'] = '/practice_area/test1/$1';
$route['specialization/documentation/(:any)'] = '/practice_area/test/$1';
$route['ppc1/uspage/(:any)'] = '/ppc1/uspage/index/$1';
$route['latest-news/(:any)'] = 'Index/News/$1';

$route['refund'] = 'index/refund';

$route['z/(:any)'] = 'z/index/$1';
// client folder


$route['time-closed'] = 'timeclosed';