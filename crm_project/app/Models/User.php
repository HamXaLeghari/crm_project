<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use \Laravel\Passport\HasApiTokens, HasFactory, Notifiable;

    protected $connection = "pgsql";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "id",
        'first_name',
        "last_name",
        "age",
        'email',
        "phone",
        "profile_image",
        "bio",
        "description",
        'password',
       // "is_locked",
        "role_id"
    ];

    /**
     * @param Request $request
     * @param array $input
     * @return bool|string
     */
    public static function saveProfileImage(Request $request, array &$input): bool|string
    {
        //   $role = Role::query()->select()->where("name","=","root")->get();

        if (!Storage::disk('public')->exists("/profile_images")) {
            Storage::disk('public')->makeDirectory("/profile_images");
        }

        $image_path = "";

        if ($request->exists("profile_image")) {
            $image_path = Storage::disk('public')->put("/profile_images", $input["profile_image"], 'public');
            unset($input["profile_image"]);
        }
        return $image_path;
    }

    public function getProfileImageAttribute($value){
        return url($value);
    }
    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    public function communities()
    {
        return $this->hasMany(Community::class);
    }

    protected $with = ["role"];

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

    public function userAccessControls(): HasMany
    {
        return $this->hasMany(UserAccessControl::class);
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class,"role_id");
    }


}
