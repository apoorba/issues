<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormData extends Model
{
    use HasFactory;

    protected $table = 'form_data';

    protected $fillable = [
        'issue', 'description', 'priority', 'department', 'issuedby', 'status',
    ];

    public function comments(){
        return $this->hasMany (Comment::class);
    }

    public function images(){
        return $this->hasMany(Image::class);
    }
}
