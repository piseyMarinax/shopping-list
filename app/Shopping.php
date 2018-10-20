<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Shopping extends Model
{

    protected $fillable = [
        'user_id', 'title','description','image'
    ];

    protected $table = "shopping_list";

    /**
     * Get register user
     */
    public function user()
    {
        return $this->hasOne('\App\User', 'id', 'user_id');
    }

    public function getUserName()
    {
        return $this->user->name;
    }
    public function getUserEmail()
    {
        return $this->user->email;
    }

}
