FROM php:7.4-apache
COPY . /var/www/html
RUN docker-php-ext-install pdo_mysql
CMD ["apache2ctl", "-D", "FOREGROUND"]
