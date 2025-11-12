<?php

namespace App\Traits;

use App\Models\Media;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HasMedia
{
    /**
     * Get all media for this model.
     */
    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediaable');
    }

    /**
     * Get media by collection.
     */
    public function mediaByCollection(string $collection): MorphMany
    {
        return $this->media()->where('collection', $collection);
    }

    /**
     * Get media by type.
     */
    public function mediaByType(string $type): MorphMany
    {
        return $this->media()->where('type', $type);
    }

    /**
     * Add a media file to this model.
     *
     * @param UploadedFile|string $file The file to upload or path to existing file
     * @param string $collection Collection name (default: 'default')
     * @param string|null $type Media type (image, document, video, audio, other)
     * @param string $disk Storage disk (default: 'public')
     * @param array $metadata Additional metadata
     * @return Media
     */
    public function addMedia($file, string $collection = 'default', ?string $type = null, string $disk = 'public', array $metadata = []): Media
    {
        if ($file instanceof UploadedFile) {
            $originalFilename = $file->getClientOriginalName();
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs($collection, $filename, $disk);
            $mimeType = $file->getMimeType();
            $size = $file->getSize();
            
            // Auto-detect type if not provided
            if (!$type) {
                $type = $this->detectMediaType($mimeType);
            }
            
            // Add image dimensions if it's an image
            if ($type === 'image') {
                $imageInfo = getimagesize($file->getRealPath());
                if ($imageInfo) {
                    $metadata['width'] = $imageInfo[0];
                    $metadata['height'] = $imageInfo[1];
                }
            }
        } else {
            // Assume it's a path to an existing file
            $originalFilename = basename($file);
            $filename = basename($file);
            $path = $file;
            $mimeType = mime_content_type($file) ?: null;
            $size = file_exists($file) ? filesize($file) : null;
            
            if (!$type && $mimeType) {
                $type = $this->detectMediaType($mimeType);
            }
        }

        // Get the next order number for this collection
        $order = $this->mediaByCollection($collection)->max('order') + 1;

        return $this->media()->create([
            'filename' => $filename,
            'original_filename' => $originalFilename,
            'path' => $path,
            'disk' => $disk,
            'mime_type' => $mimeType,
            'size' => $size,
            'type' => $type ?? 'other',
            'collection' => $collection,
            'order' => $order,
            'metadata' => $metadata,
        ]);
    }

    /**
     * Remove a media file.
     *
     * @param int|Media $media Media ID or Media instance
     * @param bool $deleteFile Whether to delete the physical file
     * @return bool
     */
    public function removeMedia($media, bool $deleteFile = true): bool
    {
        if (is_int($media)) {
            $media = $this->media()->find($media);
        }

        if (!$media) {
            return false;
        }

        // Delete physical file if requested
        if ($deleteFile && Storage::disk($media->disk)->exists($media->path)) {
            Storage::disk($media->disk)->delete($media->path);
        }

        return $media->delete();
    }

    /**
     * Clear all media for a specific collection.
     *
     * @param string $collection Collection name
     * @param bool $deleteFiles Whether to delete physical files
     * @return int Number of deleted media items
     */
    public function clearMediaCollection(string $collection, bool $deleteFiles = true): int
    {
        $mediaItems = $this->mediaByCollection($collection)->get();
        $count = 0;

        foreach ($mediaItems as $media) {
            if ($this->removeMedia($media, $deleteFiles)) {
                $count++;
            }
        }

        return $count;
    }

    /**
     * Get the first media item from a collection.
     *
     * @param string $collection Collection name
     * @return Media|null
     */
    public function getFirstMedia(string $collection = 'default'): ?Media
    {
        return $this->mediaByCollection($collection)->orderBy('order')->first();
    }

    /**
     * Get the last media item from a collection.
     *
     * @param string $collection Collection name
     * @return Media|null
     */
    public function getLastMedia(string $collection = 'default'): ?Media
    {
        return $this->mediaByCollection($collection)->orderByDesc('order')->first();
    }

    /**
     * Detect media type from MIME type.
     *
     * @param string $mimeType
     * @return string
     */
    protected function detectMediaType(string $mimeType): string
    {
        if (str_starts_with($mimeType, 'image/')) {
            return 'image';
        }

        if (str_starts_with($mimeType, 'video/')) {
            return 'video';
        }

        if (str_starts_with($mimeType, 'audio/')) {
            return 'audio';
        }

        if (in_array($mimeType, [
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'text/plain',
            'text/csv',
        ])) {
            return 'document';
        }

        return 'other';
    }
}

