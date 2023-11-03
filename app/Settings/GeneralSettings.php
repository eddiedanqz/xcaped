<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public string $commission;

    public static function group(): string
    {
        return 'general';
    }
}
