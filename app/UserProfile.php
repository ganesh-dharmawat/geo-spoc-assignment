<?php

namespace App;

use Actuallymab\LaravelComment\Commentable;
use Illuminate\Database\Eloquent\Model;
use willvincent\Rateable\Rateable;

class UserProfile extends Model
{
    use Rateable,Commentable;
    protected $mustBeApproved = false;
    protected $table = 'user_profiles';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','url','email','cover_letter','attachment','like_working','ip','user_id'];

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
