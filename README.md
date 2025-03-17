🎬 Movia - Movie Review System
A modern and fully-featured Movie Review System built with Laravel 12, designed for users to review, rate, comment on movies, and manage profiles — including profile photo uploads and admin panel functionalities.

🚀 Features
✅ User registration and authentication (with future Social Login integration)
✅ Browse and search movies
✅ User movie reviews with star ratings ⭐⭐⭐⭐⭐
✅ Comment system on movie reviews
✅ Admin panel for managing movies, genres, reviews, and comments
✅ User profile management with profile picture upload
✅ Dashboard showing recommended movies and stats
✅ Fully responsive TailwindCSS UI
📸 Screenshots
Login Page	Movie List	User Profile
Coming Soon	Coming Soon	Coming Soon
🛠️ Tech Stack
PHP 8.2.12
Laravel 12
TailwindCSS
Alpine.js
Chart.js (for admin analytics)
MySQL
🧑‍💻 Setup Instructions
1. Clone the Repository
bash
Copy
Edit
git clone https://github.com/your-username/your-repository.git
cd your-repository
2. Install PHP & JS Dependencies
bash
Copy
Edit
composer install
npm install
npm run dev
3. Set Up Environment
bash
Copy
Edit
cp .env.example .env
php artisan key:generate
4. Configure .env for Database, Mail, and Social Login
dotenv
Copy
Edit
# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

# Social Login (to be configured later)
GOOGLE_CLIENT_ID=
GOOGLE_CLIENT_SECRET=
GOOGLE_REDIRECT_URI=

FACEBOOK_CLIENT_ID=
FACEBOOK_CLIENT_SECRET=
FACEBOOK_REDIRECT_URI=

GITHUB_CLIENT_ID=
GITHUB_CLIENT_SECRET=
GITHUB_REDIRECT_URI=
5. Run Migrations
bash
Copy
Edit
php artisan migrate
6. Seed Data (Optional)
bash
Copy
Edit
php artisan db:seed
7. Run the Application
bash
Copy
Edit
php artisan serve
⚙️ Future Social Login Setup (Placeholder)
These social accounts are displayed on the interface but not yet linked. You can later set up OAuth and replace placeholders:

Google Login (coming soon)
Facebook Login (coming soon)
GitHub Login (coming soon)
🔐 Admin Panel Access
The admin panel allows you to manage movies, genres, reviews, and user comments. Ensure to create an admin user manually via database or seeders.

Admin URL: /admin/dashboard

👨‍👩‍👧‍👦 Team & Contributors
Role	Name	Email
Project Owner	Kenneth	kenneth.gulmatico@hcdc.edu.ph
Instructor/Guide	Rosselyn Cedeno	cedeno.rosselyn@gmail.com
Collaborator	Luis Joel Nujapa, James Michael Micolob
📊 Folder Structure
bash
Copy
Edit
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   ├── User/
│   │   │   ├── SocialAuthController.php
│   │   │   └── ProfileController.php
│   ├── Models/
│   │   ├── Movie.php
│   │   ├── Review.php
│   │   ├── Comment.php
│   └── ...
├── resources/views/
│   ├── admin/
│   ├── user/
│   ├── layouts/
│   └── profile/
└── routes/web.php
💡 To-Do (Future Enhancements)
 Integrate working social login (Google, Facebook, GitHub)
 Movie recommendation system based on reviews/ratings
 Like/Dislike system for reviews and comments
 Trending and latest movies page
 AI-powered suggestion engine
 Dark mode toggle 🌙
📜 License
This project is open-source and available under MIT License.

📱 Social Media (Placeholders)
Coming soon — once configured

Platform	Placeholder Link
Facebook	#
Twitter	#
Instagram	#
🙏 Acknowledgements
Laravel Documentation
TailwindCSS
Alpine.js
Chart.js
📦 Contribution
Feel free to fork this repository, create issues, and submit pull requests! Let's make Movia better together. 🌟

✅ How to Upload this to GitHub
bash
Copy
Edit
git init
git remote add origin https://github.com/your-username/your-repository.git
git add .
git commit -m "Initial commit: Movia Movie Review System"
git push -u origin main
