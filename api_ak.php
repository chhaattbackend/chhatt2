<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('users', 'API\UserController');
Route::get('/userprofile','UserController@profile')->name('user.profile');
Route::post('saveimage', 'API\UserController@save_image');
Route::post('imagerotate', 'API\UserController@rotate_image');
Route::resource('agencies', 'API\AgencyController');
Route::resource('agentspecialities','AgentSpecialityController');
Route::resource('agents', 'API\AgentController');
Route::resource('areaones', 'API\AreaOneController');
Route::resource('areatwos', 'API\AreaTwoController');
Route::resource('areathrees', 'API\AreaThreeController');
Route::resource('cities', 'API\CityController');
Route::resource('leads', 'API\LeadController');
Route::resource('leadassigns', 'API\LeadAssignController');
Route::resource('leadprojects', 'API\LeadProjectController');
Route::resource('leadproperties', 'API\LeadPropertyController');
Route::resource('payments', 'API\PaymentController');

// --------------------------Project Routes-------------------------------------------
Route::resource('projects', 'API\ProjectController');
Route::resource('projectbuyers', 'API\ProjectBuyerController');
Route::resource('projectshops', 'API\ProjectShopController');
Route::resource('projectsales', 'API\ProjectSaleController');
Route::resource('projectsalesinstallments', 'API\ProjectSaleInstallmentController');
Route::resource('projects', 'API\ProjectController');

// ---------------------------End Project Routes-----------------------------------------

Route::resource('properties', 'API\PropertyController');
Route::resource('propertyimages', 'API\PropertyImageController');
Route::get('propertyimages/delete/{id}', 'API\PropertyImageController@destroy')->name('propertyimages.delete');

Route::resource('propertysocials', 'PropertySocialController');
Route::resource('roles', 'RoleController');
Route::resource('specialities', 'SpecialityController');
Route::resource('states', 'StateController');

//-------------------------------- Sample Api -----------------------------------------


Route::get('/getuser','SampleController@get_users');
Route::get('/get/designations','SampleController@designations');
Route::get('/get/workingspec','SampleController@workingspec');

//------------------done---------


Route::post('/register','SampleController@client_reg');


Route::get('/get/position','SampleController@positions');
Route::post('/create/post','SampleController@new_post');
Route::get('/get/agency','SampleController@get_agency');
Route::get('/get/properties','SampleController@get_pro');
Route::get('/likes/{u_id}/{p_id}','SampleController@pro_likes');
Route::get('/views/{u_id}/{p_id}','SampleController@pro_views');
Route::get('/eng/{u_id}/{p_id}','SampleController@pro_eng');


Route::get('/get/count/{p_id}','SampleController@get_count');
Route::get('/get/likes/list/{p_id}','SampleController@get_likes_list');
Route::get('/get/views/list/{p_id}','SampleController@views_list');

Route::get('/get/eng/list/{p_id}','SampleController@get_eng_list');
Route::get('/get/profile/{u_id}','SampleController@profile');
Route::get('/get/same/{d_id}','SampleController@same_desg');
Route::get('/get/properties/','SampleController@get_pro');

Route::post('dummy','SampleController@dummy');
Route::get('/get/clients/','SampleController@dummyy');
Route::post('get/post/{id/1/2/3/4}','SampleController@showbyid');

Route::get('/get/sea','SampleController@sea');

