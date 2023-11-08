<?php

use Spatie\LaravelSettings\Models\SettingsProperty as BaseSettingsProperty;

class SettingsProperty extends BaseSettingsProperty
{
    use UsesTenantConnection;
}
