<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PermissionModule;
use App\Models\Permission;
use App\Models\User;
use App\Models\Group;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$user = User::create(["name"=>"Admin","email"=>"admin@admin.com","password"=>bcrypt("123"),"activated"=>1]);
			$group = Group::create(["name"=>"Supper Admin","status"=>1]);
			$group->group_user()->attach(["user_id"=>$group->id]);
 
                $modelsingplarvariable = 'permissionmodule';

                $permissionModule = PermissionModule::create(["name"=>"PermissionModule","key"=>$modelsingplarvariable]);
			$view   = Permission::create(["module_id"=>$permissionModule->id,"name"=>"View PermissionModule","function"=>"view"]);
			$add    = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Add PermissionModule","function"=>"add"]); 
			$update = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Update PermissionModule","function"=>"update"]); 
			$delete = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Delete PermissionModule","function"=>"delete"]); 
			$view->group_permission()->attach(["status"=>1]); 
			$add->group_permission()->attach(["status"=>1]); 
			$update->group_permission()->attach(["status"=>1]); 
			$delete->group_permission()->attach(["status"=>1]); 
 
                $modelsingplarvariable = 'permission';

                $permissionModule = PermissionModule::create(["name"=>"Permission","key"=>$modelsingplarvariable]);
			$view   = Permission::create(["module_id"=>$permissionModule->id,"name"=>"View Permission","function"=>"view"]);
			$add    = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Add Permission","function"=>"add"]); 
			$update = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Update Permission","function"=>"update"]); 
			$delete = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Delete Permission","function"=>"delete"]); 
			$view->group_permission()->attach(["status"=>1]); 
			$add->group_permission()->attach(["status"=>1]); 
			$update->group_permission()->attach(["status"=>1]); 
			$delete->group_permission()->attach(["status"=>1]); 
 
                $modelsingplarvariable = 'group';

                $permissionModule = PermissionModule::create(["name"=>"Group","key"=>$modelsingplarvariable]);
			$view   = Permission::create(["module_id"=>$permissionModule->id,"name"=>"View Group","function"=>"view"]);
			$add    = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Add Group","function"=>"add"]); 
			$update = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Update Group","function"=>"update"]); 
			$delete = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Delete Group","function"=>"delete"]); 
			$view->group_permission()->attach(["status"=>1]); 
			$add->group_permission()->attach(["status"=>1]); 
			$update->group_permission()->attach(["status"=>1]); 
			$delete->group_permission()->attach(["status"=>1]); 
 
                $modelsingplarvariable = 'user';

                $permissionModule = PermissionModule::create(["name"=>"User","key"=>$modelsingplarvariable]);
			$view   = Permission::create(["module_id"=>$permissionModule->id,"name"=>"View User","function"=>"view"]);
			$add    = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Add User","function"=>"add"]); 
			$update = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Update User","function"=>"update"]); 
			$delete = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Delete User","function"=>"delete"]); 
			$view->group_permission()->attach(["status"=>1]); 
			$add->group_permission()->attach(["status"=>1]); 
			$update->group_permission()->attach(["status"=>1]); 
			$delete->group_permission()->attach(["status"=>1]); 
 
                $modelsingplarvariable = 'group_permission';

                $permissionModule = PermissionModule::create(["name"=>"Group_permission","key"=>$modelsingplarvariable]);
			$view   = Permission::create(["module_id"=>$permissionModule->id,"name"=>"View Group_permission","function"=>"view"]);
			$add    = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Add Group_permission","function"=>"add"]); 
			$update = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Update Group_permission","function"=>"update"]); 
			$delete = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Delete Group_permission","function"=>"delete"]); 
			$view->group_permission()->attach(["status"=>1]); 
			$add->group_permission()->attach(["status"=>1]); 
			$update->group_permission()->attach(["status"=>1]); 
			$delete->group_permission()->attach(["status"=>1]); 
 
                $modelsingplarvariable = 'group_user';

                $permissionModule = PermissionModule::create(["name"=>"Group_user","key"=>$modelsingplarvariable]);
			$view   = Permission::create(["module_id"=>$permissionModule->id,"name"=>"View Group_user","function"=>"view"]);
			$add    = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Add Group_user","function"=>"add"]); 
			$update = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Update Group_user","function"=>"update"]); 
			$delete = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Delete Group_user","function"=>"delete"]); 
			$view->group_permission()->attach(["status"=>1]); 
			$add->group_permission()->attach(["status"=>1]); 
			$update->group_permission()->attach(["status"=>1]); 
			$delete->group_permission()->attach(["status"=>1]); 
 
                $modelsingplarvariable = 'state';

                $permissionModule = PermissionModule::create(["name"=>"State","key"=>$modelsingplarvariable]);
			$view   = Permission::create(["module_id"=>$permissionModule->id,"name"=>"View State","function"=>"view"]);
			$add    = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Add State","function"=>"add"]); 
			$update = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Update State","function"=>"update"]); 
			$delete = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Delete State","function"=>"delete"]); 
			$view->group_permission()->attach(["status"=>1]); 
			$add->group_permission()->attach(["status"=>1]); 
			$update->group_permission()->attach(["status"=>1]); 
			$delete->group_permission()->attach(["status"=>1]); 
 
                $modelsingplarvariable = 'city';

                $permissionModule = PermissionModule::create(["name"=>"City","key"=>$modelsingplarvariable]);
			$view   = Permission::create(["module_id"=>$permissionModule->id,"name"=>"View City","function"=>"view"]);
			$add    = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Add City","function"=>"add"]); 
			$update = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Update City","function"=>"update"]); 
			$delete = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Delete City","function"=>"delete"]); 
			$view->group_permission()->attach(["status"=>1]); 
			$add->group_permission()->attach(["status"=>1]); 
			$update->group_permission()->attach(["status"=>1]); 
			$delete->group_permission()->attach(["status"=>1]); 
 
                $modelsingplarvariable = 'area';

                $permissionModule = PermissionModule::create(["name"=>"Area","key"=>$modelsingplarvariable]);
			$view   = Permission::create(["module_id"=>$permissionModule->id,"name"=>"View Area","function"=>"view"]);
			$add    = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Add Area","function"=>"add"]); 
			$update = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Update Area","function"=>"update"]); 
			$delete = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Delete Area","function"=>"delete"]); 
			$view->group_permission()->attach(["status"=>1]); 
			$add->group_permission()->attach(["status"=>1]); 
			$update->group_permission()->attach(["status"=>1]); 
			$delete->group_permission()->attach(["status"=>1]); 
 
                $modelsingplarvariable = 'customer';

                $permissionModule = PermissionModule::create(["name"=>"Customer","key"=>$modelsingplarvariable]);
			$view   = Permission::create(["module_id"=>$permissionModule->id,"name"=>"View Customer","function"=>"view"]);
			$add    = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Add Customer","function"=>"add"]); 
			$update = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Update Customer","function"=>"update"]); 
			$delete = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Delete Customer","function"=>"delete"]); 
			$view->group_permission()->attach(["status"=>1]); 
			$add->group_permission()->attach(["status"=>1]); 
			$update->group_permission()->attach(["status"=>1]); 
			$delete->group_permission()->attach(["status"=>1]); 
 
                $modelsingplarvariable = 'package';

                $permissionModule = PermissionModule::create(["name"=>"Package","key"=>$modelsingplarvariable]);
			$view   = Permission::create(["module_id"=>$permissionModule->id,"name"=>"View Package","function"=>"view"]);
			$add    = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Add Package","function"=>"add"]); 
			$update = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Update Package","function"=>"update"]); 
			$delete = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Delete Package","function"=>"delete"]); 
			$view->group_permission()->attach(["status"=>1]); 
			$add->group_permission()->attach(["status"=>1]); 
			$update->group_permission()->attach(["status"=>1]); 
			$delete->group_permission()->attach(["status"=>1]); 
 
                $modelsingplarvariable = 'feature';

                $permissionModule = PermissionModule::create(["name"=>"Feature","key"=>$modelsingplarvariable]);
			$view   = Permission::create(["module_id"=>$permissionModule->id,"name"=>"View Feature","function"=>"view"]);
			$add    = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Add Feature","function"=>"add"]); 
			$update = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Update Feature","function"=>"update"]); 
			$delete = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Delete Feature","function"=>"delete"]); 
			$view->group_permission()->attach(["status"=>1]); 
			$add->group_permission()->attach(["status"=>1]); 
			$update->group_permission()->attach(["status"=>1]); 
			$delete->group_permission()->attach(["status"=>1]); 
 
                $modelsingplarvariable = 'address';

                $permissionModule = PermissionModule::create(["name"=>"Address","key"=>$modelsingplarvariable]);
			$view   = Permission::create(["module_id"=>$permissionModule->id,"name"=>"View Address","function"=>"view"]);
			$add    = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Add Address","function"=>"add"]); 
			$update = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Update Address","function"=>"update"]); 
			$delete = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Delete Address","function"=>"delete"]); 
			$view->group_permission()->attach(["status"=>1]); 
			$add->group_permission()->attach(["status"=>1]); 
			$update->group_permission()->attach(["status"=>1]); 
			$delete->group_permission()->attach(["status"=>1]); 
 
                $modelsingplarvariable = 'device';

                $permissionModule = PermissionModule::create(["name"=>"Device","key"=>$modelsingplarvariable]);
			$view   = Permission::create(["module_id"=>$permissionModule->id,"name"=>"View Device","function"=>"view"]);
			$add    = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Add Device","function"=>"add"]); 
			$update = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Update Device","function"=>"update"]); 
			$delete = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Delete Device","function"=>"delete"]); 
			$view->group_permission()->attach(["status"=>1]); 
			$add->group_permission()->attach(["status"=>1]); 
			$update->group_permission()->attach(["status"=>1]); 
			$delete->group_permission()->attach(["status"=>1]); 
 
                $modelsingplarvariable = 'banner';

                $permissionModule = PermissionModule::create(["name"=>"Banner","key"=>$modelsingplarvariable]);
			$view   = Permission::create(["module_id"=>$permissionModule->id,"name"=>"View Banner","function"=>"view"]);
			$add    = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Add Banner","function"=>"add"]); 
			$update = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Update Banner","function"=>"update"]); 
			$delete = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Delete Banner","function"=>"delete"]); 
			$view->group_permission()->attach(["status"=>1]); 
			$add->group_permission()->attach(["status"=>1]); 
			$update->group_permission()->attach(["status"=>1]); 
			$delete->group_permission()->attach(["status"=>1]); 
 
                $modelsingplarvariable = 'page';

                $permissionModule = PermissionModule::create(["name"=>"Page","key"=>$modelsingplarvariable]);
			$view   = Permission::create(["module_id"=>$permissionModule->id,"name"=>"View Page","function"=>"view"]);
			$add    = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Add Page","function"=>"add"]); 
			$update = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Update Page","function"=>"update"]); 
			$delete = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Delete Page","function"=>"delete"]); 
			$view->group_permission()->attach(["status"=>1]); 
			$add->group_permission()->attach(["status"=>1]); 
			$update->group_permission()->attach(["status"=>1]); 
			$delete->group_permission()->attach(["status"=>1]); 
			 $modelsingplarvariable = 'faq';

                $permissionModule = PermissionModule::create(["name"=>"Faq","key"=>$modelsingplarvariable]);
			$view   = Permission::create(["module_id"=>$permissionModule->id,"name"=>"View Faq","function"=>"view"]);
			$add    = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Add Faq","function"=>"add"]); 
			$update = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Update Faq","function"=>"update"]); 
			$delete = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Delete Faq","function"=>"delete"]); 
			$view->group_permission()->attach(["status"=>1]); 
			$add->group_permission()->attach(["status"=>1]); 
			$update->group_permission()->attach(["status"=>1]); 
			$delete->group_permission()->attach(["status"=>1]); 
 
                $modelsingplarvariable = 'service';

                $permissionModule = PermissionModule::create(["name"=>"Service","key"=>$modelsingplarvariable]);
			$view   = Permission::create(["module_id"=>$permissionModule->id,"name"=>"View Service","function"=>"view"]);
			$add    = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Add Service","function"=>"add"]); 
			$update = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Update Service","function"=>"update"]); 
			$delete = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Delete Service","function"=>"delete"]); 
			$view->group_permission()->attach(["status"=>1]); 
			$add->group_permission()->attach(["status"=>1]); 
			$update->group_permission()->attach(["status"=>1]); 
			$delete->group_permission()->attach(["status"=>1]); 
 
                $modelsingplarvariable = 'testimonial';

                $permissionModule = PermissionModule::create(["name"=>"Testimonial","key"=>$modelsingplarvariable]);
			$view   = Permission::create(["module_id"=>$permissionModule->id,"name"=>"View Testimonial","function"=>"view"]);
			$add    = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Add Testimonial","function"=>"add"]); 
			$update = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Update Testimonial","function"=>"update"]); 
			$delete = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Delete Testimonial","function"=>"delete"]); 
			$view->group_permission()->attach(["status"=>1]); 
			$add->group_permission()->attach(["status"=>1]); 
			$update->group_permission()->attach(["status"=>1]); 
			$delete->group_permission()->attach(["status"=>1]); 

			$modelsingplarvariable = 'client';

                $permissionModule = PermissionModule::create(["name"=>"Client","key"=>$modelsingplarvariable]);
			$view   = Permission::create(["module_id"=>$permissionModule->id,"name"=>"View Client","function"=>"view"]);
			$add    = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Add Client","function"=>"add"]); 
			$update = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Update Client","function"=>"update"]); 
			$delete = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Delete Client","function"=>"delete"]); 
			$view->group_permission()->attach(["status"=>1]); 
			$add->group_permission()->attach(["status"=>1]); 
			$update->group_permission()->attach(["status"=>1]); 
			$delete->group_permission()->attach(["status"=>1]);

			$modelsingplarvariable = 'order';

                $permissionModule = PermissionModule::create(["name"=>"Order","key"=>$modelsingplarvariable]);
			$view   = Permission::create(["module_id"=>$permissionModule->id,"name"=>"View Order","function"=>"view"]);
			$add    = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Add Order","function"=>"add"]); 
			$update = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Update Order","function"=>"update"]); 
			$delete = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Delete Order","function"=>"delete"]); 
			$view->group_permission()->attach(["status"=>1]); 
			$add->group_permission()->attach(["status"=>1]); 
			$update->group_permission()->attach(["status"=>1]); 
			$delete->group_permission()->attach(["status"=>1]); 

			$modelsingplarvariable = 'orderstatus';

                $permissionModule = PermissionModule::create(["name"=>"Order Status","key"=>$modelsingplarvariable]);
			$view   = Permission::create(["module_id"=>$permissionModule->id,"name"=>"View Order Status","function"=>"view"]);
			$add    = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Add Order Status","function"=>"add"]); 
			$update = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Update Order Status","function"=>"update"]); 
			$delete = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Delete Order Status","function"=>"delete"]); 
			$view->group_permission()->attach(["status"=>1]); 
			$add->group_permission()->attach(["status"=>1]); 
			$update->group_permission()->attach(["status"=>1]); 
			$delete->group_permission()->attach(["status"=>1]); 
 
                $modelsingplarvariable = 'invoicestatus';

                $permissionModule = PermissionModule::create(["name"=>"Invoice Status","key"=>$modelsingplarvariable]);
			$view   = Permission::create(["module_id"=>$permissionModule->id,"name"=>"View Invoice Status","function"=>"view"]);
			$add    = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Add Invoice Status","function"=>"add"]); 
			$update = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Update Invoice Status","function"=>"update"]); 
			$delete = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Delete Invoice Status","function"=>"delete"]); 
			$view->group_permission()->attach(["status"=>1]); 
			$add->group_permission()->attach(["status"=>1]); 
			$update->group_permission()->attach(["status"=>1]); 
			$delete->group_permission()->attach(["status"=>1]); 
			 $modelsingplarvariable = 'country';

                $permissionModule = PermissionModule::create(["name"=>"Country","key"=>$modelsingplarvariable]);
			$view   = Permission::create(["module_id"=>$permissionModule->id,"name"=>"View Country","function"=>"view"]);
			$add    = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Add Country","function"=>"add"]); 
			$update = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Update Country","function"=>"update"]); 
			$delete = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Delete Country","function"=>"delete"]); 
			$view->group_permission()->attach(["status"=>1]); 
			$add->group_permission()->attach(["status"=>1]); 
			$update->group_permission()->attach(["status"=>1]); 
			$delete->group_permission()->attach(["status"=>1]); 


		 

			$modelsingplarvariable = 'box';

                $permissionModule = PermissionModule::create(["name"=>"Box","key"=>$modelsingplarvariable]);
			$view   = Permission::create(["module_id"=>$permissionModule->id,"name"=>"View Box","function"=>"view"]);
			$add    = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Add Box","function"=>"add"]); 
			$delete = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Generate Box","function"=>"generate"]); 
			$update = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Update Box","function"=>"update"]); 
			$delete = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Delete Box","function"=>"delete"]); 
			$view->group_permission()->attach(["status"=>1]); 
			$add->group_permission()->attach(["status"=>1]); 
			$update->group_permission()->attach(["status"=>1]); 
			$delete->group_permission()->attach(["status"=>1]); 
 
                $modelsingplarvariable = 'boxdevice';

                $permissionModule = PermissionModule::create(["name"=>"Boxdevice","key"=>$modelsingplarvariable]);
			$view   = Permission::create(["module_id"=>$permissionModule->id,"name"=>"View Boxdevice","function"=>"view"]);
			$add    = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Add Boxdevice","function"=>"add"]); 
			$update = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Update Boxdevice","function"=>"update"]); 
			$delete = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Delete Boxdevice","function"=>"delete"]); 
			$view->group_permission()->attach(["status"=>1]); 
			$add->group_permission()->attach(["status"=>1]); 
			$update->group_permission()->attach(["status"=>1]); 
			$delete->group_permission()->attach(["status"=>1]); 

			 $modelsingplarvariable = 'device';

                $permissionModule = PermissionModule::create(["name"=>"Device","key"=>$modelsingplarvariable]);
			$view   = Permission::create(["module_id"=>$permissionModule->id,"name"=>"View Device","function"=>"view"]);
			$add    = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Add Device","function"=>"add"]); 
			$update = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Update Device","function"=>"update"]); 
			$delete = Permission::create(["module_id"=>$permissionModule->id,"name"=>"Delete Device","function"=>"delete"]); 
			$view->group_permission()->attach(["status"=>1]); 
			$add->group_permission()->attach(["status"=>1]); 
			$update->group_permission()->attach(["status"=>1]); 
			$delete->group_permission()->attach(["status"=>1]); 
    }
}
