FROM php:8.3-apache

COPY index.php /var/www/html/index.php
COPY ra2/ /var/www/html/ra2/
COPY ra3/ /var/www/html/ra3/
COPY ra4/ /var/www/html/ra4/

EXPOSE 80
