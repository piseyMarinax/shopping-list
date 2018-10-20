<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class item extends Model
{
    protected $fillable = [
        'shhping_list_id','title', 'description','create_by','update_by','complted_at'
    ];

    /**
     * Get register user
     */
    public function userCreate()
    {
        return $this->hasOne('\App\User', 'id', 'create_by');
    }

    public function getUserCreateName(){
        return $this->userCreate->name;
    }

    /**
     * Get register user
     */
    public function userUpdate()
    {
        return $this->hasOne('\App\User', 'id', 'update_by');
    }

    public function getUserUpdateName(){
        return $this->userUpdate->name;
    }
}
