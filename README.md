# Local MySQL Setup

This project is configured for MySQL in local development. With XAMPP, start
Apache and MySQL first, then import the schema and seed data.

## Default Database Settings

The app uses these defaults in `app/config/database.php`:

```text
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=final_proj
DB_USERNAME=root
DB_PASSWORD=
```

These match a typical fresh XAMPP MySQL install.

## Option 1: phpMyAdmin

1. Open `http://localhost/phpmyadmin`.
2. Go to the Import tab.
3. Import `database/schema.sql`.
4. Import `database/seed.sql`.

The schema file creates and selects the `final_proj` database automatically.

## Option 2: Terminal

From the project root:

```bash
mysql -u root < database/schema.sql
mysql -u root final_proj < database/seed.sql
```

If your MySQL root user has a password:

```bash
mysql -u root -p < database/schema.sql
mysql -u root -p final_proj < database/seed.sql
```

## Run The App

If you are using XAMPP, the simplest path is to serve the project with XAMPP's
Apache/PHP so the MySQL PDO driver is available.

If you prefer PHP's built-in server, make sure this command lists `pdo_mysql`:

```bash
php -m
```

Then run:

```bash
php -S localhost:8000 -t public
```

Then open:

```text
http://localhost:8000
```
