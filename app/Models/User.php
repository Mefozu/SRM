<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
<<<<<<< Updated upstream
        'name', 'email', 'password', 'passport_number', 'department', 'position', 'duties', 'is_admin'
=======
        'name', 'email', 'password', 'passport_number', 'department_id', 'position', 'duties', 'is_admin', 'role', 'phone_number', 'age', 'gender', 'status'
>>>>>>> Stashed changes
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

<<<<<<< Updated upstream
=======
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'assigned_to');
    }
>>>>>>> Stashed changes
}
