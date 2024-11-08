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


Route::group([

     'middleware' => ['api'],
    'prefix' => 'auth'

], function ($router) {

    Route::post('refresh', 'api\Auth\LoginController@refresh');
    
    // Route::post('login/social', 'api\Auth\LoginController@social_login');
    
   Route::post('register/email/verify', 'api\Auth\LoginController@verifycode')->name('api.customer.auth.verifyemailcode');

    // Route::post('login/email/setpassword', 'api\Auth\LoginController@setEmailPassword')->name('api.customer.auth.setemailpassword');

    Route::post('login/email', 'api\Auth\LoginController@login')->name('api.customer.auth.postemailpassword');

    Route::post('register/email', 'api\Auth\LoginController@register_email')->name('api.customer.auth.postemail');
    
    /*phone login*/
        // Route::post('login/phone/verifycode', 'api\Auth\LoginController@verifycode_phone')->name('api.customer.auth.verifyphonecode');

        // Route::post('login/phone/setphonepassword', 'api\Auth\LoginController@setphonePassword')->name('api.customer.auth.setphonepassword');

        // Route::post('login/phone/password', 'api\Auth\LoginController@login_phone')->name('api.customer.auth.postphonepassword');

        // Route::post('login/phone', 'api\Auth\LoginController@before_login_phone')->name('api.customer.auth.postphone');
        
        // Route::post('login/phone/forgot-password', 'api\Auth\LoginController@forgot_phone_password')->name('api.api.customer.auth.postphoneforgotpassword');
        
    /*phone login*/
    
    // Route::get('facebook', 'api\Auth\SocialAuthFacebookController@redirect')->name('loginwithfacebook');
    // Route::get('facebook/return', 'api\Auth\SocialAuthFacebookController@callback');
    // Route::get('google', 'api\Auth\SocialAuthGoogleController@redirect')->name('loginwithgoogle');
    // Route::get('google/return', 'api\Auth\SocialAuthGoogleController@callback');
    
    // Route::post('login/email/forgot-password', 'api\Auth\LoginController@forgot_email_password')->name('api.api.customer.auth.postemailforgotpassword');

});

Route::group([
        'middleware' => ['api','AuthMiddleware'],
        'namespace' => 'api',
    ], function ($router) {

	Route::apiResource('boxes', 'CustomerBoxController');
     /*   Route::get('permissions/modules', 'GroupsController@modules')->name('permissions.modules');
        Route::get('permissions/{module}/module', 'GroupsController@permissions')->name('modules.permissions');
        
    Route::apiResource('groups', 'GroupController');
	Route::apiResource('users', 'UserController');
	Route::apiResource('states', 'StateController');
	Route::apiResource('cities', 'CityController');
	Route::apiResource('areas', 'AreaController');
	Route::apiResource('customers', 'CustomerController');
	Route::apiResource('packages', 'PackageController');
	Route::apiResource('features', 'FeatureController');
	Route::apiResource('addresses', 'AddressController');
	Route::apiResource('lockers', 'LockerController');
	Route::apiResource('banners', 'BannerController');
	Route::apiResource('pages', 'PageController');*/

    
    
});

Route::group([
    
    'middleware' => 'api',
    'prefix' => 'auth'
    
], function ($router) {
  /*  
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');*/
    
});