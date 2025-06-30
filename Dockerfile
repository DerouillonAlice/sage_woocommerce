FROM php:8.2-apache

# Installer les extensions PHP nécessaires
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Activer mod_rewrite
RUN a2enmod rewrite

# Modifier DocumentRoot
RUN sed -i 's|/var/www/html|/var/www/web|' /etc/apache2/sites-available/000-default.conf

# Définir le nouveau DocumentRoot
ENV APACHE_DOCUMENT_ROOT=/var/www/web
