## Installing The Project Locally

### Prerequisites

This project is using Laravel Sail, ensure you have the following installed on your local machine:

- [Docker Desktop](https://www.docker.com/products/docker-desktop)
- [PHP](https://www.php.net/downloads) (recommended version 8.2)
- [Composer](https://getcomposer.org/download/)

### Steps
1. **Clone the project:**

   ```bash
   git clone <repository_url>

1. **Create .env file:**
    ```bash
    cp .env.example .env

 1. **Install dependencies:**
    ```bash
    composer update

 1. **Generate App Key:**
    ```bash
    php artisan key:generate
  
1. **Once Docker is running run the command:**

   ```bash
   ./vendor/bin/sail up -d

2. **Build the database  and seed it:**
   ```bash
   ./vendor/bin/sail artisan migrate --seed

3. **Now you can access on:**

    http://localhost

You can also access the app on http://18.188.240.152/

**Enjoy :)**