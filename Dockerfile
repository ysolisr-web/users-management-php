FROM php:8.2-apache

# Instalar dependencias del sistema necesarias para mbstring y extensiones PHP
RUN apt-get update && apt-get install -y \
    libonig-dev \
    && docker-php-ext-install pdo_mysql mysqli mbstring \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Habilitar mod_rewrite de Apache
RUN a2enmod rewrite

# Configurar DocumentRoot hacia la carpeta /public
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copiar el código fuente del proyecto al contenedor
COPY . /var/www/html/

# Asignar permisos adecuados al servidor web
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Adaptar Apache al puerto dinámico que asigna Render (por defecto 80)
CMD ["sh", "-c", "sed -i \"s/80/${PORT:-80}/g\" /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf && apache2-foreground"]