<?php

namespace App\GraphQL\Queries\User;

use App\AuthFacade\CheckAuthFacade;
use App\Models\User;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Nuwave\Lighthouse\Execution\ErrorHandler;
use App\Exceptions\CustomException;
use App\Models\Branch;
use App\Models\Group;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Route;
use AuthRole;

final class GetUser //implements ErrorHandler
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, Closure $next)
    {
        // TODO implement the resolver
        //return User::find($args['id']);
       // return null;      
       
    }
    function resolveUserId($id): User
    {  
        $all_branch_id=Branch::where('deleted_at', null )->pluck('id');
        $branch_id=Branch::where('deleted_at', null )->where('id',auth()->guard('api')->user()->branch_id)->pluck('id');
        $branch_id = count($branch_id) == 0 ? $all_branch_id   : $branch_id ;      
        $user= User::where('id',$id)->whereIn('branch_id',$branch_id);
        return $user;
    }
    
    function resolveUserAttribute($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)//: Builder
    {
        $all_branch_id=Branch::where('deleted_at', null )->pluck('id');
        $branch_id=Branch::where('deleted_at', null )->where('id',auth()->guard('api')->user()->branch_id)->pluck('id');
        $branch_id = count($branch_id) == 0 ? $all_branch_id   : $branch_id ; 
        $user= User::where('id',$args['id'])->whereIn('branch_id',$branch_id);
            return $user;       
    }
}
