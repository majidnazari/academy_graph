<?php

namespace App\AuthFacade;
use App\Models\User;
use Log;

class CheckAuth
{
    private $admin_group=array("admin");
    private $manager_group=array("manager");
    private $financial_group=array("financial");
    private $acceptor_group=array("acceptor");
    private $teacher_group=array("teacher"); 
    private $group_access=array(
        "AbsencePresence" => array( "admin","manager","acceptor"),
        "Lesson" =>array ( "admin","manager"),
        "Fault" => array("admin","manager"),
        "Year" =>array ("admin"),
        "CourseSession" =>array ("admin","manager"),
        "Course" => array("admin","manager"),
        "CourseStudent" => array("admin"),
        "Users" => array("admin","manager"), 
        "BranchClassRooms" => array("admin","manager"), 
        
        
       
    );
    
    public function CheckAccessibility(string $actionName){
        $user_role=auth()->guard('api')->user()->group->type;   
        //Log::info("role is:".$user_role . "   class name is:" .$actionName );  
        if(in_array( $user_role,$this->group_access[$actionName])){
            //Log::info("role is:".$user_role . "   class name is:" .$actionName );
            return true;
        }
           
        return false;
    }

   
    // public function GetRole(int $user_id){
    //     $user_group=User::where('deleted_at',null)
    //     ->whereHas('group', function($query) use($user_id) {
    //        // $q->where('group_id','=',1)
    //         $query->where('user_id',$user_id); 
    //     }) 
    //     ->first();
    //     if($user_group)
    //     {
    //         return $user_group->group->type;
    //     }
    //     return "there is no type for this user";

    // }
} 