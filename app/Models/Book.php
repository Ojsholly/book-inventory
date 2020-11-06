<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use BinaryCabin\LaravelUUID\Traits\HasUUID;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory, SoftDeletes, HasUUID;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'author',
        'path',
        'front_cover',
        'description',
        'publisher',
        'date_published',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function get_front_cover()
    {

        return Storage::url($this->front_cover);
    }

}
