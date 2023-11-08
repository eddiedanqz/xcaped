<?php

namespace App\Traits;

use App\Models\UserSetting;
use Cache;

trait UserSettings
{
    // get setting value
    public function getSetting($key)
    {
        $settings = $this->getCache();
        $data = $this->searchSetting($key, $settings);
        $value = $data['value'];
        $type = $data['type'];
        switch($type) {
            case 'string':
                return (string) $value;
            case 'boolean':
                return (bool) $value;
            case 'integer':
                return (int) $value;
        }
    }

    private function searchSetting($key, $array, $column = 'key')
    {
        foreach ($array as $k => $val) {
            if ($val[$column] == $key) {
                return $val;
            }
        }

        return null;
    }

    // create-update setting
    public function setSetting($key, $value, $type = 'string')
    {
        $this->storeSetting($key, $value, $type);
        $this->setCache();
    }

    // create-update multiple settings at once
    public function setSettings($data = [])
    {
        foreach ($data as $setting) {
            $key = $setting['key'];
            $value = $setting['value'];
            $type = isset($setting['type']) ? $setting['type'] : 'string';
            $this->storeSetting($key, $value, $type);
        }
        $this->setCache();
    }

    private function storeSetting($key, $value, $type)
    {
        $record = UserSetting::where(['user_id' => $this->id, 'key' => $key])->first();
        if ($record) {
            $record->value = $value;
            $record->type = $type;
            $record->save();
        } else {
            $data = new UserSetting(['key' => $key, 'value' => $value, 'type' => $type]);
            $this->settings()->save($data);
        }
    }

    private function getCache()
    {
        if (Cache::has('user_settings_'.$this->id)) {
            return Cache::get('user_settings_'.$this->id);
        }

        return $this->setCache();
    }

    private function setCache()
    {
        if (Cache::has('user_settings_'.$this->id)) {
            Cache::forget('user_settings_'.$this->id);
        }
        $settings = UserSetting::where('user_id', $this->id)->get()->toArray();
        Cache::forever('user_settings_'.$this->id, $settings);

        return $this->getCache();
    }
}
