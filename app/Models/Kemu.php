<?php

namespace App\Models;

use App\Common\Common;
use Illuminate\Database\Eloquent\Model;

class Kemu extends Model
{
    use Common;
    protected $table = 'kemu';
    protected $primaryKey = 'kemu_id';

    public function child()
    {
        return $this->hasMany(Kemu::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Kemu::class, 'parent_id');
    }
}
