<?php

namespace App\GraphQL\Validators;

use Nuwave\Lighthouse\Validation\Validator;
use Illuminate\Validation\Rule;
use App\Models\Course;


final class UpdateCourseStudentInputValidator extends Validator
{
    /**
     * Return the validation rules.
     *
     * @return array<string, array<mixed>>
     */
    public function rules(): array
    {
        return [
            // TODO Add your validation rules
            "course_id"=>[ 
                "nullable"
                
            ],
            "student_id"=> [
                "nullable",
                'unique:course_students,student_id,NULL,id,course_id,' . $this->arg('course_id'),
            ],
            'financial_refused_status' =>[
                'in:withMoney,noMoney,transferred' //Rule::in(Status::all())
            ] ,
            "transferred_to_course_id"  => [
               // "nullable" ,
                Rule::requiredIf($this->arg('financial_refused_status')=="transferred"),
                Rule::in(Course::pluck('id'))
            ]
        ];
    }
}
