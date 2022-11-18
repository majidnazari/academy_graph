<?php

namespace App\GraphQL\Queries\AbsencePresence;

use App\Models\AbsencePresence;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Nuwave\Lighthouse\Execution\ErrorHandler;
use App\Exceptions\CustomException;
use AuthRole;
use Log;

final class GetAbsencePresence
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        // TODO implement the resolver
    }
    function resolveAbsencePresenceAttribute($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo) 
    {
        $branch_id = auth()->guard('api')->user()->branch_id;
        //return AuthRole::CheckAccessibility(); 
        $AbsencePresence= AbsencePresence::where('id',$args['id'])
        ->whereHas('courseSession.course', function ($query) use ($branch_id) {
            if($branch_id!=""){
                $query->where('branch_id', $branch_id);
            }  
             return true;
        })->with('courseSession.course')
        ->first();
        
        return $AbsencePresence;
    }
    public function resolveGetAbsencePresence($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $branch_id = auth()->guard('api')->user()->branch_id;
        // //Log::info(json_encode($context->request()));
        // $response = Http::get(env('REMOTE_SERVER').'getStudent/'.$rootValue['student_id']);
        // //$getPost= Post::find($args['id']);
        // return $response;
        //Log::info("add course session id is:" . $rootValue['course_session_id'] . " and student id is:" . $rootValue['student_id']);
        $AbsencePresence= AbsencePresence::where('course_session_id',$rootValue['course_session_id'])
        ->where('student_id',$rootValue['student_id'])
        ->whereHas('courseSession.course', function ($query) use ($branch_id) {
            if($branch_id!=""){
                $query->where('branch_id', $branch_id);
            }  
             return true;
        })->with('courseSession.course')
        ->first();
        return $AbsencePresence;
    }
}
