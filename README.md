# ENSAM GradeHouse

> Web platform for continuous assessment grade management at ENSAM Rabat. **[Internship — ENSAM]**

## Overview

GradeHouse streamlines grade management for instructors and students at École Nationale Supérieure d'Arts et Métiers de Rabat. Instructors input and manage grades; students get real-time access to their academic progress with notifications on publication.

## Tech Stack

- **Backend**: Laravel (PHP)
- **Frontend**: Blade templates, Tailwind CSS
- **Database**: MySQL
- **Auth**: Role-based (Admin / Teacher / Student)

## Project Structure

```
app/
├── Http/Controllers/   # Grade, user, and auth controllers
├── Models/             # Eloquent models
resources/views/        # Blade templates
routes/web.php          # Application routes
```

## Setup & Run

```bash
composer install && npm install
cp .env.example .env
php artisan key:generate && php artisan migrate
php artisan serve
```

## Features

- Grade input and bulk CSV import/export
- Grade analytics and statistics per instructor
- Personalized student portal with progress visualization
- Automated email notifications on grade publication
- Role-based access: Admin, Teacher, Student
- Comprehensive admin panel
