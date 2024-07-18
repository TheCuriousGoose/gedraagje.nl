<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'locale',
        'active'
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
        'password' => 'hashed',
    ];

    public function getProfileImage()
    {
        if ($this->hasMedia('avatar')) {
            return $this->getMedia('avatar')->first()->getUrl('thumbnail');
        } else {
            return asset('imgs/default-avatar.jpg');
        }
    }

    public function getOriginalImage()
    {
        if ($this->hasMedia('avatar')) {
            return $this->getMedia('avatar')->first()->getUrl('original');
        } else {
            return asset('imgs/default-avatar.jpg');
        }
    }

    public function saveProfilePicture($file)
    {
        $this->clearMediaCollection('avatar');
        $this->addMedia($file)->toMediaCollection('avatar');

        return $this->getMedia('avatar')->first()->getUrl('thumbnail');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumbnail')
            ->keepOriginalImageFormat()
            ->width(96)
            ->height(96)
            ->sharpen(10)
            ->nonQueued();


        $this->addMediaConversion('original')
            ->keepOriginalImageFormat()
            ->width(368)
            ->height(232)
            ->sharpen(10);
    }
}
