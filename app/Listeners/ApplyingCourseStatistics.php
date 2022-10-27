<?php

namespace App\Listeners;

use App\Events\UpdateCourseStudentStatistics;
use App\Models\Course;
use App\Models\CourseSession;
use App\Models\CourseStudent;
use Carbon\Carbon;
use GraphQL\Error\Error;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Log;

class ApplyingCourseStatistics
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UpdateCourseStudentStatistics $event)
    {
        //Log::info("new listener is:".$event->params['course_id']);
        //return false;
        $current_date = Carbon::now()->format('Y-m-d');
        $current_time = Carbon::now()->format('H:i:s');
        //Log::info("current date is: " . $current_date . " current time is" . $current_time);

        $numberofcoursesessionpassed = CourseSession::where('course_id', $event->params['course_id'])
            ->where(function ($q) use ($current_date, $current_time) {
                $q->where('start_date', '<', $current_date)
                    ->orWhere(function ($query) use ($current_date, $current_time) {
                        $query->where('start_date', '=', $current_date)
                            ->where('end_time', '<', $current_time);
                    });
            })
            ->count('id');

        //   $sum_not_registerred= CourseStudent::where('course_id',$event->params['course_id'])->sum('total_not_registered');
        //   $sum_not_registerred= CourseStudent::where('course_id',$event->params['course_id'])->sum('total_noAction');
        //   $sum_not_registerred= CourseStudent::where('course_id',$event->params['course_id'])->sum('total_dellay60');
        //   $sum_not_registerred= CourseStudent::where('course_id',$event->params['course_id'])->sum('total_dellay45');
        //   $sum_not_registerred= CourseStudent::where('course_id',$event->params['course_id'])->sum('total_dellay30');
        //   $sum_not_registerred= CourseStudent::where('course_id',$event->params['course_id'])->sum('total_dellay15');
        //   $sum_not_registerred= CourseStudent::where('course_id',$event->params['course_id'])->sum('total_present');
        //   $sum_not_registerred= CourseStudent::where('course_id',$event->params['course_id'])->sum('total_absent');

        $courseStudents = CourseStudent::where('course_id', $event->params['course_id'])->get();
        $sum_not_registered = 0;
        $sum_noAction = 0;
        $sum_dellay60 = 0;
        $sum_dellay45 = 0;
        $sum_dellay30 = 0;
        $sum_dellay15 = 0;
        $sum_present = 0;
        $sum_absent = 0;

        foreach ($courseStudents as $courseStudent) {
            $sum_not_registered += $courseStudent->total_not_registered;
            $sum_noAction += $courseStudent->total_noAction;
            $sum_dellay60 += $courseStudent->total_dellay60;
            $sum_dellay45 += $courseStudent->total_dellay45;
            $sum_dellay30 += $courseStudent->total_dellay30;
            $sum_dellay15 += $courseStudent->total_dellay15;
            $sum_present += $courseStudent->total_present;
            $sum_absent += $courseStudent->total_absent;
        }
        $course = Course::where('id',$event->params['course_id'])->first();
        $course->avg_not_registered_session = $sum_not_registered / $numberofcoursesessionpassed;
        $course->avg_noAction_session = $sum_noAction / $numberofcoursesessionpassed;
        $course->avg_dellay60_session = $sum_dellay60 / $numberofcoursesessionpassed;
        $course->avg_dellay45_session = $sum_dellay45 / $numberofcoursesessionpassed;
        $course->avg_dellay30_session = $sum_dellay30 / $numberofcoursesessionpassed;
        $course->avg_dellay15_session = $sum_dellay15 / $numberofcoursesessionpassed;
        $course->avg_present_session = $sum_present / $numberofcoursesessionpassed;
        $course->avg_absent_session = $sum_absent / $numberofcoursesessionpassed;

        $course->save();
        //->sum('total_not_registered');
        //    ->sum('total_noAction')
        //    ->sum('total_dellay60')
        //    ->sum('total_dellay45')
        //    ->sum('total_dellay30')
        //    ->sum('total_dellay15')
        //    ->sum('total_present')
        //    ->sum('total_absent');
        //Log::info("all sum are:\n" . $all_course_session_ids_of_this_course);
    }
}
