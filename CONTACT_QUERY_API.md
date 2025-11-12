# Contact Query API Documentation

## Overview

The Contact Query API allows the Next.js frontend to submit contact form data and the dashboard to manage contact queries.

## API Endpoints

### Public Endpoints (No Authentication Required)

#### POST `/api/contact-queries`
Submit a new contact query from the frontend.

**Request Body:**
```json
{
  "name": "John Doe",
  "email": "john@example.com",
  "phone": "123-456-7890",
  "subject": "Loan Inquiry",
  "message": "I need information about..."
}
```

**Response (Success - 201):**
```json
{
  "success": true,
  "message": "Your message has been sent successfully. We will get back to you soon!",
  "data": {
    "id": 1
  }
}
```

**Response (Validation Error - 422):**
```json
{
  "success": false,
  "message": "Validation failed",
  "errors": {
    "email": ["The email field is required."],
    "name": ["The name field is required."]
  }
}
```

### Protected Endpoints (Requires Authentication)

#### GET `/api/contact-queries`
Get all contact queries with filtering and pagination.

**Query Parameters:**
- `status` - Filter by status (new, read, replied, archived)
- `is_read` - Filter by read status (true/false)
- `search` - Search by name, email, subject, or message
- `per_page` - Items per page (default: 15)

**Response:**
```json
{
  "success": true,
  "data": {
    "current_page": 1,
    "data": [...],
    "total": 50,
    "per_page": 15
  }
}
```

#### GET `/api/contact-queries/{id}`
Get a specific contact query.

#### POST `/api/contact-queries/{id}/mark-read`
Mark a contact query as read.

#### POST `/api/contact-queries/{id}/reply`
Reply to a contact query.

**Request Body:**
```json
{
  "reply_message": "Thank you for your inquiry..."
}
```

#### POST `/api/contact-queries/{id}/archive`
Archive a contact query.

#### DELETE `/api/contact-queries/{id}`
Delete a contact query (soft delete).

## Frontend Integration

### Environment Variable

Add to your Next.js `.env.local`:

```env
NEXT_PUBLIC_API_URL=http://localhost:8000/api
```

For production, update to your production API URL.

### Usage Example

```typescript
import { contactApi } from '@/lib/api'

// Submit contact form
const response = await contactApi.submit({
  name: 'John Doe',
  email: 'john@example.com',
  phone: '123-456-7890',
  subject: 'Loan Inquiry',
  message: 'I need information...'
})

if (response.success) {
  // Show success message
} else {
  // Handle errors
  console.error(response.errors)
}
```

## Dashboard Routes

### Web Routes (Blade Views)

- `GET /dashboard/contact-queries` - List all contact queries
- `GET /dashboard/contact-queries/{id}` - View contact query details
- `POST /dashboard/contact-queries/{id}` - Handle actions (mark read, reply, archive)

## CORS Configuration

CORS is automatically handled by Laravel for API routes. If you need to configure specific origins, you can add CORS middleware configuration.

## Database

The contact queries are stored in the `contact_queries` table with the following structure:

- Contact information (name, email, phone, subject, message)
- Status tracking (status, is_read, read_at, read_by)
- Reply tracking (replied_at, replied_by, reply_message)
- Internal notes and metadata

## Status Values

- `new` - New query (not read)
- `read` - Query has been read
- `replied` - Query has been replied to
- `archived` - Query has been archived

