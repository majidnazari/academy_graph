<?php

namespace App\GraphQL\Mutations\Fault;

use App\Models\Fault;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Joselfonseca\LighthouseGraphQLPassport\Events\PasswordUpdated;
use Joselfonseca\LighthouseGraphQLPassport\Exceptions\ValidationException;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class UpdateFault
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
        $Fault=Fault::find($args['id']);
        
        if(!$Fault)
        {
            return [
                'status'  => 'Error',
                'message' => __('cannot update Fault'),
            ];
        }
        $Fault_filled= $Fault->fill($args);
        $Fault->save(); 
        return $Fault;
        
    }
}
