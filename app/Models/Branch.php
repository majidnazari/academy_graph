<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Branch extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    use SoftDeletes;
    protected $fillable=[
        "user_id_creator",
        "name"
    ];

    public function user_creator()
    {
        return $this->belongsTo(User::class,"user_id_creator");
    }

    // public function user_branch()
    // {
    //     return $this->hasmany(User::class);
    // }
    
}
