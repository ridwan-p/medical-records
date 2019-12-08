<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    protected $fillable = [
    	'patient_id',
    	'therapy',
    	'anamnese',
    	'diagnosis',
    	'note',
    ];

    protected $casts = [
    	'therapy' => 'array',
    	'anamnese' => 'array',
    	'diagnosis' => 'array',
    ];

    public function medications()
    {
    	return $this->belongsToMany(Medication::class)
    		->using(JournalMedication::class)
    		->withPivot(['note'])
            ->withTimestamps();
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
}
