# Media Table Usage Guide

The `media` table is a generic, polymorphic media storage system that can be used by any model in your application.

## Features

- **Polymorphic Relationships**: Attach media to any model
- **Collections**: Organize media into collections (e.g., 'documents', 'images', 'gallery')
- **Type Detection**: Automatically detects media type (image, document, video, audio, other)
- **Metadata Storage**: Store additional information (dimensions, duration, etc.)
- **Ordering**: Support for ordering media items
- **Soft Deletes**: Media items can be soft deleted

## Setup

### 1. Run the Migration

```bash
php artisan migrate
```

### 2. Add the Trait to Your Model

```php
use App\Traits\HasMedia;

class YourModel extends Model
{
    use HasMedia;
    // ...
}
```

## Usage Examples

### Adding Media

```php
// Add a single file
$loanApplication = LoanApplication::find(1);

// Upload a file
$media = $loanApplication->addMedia(
    $request->file('document'),
    'documents',           // collection name
    'document',            // type (optional, auto-detected)
    'public',              // disk (optional, default: 'public')
    ['description' => 'ID Proof'] // metadata (optional)
);

// Add to specific collection
$loanApplication->addMedia($file, 'profile_pictures', 'image');
$loanApplication->addMedia($file, 'supporting_documents', 'document');
```

### Retrieving Media

```php
// Get all media
$allMedia = $loanApplication->media;

// Get media by collection
$documents = $loanApplication->mediaByCollection('documents')->get();
$images = $loanApplication->mediaByCollection('images')->get();

// Get media by type
$allImages = $loanApplication->mediaByType('image')->get();
$allDocuments = $loanApplication->mediaByType('document')->get();

// Get first/last media in a collection
$firstImage = $loanApplication->getFirstMedia('images');
$lastDocument = $loanApplication->getLastMedia('documents');
```

### Media Model Methods

```php
$media = Media::find(1);

// Get URL
$url = $media->url; // Full URL to the file

// Get full path
$path = $media->full_path; // Full filesystem path

// Check media type
$media->isImage();     // true/false
$media->isDocument();  // true/false
$media->isVideo();     // true/false
$media->isAudio();     // true/false

// Human readable size
$size = $media->human_readable_size; // "2.5 MB"
```

### Removing Media

```php
// Remove a single media item
$loanApplication->removeMedia($mediaId, true); // true = delete file from disk

// Remove by Media instance
$loanApplication->removeMedia($media, true);

// Clear entire collection
$loanApplication->clearMediaCollection('documents', true); // true = delete files
```

### Working with Collections

Collections help organize media:

```php
// Profile pictures
$loanApplication->addMedia($file, 'profile_pictures', 'image');

// Documents
$loanApplication->addMedia($file, 'documents', 'document');
$loanApplication->addMedia($file, 'documents', 'document'); // Multiple documents

// Gallery images
$loanApplication->addMedia($file, 'gallery', 'image');
$loanApplication->addMedia($file, 'gallery', 'image');

// Get all documents
$documents = $loanApplication->mediaByCollection('documents')->get();
```

## Use Cases

### Loan Application Documents

```php
$application = LoanApplication::find(1);

// Upload ID proof
$application->addMedia($request->file('id_proof'), 'documents', 'document', 'public', [
    'document_type' => 'id_proof',
    'uploaded_by' => auth()->id()
]);

// Upload income statement
$application->addMedia($request->file('income_statement'), 'documents', 'document', 'public', [
    'document_type' => 'income_statement',
    'uploaded_by' => auth()->id()
]);

// Get all documents
$documents = $application->mediaByCollection('documents')->get();
```

### Property Images

```php
$property = Property::find(1);

// Upload property images
$property->addMedia($request->file('image1'), 'gallery', 'image');
$property->addMedia($request->file('image2'), 'gallery', 'image');
$property->addMedia($request->file('image3'), 'gallery', 'image');

// Get all property images
$images = $property->mediaByCollection('gallery')->get();
```

### User Profile Pictures

```php
$user = User::find(1);

// Upload profile picture
$user->addMedia($request->file('avatar'), 'profile', 'image');

// Get profile picture
$avatar = $user->getFirstMedia('profile');
if ($avatar) {
    echo $avatar->url; // Display the image
}
```

## Database Structure

The `media` table includes:

- `id` - Primary key
- `mediaable_type` - Model class name (polymorphic)
- `mediaable_id` - Model ID (polymorphic)
- `filename` - Stored filename
- `original_filename` - Original upload filename
- `path` - Storage path
- `disk` - Storage disk (public, s3, etc.)
- `mime_type` - File MIME type
- `size` - File size in bytes
- `type` - Media type (image, document, video, audio, other)
- `collection` - Collection name for organization
- `order` - Order/position for sorting
- `metadata` - JSON field for additional data
- `deleted_at` - Soft delete timestamp
- `created_at`, `updated_at` - Timestamps

## Best Practices

1. **Use Collections**: Organize media into logical collections
2. **Set Appropriate Types**: Helps with filtering and display
3. **Store Metadata**: Use metadata for additional context
4. **Clean Up**: Always delete physical files when removing media
5. **Use Disks**: Configure different disks for different environments (local, S3, etc.)

## Integration with Existing Models

Any model can use the `HasMedia` trait:

```php
use App\Traits\HasMedia;

class LoanBorrower extends Model
{
    use HasMedia;
    // ...
}

class Property extends Model
{
    use HasMedia;
    // ...
}

class AuthorizedSigner extends Model
{
    use HasMedia;
    // ...
}
```

