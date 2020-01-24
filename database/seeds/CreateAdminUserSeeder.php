<?php

use App\User;
use Faker\Generator;
use Illuminate\Database\Seeder;
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
        	'name' => 'admin', 
        	'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'sponsorship' => Str::random(10).'_'.uniqid()
        ]);
  
        $role = Role::create(['name' => 'Admin']);
   
        $permissions = Permission::pluck('id','id')->all();
  
        $role->syncPermissions($permissions);
   
        $user->assignRole([$role->id]);

        factory(User::class, 100)->create();
        
        $users = User::all();

        foreach($users as $user) {
            $user->parent_id = User::find(rand(1, 10))->id;
            $user->son_id = User::find(rand(1, 10))->id;
            $user->save();
        }
    }
}
