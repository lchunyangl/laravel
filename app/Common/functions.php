<?php
/**
 * Created by PhpStorm.
 * User: chunyang
 * Date: 2017/8/5
 * Time: 8:59
 */



if (!function_exists('tips')) {
    function tips($message = '', int $error = 0, array $params = [], array $headers = [])
    {
        $params['error'] = $error;
        throw new \App\Exceptions\TipsException($message, $params, $headers);
    }
}