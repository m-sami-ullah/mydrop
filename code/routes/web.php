<?php

use App\Http\Controllers\Customer\Auth\VerificationController;
use App\Http\Controllers\Customer\Auth\ConfirmPasswordController;
use App\Http\Controllers\Customer\Auth\ForgotPasswordController as CustomerForgotPasswordController;
use App\Http\Controllers\HomeController;
use App\Models\Customer;
use App\Models\Permission;
use App\Models\PermissionModule;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

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

Route::get('/cl', function() {
 
 	
  
 	
	/* $modelsingplarvariable = 'country';

                $permissionModule = PermissionModule::create(["name"=>"Country","key"=>$modelsingplarvariable]);
			$view   = Permission::create(["module_id"=>$permissionModule->id,"name"=>"View Country","function"=>"view"]);
			$add    = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Add Country","function"=>"add"]); 
			$update = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Update Country","function"=>"update"]); 
			$delete = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Delete Country","function"=>"delete"]); 
			$view->group_permission()->attach(["status"=>1]); 
			$add->group_permission()->attach(["status"=>1]); 
			$update->group_permission()->attach(["status"=>1]); 
			$delete->group_permission()->attach(["status"=>1]); */
	 	 
    // $auth = Auth::guard('box')->attempt(['email'=>'first@mail.com','password'=>'123']);
    // dd($auth);
});

	Route::get('device', 'HomeController@device')->name('device');


Route::group(['middleware' => ['auth'],'prefix'=>'backend','namespace'=>'Admin'], function () {

	Route::get('dashboard', 'AdminController@index')->name('admindashboard');
	Route::get('home', 'PageController@home')->name('admin.homepage');

	Route::resource('groups', 'GroupController');
	Route::post('groups/deleteall', 'GroupController@deleteall')->name('groups.deleteall');
	Route::resource('users', 'UserController');
	Route::post('users/deleteall', 'UserController@deleteall')->name('users.deleteall');
	Route::resource('states', 'StateController');
	Route::post('states/deleteall', 'StateController@deleteall')->name('states.deleteall');
	Route::resource('cities', 'CityController');
	Route::post('cities/deleteall', 'CityController@deleteall')->name('cities.deleteall');
	Route::get('city', 'AjaxController@cities')->name('getcities');
	Route::resource('areas', 'AreaController');
	Route::post('areas/deleteall', 'AreaController@deleteall')->name('areas.deleteall');
	Route::resource('customers', 'CustomerController');
	Route::post('customers/deleteall', 'CustomerController@deleteall')->name('customers.deleteall');
	Route::resource('packages', 'PackageController');
	Route::post('packages/deleteall', 'PackageController@deleteall')->name('packages.deleteall');
	Route::resource('packages.features', 'FeatureController');
	Route::post('packages/{package}/features/deleteall', 'FeatureController@deleteall')->name('packages.features.deleteall');
	Route::resource('customers.addresses', 'AddressController');
	Route::post('customers/{customer}/addresses/deleteall', 'AddressController@deleteall')->name('customers.addresses.deleteall');
	Route::resource('customers.addresses.boxes', 'CustomerBoxController');
	Route::post('customers/{customer}/addresses/{address}/box/deleteall', 'CustomerBoxController@deleteall')->name('customers.addresses.boxes.deleteall');

	Route::resource('customers.addresses.devices', 'DeviceController');
	Route::post('customers/{customer}/addresses/deleteall', 'AddressController@deleteall')->name('customers.addresses.deleteall');

	Route::resource('devices', 'DeviceController');
	Route::post('devices/deleteall', 'DeviceController@deleteall')->name('devices.deleteall');
	Route::resource('banners', 'BannerController');
	Route::post('banners/deleteall', 'BannerController@deleteall')->name('banners.deleteall');
	Route::resource('pages', 'PageController');
	Route::post('pages/deleteall', 'PageController@deleteall')->name('pages.deleteall');

	Route::resource('faqs', 'FaqController');
	Route::post('faqs/deleteall', 'FaqController@deleteall')->name('faqs.deleteall');
	Route::resource('services', 'ServiceController');
	Route::post('services/deleteall', 'ServiceController@deleteall')->name('services.deleteall');
	Route::resource('testimonials', 'TestimonialController');
	Route::post('testimonials/deleteall', 'TestimonialController@deleteall')->name('testimonials.deleteall');

	Route::resource('socials', 'SocialController');
	Route::post('socials/deleteall', 'SocialController@deleteall')->name('socials.deleteall');

	Route::get('menu/{nav}/links', 'MenuController@menu')->name('menu.links');
	Route::post('menu/{nav}/addpage', 'MenuController@addpage')->name('menu.addpage');
	Route::post('menu/{nav}/addcategory', 'MenuController@addcategory')->name('menu.addcategory');
	Route::post('menu/{nav}/addcustom', 'MenuController@addcustom')->name('menu.addcustom');
	Route::get('menu/{nav}/{menu}/delete', 'MenuController@delete_menu')->name('menu.links.delete');
	Route::patch('menu/{nav}/updatemenu', 'MenuController@updatemenu')->name('menu.update');
	Route::resource('nav', 'MenuController');

	Route::get('clients/getclient', 'ClientController@getclient')->name('clients.getclient');
	Route::resource('clients', 'ClientController');
	Route::post('clients/deleteall', 'ClientController@deleteall')->name('clients.deleteall');

	Route::resource('orders', 'OrderController');
	Route::post('orders/deleteall', 'OrderController@deleteall')->name('orders.deleteall');

	Route::get('orderstatuses/getorderstatus', 'OrderstatusController@getorderstatus')->name('orderstatuses.getorderstatus');
	Route::resource('orderstatuses', 'OrderstatusController');
	Route::post('orderstatuses/deleteall', 'OrderstatusController@deleteall')->name('orderstatuses.deleteall');
	Route::get('invoicestatuses/getinvoicestatus', 'InvoicestatusController@getinvoicestatus')->name('invoicestatuses.getinvoicestatus');
	Route::resource('invoicestatuses', 'InvoicestatusController');
	Route::post('invoicestatuses/deleteall', 'InvoicestatusController@deleteall')->name('invoicestatuses.deleteall');

	Route::resource('countries', 'CountryController');
	Route::post('countries/deleteall', 'CountryController@deleteall')->name('countries.deleteall');
	
	Route::get('customers/{customer}/addresses/{address}/boxes/{box}/devices/', 'BoxdeviceController@customer_device')->name('customer.boxes.devices.index');
	
	Route::post('boxes/doortoogle', 'BoxController@doortoogle')->name('boxes.doortoogle');
	Route::post('boxes/deviceinfo', 'BoxController@deviceinfo')->name('boxes.deviceinfo');
	Route::get('boxes/generate', 'BoxController@generate')->name('boxes.generate');
	Route::post('boxes/generate', 'BoxController@store_generate')->name('boxes.generate.store');
	Route::get('address', 'AjaxController@addresses')->name('getaddresses');
	Route::resource('boxes', 'BoxController');
	Route::post('boxes/deleteall', 'BoxController@deleteall')->name('boxes.deleteall');
	Route::resource('boxes.boxdevices', 'BoxdeviceController');
	Route::post('boxes/{box}/boxdevices/deleteall', 'BoxdeviceController@deleteall')->name('boxes.boxdevices.deleteall');

	Route::resource('config', 'SiteconfigController')->only(['edit','update']);
}); 

