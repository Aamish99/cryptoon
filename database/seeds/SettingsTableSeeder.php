<?php

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setting = new Setting();
        $setting->key = 'logo';
        $setting->value = 'logo.png';
        $setting->save();

        $setting = new Setting();
        $setting->key = 'site_title';
        $setting->value = 'Crypto Market';
        $setting->save();

        $setting = new Setting();
        $setting->key = 'site_url';
        $setting->value = 'http://localhost:8000';
        $setting->save();

        $setting = new Setting();
        $setting->key = 'language';
        $setting->value = null;
        $setting->save();

        $setting = new Setting();
        $setting->key = 'copyright';
        $setting->value = null;
        $setting->save();

        $setting = new Setting();
        $setting->key = 'keywords';
        $setting->value = null;
        $setting->save();

        $setting = new Setting();
        $setting->key = 'description';
        $setting->value = null;
        $setting->save();

        $setting = new Setting();
        $setting->key = 'analytics';
        $setting->value = null;
        $setting->save();

        $setting = new Setting();
        $setting->key = 'captcha_status';
        $setting->value = null;
        $setting->save();

        $setting = new Setting();
        $setting->key = 'site_key';
        $setting->value = null;
        $setting->save();

        $setting = new Setting();
        $setting->key = 'facebook';
        $setting->value = null;
        $setting->save();

        $setting = new Setting();
        $setting->key = 'twitter';
        $setting->value = null;
        $setting->save();

        $setting = new Setting();
        $setting->key = 'linkedin';
        $setting->value = null;
        $setting->save();

        $setting = new Setting();
        $setting->key = 'google_plus';
        $setting->value = null;
        $setting->save();

        $setting = new Setting();
        $setting->key = 'instagram';
        $setting->value = null;
        $setting->save();

    }
}
