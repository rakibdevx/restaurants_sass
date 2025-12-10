<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    public function run()
    {
        $settings = [

            // ------- BASIC INFO -------
            ['key' => 'site_title', 'value' => 'My Awesome Website'],
            ['key' => 'site_url', 'value' => 'main.com'],
            ['key' => 'site_tagline', 'value' => 'Best Website Ever'],
            ['key' => 'site_logo', 'value' => 'logo.png'],
            ['key' => 'site_dark_logo', 'value' => 'logo.png'],
            ['key' => 'site_favicon', 'value' => 'favicon.ico'],

            ['key' => 'support_email', 'value' => 'support@example.com'],
            ['key' => 'support_phone', 'value' => '+8801555000000'],
            ['key' => 'site_address', 'value' => 'Dhaka, Bangladesh'],

            // ------- SOCIAL LINKS -------
            ['key' => 'facebook_url', 'value' => 'https://facebook.com'],
            ['key' => 'twitter_url', 'value' => 'https://twitter.com'],
            ['key' => 'instagram_url', 'value' => 'https://instagram.com'],
            ['key' => 'linkedin_url', 'value' => 'https://linkedin.com'],
            ['key' => 'youtube_url', 'value' => 'https://youtube.com'],
            ['key' => 'whatsapp_number', 'value' => '+8801777000000'],
            ['key' => 'telegram_url', 'value' => 'https://t.me/example'],
            ['key' => 'tiktok_url', 'value' => 'https://tiktok.com/@example'],

            // ------- SEO SETTINGS -------
            ['key' => 'meta_title', 'value' => 'Best Website Meta Title'],
            ['key' => 'meta_description', 'value' => 'Meta description for the website'],
            ['key' => 'meta_keywords', 'value' => 'website, blog, ecommerce'],
            ['key' => 'og_title', 'value' => 'OG Title'],
            ['key' => 'og_description', 'value' => 'OG Description'],
            ['key' => 'og_image', 'value' => 'og.jpg'],
            ['key' => 'google_analytics_id', 'value' => 'UA-000000-2'],
            ['key' => 'google_tag_manager_id', 'value' => 'GTM-XXXXXX'],
            ['key' => 'bing_verification', 'value' => 'bing-code'],

            // ------- APP SETTINGS -------
            ['key' => 'timezone', 'value' => 'Asia/Dhaka'],
            ['key' => 'currency', 'value' => 'BDT'],
            ['key' => 'currency_symbol', 'value' => '৳'],
            ['key' => 'date_format', 'value' => 'd-m-Y'],
            ['key' => 'time_format', 'value' => 'H:i A'],
            ['key' => 'default_language', 'value' => 'en'],
            ['key' => 'multi_language', 'value' => 'true'],

            // ------- PAYMENT SETTINGS -------
            ['key' => 'paypal_status', 'value' => 'active'],
            ['key' => 'paypal_client_id', 'value' => 'xxxxx'],
            ['key' => 'paypal_secret', 'value' => 'xxxxx'],

            ['key' => 'stripe_status', 'value' => 'active'],
            ['key' => 'stripe_key', 'value' => 'stripe_key'],
            ['key' => 'stripe_secret', 'value' => 'stripe_secret'],

            ['key' => 'sslcommerz_status', 'value' => 'inactive'],
            ['key' => 'sslcommerz_store_id', 'value' => 'store_id'],
            ['key' => 'sslcommerz_store_password', 'value' => 'password'],

            // ------- MAIL SETTINGS -------
            ['key' => 'mail_driver', 'value' => 'smtp'],
            ['key' => 'mail_host', 'value' => 'smtp.mailtrap.io'],
            ['key' => 'mail_port', 'value' => '2525'],
            ['key' => 'mail_username', 'value' => 'username'],
            ['key' => 'mail_password', 'value' => 'password'],
            ['key' => 'mail_encryption', 'value' => 'tls'],
            ['key' => 'mail_from_address', 'value' => 'no-reply@example.com'],
            ['key' => 'mail_from_name', 'value' => 'Admin'],

            // ------- HOME PAGE SETTINGS -------
            ['key' => 'home_banner_title', 'value' => 'Welcome to Our Website'],
            ['key' => 'home_banner_subtitle', 'value' => 'We provide the best services'],
            ['key' => 'home_banner_image', 'value' => 'banner.jpg'],
            ['key' => 'home_feature_section', 'value' => 'enabled'],
            ['key' => 'home_about_section', 'value' => 'enabled'],
            ['key' => 'home_testimonial_section', 'value' => 'enabled'],
            ['key' => 'home_team_section', 'value' => 'enabled'],

            // ------- FOOTER SETTINGS -------
            ['key' => 'footer_about_text', 'value' => 'We are the best company'],
            ['key' => 'footer_copyright', 'value' => '© 2025 All Rights Reserved'],
            ['key' => 'footer_logo', 'value' => 'footer_logo.png'],
            ['key' => 'footer_bg_color', 'value' => '#000000'],
            ['key' => 'footer_text_color', 'value' => '#ffffff'],

            // ------- COMPANY INFO -------
            ['key' => 'company_name', 'value' => 'Demo Company'],
            ['key' => 'company_phone', 'value' => '+8801999000000'],
            ['key' => 'company_email', 'value' => 'company@example.com'],
            ['key' => 'company_website', 'value' => 'https://example.com'],
            ['key' => 'company_map', 'value' => 'Google map embed code'],

            // ------- SECURITY SETTINGS -------
            ['key' => 'captcha_enabled', 'value' => 'false'],
            ['key' => 'captcha_site_key', 'value' => 'captcha-key'],
            ['key' => 'captcha_secret_key', 'value' => 'captcha-secret'],
            ['key' => 'allow_registration', 'value' => 'true'],
            ['key' => 'email_verification_required', 'value' => 'true'],
            ['key' => 'maintenance_mode', 'value' => 'off'],

            // ------- API SETTINGS -------
            ['key' => 'api_status', 'value' => 'active'],
            ['key' => 'api_key', 'value' => 'random-api-key'],
            ['key' => 'api_limit_per_minute', 'value' => '60'],

            // ------- NOTIFICATION SETTINGS -------
            ['key' => 'notify_admin_on_order', 'value' => 'true'],
            ['key' => 'notify_admin_on_register', 'value' => 'true'],
            ['key' => 'notify_user_on_order', 'value' => 'true'],

            // ------- ECOMMERCE SETTINGS -------
            ['key' => 'tax_rate', 'value' => '15'],
            ['key' => 'shipping_fee', 'value' => '70'],
            ['key' => 'min_order_amount', 'value' => '200'],
            ['key' => 'stock_alert_quantity', 'value' => '5'],
            ['key' => 'cart_expire_time', 'value' => '60'], // minutes

            // ------- EXTRA SETTINGS (to reach 100+) -------
            ['key' => 'default_theme', 'value' => '1'],
            ['key' => 'theme_color_primary', 'value' => '#3498db'],
            ['key' => 'theme_color_secondary', 'value' => '#2ecc71'],
            ['key' => 'theme_dark_mode', 'value' => 'disabled'],
            ['key' => 'show_cookie_popup', 'value' => 'true'],
            ['key' => 'cookie_text', 'value' => 'We use cookies'],
            ['key' => 'enable_blog', 'value' => 'true'],
            ['key' => 'enable_comments', 'value' => 'true'],
            ['key' => 'homepage_layout', 'value' => 'default'],
            ['key' => 'dashboard_theme', 'value' => 'light'],
            ['key' => 'max_upload_size', 'value' => '20MB'],
            ['key' => 'default_user_role', 'value' => 'user'],
            ['key' => 'auto_approve_reviews', 'value' => 'false'],
            ['key' => 'newsletter_status', 'value' => 'active'],
            ['key' => 'newsletter_provider', 'value' => 'mailchimp'],
            ['key' => 'smtp_status', 'value' => 'active'],

        ];

        foreach ($settings as $setting) {
            DB::table('settings')->updateOrInsert(
                ['key' => $setting['key']],
                ['value' => $setting['value']]
            );
        }
    }
}
