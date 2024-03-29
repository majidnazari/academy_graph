<?php

namespace App\GraphQL\Queries\User;

use App\Models\Branch;
use App\Models\User;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use AuthRole;
use GraphQL\Error\Error;

final class GetUsers
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        // TODO implement the resolver
    }
    public function resolveUser($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $all_branch_id=Branch::where('deleted_at', null )->pluck('id');
        $branch_id=Branch::where('deleted_at', null )->where('id',auth()->guard('api')->user()->branch_id)->pluck('id');
        $branch_id = count($branch_id) == 0 ? $all_branch_id   : $branch_id ;  
       
        if( AuthRole::CheckAccessibility("Users")){
            $user=User::where('deleted_at', null)
            ->whereIn('branch_id',$branch_id)
            ->whereHas('group',function ($query) use($args){
                if(isset($args["group_id"]))
                    $query->where("groups.id",$args["group_id"]);
                else
                  return true;
            })       
            ->with('group');
        
            
            return $user;
        }
        $User =User::where('deleted_at',null)
        ->where('id',-1);       
        return  $User;
    }

}
