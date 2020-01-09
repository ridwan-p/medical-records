<?php

namespace App;

use App\Repositories\Code;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class Patient extends Model
{
    protected $fillable = [
        'code',
    	'name',
    	'address',
    	'date_of_birth',
    	'place_of_birth',
    	'gender',
    	'blood',
    	'phone',
    	'parent',
        'allergies',
        'photo',
        'age_of_birth'
    ];

    protected $appends = [
        'age',
    ];

    protected $casts = [
        'allergies' => 'array',
        'photo' => 'array',
        'date_of_birth' => 'date:d M Y'
    ];



    public function journals()
    {
        return $this->hasMany(Journal::class);
    }

    public function latestJournals()
    {
        return $this->journals()->latest()->first();
    }

    // accessor

    public function getAllergiesAttribute($allergies)
    {
        return json_decode($allergies) ?? [];
    }

    public function getAgeAttribute()
    {
        if(empty($this->date_of_birth)) return '';

        return Carbon::parse($this->date_of_birth)->age;
    }

    // mutator
    public function setPhotoAttribute($photo)
    {
        $this->storePhoto($photo);
    }

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = ucwords($name);
    }

    public function setAgeOfBirthAttribute($age)
    {
        if(empty(request()->date_of_birth)) {
            $time = strtotime("-{$age} year", time());
            $this->attributes['date_of_birth'] = date("Y-m-d", $time);
        }
    }

    // other
    public function deletePhoto()
    {
        $id = $this->attributes['id'] ?? 'undefined';
        if (!empty($account->photo)) {
            Storage::delete("public/photo/{$id}/s-{$this->attributes['photo']}");
            Storage::delete("public/photo/{$id}/m-{$this->attributes['photo']}");
            Storage::delete("public/photo/{$id}/l-{$this->attributes['photo']}");
        }

    }

    public function storePhoto($photo)
    {
        if (!empty($this->attributes['photo'])) {
            $this->deletePhoto();
        }

        $this->savePhoto($photo);
    }

    public function savePhoto($photo)
    {
        $file_name = Str::uuid() . '.' . $photo->extension();

        Storage::disk('public')->makeDirectory("photo", 0755, true);

        $directory = "app/public/photo";
        // Resize small
        Image::make($photo)->widen(100)->save(storage_path("{$directory}/s-{$file_name}"));

        // resize medium
        Image::make($photo)->widen(200)->save(storage_path("{$directory}/m-{$file_name}"));

        // resize large
        Image::make($photo)->widen(400)->save(storage_path("{$directory}/l-{$file_name}"));

        $this->attributes['photo'] = json_encode([
            'small' => "storage/photo/s-{$file_name}",
            'medium' => "storage/photo/m-{$file_name}",
            'large' => "storage/photo/s-{$file_name}",
        ]);
    }

    public function generateCode($code_key = null)
    {
        $key = substr(($code_key ?? $this->name), 0, 1);
        $this->attributes['code'] = Code::generate(ucfirst($key));

        return $this->code;
    }
}
