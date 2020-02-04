<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    protected $fillable = [
    	'patient_id',
    	'physical_report',
    	'anamnese',
    	// 'diagnosis',
    	'note',
    ];

    protected $casts = [
    	'physical_report' => 'array',
    	'anamnese' => 'array',
    	// 'diagnosis' => 'array',
    ];

    // protected $dates = [
    //     'created_at',
    //     'updated_at',
    // ];

    public function medications()
    {
    	return $this->belongsToMany(Medication::class)
    		->using(JournalMedication::class)
    		->withPivot(['note'])
            ->withTimestamps();
    }

    public function diagnosis()
    {
        return $this->belongsToMany(Diagnose::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function storeToMany($relations)
    {
        foreach ($relations as $key => $items) {
            $ids = [];

            foreach ($items as $item) {
                if(is_integer($item)) {
                    $ids[$item] = $item;
                } else {
                    $model = $this->{$key}()->getModel();
                    $model = $model->firstOrNew($item);
                    $model->fill($item);
                    $model->save();
                    $ids[$model->id] = $item['pivot'] ?? [];
                }
            }
            $this->{$key}()->sync($ids);
        }
    }

    public function getPhysicalReportAttribute($item)
    {
        return isset($item) ? json_decode($item) : "";
    }
}
