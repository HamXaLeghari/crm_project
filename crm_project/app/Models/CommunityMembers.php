<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityMembers extends Model
{
    use HasFactory;

    protected $connection = "pgsql";

    protected $table = "community_members";
    protected $fillable = [
        'first_name',
        "last_name",
        'email',
        'password',
        'community_id'
    ];
}
