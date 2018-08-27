<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use willvincent\Rateable\Rateable;

class Candidate extends Model
{
    use Rateable;
    protected $table = 'candidate_info';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','url','email','cover_letter','attachment','like_working','ip'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * Set the user's first name.
     *
     * @param  string  $value
     * @return void
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value);
    }

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }
}
