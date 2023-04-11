<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class ModelUsers extends Model
{
    use HasFactory;
    use Sortable;

    protected $table = 'users';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $sortable = [
        'name', 'alamat',
    ];
}
