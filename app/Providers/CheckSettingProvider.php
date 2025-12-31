<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\RelatedNewsSite;
use App\Models\Setting;
use Illuminate\Support\ServiceProvider;

class CheckSettingProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
       $getsetting= Setting::firstOr(function(){
            return Setting::create([
                "site_name"=>'news',
                "logo"=>'logo',
                "favicon"=>'defult',
                "site_email"=>'news@gmail.com',
                "facebook"=>'https://www.facebook.com/',
                'twitter'=>'https://x.com/?mx=2',
                'youtube'=>'https://www.youtube.com/',
                'phone'=>'01289490393',
                'instagram'=>'defult',
                'country'=>'Egypt',
                'city'=>'Damitta',
                'street'=>'near nail',
            ]);
        });

      $getsetting -> whatsapp ='https://wa.me/'.$getsetting->phone;
    

        view()->share([
            'getsetting'=> $getsetting,
            
        ]);
        
    }
}
