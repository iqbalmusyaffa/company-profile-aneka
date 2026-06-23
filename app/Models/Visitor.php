<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Agent\Agent;

class Visitor extends Model
{
    protected $guarded = ['id'];

    public function getDeviceTypeAttribute()
    {
        if (!$this->user_agent) return 'Unknown';
        
        $agent = new Agent();
        $agent->setUserAgent($this->user_agent);
        
        if ($agent->isTablet()) return 'Tablet';
        if ($agent->isMobile()) return 'Mobile';
        if ($agent->isDesktop()) return 'Desktop';
        
        return 'Unknown';
    }

    public function getPlatformAttribute()
    {
        if (!$this->user_agent) return 'Unknown';
        
        $agent = new Agent();
        $agent->setUserAgent($this->user_agent);
        return $agent->platform() ?: 'Unknown';
    }

    public function getBrowserNameAttribute()
    {
        if (!$this->user_agent) return 'Unknown';
        
        $agent = new Agent();
        $agent->setUserAgent($this->user_agent);
        return $agent->browser() ?: 'Unknown';
    }
}
