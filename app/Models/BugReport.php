<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class BugReport extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'name',
        'contact',
        'page_url',
        'message',
        'is_read',
        'is_resolved',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'is_resolved' => 'boolean',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('attachments')->singleFile();
    }
}
