<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Instructor;

class UserTableSeeder extends Seeder
{
  public function run()
  {
    $role_student = Role::where('name', 'student')->first();
    $role_instructor  = Role::where('name', 'instructor')->first();
    $role_admin  = Role::where('name', 'admin')->first();

    $is_exist = User::all();

    if (!$is_exist->count()) {
        $student = new User();
        $student->first_name = 'Farhan';
        $student->last_name = 'Diren';
        $student->email = 'farhan@gmail.com';
        $student->password = bcrypt('secret');
        $student->is_active = 1;
        $student->save();
        $student->roles()->attach($role_student);

        $admin = new User();
        $admin->first_name = 'Admin';
        $admin->last_name = 'Rohmad';
        $admin->email = 'admin@gmail.com';
        $admin->password = bcrypt('admin12345');
        $admin->is_active = 1;
        $admin->save();
        $admin->roles()->attach($role_admin);


        //import instructors
        $instructor_user = new User();
        $instructor_user->first_name = 'Putri';
        $instructor_user->last_name = 'Kharisma';
        $instructor_user->email = 'putri@gmail.com';
        $instructor_user->password = bcrypt('secret');
        $instructor_user->is_active = 1;
        $instructor_user->save();
        $instructor_user->roles()->attach($role_student);
        
        $instructor = new Instructor();
        $instructor->user_id = $instructor_user->id;
        $instructor->first_name = 'Tiara';
        $instructor->last_name = 'Ayu';
        $instructor->instructor_slug = 'tiara-ayu';
        $instructor->contact_email = 'tiara@gmail.com';
        $instructor->telephone = '+61 (800) 123-54323';
        $instructor->mobile = '+61 800-1233-8766';
        $instructor->paypal_id = 'tiara@gmail.com';
        $instructor->biography = '<p>Tiara is a trainer who is always optimistic, diligent and very humble towards her students. 
                                  Have abilities in the fields of soft skills and hard skills. Very diligent and always prioritizes 
                                  his work as a trainer.</p>';
        $instructor->instructor_image = 'instructor/1/angela.jpg';
        $instructor->save();
        $instructor_user->roles()->attach($role_instructor);

        
    }
  }
}