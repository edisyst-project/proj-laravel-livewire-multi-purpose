<?php


function setting($key)
{
    $setting = \Illuminate\Support\Facades\Cache::rememberForever('setting', function (){
        return \App\Models\Setting::first();
    });

    return \App\Models\Setting::first()->{$key};
}
