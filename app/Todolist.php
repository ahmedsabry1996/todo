<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Todolist extends Model
{
    //
    use softDeletes;
    protected $fillable = ['user_id','todo'];
    protected $dates = ['deleted_at'];
    
    public function user(){
        return $this->belongsTo('App\User');
    }
}
