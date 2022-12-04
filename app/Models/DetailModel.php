<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailModel extends Model
{
    use HasFactory;

    protected $table = 'detail_data';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_user',
        'alamat',
        'tempat_lahir',
        'tanggal_lahir',
        'id_agama',
        'foto_ktp',
        'umur'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function agama()
    {
        return $this->belongsTo(AgamaModel::class, 'id_agama', 'id');
    }
}
