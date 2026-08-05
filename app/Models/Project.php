<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Project extends Model
{

use HasFactory;
protected $fillable = [
    'user_id',
    'title',
    'category',
    'image',
    'github',
    'demo',
    'technology',
    'description',
    'status',
    'is_published',
    'visibility',
];


public function user()
{
    return $this->belongsTo(User::class, 'user_id', 'id');
}
// project can have many ratings
public function ratings()
{
    return $this->hasMany(Rating::class);
}
}
