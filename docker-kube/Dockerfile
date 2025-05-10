FROM php:8.3-apache
# Install dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libxml2-dev \
    libonig-dev \
    unzip \
    git \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip pdo pdo_mysql xml mysqli opcache

# Enable Apache modules
RUN a2enmod rewrite headers ssl

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/html

# Copy the application files
COPY . .

# Install PHP dependencies using Composer
RUN composer install --no-dev --optimize-autoloader
# Set permissions for the Apache user
RUN chown -R www-data:www-data /var/www/html/
# RUN chmod -R 775 /var/www/html/

# Storage links
RUN php artisan storage:link

# # Change to MPM event
# RUN a2dismod mpm_prefork && \
#     a2enmod mpm_event

# Copy Apache configuration file
COPY ./docker-kube/000-default.conf /etc/apache2/sites-available/000-default.conf

# Expose port 80
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]