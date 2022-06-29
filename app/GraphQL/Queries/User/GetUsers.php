<?php

namespace App\GraphQL\Queries\User;

use App\Models\User;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

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
    // function resolveUserAttribute($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    // {
    //     $users= User::paginate(2);       
    //     return $users;
    // }
    public function resolveUser($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
    //    $user= User::where('deleted_at', null);//->orderBy('id','desc');
    //    return $user;
        
            $user=User::where('deleted_at', null)->whereHas('groups',function ($query) use($args){
                if(isset($args["group_id"]))
                    $query->where("groups.id",$args["group_id"]);
                else
                  return true;
            })       
            ->with('groups');
        
            
            return $user;
    }

}
