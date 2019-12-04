<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    protected $fillable = [
    	'name'
    ];

    public function journals()
    {
    	return $this->belongsToMany(Journals::class)
    		->using(JournalMedication::class);;
    }
}
