<?php

namespace App\Policies;

use App\Models\StudentWarningHistory;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StudentWarningHistoryPolicy
{
    use HandlesAuthorization;
    private $group_access_student_warning_history=array("admin","manager");

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $this->get_accessibility();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\StudentWarningHistory  $studentWarningHistory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, StudentWarningHistory $studentWarningHistory)
    {
        return $this->get_accessibility();
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $this->get_accessibility();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\StudentWarningHistory  $studentWarningHistory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, StudentWarningHistory $studentWarningHistory)
    {
        return $this->get_accessibility();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\StudentWarningHistory  $studentWarningHistory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, StudentWarningHistory $studentWarningHistory)
    {
        return $this->get_accessibility();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\StudentWarningHistory  $studentWarningHistory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, StudentWarningHistory $studentWarningHistory)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\StudentWarningHistory  $studentWarningHistory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, StudentWarningHistory $studentWarningHistory)
    {
        //
    }
    public function get_accessibility()
    {
        $user_role=auth()->guard('api')->user()->group->type;       
        if(in_array($user_role,$this->group_access_student_warning_history))
            return true;
        return false;
    }
}
