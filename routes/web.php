<?php

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

// Route::get('/', function () {
//     return view('login');
//             $this->get('login', 'Auth\LoginController@showLoginForm')->name('login');

// });

Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');


Route::get('test/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'ajax','namespace' => 'Ajax' ], function() {
    Route::get('/location_by_keyword', 'AjaxController@location_by_keyword');
    Route::get('/doctor_by_keyword', 'AjaxController@doctor_by_keyword');
    Route::get('/representative_by_keyword', 'AjaxController@representative_by_keyword');
});

Route::group(['prefix' => 'admin' ,'namespace' => 'Admin','middleware' => 'auth'],function() {
    Route::get('dashboard2', ['as' => 'admin.dashboard2.index', 'uses' => 'DashboardController@test' ]);

    Route::match(['get', 'post' ], 'dashboard', ['as' => 'admin.dashboard.index', 'uses' => 'DashboardController@index' ]);
    /* --------------------------------------AdminUser Controller--------------------------------------------------- */
    Route::resource('adminuser', 'AdminUserController', [
        'only' => ['index', 'create', 'store', 'edit' ]
    ]);
    Route::get('adminuser', ['as' => 'admin.adminuser.index', 'uses' => 'AdminUserController@index' ]);
    Route::get('adminuser/create', ['as' => 'admin.adminuser.create', 'uses' => 'AdminUserController@create' ]);
    Route::post('adminuser/store', ['as' => 'admin.adminuser.store', 'uses' => 'AdminUserController@store' ]);
    Route::get('adminuser/{id}/edit', ['as' => 'admin.adminuser.edit', 'uses' => 'AdminUserController@edit' ]);
    Route::post('adminuser/{id}/update', ['as' => 'admin.adminuser.update', 'uses' => 'AdminUserController@update' ]);
    Route::get('adminuser/{id}/delete', ['as' => 'admin.adminuser.delete', 'uses' => 'AdminUserController@delete' ]);
    /* ----------------------------------------------------------------------------------------- */
    /* --------------------------------------schedule--------------------------------------------------- */
    Route::resource('schedule', 'ScheduleController', [
        'only' => ['index', 'create', 'store', 'edit' ]
    ]);
    Route::get('schedule', ['as' => 'admin.schedule.index', 'uses' => 'ScheduleController@index' ]);
    Route::get('schedule/create', ['as' => 'admin.schedule.create', 'uses' => 'ScheduleController@create' ]);
    Route::post('schedule/store', ['as' => 'admin.schedule.store', 'uses' => 'ScheduleController@store' ]);
    Route::get('schedule/{id}/edit', ['as' => 'admin.schedule.edit', 'uses' => 'ScheduleController@edit' ]);
    Route::post('schedule/{id}/update', ['as' => 'admin.schedule.update', 'uses' => 'ScheduleController@update' ]);
    Route::get('schedule/{id}/delete', ['as' => 'admin.schedule.delete', 'uses' => 'ScheduleController@delete' ]);
    // Route::get('schedule/{id}/professional_list', ['as' => 'admin.schedule.professional.list', 'uses' => 'ScheduleController@professional_list' ]);
    Route::get('schedule/{schedule_id}/{prof_id}/add', ['as' => 'admin.schedule.professional.add', 'uses' => 'ScheduleController@add_professional' ]);
    Route::post('schedule/{schedule_id}/invite', ['as' => 'admin.schedule.professional.invite', 'uses' => 'ScheduleController@invite_professional' ]);
    
Route::match(['get', 'post' ], 'schedule/{id}/professional_list', ['as' => 'admin.schedule.professional.list', 'uses' => 'ScheduleController@professional_list' ]);
    
    /* ----------------------------------content controller --------------------------------------------------- */
    Route::resource('content', 'ContentController', [
        'only' => ['index', 'create', 'store', 'edit' ]
    ]);
    Route::get('content', ['as' => 'admin.content.index', 'uses' => 'ContentController@index' ]);
    Route::get('content/create', ['as' => 'admin.content.create', 'uses' => 'ContentController@create' ]);
    Route::post('content/store', ['as' => 'admin.content.store', 'uses' => 'ContentController@store' ]);
    Route::post('content/{id}/edit', ['as' => 'admin.content.edit', 'uses' => 'ContentController@edit' ]);
    Route::post('content/{id}/update', ['as' => 'admin.content.update', 'uses' => 'ContentController@update' ]);
    Route::get('content/{id}/delete', ['as' => 'admin.content.delete', 'uses' => 'ContentController@delete' ]);


    /* --------------------------------------Procedure--------------------------------------------------- */
    Route::get('procedure', ['as' => 'admin.procedure.index', 'uses' => 'ProcedureController@index' ]);
    Route::get('procedure/{id}/view', ['as' => 'admin.procedure.edit', 'uses' => 'ProcedureController@view' ]);
    Route::get('procedure/{id}/cancel', ['as' => 'admin.procedure.cancel', 'uses' => 'ProcedureController@cancel' ]);
    Route::post('procedure/{id}/ob_store', ['as' => 'admin.procedure.observation.save', 'uses' => 'ProcedureController@ob_store' ]);
    Route::post('procedure/{id}/hs_store', ['as' => 'admin.procedure.history.save', 'uses' => 'ProcedureController@hs_store' ]);

    /* --------------------------------------Procedure--------------------------------------------------- */


    /* ----------------------------------------------------------------------------------------- */
    
    /* --------------------------------------Profile--------------------------------------------------- */
    Route::resource('profile', 'ProfileController', [
        'only' => ['index', 'store', 'edit' ]
    ]);
    Route::post('profile/{id}/update', ['as' => 'admin.profile.update', 'uses' => 'ProfileController@update' ]);
    /* ----------------------------------------------------------------------------------------- */
    
});

