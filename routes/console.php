<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () { 
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();
 

// Schedule::command('notify:cron')->everyMinute();

Schedule::command('notify:cron')->monthlyOn(5, '00:00'); 

