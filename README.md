# Sticky Notes (PHP + MySQL)

Sticky Notes is a simple web app that lets users sign up, sign in, and manage personal notes by date and time.

## Features

- User registration and login
- Password hashing with `password_hash()` / `password_verify()`
- Session-based authentication
- Add, list, and delete notes
- Delete all notes for the signed-in user
- Notes are sorted by date/time
- Output escaping for safer rendering in the browser

## Security Improvements Included

This project includes basic hardening:

- Prepared statements for note and signup database writes/reads
- User-scoped note deletion (a user can only delete their own notes)
- Escaped output in note and username rendering to reduce XSS risk

## Project Structure

- `signin.php` - Login form and authentication logic
- `signup.php` - Registration form and account creation
- `index.php` - Home page after login
- `add_note.php` - Add note form and submit handler
- `show_notes.php` - List notes for current user
- `delete_note.php` - Delete one/all notes for current user
- `database.php` - MySQL connection and note data functions
- `sessionchk.php` - Session/auth guard

## Requirements

- PHP 7.4+
- MySQL / MariaDB
- Web server (Apache, Nginx, or PHP built-in server)

## Database Setup

Create a database named `sticky_notes` and the required tables:

```sql
CREATE DATABASE sticky_notes;
USE sticky_notes;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
);

CREATE TABLE notes (
  sno INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  date DATE NOT NULL,
  time TIME NOT NULL,
  note TEXT NOT NULL,
  submit_dt DATETIME NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

## Configuration

Update database credentials in `database.php` if needed:

- `$servername`
- `$username`
- `$password`
- `$dbname`

## Run Locally

From the project directory:

```bash
php -S localhost:8000
```

Then open:

- `http://localhost:8000/signin.php`

## Notes

- This is a lightweight educational project and does not yet include CSRF tokens, rate limiting, password policy checks, or email verification.
- For production, add stricter validation, CSRF protection, secure cookie settings, and environment-based secret management.
