<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

      // roles for out users
      const ROLE_ADMIN = 'ADMIN';
      const ROLE_EDITOR = 'EDITOR';
      const ROLE_USER = 'USER';
  
      const ROLES = [
          self::ROLE_ADMIN => 'Admin',
          self::ROLE_EDITOR => 'Editor',
          self::ROLE_USER => 'User',
      ];

      public function canAccessPanel(Panel $panel): bool
      {
          return $this->isAdmin() || $this->isEditor();
      }

      public function isAdmin()
      {
        return $this->role === self::ROLE_ADMIN ;
      }
      public function isEditor()
      {
        return $this->role === self::ROLE_EDITOR;
      }


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'email', 'password', 'role'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['password', 'remember_token', 'two_factor_recovery_codes', 'two_factor_secret'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = ['profile_photo_url'];
    

    public function post()
    {
        return $this->hasMany('App\Models\Post');
    }

    public function likes()
    {
        return $this->belongsToMany('App\Models\Post', 'post_like');
    }

    public function hasLiked($id)
    {
        return $this->likes()
            ->where('post_id', $id)
            ->exists();
    }

    public function comment()
    {
        return $this->hasMany('App\Models\Comment');
    }
}
