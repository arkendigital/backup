<?php

use Illuminate\Database\Seeder;
use App\Setting;

class SettingSeeder extends Seeder
{
    protected $defaultItems = [
        'site_name' => 'Example.com',
        'site_version' => '2.0.0a',
        'user_redirect' => '/discussion',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->defaultItems as $key => $value) {
            Setting::create([
                    'key'       => $key,
                    'value'     => $value,
            ]);
        }
    }
}
