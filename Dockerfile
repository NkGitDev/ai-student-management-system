FROM php:8.2-fpm

# Install system dependencies including Node.js & NPM
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nginx \
    nodejs \
    npm

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy existing application directory contents
COPY . /var/www

# Copy Nginx config
COPY nginx.conf /etc/nginx/sites-available/default

# Install composer dependencies
RUN composer install --no-dev --optimize-autoloader

# Install NPM dependencies & Build Vite assets (Fixes missing Vite manifest error)
RUN npm install
RUN npm run build

# Set permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

EXPOSE 80

# Create log file, set storage permissions, run Laravel optimization commands, and stream logs
CMD touch /var/www/storage/logs/laravel.log && chown -R www-data:www-data /var/www/storage && chmod -R 775 /var/www/storage && php artisan config:clear && php artisan cache:clear && php artisan view:clear && php artisan migrate --force && service nginx start && php-fpm -D && tail -f /var/www/storage/logs/laravel.log