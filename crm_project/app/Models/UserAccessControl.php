<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserAccessControl extends Model
{
    use HasFactory;


    protected $connection = "pgsql";

    protected $table = "user_access_control";

    protected $with = ["user","accessControl"];
    protected $fillable = ["id","name","description","created_at","updated_at","user_id","access_control_id"];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,"user_id");
    }

    public function accessControl(): BelongsTo
    {
        return $this->belongsTo(AccessControl::class,"access_control_id");
    }

}
