<?php

namespace App\Models;

use App\Activation;
use Cartalyst\Sentinel\Users\EloquentUser as SentinelUser;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;

class User extends SentinelUser
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'first_name', 'last_name', 'username', 'email', 'password', 'phone_number'
    ];
    
    protected $loginNames = ['email', 'username'];

    protected $guarded = ['id'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
  
  public function role()
  {
    return $this->hasOne(Role::class);
  }
  public function questions()
  {
    return $this->hasMany(Question::class);
  }
  
  public function reminders()
  {
    return $this->hasMany(Reminder::class);
  }
  
  public function activation()
  {
    return $this->hasOne(Activation::class);
  }
}
