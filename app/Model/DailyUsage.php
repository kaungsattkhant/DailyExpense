<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DailyUsage extends Model
{
    protected $fillable=['user_id','title','status','amount','date'];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
