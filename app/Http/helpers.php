<?php

use App\Models\Setting;

if (!function_exists('setting')) {
    function setting($key)
    {
        $array = Setting::where('key', $key)->first();
        if(!empty($array)){
            return $array->value;
        }
        return null;
    }
}



?>
