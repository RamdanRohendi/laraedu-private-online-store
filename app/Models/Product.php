<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function getFotoAttribute($value)
    {
        $path = '/assets/img/default-profile.jpg';

        if ($value) {
            $path = 'uploads/'.$this->user_id.'/products/'.$value;
            return Storage::url($path);
        }

        return $path;
    }
}
