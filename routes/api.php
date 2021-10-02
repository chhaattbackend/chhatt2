<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use PharIo\Manifest\Email;

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

// -------------------------------------------------Custom Update Routes-----------------------------------------------------------
Route::get('properties/search', 'API\PropertyController@search')->name('properties.search');
Route::get('/getagencies','API\AgencyController@actioncheck');
Route::get('agencies/agencyall','API\AgencyController@agencyall')->name('agencies.agencyall');
Route::get('allareas','API\AreaOneController@allareas')->name('allareas');
Route::get('properties/related', 'API\PropertyController@related')->name('properties.related');
Route::resource('properties', 'API\PropertyController');
Route::resource('agencies', 'API\AgencyController');
Route::resource('areaones', 'API\AreaOneController');
Route::resource('areatwos', 'API\AreaTwoController');
Route::resource('areathrees', 'API\AreaThreeController');
Route::resource('cities', 'API\CityController');


Route::prefix('3ACA9CFF3B54BC1B4D3F7E23214EE')->group(function () {


Route::get('/actioncheck','API\AgencyController@actioncheck');
Route::put('agencies/update', 'API\AgencyController@update');
Route::put('agentspecialities/update','API\AgentSpecialityController@update');
Route::put('agents/update', 'API\AgentController@update');
Route::put('areaones/update', 'API\AreaOneController@update');
Route::put('areatwos/update', 'API\AreaTwoController@update');
Route::put('areathrees/update', 'API\AreaThreeController@update');
Route::put('cities/update', 'API\CityController@update');
Route::put('leads/update', 'API\LeadController@update');
Route::put('leadassigns/update', 'API\LeadAssignController@update');
Route::put('leadprojects/update', 'API\LeadProjectController@update');
Route::put('leadproperties/update', 'API\LeadPropertyController@update');
Route::put('payments/update', 'API\PaymentController@update');
Route::put('properties/update', 'API\PropertyController@update');
Route::put('users/profileupdate', 'API\UserController@profileupdate');
Route::post('users/profileimageupdate', 'API\UserController@profileimageupdate');
Route::put('projects/update', 'API\ProjectController@update');



///////////////////////umair work///////////////////////


///////////////////////umair work///////////////////////

// -------------------------------------------------End Custom Update Routes-----------------------------------------------------------

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('user/login', 'API\UserController@login');


Route::get('users/find','API\UserController@find')->name('users.find');
Route::get('mainsearch','API\AreaOneController@mainsearch')->name('mainsearch');

// --------------------------------------------------------Resources-----------------------------------------------------------
Route::resource('users', 'API\UserController');
Route::get('/userprofile', 'UserController@profile')->name('user.profile');
// Route::post('saveimage', 'API\UserController@save_image');
// Route::post('imagerotate', 'API\UserController@rotate_image');
Route::resource('agencies', 'API\AgencyController');
Route::get('/actioncheck','API\AgencyController@actioncheck');
Route::resource('agentspecialities', 'API\AgentSpecialityController');
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
Route::resource('roles', 'RoleController');
Route::resource('specialities', 'API\SpecialityController');
Route::resource('states', 'StateController');

// --------------------------------------------------------End Resources-----------------------------------------------------------

Route::get('properties/search', 'API\PropertyController@search')->name('properties.search');
Route::get('/getagencies','API\AgencyController@actioncheck');
Route::get('agencies/agencyall','API\AgencyController@agencyall')->name('agencies.agencyall');
Route::get('allareas','API\AreaOneController@allareas')->name('allareas');
Route::get('properties/related', 'API\PropertyController@related')->name('properties.related');
// --------------------------Project Routes-------------------------------------------
Route::resource('projects', 'API\ProjectController');
Route::resource('projectbuyers', 'API\ProjectBuyerController');
Route::resource('projectshops', 'API\ProjectShopController');
Route::resource('projectsales', 'API\ProjectSaleController');
Route::resource('projectsalesinstallments', 'API\ProjectSaleInstallmentController');
Route::resource('projects', 'API\ProjectController');
Route::get('get/maps','API\MapController@maps');


// ---------------------------End Project Routes-----------------------------------------


// --------------------------Property Routes-------------------------------------------

Route::post('properties/unformattedproperty', 'API\PropertyController@unformatedProperty');
Route::get('properties/favproperty', 'API\PropertyController@favproperty');
// Route::get('properties/aaa', 'API\PropertyController@store')->name('properties.store');
Route::resource('properties', 'API\PropertyController');
Route::resource('propertyimages', 'API\PropertyImageController');
Route::get('propertyimages/delete/{id}', 'API\PropertyImageController@destroy')->name('propertyimages.delete');
Route::resource('propertysocials', 'API\PropertySocialController');

// --------------------------End Property Routes-------------------------------------------



// Route::put('agencies/update','API\AgencyController@update2');


// --------------------------News -------------------------------------------

Route::get('newsletter', function (Request $request) {

    $emailex=DB::table('newsletter')->where('email',$request->email)->first();

    if ($emailex == null) {
        DB::table('newsletter')->insert([
            'email'=>$request->email
        ]);
    }

    return response()->json([
        'success' => true
    ]);
});


Route::get('getName', 'API\AgentController@getName');
});
