<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Services;

class Community extends Model
{
    use HasFactory;

    protected $connection = "pgsql";

    protected $table = "community";

    protected $fillable = [
        'Name',
        'user_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function services()
    {
        return $this->belongsToMany(Services::class ,'community_service' ,'com_id','ser_id');
    }

}
