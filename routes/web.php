<?php

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
Route::get('/dashboard', function () {
    return view('admin_dashboard');
});

Route::get('/dashboard2', function () {
    return view('bank_dashboard');
});
Route::get('/', [App\Http\Controllers\SiteController::class, 'index']);
Route::get('/appointment', 'App\Http\Controllers\SiteController@create_appointment');
Route::post('/appointment', 'App\Http\Controllers\SiteController@store_appointment');
Route::get('/host', 'App\Http\Controllers\SiteController@create_drive');
Route::post('/host', 'App\Http\Controllers\SiteController@store_drive');

Auth::routes(['verify' => true]);
// Auth::routes();

//**********************************DONOR ROUTES*************************************************
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home/profile/{id}', 'App\Http\Controllers\HomeController@edit_profile');
Route::post('/home/profile/{id}', 'App\Http\Controllers\HomeController@update_profile');
Route::get('/home/appointment', 'App\Http\Controllers\HomeController@create_appointment');
Route::post('/home/appointment', 'App\Http\Controllers\HomeController@store_appointment');

//Custom logout for user so that all sessions may not be destroyed
Route::post('/user/logout', 'App\Http\Controllers\Auth\LoginController@userLogout')->name('user.logout');

//**********************************STAFF ROUTES*************************************************
Route::prefix('staff')->group(function () {

    // Waiting assignment route
    Route::get('/approval', 'App\Http\Controllers\StaffController@assigned')->name('assigned');

    // Register routes
    Route::get('/register', 'App\Http\Controllers\Auth\StaffRegisterController@showRegistrationForm')->name('staff.register');
    Route::post('/register', 'App\Http\Controllers\Auth\StaffRegisterController@register')->name('staff.register.submit');

    // Login routes
     Route::get('/login', 'App\Http\Controllers\Auth\StaffLoginController@showLoginForm')->name('staff.login');
     Route::post('/login', 'App\Http\Controllers\Auth\StaffLoginController@login')->name('staff.login.submit');

    // Logout route
     Route::post('/logout', 'App\Http\Controllers\Auth\StaffLoginController@logout')->name('staff.logout');

    // Only assigned staff routes
     Route::middleware(['assigned','prevent-back-history'])->group(function () {

        // Staff dashboard route
        Route::get('/', 'App\Http\Controllers\StaffController@index')->name('staff.dashboard');

        // Donor management routes
        Route::get('/all-users', 'App\Http\Controllers\StaffController@all_donors');
        Route::post('/all-users', 'App\Http\Controllers\StaffController@search_donor');
        Route::get('/user/edit/{id}', 'App\Http\Controllers\StaffController@editUser');
        Route::post('/user/edit/{id}', 'App\Http\Controllers\StaffController@updateUser');
        Route::get('/user/delete/{id}', 'App\Http\Controllers\StaffController@deleteUser');
        Route::get('/add-user', 'App\Http\Controllers\StaffController@createUser');
        Route::post('/add-user', 'App\Http\Controllers\StaffController@storeUser');
        Route::get('/users/pdf', 'App\Http\Controllers\StaffController@createPDF');

        // Password reset routes
        Route::get('/password/reset/{token}', 'App\Http\Controllers\Auth\StaffResetPasswordController@showResetForm')->name('staff.password.reset');
        Route::post('/password/reset', 'App\Http\Controllers\Auth\StaffResetPasswordController@reset')->name('staff.password.update');

        // Donation management routes
        Route::get('/all-donations', 'App\Http\Controllers\StaffController@all_donations');
        Route::post('/all-donations', 'App\Http\Controllers\StaffController@search_donation');
        Route::get('/add-donation', 'App\Http\Controllers\StaffController@add_donation');
        Route::post('/add-donation', 'App\Http\Controllers\StaffController@save_donation');
        Route::get('/donation/edit/{id}', 'App\Http\Controllers\StaffController@edit_donation');
        Route::post('/donation/edit/{id}', 'App\Http\Controllers\StaffController@update_donation');
        Route::get('/donation/delete/{id}', 'App\Http\Controllers\StaffController@discard_donation');

        // Blood results management routes
        Route::get('/unscreened-donations', 'App\Http\Controllers\StaffController@all_unscreened_donations');
        Route::get('/add-blood-results/{id}', 'App\Http\Controllers\StaffController@add_blood_results');
        Route::post('/add-blood-results/{id}', 'App\Http\Controllers\StaffController@store_blood_results');

        // Agitators management routes
        Route::get('/all-agitators', 'App\Http\Controllers\StaffController@all_agitators')->name('agitators.index');
        Route::get('/add-agitator', 'App\Http\Controllers\StaffController@add_agitator');
        Route::post('/add-agitator', 'App\Http\Controllers\StaffController@store_agitator');
        Route::get('/agitator/show/{id}', 'App\Http\Controllers\StaffController@show_agitator');
        Route::get('/agitator/edit/{id}', 'App\Http\Controllers\StaffController@edit_agitator');
        Route::post('/agitator/edit/{id}', 'App\Http\Controllers\StaffController@update_agitator');
        Route::get('/agitator/delete/{id}', 'App\Http\Controllers\StaffController@delete_agitator');

        // Freezers management routes
        Route::get('/all-freezers', 'App\Http\Controllers\StaffController@all_freezers')->name('freezers.index');
        Route::get('/add-freezer', 'App\Http\Controllers\StaffController@add_freezer');
        Route::post('/add-freezer', 'App\Http\Controllers\StaffController@store_freezer');
        Route::get('/freezer/show/{id}', 'App\Http\Controllers\StaffController@show_freezer');
        Route::get('/freezer/edit/{id}', 'App\Http\Controllers\StaffController@edit_freezer');
        Route::post('/freezer/edit/{id}', 'App\Http\Controllers\StaffController@update_freezer');
        Route::get('/freezer/delete/{id}', 'App\Http\Controllers\StaffController@delete_freezer');

        // Refrigerators management routes
        Route::get('/all-refrigerators', 'App\Http\Controllers\StaffController@all_refrigerators')->name('refrigerators.index');
        Route::get('/add-refrigerator', 'App\Http\Controllers\StaffController@add_refrigerator');
        Route::post('/add-refrigerator', 'App\Http\Controllers\StaffController@store_refrigerator');
        Route::get('/refrigerator/show/{id}', 'App\Http\Controllers\StaffController@show_refrigerator');
        Route::get('/refrigerator/edit/{id}', 'App\Http\Controllers\StaffController@edit_refrigerator');
        Route::post('/refrigerator/edit/{id}', 'App\Http\Controllers\StaffController@update_refrigerator');
        Route::get('/refrigerator/delete/{id}', 'App\Http\Controllers\StaffController@delete_refrigerator');

        // Agitators management routes
        Route::get('/all-refrigerators', 'App\Http\Controllers\StaffController@all_refrigerators')->name('refrigerators.index');
        Route::get('/add-refrigerator', 'App\Http\Controllers\StaffController@add_refrigerator');
        Route::post('/add-refrigerator', 'App\Http\Controllers\StaffController@store_refrigerator');
        Route::get('/refrigerator/show/{id}', 'App\Http\Controllers\StaffController@show_refrigerator');
        Route::get('/refrigerator/edit/{id}', 'App\Http\Controllers\StaffController@edit_refrigerator');
        Route::post('/refrigerator/edit/{id}', 'App\Http\Controllers\StaffController@update_refrigerator');
        Route::get('/refrigerator/delete/{id}', 'App\Http\Controllers\StaffController@delete_refrigerator');

        // Blood Processing Management
        Route::get('/process', 'App\Http\Controllers\ProcessingController@index');
        Route::get('/process/{id}', 'App\Http\Controllers\ProcessingController@edit');
        Route::post('/process/{id}', 'App\Http\Controllers\ProcessingController@update');

        // Route::get('/process', 'App\Http\Controllers\BloodController@all_safe');
        // Route::get('/process/store/{id}', 'App\Http\Controllers\BloodController@store_blood');
        // Route::get('/process/process/{id}', 'App\Http\Controllers\BloodController@process_blood');
        Route::get('/processed', 'App\Http\Controllers\ProcessingController@processed_blood');

        // Blood Storage Management
        Route::get('/blood', 'App\Http\Controllers\StorageController@blood_index');
        Route::get('/blood/store/{id}', 'App\Http\Controllers\StorageController@store_blood');
        Route::get('/plasma', 'App\Http\Controllers\StorageController@plasma_index');
        Route::get('/plasma/store/{id}', 'App\Http\Controllers\StorageController@plasma_store_view');
        Route::post('/plasma/store/{id}', 'App\Http\Controllers\StorageController@store_plasma');
        Route::get('/platelets', 'App\Http\Controllers\StorageController@platelets_index');
        Route::get('/platelet/store/{id}', 'App\Http\Controllers\StorageController@platelets_store_view');
        Route::post('/platelet/store/{id}', 'App\Http\Controllers\StorageController@store_platelets');
        Route::get('/rbc', 'App\Http\Controllers\StorageController@rbc_index');
        Route::get('/rbc/store/{id}', 'App\Http\Controllers\StorageController@rbc_store_view');
        Route::post('/rbc/store/{id}', 'App\Http\Controllers\StorageController@store_rbc');

        // Whole blood stock management routes
        Route::get('/cold-room', 'App\Http\Controllers\BloodController@whole_blood');
        Route::get('/blood/issue/{id}', 'App\Http\Controllers\BloodController@issue');
        Route::post('/blood/issue/{id}', 'App\Http\Controllers\BloodController@store_issued');
        Route::get('/blood/issued', 'App\Http\Controllers\BloodController@issued_blood');
        Route::get('/blood/discarded', 'App\Http\Controllers\BloodController@discarded_blood');

        // Rbc stock management routes
        Route::get('/refrigerator/{id}', 'App\Http\Controllers\RbcController@index');
        // Route::get('/rbc', 'App\Http\Controllers\RbcController@index');
        Route::get('/rbc/add', 'App\Http\Controllers\RbcController@create');
        Route::post('/rbc/add', 'App\Http\Controllers\RbcController@store');
        Route::get('/rbc/show/{id}', 'App\Http\Controllers\RbcController@show');
        Route::get('/rbc/issue/{id}', 'App\Http\Controllers\RbcController@issue');
        Route::post('/rbc/issue/{id}', 'App\Http\Controllers\RbcController@store_issued');
        Route::get('/rbc/issued', 'App\Http\Controllers\RbcController@issued_rbc');
        Route::get('/rbc/edit/{id}', 'App\Http\Controllers\RbcController@edit');
        Route::post('/rbc/edit/{id}', 'App\Http\Controllers\RbcController@update');
        Route::get('/rbc/delete/{id}', 'App\Http\Controllers\RbcController@destroy');
        Route::get('/rbc/discard/{id}', 'App\Http\Controllers\RbcController@discard');
        Route::get('/rbc/discarded', 'App\Http\Controllers\RbcController@discarded_rbc');

        // Platelets stock management routes
        Route::get('/agitator/{id}', 'App\Http\Controllers\PlateletController@index');
        // Route::get('/platelets', 'App\Http\Controllers\PlateletController@index');
        Route::get('/platelets/add', 'App\Http\Controllers\PlateletController@create');
        Route::post('/platelets/add', 'App\Http\Controllers\PlateletController@store');
        Route::get('/platelet/issue/{id}', 'App\Http\Controllers\PlateletController@issue');
        Route::post('/platelet/issue/{id}', 'App\Http\Controllers\PlateletController@store_issued');
        Route::get('/platelet/issue/{id}', 'App\Http\Controllers\PlateletController@issue');
        Route::get('/platelets/issued', 'App\Http\Controllers\PlateletController@issued_platelets');
        Route::get('/platelets/show/{id}', 'App\Http\Controllers\PlateletController@show');
        Route::get('/platelets/edit/{id}', 'App\Http\Controllers\PlateletController@edit');
        Route::post('/platelets/edit/{id}', 'App\Http\Controllers\PlateletController@update');
        Route::get('/platelets/delete/{id}', 'App\Http\Controllers\PlateletController@destroy');
        Route::get('/platelet/discard/{id}', 'App\Http\Controllers\PlateletController@discard');
        Route::get('/platelets/discarded', 'App\Http\Controllers\PlateletController@discarded_platelets');

        // Plasma stock management routes
        Route::get('/freezer/{id}', 'App\Http\Controllers\PlasmaController@index');
        // Route::get('/plasma', 'App\Http\Controllers\PlasmaController@index');
        Route::get('/plasma/add', 'App\Http\Controllers\PlasmaController@create');
        Route::post('/plasma/add', 'App\Http\Controllers\PlasmaController@store');
        Route::get('/plasma/show/{id}', 'App\Http\Controllers\PlasmaController@show');
        Route::get('/plasma/issue/{id}', 'App\Http\Controllers\PlasmaController@issue');
        Route::post('/plasma/issue/{id}', 'App\Http\Controllers\PlasmaController@store_issued');
        Route::get('/plasma/issued', 'App\Http\Controllers\PlasmaController@issued_plasma');
        Route::get('/plasma/edit/{id}', 'App\Http\Controllers\PlasmaController@edit');
        Route::post('/plasma/edit/{id}', 'App\Http\Controllers\PlasmaController@update');
        Route::get('/plasma/delete/{id}', 'App\Http\Controllers\PlasmaController@destroy');
        Route::get('/plasma/discard/{id}', 'App\Http\Controllers\PlasmaController@discard');
        Route::get('/plasma/discarded', 'App\Http\Controllers\PlasmaController@discarded_plasma');

        // Drives management routes
        Route::get('/drives', 'App\Http\Controllers\StaffController@all_drives');
        Route::get('/drive/add', 'App\Http\Controllers\StaffController@create_drive');
        Route::post('/drive/add', 'App\Http\Controllers\StaffController@store_drive');
        Route::get('/drive/show/{id}', 'App\Http\Controllers\StaffController@show_drive');
        Route::get('/drive/edit/{id}', 'App\Http\Controllers\StaffController@edit_drive');
        Route::post('/drive/edit/{id}', 'App\Http\Controllers\StaffController@update_drive');
        Route::get('/drive/delete/{id}', 'App\Http\Controllers\StaffController@destroy_drive');
        Route::get('/hosted', 'App\Http\Controllers\StaffController@hosted_drives');
        Route::get('/hosted/accept/{id}', 'App\Http\Controllers\StaffController@accept_hosted_drive');

        // Appointments management routes
        Route::get('/appointments', 'App\Http\Controllers\StaffController@appointments');
        Route::get('/appointment/mark/{id}', 'App\Http\Controllers\StaffController@mark_appointment');
        Route::get('/appointment/accept/{id}', 'App\Http\Controllers\StaffController@approve_appointment');

        // Requests management routes
        Route::get('/requests', 'App\Http\Controllers\StaffController@hospital_requests');
        Route::get('/requests/full/{id}', 'App\Http\Controllers\StaffController@issuing_full_quantity');
        Route::get('/requests/available-blood/{id}', 'App\Http\Controllers\StaffController@issuing_available_blood');
        Route::get('/requests/available-plasma/{id}', 'App\Http\Controllers\StaffController@issuing_available_plasma');
        Route::get('/requests/available-platelets/{id}', 'App\Http\Controllers\StaffController@issuing_available_platelets');
        Route::get('/requests/available-rbc/{id}', 'App\Http\Controllers\StaffController@issuing_available_rbc');

        // Report management routes
        Route::get('/reports/donors', 'App\Http\Controllers\StaffController@donors_pdf');
        Route::get('/reports/donations', 'App\Http\Controllers\StaffController@donations_pdf');
        Route::get('/reports/plasma', 'App\Http\Controllers\StaffController@plasma_pdf');
        Route::get('/reports/platelets', 'App\Http\Controllers\StaffController@platelets_pdf');
        Route::get('/reports/rbc', 'App\Http\Controllers\StaffController@rbc_pdf');
        Route::get('/reports/blood', 'App\Http\Controllers\StaffController@blood_pdf');
    });
});


