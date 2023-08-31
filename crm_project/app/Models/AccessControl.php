<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AccessControl extends Model
{
    use HasFactory;

    protected $connection = "pgsql";
    protected $table = "access_control";

    protected $with = ["userAccessControls"];

    protected $fillable = ["id","name","description","created_at","updated_at"];

    public function userAccessControls(): HasMany
    {
        return $this->hasMany(AccessControl::class);
    }
}
