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
        if ($minutes > 0) {
            return $minutes . '分' . $seconds . '秒';
        } else {
            return $seconds . '秒';
        }
    }
}