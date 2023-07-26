# Use the official PHP image
FROM php:8.1-fpm

# Set working directory
WORKDIR /var/www

# Install PHP extensions and other dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN curl -sL https://deb.nodesource.com/setup_16.x -o nodesource_setup.sh && bash nodesource_setup.sh && apt-get -y --force-yes install nodejs

# Copy Laravel files to the container
COPY . /var/www

RUN chown -R www-data:www-data /var/www/storage
RUN chmod 775 /var/www/storage


# Expose port 9000 and start PHP-FPM server
EXPOSE 9000
CMD ["php-fpm"]