Route::group(['prefix' => 'admin/settings' ,'namespace' => 'Admin\Settings','middleware' => 'auth'], function() {
 /* --------------------------------------AdminUser Type Controller--------------------------------------------------- */
    Route::resource('usertype', 'UserTypeController', [
        'only' => ['index', 'create', 'store', 'edit' ]
    ]);
    Route::get('usertype', ['as' => 'admin.settings.usertype.index', 'uses' => 'UserTypeController@index' ]);
    Route::get('usertype/create', ['as' => 'admin.settings.usertype.create', 'uses' => 'UserTypeController@create' ]);
    Route::post('usertype/store', ['as' => 'admin.settings.usertype.store', 'uses' => 'UserTypeController@store' ]);
    Route::post('usertype/{id}/edit', ['as' => 'admin.settings.usertype.edit', 'uses' => 'UserTypeController@edit' ]);
    Route::post('usertype/{id}/update', ['as' => 'admin.settings.usertype.update', 'uses' => 'UserTypeController@update' ]);
    Route::get('usertype/{id}/delete', ['as' => 'admin.settings.usertype.delete', 'uses' => 'UserTypeController@delete' ]);
    /* ----------------------------------------------------------------------------------------- */
    /* --------------------------------------AdminUser Type Controller--------------------------------------------------- */
    Route::resource('workregion', 'WorkRegionController', [
        'only' => ['index', 'create', 'store', 'edit' ]
    ]);
    Route::get('workregion', ['as' => 'admin.settings.workregion.index', 'uses' => 'WorkRegionController@index' ]);
    Route::get('workregion/create', ['as' => 'admin.settings.workregion.create', 'uses' => 'WorkRegionController@create' ]);
    Route::post('workregion/store', ['as' => 'admin.settings.workregion.store', 'uses' => 'WorkRegionController@store' ]);
    Route::post('workregion/{id}/edit', ['as' => 'admin.settings.workregion.edit', 'uses' => 'WorkRegionController@edit' ]);
    Route::post('workregion/{id}/update', ['as' => 'admin.settings.workregion.update', 'uses' => 'WorkRegionController@update' ]);
    Route::get('workregion/{id}/delete', ['as' => 'admin.settings.workregion.delete', 'uses' => 'WorkRegionController@delete' ]);
    /* ----------------------------------------------------------------------------------------- */
    /* ----------------------------------Category controller --------------------------------------------------- */
    Route::resource('category', 'CategoryController', [
        'only' => ['index', 'create', 'store', 'edit' ]
    ]);
    Route::get('category', ['as' => 'admin.settings.category.index', 'uses' => 'CategoryController@index' ]);
    Route::get('category/create', ['as' => 'admin.settings.category.create', 'uses' => 'CategoryController@create' ]);
    Route::post('category/store', ['as' => 'admin.settings.category.store', 'uses' => 'CategoryController@store' ]);
    Route::post('category/{id}/edit', ['as' => 'admin.settings.category.edit', 'uses' => 'CategoryController@edit' ]);
    Route::post('category/{id}/update', ['as' => 'admin.settings.category.update', 'uses' => 'CategoryController@update' ]);
    Route::get('category/{id}/delete', ['as' => 'admin.settings.category.delete', 'uses' => 'CategoryController@delete' ]);
    


    /* --------------------------------------AdminLocation Controller--------------------------------------------------- */
    Route::resource('location', 'LocationController', [
        'only' => ['index', 'create', 'store', 'edit' ]
    ]);
    Route::get('location', ['as' => 'admin.settings.location.index', 'uses' => 'LocationController@index' ]);
    Route::get('location/create', ['as' => 'admin.settings.location.create', 'uses' => 'LocationController@create' ]);
    Route::post('location/store', ['as' => 'admin.settings.location.store', 'uses' => 'LocationController@store' ]);
    Route::post('location/{id}/edit', ['as' => 'admin.settings.location.edit', 'uses' => 'LocationController@edit' ]);
    Route::post('location/{id}/update', ['as' => 'admin.settings.location.update', 'uses' => 'LocationController@update' ]);
    Route::get('location/{id}/delete', ['as' => 'admin.settings.location.delete', 'uses' => 'LocationController@delete' ]);
    
    Route::get('location/importGet', ['as' => 'admin.settings.location.importGet', 'uses' => 'LocationController@importGet' ]);
    Route::post('location/importPost', ['as' => 'admin.settings.location.importPost', 'uses' => 'LocationController@importPost' ]);
    /* ----------------------------------------------------------------------------------------- */
    /* --------------------------------------AdminProcessType Controller--------------------------------------------------- */
    Route::resource('processtype', 'ProcessTypeController', [
        'only' => ['index', 'create', 'store', 'edit' ]
    ]);
    Route::get('processtype', ['as' => 'admin.settings.processtype.index', 'uses' => 'ProcessTypeController@index' ]);
    Route::get('processtype/create', ['as' => 'admin.settings.processtype.create', 'uses' => 'ProcessTypeController@create' ]);
    Route::post('processtype/store', ['as' => 'admin.settings.processtype.store', 'uses' => 'ProcessTypeController@store' ]);
    Route::post('processtype/{id}/edit', ['as' => 'admin.settings.processtype.edit', 'uses' => 'ProcessTypeController@edit' ]);
    Route::post('processtype/{id}/update', ['as' => 'admin.settings.processtype.update', 'uses' => 'ProcessTypeController@update' ]);
    Route::get('processtype/{id}/delete', ['as' => 'admin.settings.processtype.delete', 'uses' => 'ProcessTypeController@delete' ]);
    /* ----------------------------------------------------------------------------------------- */
     /* --------------------------------------Materail Controller--------------------------------------------------- */
    Route::resource('material', 'MaterialController', [
        'only' => ['index', 'create', 'store', 'edit' ]
    ]);
    Route::get('material', ['as' => 'admin.settings.material.index', 'uses' => 'MaterialController@index' ]);
    Route::get('material/create', ['as' => 'admin.settings.material.create', 'uses' => 'MaterialController@create' ]);
    Route::post('material/store', ['as' => 'admin.settings.material.store', 'uses' => 'MaterialController@store' ]);
    Route::post('material/{id}/edit', ['as' => 'admin.settings.material.edit', 'uses' => 'MaterialController@edit' ]);
    Route::post('material/{id}/update', ['as' => 'admin.settings.material.update', 'uses' => 'MaterialController@update' ]);
    Route::get('material/{id}/delete', ['as' => 'admin.settings.material.delete', 'uses' => 'MaterialController@delete' ]);
    
    Route::get('material/importGet', ['as' => 'admin.settings.material.importGet', 'uses' => 'MaterialController@importGet' ]);
    Route::post('material/importPost', ['as' => 'admin.settings.material.importPost', 'uses' => 'MaterialController@importPost' ]);
    /* ----------------------------------------------------------------------------------------- */
     /* --------------------------------------Representative Controller--------------------------------------------------- */
    Route::resource('representative', 'RepresentativeController', [
        'only' => ['index', 'create', 'store', 'edit' ]
    ]);
    Route::get('representative', ['as' => 'admin.settings.representative.index', 'uses' => 'RepresentativeController@index' ]);
    Route::get('representative/create', ['as' => 'admin.settings.representative.create', 'uses' => 'RepresentativeController@create' ]);
    Route::post('representative/store', ['as' => 'admin.settings.representative.store', 'uses' => 'RepresentativeController@store' ]);
    Route::post('representative/{id}/edit', ['as' => 'admin.settings.representative.edit', 'uses' => 'RepresentativeController@edit' ]);
    Route::post('representative/{id}/update', ['as' => 'admin.settings.representative.update', 'uses' => 'RepresentativeController@update' ]);
    Route::get('representative/{id}/delete', ['as' => 'admin.settings.representative.delete', 'uses' => 'RepresentativeController@delete' ]);
    /* ----------------------------------------------------------------------------------------- */

     /* --------------------------------------Doctor Controller--------------------------------------------------- */
    Route::resource('doctor', 'DoctorController', [
        'only' => ['index', 'create', 'store', 'edit' ]
    ]);
    Route::get('doctor', ['as' => 'admin.settings.doctor.index', 'uses' => 'DoctorController@index' ]);
    Route::get('doctor/create', ['as' => 'admin.settings.doctor.create', 'uses' => 'DoctorController@create' ]);
    Route::post('doctor/store', ['as' => 'admin.settings.doctor.store', 'uses' => 'DoctorController@store' ]);
    Route::post('doctor/{id}/edit', ['as' => 'admin.settings.doctor.edit', 'uses' => 'DoctorController@edit' ]);
    Route::post('doctor/{id}/update', ['as' => 'admin.settings.doctor.update', 'uses' => 'DoctorController@update' ]);
    Route::get('doctor/{id}/delete', ['as' => 'admin.settings.doctor.delete', 'uses' => 'DoctorController@delete' ]);
    
    Route::get('doctor/importGet', ['as' => 'admin.settings.doctor.importGet', 'uses' => 'DoctorController@importGet' ]);
    Route::post('doctor/importPost', ['as' => 'admin.settings.doctor.importPost', 'uses' => 'DoctorController@importPost' ]);
    /* ----------------------------------------------------------------------------------------- */
    
     /* --------------------------------------Professional Controller--------------------------------------------------- */
    Route::resource('professional', 'ProfessionalController', [
        'only' => ['index', 'create', 'store', 'edit' ]
    ]);
    Route::get('professional', ['as' => 'admin.settings.professional.index', 'uses' => 'ProfessionalController@index' ]);
    Route::get('professional/create', ['as' => 'admin.settings.professional.create', 'uses' => 'ProfessionalController@create' ]);
    Route::post('professional/store', ['as' => 'admin.settings.professional.store', 'uses' => 'ProfessionalController@store' ]);
    Route::post('professional/{id}/edit', ['as' => 'admin.settings.professional.edit', 'uses' => 'ProfessionalController@edit' ]);
    Route::post('professional/{id}/update', ['as' => 'admin.settings.professional.update', 'uses' => 'ProfessionalController@update' ]);
    Route::get('professional/{id}/delete', ['as' => 'admin.settings.professional.delete', 'uses' => 'ProfessionalController@delete' ]);
    /* ----------------------------------------------------------------------------------------- */
    
    Route::get('professional/importGet', ['as' => 'admin.settings.professional.importGet', 'uses' => 'ProfessionalController@importGet' ]);
    Route::post('professional/importPost', ['as' => 'admin.settings.professional.importPost', 'uses' => 'ProfessionalController@importPost' ]);

    /* ----------------------------------------------------------------------------------------- */
    /* --------------------------------------AdminSection Controller--------------------------------------------------- */
    Route::resource('section', 'SectionController', [
        'only' => ['index', 'create', 'store', 'edit' ]
    ]);
    Route::get('section', ['as' => 'admin.settings.section.index', 'uses' => 'SectionController@index' ]);
    Route::get('section/create', ['as' => 'admin.settings.section.create', 'uses' => 'SectionController@create' ]);
    Route::post('section/store', ['as' => 'admin.settings.section.store', 'uses' => 'SectionController@store' ]);
    Route::post('section/{id}/edit', ['as' => 'admin.settings.section.edit', 'uses' => 'SectionController@edit' ]);
    Route::post('section/{id}/update', ['as' => 'admin.settings.section.update', 'uses' => 'SectionController@update' ]);
    Route::get('section/{id}/delete', ['as' => 'admin.settings.section.delete', 'uses' => 'SectionController@delete' ]);
    
    Route::get('section/importGet', ['as' => 'admin.settings.section.importGet', 'uses' => 'SectionController@importGet' ]);
    Route::post('section/importPost', ['as' => 'admin.settings.section.importPost', 'uses' => 'SectionController@importPost' ]);
    /* ----------------------------------------------------------------------------------------- */
    
});

Auth::routes();

Route::get('/home', 'Admin\DashboardController@index')->name('home');
