<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//別忘記這行 關聯 使用者資料表
use App\User as UserEloquent;

class SocialUser extends Model
{
    protected $fillable = [
        'user_id', 'provider_user_id', 'provider',
    ];

    public function user(){
        return $this->belongsTo(UserEloquent::class);
    }
}
