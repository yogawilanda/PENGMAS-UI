<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusPekerjaan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    public function dataDiris()
    {
        return $this->hasMany(DataDiri::class, 'id_status_pekerjaan');
    }
}
