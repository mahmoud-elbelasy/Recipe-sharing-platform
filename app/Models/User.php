<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
        'created_at',
        "updated_at"
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function friendsTo(){
        return $this->belongsToMany(User::class,'friends','user_id','friend_id')
        ->withPivot('accepted')
        ->withTimestamps();
    }

    public function friendsFrom(){
        return $this->belongsToMany(User::class,'friends','friend_id','user_id')
        ->withPivot('accepted')
        ->withTimestamps();
    }

    public function pendingFriendsTo(){
        return $this->friendsTo()->wherePivot('accepted',false);
    }
    public function pendingFriendsFrom(){
        return $this->friendsFrom()->wherePivot('accepted',false);
    }
    public function acceptedFriendsTo(){
        return $this->friendsTo()->wherePivot('accepted',true);
    }
    public function acceptedFriendsFrom(){
        return $this->friendsFrom()->wherePivot('accepted',true);
    }

    public function friends(){
        return $this->acceptedFriendsFrom->merge($this->acceptedFriendsTo);
    }
}