Route::group(['prefix'=>'administration'],function () {
	Auth::routes();


	}); 



Route::group(['middleware'=>'sharing'],function () {

	
	Route::group(['middleware' => ['customer'],'prefix'=>'customer'], function () {

		Route::group(['namespace'=>'Customer'], function () 
		{
			Route::get('changepassword', 'ProfileController@changepassword')->name('customer.changepassword');
			Route::post('changepassword', 'ProfileController@change_password')->name('customer.password.update');
			Route::get('profile', 'ProfileController@index')->name('profile');
			Route::get('account', 'ProfileController@account')->name('customer.account');
			Route::get('addresses', 'ProfileController@addresses')->name('customer.addresses');
			Route::get('addresses/addnew', 'ProfileController@add_address')->name('customer.addresses.addnew');
			Route::post('addresses/addnew', 'ProfileController@store_address')->name('customer.addresses.store');
			

			Route::post('account', 'ProfileController@save_account')->name('customer.account.update');

			Route::get('orders', 'ProfileController@orders')->name('customer.orders');
			Route::post('boxes/doortoogle', 'CustomerBoxController@doortoogle')->name('customer.boxes.doortoogle');

			Route::post('boxes/deviceinfo', 'CustomerBoxController@deviceinfo')->name('customer.boxes.deviceinfo');
			Route::get('boxes/{box}/gallery', 'CustomerBoxController@getgallery')->name('customer.getgallery');

			Route::resource('boxes', 'CustomerBoxController', ['as' => 'customer']);

		}); // customer profile

			Route::get('checkout/{plan:slug}', 'PackageController@index')->name('plan.url');
			Route::get('thanks', 'PageController@thanks')->name('thanks.url');
	});

	Route::group(['namespace'=>'Customer\Auth','prefix'=>'customer'],function () {

		Route::get('email/verify', [VerificationController::class, 'show'])->name('customer.verification.notice');
		Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('customer.verification.verify');
		Route::post('email/resend',  [VerificationController::class, 'resend'])->name('customer.verification.resend');


		// Password Reset Routes...
		Route::post('password/email', [CustomerForgotPasswordController::class, 'sendResetLinkEmail'])->name('customer.password.email');
		Route::get('password/reset/{token}', [CustomerForgotPasswordController::class, 'showResetForm'])->name('customer.password.reset');
		Route::get('password/reset', [CustomerForgotPasswordController::class, 'showLinkRequestForm'])->name('customer.password.request');
		Route::post('password/reset', [CustomerForgotPasswordController::class, 'reset'])->name('customer.password.update');

		// Confirm Password 
		Route::get('password/confirm', [ConfirmPasswordController::class, 'showConfirmForm'])->name('customer.password.confirm');
		Route::post('password/confirm', [ConfirmPasswordController::class, 'confirm']);


		Route::get('signup', 'RegisterController@showRegistrationForm')->name('customer.signup');
		Route::get('login', 'LoginController@showLoginForm')->name('customer.auth')->middleware('guest');

		Route::post('register', 'RegisterController@register')->name('customer.register');

		Route::get('login/email', 'LoginController@showLoginForm')->name('customer.auth.email');
		Route::get('login/email/verify', 'LoginController@showVerifyCodeForm')->name('customer.auth.emailcode');
		Route::post('login/email/verifycode', 'LoginController@verifycode')->name('customer.auth.verifyemailcode');
		Route::get('login/email/setemailpassword', 'LoginController@showEmailPasswordForm')->name('customer.auth.showemailpassword');
		Route::post('login/email/setemailpassword', 'LoginController@setEmailPassword')->name('customer.auth.setemailpassword');

		Route::get('login/email/password', 'LoginController@showVerifyPasswordForm')->name('customer.auth.emailpassowrd');

		// Route::get('auth/facebook', 'SocialAuthFacebookController@redirect')->name('loginwithfacebook');
		// Route::get('auth/facebook/return', 'SocialAuthFacebookController@callback');
		 // Route::get('auth/facebook/deletion', 'SocialAuthFacebookController@deletion');

		// Route::get('auth/google', 'SocialAuthGoogleController@redirect')->name('loginwithgoogle');
		// Route::get('auth/google/return', 'SocialAuthGoogleController@callback');


		Route::get('login/phone', 'LoginController@showLoginForm')->name('customer.auth.phone');


		// Route::get('login/email/password', 'LoginController@showVerifyPasswordForm')->name('customer.auth.emailpassowrd');

		Route::post('login/email', 'LoginController@before_login')->name('customer.auth.postemail');
		Route::post('login/email/password', 'LoginController@login')->name('customer.auth.postemailpassword');

		Route::post('logout', 'LoginController@logout')->name('customer.auth.logout');

		Route::post('login/phone', 'LoginController@before_phonelogin')->name('customer.auth.postphone');


		Route::post('login/phone/password', 'LoginController@loginwithphone')->name('customer.auth.postphonepassword');

		Route::post('login/phone/verifycode', 'LoginController@verifyphonecode')->name('customer.auth.verifyphonecode');
		Route::post('login/phone/setphonepassword', 'LoginController@setPhonePassword')->name('customer.auth.setphonepassword');

		Route::post('login/email/forgot-password', 'LoginController@forgot_email_password')->name('customer.auth.postemailforgotpassword');

	}); 


	Route::post('contact-us', 'PageController@savecontact')->name('contactus.store');

	Route::post('payment/{plan:slug}', 'PayWithPayPalController@payment')->name('payment');
	Route::get('cancel', 'PayWithPayPalController@cancelTransaction')->name('payment.cancel');
	Route::get('payment/success', 'PayWithPayPalController@successTransaction')->name('payment.success');

	Route::get('/', [HomeController::class,'home'])->name('home');
	Route::get('city', 'AjaxController@cities')->name('getcities');
	Route::get('area', 'AjaxController@areas')->name('getareas');

	Route::get('contact-us', 'PageController@contactus')->name('page.contactus');

	Route::get('{page:slug}', 'PageController@page')->name('page.url');
	Route::get('service/{service:slug}', 'ServiceController@index')->name('service.url');
	
});

