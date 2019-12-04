<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{

    const META_ALLERGIES = 'allergies';
    // const META_AVATAR = 'avatar';
    //
    protected $fillable = [
    	'name',
    	'address',
    	'date_of_birth',
    	'place_of_birth',
    	'gender',
    	'blood',
    	'phone',
    	'parent',
        'allergies',
        'photo'
    ];

    protected $appends = [
        'age',
    ];

    protected $casts = [
        'allergies' => 'array'
    ];

    public function getAgeAttribute()
    {
        if(empty($this->date_of_birth)) return 0;

        return Carbon::parse($this->date_of_birth)->age;
    }

    public function journals()
    {
        return $this->hasMany(Journal::class);
    }
}
