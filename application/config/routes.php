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
$route['default_controller'] = "frontend/home";


$route['^tr'] = $route['default_controller'];
$route['^en$'] = $route['default_controller'];
$route['^fr$'] = $route['default_controller'];



$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['admin'] = "backend/Index/index";



/* Login Section */

$route['login'] = "backend/Login/index";
$route['login/accept'] = "backend/Login/accept";
$route['logout'] = "backend/Login/logout";

/* Category Section */

$route['category'] = "backend/Category/index";
$route['category/add'] = "backend/Category/add";
$route['category/add_form'] = "backend/Category/add_form";
$route['category/active'] = "backend/Category/active";
$route['category/edit/(:num)'] = "backend/Category/edit/$1";
$route['category/edit_form'] = "backend/Category/edit_form";
$route['category/delete'] = "backend/Category/delete";
$route['category/image/(:num)'] = "backend/Category/image/$1";
$route['category/image_form/(:num)'] = "backend/Category/image_form/$1";
$route['category/image_head'] = "backend/Category/image_head";
$route['category/image_delete'] = "backend/Category/image_delete";


/* Subcategory Section */

$route['subcategory'] = "backend/Subcategory/index";
$route['subcategory/add'] = "backend/Subcategory/add";
$route['subcategory/add_form'] = "backend/Subcategory/add_form";
$route['subcategory/edit/(:num)'] = "backend/Subcategory/edit/$1";
$route['subcategory/edit_form'] = "backend/Subcategory/edit_form";
$route['subcategory/delete'] = "backend/Subcategory/delete";
$route['subcategory/active'] = "backend/Subcategory/active";
$route['subcategory/image/(:num)'] = "backend/Subcategory/image/$1";
$route['subcategory/image_form/(:num)'] = "backend/Subcategory/image_form/$1";
$route['subcategory/image_head'] = "backend/Subcategory/image_head";
$route['subcategory/image_delete'] = "backend/Subcategory/image_delete";



/* Product Section */

$route['product'] = "backend/Product/index";
$route['product/add'] = "backend/Product/add";
$route['product/add_form'] = "backend/Product/add_form";
$route['product/edit/(:num)'] = "backend/Product/edit/$1";
$route['product/edit_form'] = "backend/Product/edit_form";
$route['product/active'] = "backend/Product/active";

$route['product/category_select'] = "backend/Product/category_select";



/* Settings Section */

$route['settings'] = "backend/settings/index";
$route['setting/lang_add_form'] = "backend/settings/lang_add_form";
$route['settings/lang_edit_form'] = "backend/settings/lang_edit_form";
$route['settings/settings_edit'] = "backend/settings/settings_edit";
$route['settings/gallery_add'] = "backend/settings/gallery_add";

/* Text Section */

$route['text-section'] = "backend/settings/text_section";


/* Menu Section */

$route['menu'] = "backend/Menu/index";
$route['menu/add'] = "backend/Menu/add";
$route['menu/add_form'] = "backend/Menu/add_form";

$route['settings/lang_edit_form'] = "backend/settings/lang_edit_form";
$route['settings/settings_edit'] = "backend/settings/settings_edit";
$route['settings/gallery_add'] = "backend/settings/gallery_add";


/* Submenu Section */

$route['submenu/(:num)'] = "backend/Submenu/index/$1";
$route['submenu/add/(:num)'] = "backend/Submenu/add/$1";
$route['submenu/add_form'] = "backend/Submenu/add_form";


$route['menu/add_form'] = "backend/Menu/add_form";
$route['settings/lang_edit_form'] = "backend/settings/lang_edit_form";
$route['settings/settings_edit'] = "backend/settings/settings_edit";
$route['settings/gallery_add'] = "backend/settings/gallery_add";



