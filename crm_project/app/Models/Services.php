<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Community;

class Services extends Model
{
    use HasFactory;
    protected $connection = "pgsql";

    protected $table = "services";

    protected $fillable = ['Name'];

    public function Comunities()
    {
        return $this->belongsToMany(Community::class ,'community_service' ,'ser_id','com_id');
    }

}
