<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class Patient extends Model
{
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
        'allergies' => 'array',
        'photo' => 'array',
        'date_of_birth' => 'date'
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

    public function latestJournals()
    {
        return $this->journals()->latest()->first();
    }

    public function setPhotoAttribute($photo)
    {
        $this->storePhoto($photo);
    }

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
}
