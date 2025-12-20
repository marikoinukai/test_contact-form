<?php

namespace App\Models;

// 修正ポイント1: 継承元を Authenticatable に変更するための use 宣言
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    
        protected $fillable = [
           'name',
           'email',
           'password'
        ];
}
