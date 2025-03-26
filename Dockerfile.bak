# Dockerfile
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nodejs \
    npm \
    libzip-dev \
    libsodium-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip xml sodium

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy existing application directory contents
COPY ./ /var/www

RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www/storage

# Copy existing application directory permissions
COPY --chown=www-data:www-data ./ /var/www

# Install Composer dependencies
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Run composer dumpautoload
RUN composer dumpautoload

# Install npm dependencies and build assets
RUN npm install && npm run build

# RUN php artisan optimize:clear

# disable ini setelah dibuild 
# RUN php artisan migrate:fresh --seed

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
