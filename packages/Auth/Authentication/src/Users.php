<?php

namespace Auth\Authentication;

use Laravel\Passport\HasApiTokens;
 
use Illuminate\Notifications\Notifiable;
 
use Illuminate\Foundation\Auth\User as Authenticatable;
 
 
 
class Users extends Authenticatable
 
{
 
   use HasApiTokens, Notifiable;
 
 
 
   /**
 
    * The attributes that are mass assignable.
 
    *
 
    * @var array
 
    */
 
   protected $fillable = [
 
       'user_firstname', 'user_email', 'user_password',
 
   ];
 
 
 
   /**
 
    * The attributes that should be hidden for arrays.
 
    *
 
    * @var array
 
    */
 
   protected $hidden = [
 
       'user_password', 'remember_token',
 
   ];
 
}