<?php

namespace App;

use App\Utils\MetadataChild;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
	use MetadataChild;

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
    ];

    protected $appends = [
        'age',
        'allergies',
    ];

    public function getAgeAttribute()
    {
        if(empty($this->date_of_birth)) return 0;

        return Carbon::parse($this->date_of_birth)->age;
    }

    public function getAllergiesAttribute()
    {
        $allergies = $this->meta()
        ->where('meta_key', self::META_ALLERGIES)
        ->first();
        return isset($allergies) ? $allergies->meta_value : [];
    }

    public function getMetaData()
    {
    	# code...
    }



    public function meta()
    {
    	return $this->hasMany(PatientMeta::class);
    }

    public function storeMeta(array $items)
    {
        // dd($items);
        $models = collect($items)->map(function($item, $key) {
            return new PatientMeta(['meta_key' => $key, 'meta_value' => $item]);
        });

        $this->meta()->saveMany($models);
        // dd($models);

        // foreach ($items as $key => $item) {
        //     $models = new PatientMeta(['meta_key' => $key, 'meta_value' => $item]);
        // }

    }
}
