<?php

namespace App\Rules;

use App\Models\CourseSession;
use Illuminate\Contracts\Validation\Rule;
use Log;

class CreateLimitationDateForAbsencePresence implements Rule
{
    protected $course_session_id;
    protected $course_id;
    private $err;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($course_id_param)
    {
        //$this->course_session_id=$course_session_i_param;
        $this->course_id=$course_id_param;

    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->CheckCourseSessionDateTime($this->course_id,$value);
    }
    public function CheckCourseSessionDateTime($course_id,$course_session_id)
    {
        $get_course_session=CourseSession::where('id',$course_session_id)
        ->where('course_id',$course_id)->first();
        if(!$get_course_session){
             $this->err="THIS_COURSE_SESSION_AND_COURSE_IS_MISMATCH";
             return false;

        }
        // Log::info(strtotime($get_course_session->start_date .' '. $get_course_session->end_time));
        // Log::info(strtotime(date("Y-m-d H:i:s")));
        $course_session_date=strtotime($get_course_session->start_date . ' ' . "23:59:59");//.' '. $get_course_session->end_time);
        $now=strtotime(date("Y-m-d H:i:s"));
       //Log::info("course_session_date is:" . $course_session_date);
      // Log::info("now is:".  $now);
        if($now>$course_session_date){
            $this->err="COURSE_SESSION_DATE_TIME_IS_PASSED";
            return false;
        }
        return true;


    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->err;
    }
}
