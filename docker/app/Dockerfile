FROM php:5.6-apache
WORKDIR /var/www/html

RUN a2enmod rewrite
RUN docker-php-ext-install mysqli 
RUN docker-php-ext-enable mysqli
