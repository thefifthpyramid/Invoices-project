<?php
  
//namespace Database\Seeders;
  
use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
  
class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Ahmed Ali Klay', 
            'email' => 'AhmedAliKlay@outlook.com',
            'password' => bcrypt('Ahmed2022Klayphp artisan db:seed --class=PermissionTableSeeder'),
            'roles_name' => ['Admin'],
            'Status' => 'مفعل'
        ]);
    
        $role = Role::create(['name' => 'Admin']);
     
        $permissions = Permission::pluck('id','id')->all();
   
        $role->syncPermissions($permissions);
     
        $user->assignRole([$role->id]);
    }
}