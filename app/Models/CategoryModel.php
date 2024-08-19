<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use mysql_xdevapi\Table;

class CategoryModel extends Model
{
    protected $table = 'categories';
    use HasFactory;
}
