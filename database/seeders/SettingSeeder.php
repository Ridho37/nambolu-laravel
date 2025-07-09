<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'site_name', 'value' => 'Nambolu'],
            ['key' => 'site_tagline', 'value' => 'Freshly Baked, Made with Love'],
            ['key' => 'store_address', 'value' => 'Jl. Ring Road Utara, Condongcatur, Sleman'],
            ['key' => 'store_phone', 'value' => '0895-4121-74058'],
            ['key' => 'store_email', 'value' => 'order@nambolu.com'],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}