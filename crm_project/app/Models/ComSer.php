<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Services;
use App\Models\Community;

class ComSer extends Model
{
    use HasFactory;
    protected $connection = "pgsql";

    protected $table = "community_service";

    protected $fillable = [
        'ser_id',
        'com_id'
    ];

    public function services()
    {
        return $this->belongsTo(Services::class,'ser_id');
    }

    public function community()
    {
        return $this->belongsTo(Community::class,'com_id');
    }
}
