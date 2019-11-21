FROM php:7.2-apache

RUN apt-get update && \
    apt-get install -y zip git libfreetype6-dev libjpeg62-turbo-dev libpng-dev && \
    service apache2 restart

COPY . /var/www/html
COPY .docker/php/vhost.conf /etc/apache2/sites-available/000-default.conf
COPY .docker/php/mpm_prefork.conf /etc/apache2/mods-available/

RUN chown -R www-data:www-data /var/www/html && a2enmod rewrite headers && \
    docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ && \
    docker-php-ext-install -j$(nproc) gd && \
    docker-php-ext-install pdo_mysql && chown -R www-data:www-data /var/www/html && \
    docker-php-ext-install zip && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

RUN touch storage/logs/lumen.log && \
    chmod 777 storage/logs/lumen.log && \
    composer install --no-dev --optimize-autoloader
# RUN php artisan migrate
