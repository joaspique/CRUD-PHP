FROM php:7.3-apache
RUN a2enmod rewrite
RUN docker-php-ext-install mysqli
RUN echo '<Directory "/var/www/html">\n\
    AllowOverride All\n\
</Directory>' >> /etc/apache2/apache2.conf
