<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, SoftDeletes;
  protected $fillable = [
    'name',
    'status',
    'email',
    'password',
    'plan',
    'membership_status',
    'membership_expiry',
];
public function projects()
{
    return $this->hasMany(Project::class);
}

// user can have many ratings
public function ratings()
{
    return $this->hasMany(Rating::class);
}

public function employee()
{
    return $this->hasOne(Employee::class);
}
public function invoices()
{
    return $this->hasMany(Invoice::class);
}
}
