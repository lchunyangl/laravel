<?php
/**
 * Created by PhpStorm.
 * User: chunyang
 * Date: 2017/8/12
 * Time: 14:46
 */

namespace App\Common;


trait Common
{

    public function get_key($fh)
    {
        if (!empty($fh)) {
            return $fh . '.' . $this->primaryKey;
        }
        return $this->primaryKey;
    }

}