//******************************ADMIN ROUTES****************************************************************
Route::prefix('admin')->group(function () {
    // Dashboard route
    Route::get('/', 'App\Http\Controllers\AdminController@index')->name('admin.dashboard');

    // Login routes
    Route::get('/login', 'App\Http\Controllers\Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'App\Http\Controllers\Auth\AdminLoginController@login')->name('admin.login.submit');

    // Logout route
    Route::post('/logout', 'App\Http\Controllers\Auth\AdminLoginController@logout')->name('admin.logout');

    // Register routes
    Route::get('/register', 'App\Http\Controllers\Auth\AdminRegisterController@showRegistrationForm')->name('admin.register');
    Route::post('/register', 'App\Http\Controllers\Auth\AdminRegisterController@register')->name('admin.register.submit');

    // Password reset routes
    Route::get('/password/reset', 'App\Http\Controllers\Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/email', 'App\Http\Controllers\Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset/{token}', 'App\Http\Controllers\Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('/password/reset', 'App\Http\Controllers\Auth\AdminResetPasswordController@reset')->name('admin.password.update');

    // Bank management routes
    Route::get('/all-banks', 'App\Http\Controllers\AdminController@allBanks');
    Route::get('/add-bank', 'App\Http\Controllers\AdminController@addBank');
    Route::post('/add-bank', 'App\Http\Controllers\AdminController@storeBank');
    Route::get('/bank/edit/{id}', 'App\Http\Controllers\AdminController@edit_bank');
    Route::post('/bank/edit/{id}', 'App\Http\Controllers\AdminController@update_bank');
    Route::get('/bank/delete/{id}', 'App\Http\Controllers\AdminController@delete_bank');

    // Blood groups management routes
    Route::get('/all-blood-groups', 'App\Http\Controllers\AdminController@all_blood_groups');
    Route::get('/add-blood-group', 'App\Http\Controllers\AdminController@add_blood_group');
    Route::post('/add-blood-group', 'App\Http\Controllers\AdminController@store_blood_group');
    Route::get('/group/edit/{id}', 'App\Http\Controllers\AdminController@edit_blood_group');
    Route::post('/group/edit/{id}', 'App\Http\Controllers\AdminController@update_blood_group');
    Route::get('/group/delete/{id}', 'App\Http\Controllers\AdminController@delete_blood_group');

    // Hospital management routes
    Route::get('/hospitals', 'App\Http\Controllers\HospitalController@index');
    Route::get('/hospital/add', 'App\Http\Controllers\HospitalController@create');
    Route::post('/hospital/add', 'App\Http\Controllers\HospitalController@store');
    Route::get('/hospital/edit/{id}', 'App\Http\Controllers\HospitalController@edit');
    Route::post('/hospital/edit/{id}', 'App\Http\Controllers\HospitalController@update');
    Route::get('/hospital/delete/{id}', 'App\Http\Controllers\HospitalController@destroy');

    // Agitators management routes
    Route::get('/all-agitators', 'App\Http\Controllers\AgitatorController@index');
    Route::get('/add-agitator', 'App\Http\Controllers\AgitatorController@create');
    Route::post('/add-agitator', 'App\Http\Controllers\AgitatorController@store');
    Route::get('/agitator/edit/{id}', 'App\Http\Controllers\AgitatorController@edit');
    Route::post('/agitator/edit/{id}', 'App\Http\Controllers\AgitatorController@update');
    Route::get('/agitator/delete/{id}', 'App\Http\Controllers\AgitatorController@destroy');

    // Freezers management routes
    Route::get('/all-freezers', 'App\Http\Controllers\FreezerController@index');
    Route::get('/add-freezer', 'App\Http\Controllers\FreezerController@create');
    Route::post('/add-freezer', 'App\Http\Controllers\FreezerController@store');
    Route::get('/freezer/show/{id}', 'App\Http\Controllers\FreezerController@show');
    Route::get('/freezer/edit/{id}', 'App\Http\Controllers\FreezerController@edit');
    Route::post('/freezer/edit/{id}', 'App\Http\Controllers\FreezerController@update');
    Route::get('/freezer/delete/{id}', 'App\Http\Controllers\FreezerController@destroy');

    // Refrigerators management routes
    Route::get('/all-refrigerators', 'App\Http\Controllers\RefrigeratorController@index');
    Route::get('/add-refrigerator', 'App\Http\Controllers\RefrigeratorController@create');
    Route::post('/add-refrigerator', 'App\Http\Controllers\RefrigeratorController@store');
    Route::get('/refrigerator/show/{id}', 'App\Http\Controllers\RefrigeratorController@show');
    Route::get('/refrigerator/edit/{id}', 'App\Http\Controllers\RefrigeratorController@edit');
    Route::post('/refrigerator/edit/{id}', 'App\Http\Controllers\RefrigeratorController@update');
    Route::get('/refrigerator/delete/{id}', 'App\Http\Controllers\RefrigeratorController@delete');

    // Staff management routes
    Route::get('/all-staff', 'App\Http\Controllers\AdminController@all_staff');
    Route::get('/add-staff', 'App\Http\Controllers\AdminController@create_staff');
    Route::post('/add-staff', 'App\Http\Controllers\AdminController@store_staff');
    Route::get('/unassigned-staff', 'App\Http\Controllers\AdminController@all_unassigned_staff')->name('admin.staff.index');
    Route::get('/staff/assign/{id}', 'App\Http\Controllers\AdminController@assign_bank')->name('admin.staff.assign');
    Route::post('/staff/assign/{id}', 'App\Http\Controllers\AdminController@save_assigned_bank')->name('admin.staff.assign');
    Route::get('/staff/edit/{id}', 'App\Http\Controllers\AdminController@edit_staff');
    Route::post('/staff/edit/{id}', 'App\Http\Controllers\AdminController@update_staff');
    Route::get('/staff/delete/{id}', 'App\Http\Controllers\AdminController@delete_staff');

    // Donor management routes
    Route::get('/all-donors', 'App\Http\Controllers\AdminController@all_donors');
    Route::post('/all-donors', 'App\Http\Controllers\AdminController@search_donor');
    Route::get('/donor/edit/{id}', 'App\Http\Controllers\AdminController@edit_donor');
    Route::post('/donor/edit/{id}', 'App\Http\Controllers\AdminController@update_donor');
    Route::get('/donor/delete/{id}', 'App\Http\Controllers\AdminController@delete_donor');

    // Drive management routes
    Route::get('/unapproved-drives', 'App\Http\Controllers\AdminController@unapproved_drives');
    Route::get('/drive/approve/{id}', 'App\Http\Controllers\AdminController@approve_drive');

    // Donations view routes
    Route::get('/donations', 'App\Http\Controllers\AdminController@all_donations');

    // Stock view routes
    Route::get('/stock', 'App\Http\Controllers\AdminController@banks_stock');
    Route::get('/stock/show/{id}', 'App\Http\Controllers\AdminController@bank_stock');
    Route::get('/blood', 'App\Http\Controllers\AdminController@blood');
    Route::get('/plasma', 'App\Http\Controllers\AdminController@plasma');
    Route::get('/platelets', 'App\Http\Controllers\AdminController@platelets');
    Route::get('/rbc', 'App\Http\Controllers\AdminController@rbc');
    Route::get('/issued-blood', 'App\Http\Controllers\AdminController@issued_blood');
    Route::get('/issued-plasma', 'App\Http\Controllers\AdminController@issued_plasma');
    Route::get('/issued-platelets', 'App\Http\Controllers\AdminController@issued_platelets');
    Route::get('/issued-rbc', 'App\Http\Controllers\AdminController@issued_rbc');
    Route::get('/discarded-blood', 'App\Http\Controllers\AdminController@discarded_blood');
    Route::get('/discarded-plasma', 'App\Http\Controllers\AdminController@discarded_plasma');
    Route::get('/discarded-platelets', 'App\Http\Controllers\AdminController@discarded_platelets');
    Route::get('/discarded-rbc', 'App\Http\Controllers\AdminController@discarded_rbc');

    // Report management routes
    Route::get('/reports/donors', 'App\Http\Controllers\AdminController@donors_pdf');
    Route::get('/reports/staff', 'App\Http\Controllers\AdminController@staff_pdf');
    Route::get('/reports/donations', 'App\Http\Controllers\AdminController@donations_pdf');
    Route::get('/reports/blood', 'App\Http\Controllers\AdminController@blood_pdf');
    Route::get('/reports/plasma', 'App\Http\Controllers\AdminController@plasma_pdf');
    Route::get('/reports/platelets', 'App\Http\Controllers\AdminController@platelets_pdf');
    Route::get('/reports/rbc', 'App\Http\Controllers\AdminController@rbc_pdf');

    Route::get('/reports/issued-plasma', 'App\Http\Controllers\AdminController@issued_plasma_pdf');
    Route::get('/reports/issued-platelets', 'App\Http\Controllers\AdminController@issued_platelets_pdf');
    Route::get('/reports/issued-rbc', 'App\Http\Controllers\AdminController@issued_rbc_pdf');
    Route::get('/reports/issued-blood', 'App\Http\Controllers\AdminController@issued_blood_pdf');

    Route::get('/reports/discarded-plasma', 'App\Http\Controllers\AdminController@discarded_plasma_pdf');
    Route::get('/reports/discarded-platelets', 'App\Http\Controllers\AdminController@discarded_platelets_pdf');
    Route::get('/reports/discarded-rbc', 'App\Http\Controllers\AdminController@discarded_rbc_pdf');
    Route::get('/reports/discarded-blood', 'App\Http\Controllers\AdminController@discarded_blood_pdf');

    // Chart management routes
    Route::get('/charts/donors', 'App\Http\Controllers\AdminController@donors_charts');
    Route::get('/charts/staff', 'App\Http\Controllers\AdminController@staff_charts');

    Route::get('/charts/donations', 'App\Http\Controllers\AdminController@donations_charts');

    Route::get('/charts/blood', 'App\Http\Controllers\AdminController@blood_charts');
    Route::get('/charts/plasma', 'App\Http\Controllers\AdminController@plasma_charts');
    Route::get('/charts/platelets', 'App\Http\Controllers\AdminController@platelets_charts');
    Route::get('/charts/rbc', 'App\Http\Controllers\AdminController@rbc_charts');

    Route::get('/charts/issued-plasma', 'App\Http\Controllers\AdminController@issued_plasma_charts');
    Route::get('/charts/issued-platelets', 'App\Http\Controllers\AdminController@issued_platelets_charts');
    Route::get('/charts/issued-rbc', 'App\Http\Controllers\AdminController@issued_rbc_charts');
    Route::get('/charts/issued-blood', 'App\Http\Controllers\AdminController@issued_blood_charts');

    Route::get('/charts/discarded-plasma', 'App\Http\Controllers\AdminController@discarded_plasma_charts');
    Route::get('/charts/discarded-platelets', 'App\Http\Controllers\AdminController@discarded_platelets_charts');
    Route::get('/charts/discarded-rbc', 'App\Http\Controllers\AdminController@discarded_rbc_charts');
    Route::get('/charts/discarded-blood', 'App\Http\Controllers\AdminController@discarded_blood_charts');

    Route::get('/chart', 'App\Http\Controllers\AdminController@statistics');
    Route::get('/highchart', 'App\Http\Controllers\AdminController@highchart');
    Route::get('/blood-trends', 'App\Http\Controllers\StatisticsController@blood_highchart');
    Route::get('/plasma-trends', 'App\Http\Controllers\StatisticsController@plasma_highchart');
    Route::get('/platelets-trends', 'App\Http\Controllers\StatisticsController@platelets_highchart');
    Route::get('/rbc-trends', 'App\Http\Controllers\StatisticsController@rbc_highchart');

    // Site management routes
    Route::get('/faqs', 'App\Http\Controllers\AdminController@faqs');
    Route::post('/faqs', 'App\Http\Controllers\AdminController@store_faq');
    Route::get('/faqs/change', 'App\Http\Controllers\AdminController@update_faq_status');
    Route::get('/about', 'App\Http\Controllers\AdminController@edit_about');
    Route::post('/about', 'App\Http\Controllers\AdminController@update_about');
});
