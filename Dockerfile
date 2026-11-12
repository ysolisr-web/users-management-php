FROM php:8.2-apache

# Instalar extensiones de PHP necesarias para MySQL y manejo de cadenas
RUN docker-php-ext-install pdo pdo_mysql mysqli mbstring

# Habilitar mod_rewrite de Apache
RUN a2enmod rewrite

# Configurar DocumentRoot hacia la carpeta /public de la Arquitectura Hexagonal
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copiar el código fuente del proyecto al contenedor
COPY . /var/www/html/

# Asignar permisos adecuados al servidor web
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Exponer el puerto 80
EXPOSE 80