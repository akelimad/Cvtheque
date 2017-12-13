<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cv extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    // one c.v belongs to juste one user
    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function formations(){
        return $this->hasMany('App\Formation');
    }
    // one c.v has one or many experiences
    public function experiences(){
        return $this->hasMany('App\Experience');
    }

    public function projects(){
        return $this->hasMany('App\Project');
    }

    public function skills(){
        return $this->hasMany('App\Skill');
    }
}
