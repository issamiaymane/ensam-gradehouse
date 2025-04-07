# ENSAM GradeHouse 🎓📊

**ENSAM GradeHouse** is a Laravel-based web application developed to streamline the management and visualization of continuous assessment grades at **École Nationale Supérieure d'Arts et Métiers de Rabat (ENSAM Rabat)**.

It provides an intuitive platform for instructors to input grades and for students to monitor their academic progress throughout the semester.

---

## 🚀 Features

- 👩‍🏫 Instructor dashboard for managing and entering grades
- 🎓 Secure student portal for grade consultation
- 📄 CSV import/export support for bulk grade handling
- 🔒 Role-based access control (Admin, Teacher, Student)
- 📈 Real-time statistics and grade visualization
- 📬 Email alerts upon grade publication

---

## 🧱 Tech Stack

- **Framework:** Laravel 10 (Breeze + Blade + Alpine.js)
- **Language:** PHP 8.2
- **Database:** MySQL
- **Frontend:** TailwindCSS, Alpine.js
- **Authentication:** Laravel Breeze
- **Testing:** PestPHP

---

## ⚙️ Getting Started

### 1. Clone the Repository

\`\`\`bash
git clone https://github.com/issamiaymane/ensam-gradehouse.git
cd ensam-gradehouse
\`\`\`

### 2. Install Dependencies

\`\`\`bash
composer install
npm install && npm run dev
\`\`\`

### 3. Set Up Environment

\`\`\`bash
cp .env.example .env
php artisan key:generate
\`\`\`

### 4. Configure Database

Update your `.env` file with your MySQL database credentials.

### 5. Run Migrations & Seeders

\`\`\`bash
php artisan migrate --seed
\`\`\`

### 6. Start the Server

\`\`\`bash
php artisan serve
\`\`\`

---

## 👥 User Roles

| Role     | Description                        |
|----------|------------------------------------|
| \`admin\`  | Manages users and platform settings |
| \`teacher\`| Adds, edits, and manages grades     |
| \`student\`| Views personal grades and history   |

---

## 🧪 Running Tests

\`\`\`bash
php artisan test
# or
./vendor/bin/pest
\`\`\`

---

## 📂 Key Folder Structure

- \`app/Models/Student.php\` – Student model with relationships
- \`app/Http/Controllers/GradeController.php\` – Grade logic and operations
- \`resources/views/\` – Blade templates for frontend views
- \`database/seeders/StudentsSeeder.php\` – Initial student data seeder

---

## 📌 Roadmap

- ✅ Export grades to PDF
- ⏳ Dashboard with detailed grade statistics
- ⏳ Notifications for upcoming assessments
- ⏳ Dark mode support 🌙

---

## 👨‍💻 Contributor

- **Aymane ISSAMI** – [@issamiaymane](https://github.com/issamiaymane)

---

## 📄 License

This project is licensed under the [MIT License](LICENSE).

> Built with ❤️ for ENSAM Rabat.
