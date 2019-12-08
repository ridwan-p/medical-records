<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    protected $fillable = [
    	'patient_id',
    	'therapy',
    	'note',
    	'anamnese',
    	'diagnosis'
    ];

    protected $cast = [
    	'therapy' => 'array',
    	'anamnese' => 'array',
    	'diagnosis' => 'array',
    	// 'note' => 'array',
    ];

    public function medications()
    {
    	return $this->belongsToMany(Medication::class)
    		->using(JournalMedication::class)
    		->withPivot(['note']);
    }
}
