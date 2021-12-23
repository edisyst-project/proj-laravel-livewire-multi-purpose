<?php

namespace App;

use App\Models\Setting;

class NullSetting extends Setting
{
    protected $attributes = [
        'site_name'        => 'Default site_name',
        'site_email'       => 'default@default.com',
        'site_title'       => 'Default site_title',
        'footer_text'      => 'Default footer_text',
        'sidebar_collapse' => false,
    ];
}
