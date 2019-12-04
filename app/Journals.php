<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Journals extends Model
{
    protected $fillable = [
    	'patient_id',
    	'action',
    	'note',
    	'anamnese',
    	'diagnosis'
    ];

    protected $cast = [
    	'anamnese' => 'array',
    	'diagnosis' => 'array',
    	// 'note' => 'array',
    	// 'action' => 'array'
    ];

    public function medications()
    {
    	return $this->belongsToMany(Medication::class)
    }
}
