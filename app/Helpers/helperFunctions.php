<?php

use App\Kernel\App;
use App\Kernel\SessionManager;

function url($path): string
{
    return App::getUrl($path);
}

function app(): App
{
    return App::app();
}

function session(): SessionManager
{
    return App::session();
}

function generate_stars(float $score): string
{
    $fill_count = floor($score);
    if ($fill_count == $score) {
        $has_half = false;
    } else {
        $has_half = true;
    }
    $empty_count = 5 - ceil($score);

    $output = '';
    for ($i = 0; $i < $fill_count; $i++) {
        $output .= '<img class="icon star" src="' . url('assets/img/icon/star.svg') . '">';
    }
    if ($has_half) {
        $output .= '<img class="icon star" src="' . url('assets/img/icon/star-half-stroke.svg') . '">';
    }
    for ($i = 0; $i < $empty_count; $i++) {
        $output .= '<img class="icon star" src="' . url('assets/img/icon/star-outline.svg') . '">';
    }
    return $output;
}

function week_days_array_persian(): array
{
    return ['شنبه', 'یکشنبه', 'دوشنبه', 'سه شنبه', 'چهارشنبه', 'پنجشنبه', 'جمعه'];
}
function week_days_array_english(): array
{
    return ['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
}
function week_days_persian($index): string
{
    $week_days_persian = week_days_array_persian();
    return $week_days_persian[$index];
}
function week_days_english($index): string
{
    $week_days = week_days_array_english();
    return $week_days[$index];
}