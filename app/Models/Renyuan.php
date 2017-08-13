<?php

namespace App\Models;

use App\Common\Common;
use Illuminate\Database\Eloquent\Model;

class Renyuan extends Model
{
    use Common;
    protected $table = 'renyuan';
    protected $primaryKey = 'renyuan_id';

    public function bumen()
    {
        return $this->belongsTo(Bumen::class, 'bumen_id');
    }
}
