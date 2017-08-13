<?php

namespace App\Models;

use App\Common\Common;
use Illuminate\Database\Eloquent\Model;

class Bumen extends Model
{
    use Common;
    protected $table = 'bumen';
    protected $primaryKey = 'bumen_id';
}
