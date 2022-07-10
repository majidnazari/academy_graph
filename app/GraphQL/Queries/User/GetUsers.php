<?php

namespace App\GraphQL\Queries\User;

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
    // function resolveUserAttribute($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    // {
    //     $users= User::paginate(2);       
    //     return $users;
    // }
    public function resolveUser($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
    //    $user= User::where('deleted_at', null);//->orderBy('id','desc');
    //    return $user;
            // if (! Gate::allows('GetAllUsers')) {
            //     abort(403);
            // }
        if( AuthRole::CheckAccessibility()){
            $user=User::where('deleted_at', null)->whereHas('group',function ($query) use($args){
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
