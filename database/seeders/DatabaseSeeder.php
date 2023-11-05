<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

use App\Models\
{
    User,
    Project,
    Task,
    TimeSpent
};
    


class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
      

        for ($i = 0; $i < 10; $i ++) {
            
            
            if($i == 0){
                
             $user =  User::factory()->create([
                    'name' => 'Test User',
                    'email' => 'test@test.ru',
                    'email_verified_at' => now(),
                    'password' => '$2y$10$12XKpQNK014ZVVxNGi8O/ubJjdm4UsUL3KOZnrkKpNbQHjg60DUIq', // password
                    'remember_token' => Str::random(10)
                       ]);
                
            }
            else{
            $user = User::factory()->create();
            }
            
            
            $j=0;
            while($j<8){
            $project = Project::factory()->create([
                'user_id' => $user->id
            ]);
            $j++;   
                    $k=0;
                    while($k<2){
                    $task = Task::factory()->create([
                        'project_id' => $project->id
                    ]);
                    $k++;
            
                        $z=0;
                        while($z<2){
                        TimeSpent::factory()->create([
                            'task_id' => $task->id
                        ]);
                        $z++;
                        echo '-';
                        }
                    
                     echo '=';
            
                    }
            
            
              
    
                
            }
                       
          echo '--' ;
        }
    }
    
    
    
    
}
