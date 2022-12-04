<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgamaModel extends Model
{
    use HasFactory;

    public $table = 'agama';
    protected $primaryKey = 'id';
    protected $fillable = ['nama_agama'];

    public function detail()
    {
        return $this->hasMany(DetailModel::class, 'id_agama', 'id');
    }
}
