<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'mediaable_type',
        'mediaable_id',
        'filename',
        'original_filename',
        'path',
        'disk',
        'mime_type',
        'size',
        'type',
        'collection',
        'order',
        'metadata',
    ];

    protected function casts(): array
    {
        return [
            'size' => 'integer',
            'order' => 'integer',
            'metadata' => 'array',
        ];
    }

    /**
     * Get the parent mediaable model.
     */
    public function mediaable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the full URL to the media file.
     */
    public function getUrlAttribute(): string
    {
        return \Storage::disk($this->disk)->url($this->path);
    }

    /**
     * Get the full path to the media file.
     */
    public function getFullPathAttribute(): string
    {
        return \Storage::disk($this->disk)->path($this->path);
    }

    /**
     * Check if the media is an image.
     */
    public function isImage(): bool
    {
        return $this->type === 'image' || str_starts_with($this->mime_type ?? '', 'image/');
    }

    /**
     * Check if the media is a document.
     */
    public function isDocument(): bool
    {
        return $this->type === 'document' || str_starts_with($this->mime_type ?? '', 'application/');
    }

    /**
     * Check if the media is a video.
     */
    public function isVideo(): bool
    {
        return $this->type === 'video' || str_starts_with($this->mime_type ?? '', 'video/');
    }

    /**
     * Check if the media is audio.
     */
    public function isAudio(): bool
    {
        return $this->type === 'audio' || str_starts_with($this->mime_type ?? '', 'audio/');
    }

    /**
     * Get human readable file size.
     */
    public function getHumanReadableSizeAttribute(): string
    {
        if (!$this->size) {
            return 'Unknown';
        }

        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = $this->size;
        $unitIndex = 0;

        while ($bytes >= 1024 && $unitIndex < count($units) - 1) {
            $bytes /= 1024;
            $unitIndex++;
        }

        return round($bytes, 2) . ' ' . $units[$unitIndex];
    }
}