Route::post('/search','SampleController@search');
Route::get('/get/approved/agent','SampleController@a_agent');
Route::post('/get/data','SampleController@s_Data');
Route::get('/get/properties/{user_id}','SampleController@m_post');
Route::get('/properties/likes/{p_id}','SampleController@u_likes');
Route::post('/post/upload','SampleController@upload');
Route::post('/get/pid','SampleController@pid');
Route::post('/file/upload','SampleController@file');
Route::get('/get/workspec','SampleController@workingspec');
Route::post('/get/user/profile','SampleController@getname');
Route::post('/post/status','SampleController@getstat');
Route::get('/get/propid/{id}','SampleController@propid');
Route::get('get/chkid','SampleController@chk_id');
Route::get('/get/agent/data/{office_id}','SampleController@ag_data');
Route::get('get/maps','SampleController@maps');
Route::get('get/sub','SampleController@sub');
Route::get('get/agencies','SampleController@agencies');
Route::get('get/actioncheck','SampleController@actioncheck');
Route::get('get/list/maps','SampleController@listmaps');
Route::post('post/reward','SampleController@reward');
Route::get('get/area_cat','SampleController@area_cat');
Route::get('get/plot_cat','SampleController@plot_cat');
Route::get('get/plot_detail','SampleController@plot_det');
Route::post('post/mob_data','SampleController@mob_data');
Route::get('get/posted','SampleController@posted');
Route::get('get/post/details','SampleController@postbyid');
Route::post('post/postedit/{id}','SampleController@postEdit');
Route::get('agency/search','SampleController@globsearch');
Route::get('agency/verify','SampleController@AgencyVerf');
Route::get('delete/post','SampleController@Softdelete');
Route::get('set/office','SampleController@setoffice');
Route::get('search/speciality','SampleController@SearchSpec');
Route::get('map/search','SampleController@globsearchmap');
Route::get('add/majorminor','SampleController@MajMinor');
Route::post('upload/pdf','SampleController@pdf');
Route::post('post/getvaluation','SampleController@getvaluation');
Route::get('post/return','SampleController@post_return');
Route::get('get/paginated/properties','SampleController@get_paginated_pro');
Route::get('get/agency/temporary','SampleController@temporary');
Route::get('update/up_postdetails','SampleController@up_postdetails');
Route::post('ui/post/edit/{id}','SampleController@UIpostEdit');
Route::get('ui/post/get','SampleController@UIgetpost');
Route::get('ui/postdetail/get','SampleController@UIgetpostdetail');
Route::post('ui/create/postdetail','SampleController@UIcreatePostdetail');
Route::get('post/click/{id}','SampleController@post_click');
Route::get('get/post/marker','SampleController@post_marker');
Route::get('get/related/post','SampleController@relatedPostOnApp');
Route::get('get/first/imagepost','SampleController@FirstImagePost');
Route::get('get/post/majorminor','SampleController@post_majorminor');
Route::get('get/attributes/count','SampleController@allcount');
Route::get('get/postdetail/majorminor','SampleController@postdetail_majorminor');
Route::get('get/post/allmarker','SampleController@post_allmarker');
Route::get('get/agents/lead','SampleController@AgentsLead');
Route::get('get/marker/search','SampleController@WebSearch');
Route::get('get/all/cities','SampleController@allPostCities');
Route::get('get/cities/majorminor','SampleController@PostDetailByCity');
Route::get('get/post/sold','SampleController@PostSold');
Route::get('get/hacked','SampleController@hack');
Route::get('get/post_detail/major','SampleController@post_details_major');
Route::get('agency/for/msg','SampleController@agencyformsg');

//React UI
Route::get('get/latlong','SampleController@latlong');
Route::get('post/nearprop','SampleController@nearprop');
Route::get('get/allareas','SampleController@allareas');
Route::get('get/arealist','SampleController@agencyarea');
Route::get('get/postcard','SampleController@postcard');
Route::get('get/postdetails/{id}','SampleController@postdetail');
Route::get('get/relatedpost','SampleController@relatedPost');
Route::get('get/uimaps','SampleController@UImaps');
Route::get('get/agencydetails','SampleController@get_agency_details');
Route::get('get/allmaps/{id}','SampleController@Mapbyid');
Route::get('get/staticmap','SampleController@staticmap');
Route::get('get/user/properties','SampleController@user_properties');
Route::get('get/updatemethod','SampleController@updatemethod');
Route::get('get/reltor_agencies','SampleController@getagents');



//Akash new APIs
Route::get('get/agencies/search', 'SampleController@globalSearch');
Route::get('get/user/search', 'SampleController@userSearch');
Route::get('get/city/count', 'SampleController@cityCount');
Route::get('/agents/test', 'AgentController@test');
Route::get('/salesagents/test', 'SalesAgentController@test');
Route::get('searchproperties', 'Api\PostDetailController@index');
Route::resource('leads', 'Api\LeadController');


//Lead Post
Route::post('post/leads', 'SampleController@Postleads');
Route::post('post/leadsattention', 'SampleController@leadsattention');
Route::post('post/call_chatstatus', 'SampleController@call_chatstatus');
Route::post('post/leadmessage', 'LeadController@leadmessage');

//AJAX
Route::post('post/position','SampleController@ajaxreq');

