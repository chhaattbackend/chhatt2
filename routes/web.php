<?php

use App\Mail\mail;
use App\Map;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
   //   Artisan::call('up');
     // dd('asdsad');
    // return view('welcome');
      return redirect('/login');
});
// Route::get('/email', function () {
//     return view('emails.wow');
// });
Auth::routes();
Route::group(['middleware' => 'auth'], function () {





    // Route::get('/home', 'HomeController@index')->name('home');



    Route::get('/home', 'HomeController@index')->name('home');
    Route::post('home/ajaxSearch', 'HomeController@ajaxSearch');



    Route::resource('users', 'UserController');
    Route::get('/userprofile', 'UserController@profile')->name('user.profile');
    Route::post('saveimage', 'UserController@save_image');
    Route::post('imagerotate', 'UserController@rotate_image');
    Route::resource('agencies', 'AgencyController');
    Route::resource('agentspecialities', 'AgentSpecialityController');
    Route::resource('agentareas', 'AgentAreaController');
    Route::resource('agents', 'AgentController');

    //-------------------Area Routes-----------------------------------

    Route::resource('areaones', 'AreaOneController');
    Route::resource('areatwos', 'AreaTwoController');
    Route::resource('areathrees', 'AreaThreeController');
    Route::resource('cities', 'CityController');

    //-------------------End Area Routes--------------------------------

    //-------------------Lead Routes------------------------------------

    Route::get('leads/filter', 'LeadController@filter')->name('leads.filter');
    Route::resource('leads', 'LeadController');
    Route::resource('leadassigns', 'LeadAssignController');
    Route::get('leadprojects/filter', 'LeadProjectController@filter')->name('leadprojects.filter');
    Route::resource('leadprojects', 'LeadProjectController');
    Route::resource('leadproperties', 'LeadPropertyController');


    //-------------------End Lead Routes--------------------------------

    Route::resource('payments', 'PaymentController');

    //-------------------Extra Features--------------------------------
    Route::resource('leadsources', 'LeadSourceController');
    Route::resource('leadtypes', 'LeadTypeController');
    Route::resource('responsestatus', 'ResponseStatusController');
    Route::resource('callstatus', 'CallstatusController');
    Route::resource('propertytypes', 'PropertyTypeController');

    //-------------------Extra Features--------------------------------

    Route::get('parent/{id}', 'AgencyController@getParent')->name('parent');
    Route::get('categories/{id}', 'AgencyController@getSubCategory')->name('categories');
    Route::get('subcategories/{id}', 'AgencyController@getSubSubCategory')->name('subcategories');

    Route::post('leads/ajax', 'LeadController@ajax');
    Route::post('leads/ajaxSearch', 'LeadController@ajaxSearch');
    Route::post('users/ajaxSearch', 'LeadController@ajaxSearch');


    // --------------------------Project Routes-------------------------------------------

    Route::resource('projects', 'ProjectController');
    Route::resource('projectbuyers', 'ProjectBuyerController');
    Route::resource('projectshops', 'ProjectShopController');
    Route::resource('projectsales', 'ProjectSaleController');
    Route::resource('projectsalesinstallments', 'ProjectSaleInstallmentController');
    Route::resource('projects', 'ProjectController');
    Route::get('createproject', 'LeadController@createproject')->name('leads.createproject');
    Route::post('storeproject', 'LeadController@storeproject')->name('leads.storeproject');
    Route::resource('projectimages', 'ProjectImageController');
    Route::get('projectimages/delete/{id}', 'ProjectImageController@destroy')->name('projectimages.delete');



    // ---------------------------End Project Routes-----------------------------------------
     // --------------------------Map Routes-------------------------------------------
    Route::resource('maps','MapController');
    Route::get('explode', 'MapController@explode')->name('explode');



     // ---------------------------End Map Routes-----------------------------------------

    Route::get('properties/byparent', 'PropertyController@byParent')->name('properties.by_parent');
    Route::resource('properties', 'PropertyController');
    Route::resource('propertyfor', 'PropertyForController');
    Route::resource('propertyimages', 'PropertyImageController');
    Route::get('propertyimages/delete/{id}', 'PropertyImageController@destroy')->name('propertyimages.delete');

    Route::resource('propertysocials', 'PropertySocialController');
    Route::resource('roles', 'RoleController');
    Route::resource('specialities', 'SpecialityController');
    Route::resource('states', 'StateController');
    Route::resource('projectusers', 'ProjectUserController');


    Route::get('propertiessearch', 'PropertyController@search')->name('properties.search');
    Route::get('filter', 'AgencyController@filter')->name('agencies.filter');

Route::get('completedleads','LeadController@completedleads')->name('leads.completedleads');
Route::get('filter1','AgentController@filter')->name('agents.filter');
Route::get('filtered','PropertyController@filter')->name('properties.filter');
Route::get('filtere','UserController@filter')->name('users.filter');
});





// --------------------------------------------Excel Routes-----------------------------------------------------------------

Route::get('importExportView', 'MyController@importExportView')->name('leads.import');
Route::get('export', 'MyController@export')->name('export');
Route::post('import', 'MyController@import')->name('import');

// --------------------------------------------End Excel Routes-----------------------------------------------------------------
