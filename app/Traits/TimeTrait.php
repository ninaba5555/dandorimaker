<?php

namespace App\Traits;

trait TimeTrait
{
    /**
     * 秒を分秒に変換
     */
    public function s2m($seconds)
    {
        $minutes = floor(($seconds / 60) % 60);
        $seconds = $seconds % 60;

        return $minutes . '分' . $seconds . '秒';
    }
}