<?php

namespace App\GraphQL\Mutations\CourseSession;

use App\Models\CourseSession;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Joselfonseca\LighthouseGraphQLPassport\Events\PasswordUpdated;
use Joselfonseca\LighthouseGraphQLPassport\Exceptions\ValidationException;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class DeleteCourseSession
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        // TODO implement the resolver
    }
    public function resolver($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        $user_id=auth()->guard('api')->user()->id;
        $args["user_id_creator"]=$user_id;
        $CourseSession=CourseSession::find($args['id']);
        
        if(!$CourseSession)
        {
            return [
                'status'  => 'Error',
                'message' => __('cannot delete CourseSession'),
            ];
        }
        $CourseSession_result= $CourseSession->delete();        
       
        return $CourseSession;
        
    }
    
}
