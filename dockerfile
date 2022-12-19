FROM php:7.4-apache
COPY . /var/www/html
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install gd
CMD ["apache2ctl", "-D", "FOREGROUND"]
