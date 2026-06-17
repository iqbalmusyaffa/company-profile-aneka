<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SeoPage extends Model
{
    use LogsActivity;
    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'open_graph_data' => 'array',
        ];
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['page_name', 'meta_title', 'meta_description'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn(string $eventName) => "SEO Page telah di {$eventName}");
    }
}
