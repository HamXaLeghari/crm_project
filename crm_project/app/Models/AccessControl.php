<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AccessControl extends Model
{
    use HasFactory;

    protected $primaryKey = "access_control_id";
    protected $connection = "pgsql";
    protected $table = "access_control";

    protected $fillable = ["access_control_id","name","description","created_at","updated_at"];

    public function userAccessControls()
    {
       return $this->hasMany(AccessControl::class);
    }
}
