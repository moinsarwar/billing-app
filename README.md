# 🚀 Laravel Project Setup Guide

Welcome to the **Laravel Project**! Follow these simple steps to set up your local development environment.

---

## 🧑‍💻 Installation Steps

1. Clone the repository:
    ```bash
    git clone https://github.com/your-username/your-laravel-project.git
    cd your-laravel-project
    ```

2. Install Composer dependencies:
    ```bash
    composer install
    ```

3. Copy `.env` file and generate application key:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. Build and start Laravel Sail:
    ```bash
    ./vendor/bin/sail up --build -d
    ```

5. Run migrations:
    ```bash
    ./vendor/bin/sail artisan migrate
    ```

---

## ⚡️ Useful Sail Commands

- Start containers:  
    ```bash
    ./vendor/bin/sail up -d
    ```
- Stop containers:  
    ```bash
    ./vendor/bin/sail down
    ```
- Run Artisan commands:  
    ```bash
    ./vendor/bin/sail artisan <command>
    ```

---

## 💡 Notes

- Make sure **Docker** is installed and running on your system.
- For Laravel Sail compatibility, check your `.env` file's database settings.
- After starting Sail, your app will be available at:  
   [http://localhost](http://localhost)

---

## ❤️ Happy Coding!

