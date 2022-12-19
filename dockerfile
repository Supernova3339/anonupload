FROM php:7.4-apache
COPY . /var/www/html
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install gd
RUN docker-php-ext-install zlib
CMD ["apache2ctl", "-D", "FOREGROUND"]
