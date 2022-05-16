<?php

namespace App\GraphQL\Mutations\AzmoonResult;

use App\Models\AzmoonResult;
use GraphQL\Type\Definition\ResolveInfo;
use App\Models\GroupUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Joselfonseca\LighthouseGraphQLPassport\Events\PasswordUpdated;
use Joselfonseca\LighthouseGraphQLPassport\Exceptions\ValidationException;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class CreateAzmoonResult
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
        $AzmoonResult=[
            'student_id' => $args['student_id'],
            "result_score" => $args['result_score']            
        ];
        $AzmoonResult_result=AzmoonResult::create($AzmoonResult);
        return $AzmoonResult_result;
    }
}
