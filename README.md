## Aplikasi manajemen voucher
Aplikasi manajemen voucher

## Requirements

 - Docker
https://docs.docker.com/docker-for-windows/install/
- Laragon / Executable PHP
https://laragon.org/download/index.html / https://windows.php.net/
- Composer
https://getcomposer.org/download/
- Code Editor
https://code.visualstudio.com/download
- Git
https://git-scm.com/downloads

## Tech Stacks

 - Laravel 8.40 **(Upgradeable)**
 - Nginx Stable-Alpine
 - PHP 8.0-FPM-Alpine + JIT

## Docker Installation
 1. Git Clone
 `https://github.com/emixbal/kambing-app.git`
 2. in root directory
  - create container
    ````
    docker-compose up -d
    ````
  - run composer
    ````
    docker-compose run --rm composer <command>
    ````
    example:
    ````
    docker-compose run --rm composer install
    ````
  - run artisan
    ````
    docker-compose run --rm artisan <command>
    ````
    example:
    ````
    docker-compose run --rm artisan migrate
    ````

## Native Installation
 1. Git Clone
 `https://github.com/emixbal/kambing-app.git`
 2. Run Composer Install
 `composer install`
 3.  Copy .env.example to .env
 `cp .env.example .env` 
 4. Generate Laravel Key
 `php artisan key:generate`
 5. Set Git Hook
 `php ./vendor/bin/grumphp git:pre-commit`
 6. Sesuaikan konfigurasi .env
 7. Generate JWT_SECRET dari sini (64 Length, 1 Number of Strings)
`http://www.unit-conversion.info/texttools/random-string-generator/`
 8. Run Migration
`php artisan migrate`
 9. Run Seeder
`php artisan db:seed`
 10. Build Docker
 `docker-compose up -d --build site` 
 11. Access site
`http://localhost/`

## Before Commit / Push
 1. Run composer lint untuk cek standarisasi code
   `composer lint`
 2. Run composer lint:fix jika ada error yang dapat diperbaiki secara otomatis
   `composer lint:fix`
 3. Setelah selesai diperbaiki, jalankan git add kembali sebelum push
   `git add .`

## Port Docker
 - **nginx** - `:80`
 - **mysql** - `:3306`
 - **php** - `:9000`
 - **redis** - `:6379`
## References
 - PHPCS Ruleset
 https://medium.com/@nandosalles/the-ruleset-phpcs-for-my-laravel-projects-a54cb3c95b31
 - Laravel Docker
 https://dev.to/aschmelyun/the-beauty-of-docker-for-local-laravel-development-13c0
 - Git Hook
 https://aicha-fatrah.medium.com/git-hooks-to-improve-code-quality-grumphp-phpcs-phpcpd-and-phpstan-45e9196d4906
 - Laravel Modules
https://nwidart.com/laravel-modules/v6/introduction
- Laravel Actions
https://laravelactions.com/
