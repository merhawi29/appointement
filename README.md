# Cafe Appointments - Laravel 11 API with Blade UI

A simple appointment booking system for a cafe using Laravel 11 backend API and Blade frontend UI.

---

## Features

- CRUD operations for appointments (Create, Read, Update, Delete) via API
- Frontend Blade UI for managing appointments
- API resource routes using Laravel API Resource Controllers
- JSON validation and error handling
- Basic form with create and edit in the same page

---

## Requirements

- PHP >= 8.1
- Composer
- MySQL or other supported database
- Node.js & npm (for frontend assets with Vite)
- Laravel 11

---

## Installation

1. Clone the repo:

   ```bash
   git clone https://github.com/yourusername/cafe-appointments.git
   cd cafe-appointments
2 . composer install
3. cp .env.example .env
php artisan key:generate
4 .  DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=appointments_db
DB_USERNAME=root
DB_PASSWORD=secret
5. php artisan migrate
6. npm install
npm run dev
7. php artisan serve
* API Routes
The API routes are prefixed with /api (defined in routes/api.php).

| Method | Endpoint                 | Description             |
| ------ | ------------------------ | ----------------------- |
| GET    | `/api/appointments`      | List all appointments   |
| POST   | `/api/appointments`      | Create new appointment  |
| GET    | `/api/appointments/{id}` | Show single appointment |
| PUT    | `/api/appointments/{id}` | Update appointment      |
| DELETE | `/api/appointments/{id}` | Delete appointment      |


* Blade UI
The appointments UI is accessible at /appointments

CRUD operations are handled via fetch API calls to backend /api/appointments

Includes form for create/edit and table listing all appointments

* Testing with Postman
Use POST /api/appointments with JSON body:
{
  "customer_name": "John Doe",
  "email": "john@example.com",
  "appointment_time": "2025-07-23 14:30:00",
  "notes": "Bring documents"
}
Use PUT /api/appointments/{id} with JSON body to update existing appointment

Use DELETE /api/appointments/{id} to delete

Use GET /api/appointments/{id} to fetch one appointment
* Troubleshooting
If you get 404 errors on API routes, confirm routes with:
php artisan route:list
Ensure you use the correct URL prefix /api

Check Laravel logs in storage/logs/laravel.log for errors

Confirm your database connection and schema is correct

Verify $fillable fields in Appointment model to allow mass assignment
