<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Course;
use Carbon\Carbon;

class CourseSessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        //dd("course session is run");
        $user=$this->faker->randomElement(User::pluck('id'));// User::factory()->create();
        if($user===null)
        {
            $user= User::factory()->create();
            $user=$user->id;
        }
        //dd( $user);
        $course=Course::factory()->create();
        //dd($course->id);
        $name=$this->faker->name();
        $start_date=Carbon::parse(now())->format('Y-m-d');
        $start_time=Carbon::parse(now())->format('H:00:00');
        $end_time =Carbon::parse(now('+5 Hour'))->format('H:00:00');
        //dd($start_date ."   " .$start_time . " " .  $end_time );           
      
       // dd( $user);
        return  [
                    "user_id"   => $user,
                    "course_id" => $course->id,
                    "name"      => $name,
                    "start_date" =>$start_date,
                    "start_time" =>$start_time,
                    "end_time" =>$end_time,
        ];
    }
}
