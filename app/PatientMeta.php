<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientMeta extends Model
{
    protected $table = 'patient_meta';

    protected $fillable = [
    	'parent_id',
    	'meta_key',
    	'meta_value'
    ];

    public function patinet()
    {
    	return $this->belongsTo(Patient::class);
    }

    public function setMetaValueAttribute($value)
    {
    	$this->attributes['meta_value'] = is_array($value) ? serialize($value) : $value;
    }

    public function getMetaValueAttribute()
    {
    	return unserialize($this->attributes['meta_value']);
    }
}
