<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class ModelPengadilan extends Model
{
    use HasFactory;
    use Sortable;

    protected $table = 'berkas';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $sortable = [
        'nik', 'nama', 'alamat',
    ];
}
