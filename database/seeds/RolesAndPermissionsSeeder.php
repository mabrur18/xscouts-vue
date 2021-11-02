<?php
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RolesAndPermissionsSeeder extends Seeder
{
	private $permissionsByRole = [
			
		'administrator' => [
			'home/list', 'appoinment/list', 'appoinment/view', 'appoinment/add', 'appoinment/store', 'appoinment/edit', 'appoinment/delete', 'user/list', 'user/view', 'user/add', 'user/store', 'user/edit', 'user/delete', 'account/list', 'account/edit', 'pitch_xscouts/list', 'pitch_xscouts/view', 'pitch_xscouts/add', 'pitch_xscouts/store', 'pitch_xscouts/edit', 'pitch_xscouts/delete', 'model_has_permissions/list', 'model_has_permissions/view', 'model_has_permissions/add', 'model_has_permissions/store', 'model_has_permissions/edit', 'model_has_permissions/delete', 'model_has_roles/list', 'model_has_roles/view', 'model_has_roles/add', 'model_has_roles/store', 'model_has_roles/edit', 'model_has_roles/delete', 'permissions/list', 'permissions/view', 'permissions/add', 'permissions/store', 'permissions/edit', 'permissions/delete', 'role_has_permissions/list', 'role_has_permissions/view', 'role_has_permissions/add', 'role_has_permissions/store', 'role_has_permissions/edit', 'role_has_permissions/delete', 'roles/list', 'roles/view', 'roles/add', 'roles/store', 'roles/edit', 'roles/delete', 'pitch_xscouts/list_review'
		], 
		'user' => [
			'home/list', 'account/list', 'account/edit', 'pitch_xscouts/list_review'
		], 
		'developer' => [
			'home/list', 'appoinment/list', 'appoinment/view', 'appoinment/add', 'appoinment/store', 'appoinment/edit', 'appoinment/delete', 'appoinment/importdata', 'user/list', 'user/view', 'user/add', 'user/store', 'user/edit', 'user/delete', 'user/importdata', 'pitch_xscouts/list', 'pitch_xscouts/view', 'pitch_xscouts/add', 'pitch_xscouts/store', 'pitch_xscouts/edit', 'pitch_xscouts/delete', 'pitch_xscouts/importdata', 'model_has_permissions/list', 'model_has_permissions/view', 'model_has_permissions/add', 'model_has_permissions/store', 'model_has_permissions/edit', 'model_has_permissions/delete', 'model_has_permissions/importdata', 'model_has_roles/list', 'model_has_roles/view', 'model_has_roles/add', 'model_has_roles/store', 'model_has_roles/edit', 'model_has_roles/delete', 'model_has_roles/importdata', 'permissions/list', 'permissions/view', 'permissions/add', 'permissions/store', 'permissions/edit', 'permissions/delete', 'permissions/importdata', 'role_has_permissions/list', 'role_has_permissions/view', 'role_has_permissions/add', 'role_has_permissions/store', 'role_has_permissions/edit', 'role_has_permissions/delete', 'role_has_permissions/importdata', 'roles/list', 'roles/view', 'roles/add', 'roles/store', 'roles/edit', 'roles/delete', 'roles/importdata', 'account/list', 'account/edit', 'pitch_xscouts/list_review'
		]
	];
    public function run()
    {
        $tableNames = config('permission.table_names');

		Schema::disableForeignKeyConstraints();

        DB::table($tableNames['roles'])->truncate();
        DB::table($tableNames['permissions'])->truncate();
		DB::table($tableNames['role_has_permissions'])->truncate();
		
		Schema::enableForeignKeyConstraints();
		
		app()['cache']->forget('spatie.permission.cache');
		app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

		$this->syncPermissions();
		$this->syncRoles();
		$this->syncUsersRole('administrator');
    }
	function syncRoles(){
		foreach ($this->permissionsByRole as $rolename => $permissions) {
			$role = Role::create(['name' => $rolename]);
			$role->givePermissionTo($permissions);
		}
	}

	function syncPermissions(){
		$permissions = [];

		foreach ($this->permissionsByRole as $rolename => $rolePermissions) {
			$permissions = array_merge($permissions, $rolePermissions);
		}

		$insertData = [];
		foreach($permissions as $name){
			$insertData[] = ['name'=>$name, 'guard_name' => 'web'];
		}
		Permission::insert($insertData);
	}

	function syncUsersRole($role){
		$users = User::all();
		foreach($users as $user){
			$user->syncRoles($role);
		}
	}
}
