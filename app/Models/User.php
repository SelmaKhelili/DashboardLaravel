<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\ProfileView; //Or the equivalent of where your models resides

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function incrementProfileView(){
    
        $profileViewModel = new ProfileView;
    
        $profileViewModel->user_id = $this->id;
        $profileViewModel->save();
        $profileViews = $this->profileViews->groupBy(function ($item) {
            return $item->created_at->format('F Y');
        });

        return view('profile.profile', compact('user', 'profileViews'));
    }
    /*public function profileViews(){
    
        return $this->hasMany('App\Models\ProfileView', 'user_id');
    }*/
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
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    
}
