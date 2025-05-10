# NoteAppsLaravel

A simple Note App built with Laravel.

## Features

- User authentication (login/register)
- Create, edit, and delete notes
- List all your notes
- Secure and RESTful API endpoints
- Responsive and clean UI

## Requirements

- PHP 8.2+
- Composer
- MySQL or SQLite
- Node.js & npm (for frontend assets)

## Installation

1. Clone the repository:
    ```
    git clone https://github.com/yourusername/NoteAppsLaravel.git
    cd NoteAppsLaravel
    ```

2. Install dependencies:
    ```
    composer install
    npm install
    ```

3. Copy the example environment file and set your environment variables:
    ```
    cp [.env.example](http://_vscodecontentref_/0) .env
    ```

4. Generate application key:
    ```
    php artisan key:generate
    ```

5. Run migrations:
    ```
    php artisan migrate
    ```

6. (Optional) Build frontend assets:
    ```
    npm run dev
    ```

7. Start the development server:
    ```
    php artisan serve
    ```

## Usage

- Register a new account or log in.
- Create, view, edit, and delete your notes.

## License

This project is open-sourced under the MIT license.