<?php
namespace Database\Seeders;

use App\Models\WeddingSetting;
use Illuminate\Database\Seeder;

class WeddingSettingSeeder extends Seeder
{
    public function run()
    {
        $settings = [
            // Hero Section
            ['key' => 'hero_title', 'value' => 'The Wedding Of', 'type' => 'text'],
            ['key' => 'hero_subtitle', 'value' => 'Syachrul & Dhinda', 'type' => 'text'],
            ['key' => 'hero_image', 'value' => '', 'type' => 'image'],

            // Bride & Groom
            ['key' => 'groom_name', 'value' => 'Syachrul Ramadhan', 'type' => 'text'],
            ['key' => 'groom_parents', 'value' => 'Travis Sekut & Kylie Jannar', 'type' => 'text'],
            ['key' => 'groom_address', 'value' => 'Jl. Kebenaran', 'type' => 'text'],
            ['key' => 'groom_photo', 'value' => '', 'type' => 'image'],

            ['key' => 'bride_name', 'value' => 'Dhinda Oktavia Ramadhansi', 'type' => 'text'],
            ['key' => 'bride_parents', 'value' => 'Tatang & Siti', 'type' => 'text'],
            ['key' => 'bride_address', 'value' => 'Jl. Ombak', 'type' => 'text'],
            ['key' => 'bride_photo', 'value' => '', 'type' => 'image'],

            // Event Info
            ['key' => 'event_date', 'value' => '2025-04-16', 'type' => 'date'],
            ['key' => 'event_time', 'value' => '19:30', 'type' => 'time'],
            ['key' => 'event_end_time', 'value' => '22:00', 'type' => 'time'],
            ['key' => 'event_venue', 'value' => 'Gran Melia', 'type' => 'text'],
            ['key' => 'event_address', 'value' => 'Gran Melia Jakarta, Jl. HR Rasuna Said Kav X-0, Kuningan, Jakarta Selatan', 'type' => 'textarea'],

            // Quote
            ['key' => 'home_quote', 'value' => 'Di antara tanda-tanda (kebesaran)-Nya ialah bahwa Dia menciptakan pasangan-pasangan untukmu dari (jenis) dirimu sendiri agar kamu merasa tenteram kepadanya.', 'type' => 'textarea'],
            ['key' => 'home_quote_source', 'value' => 'QS. Ar-Rum Ayat 21', 'type' => 'text'],
        ];

        foreach ($settings as $setting) {
            WeddingSetting::create($setting);
        }
    }
}
