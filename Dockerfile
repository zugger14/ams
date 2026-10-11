FROM php:7.4-apache

# Install mysqli for CodeIgniter database connection
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Enable Apache mod_rewrite for CodeIgniter clean URLs
RUN a2enmod rewrite

# Update default apache site to allow .htaccess overrides
RUN echo '<Directory /var/www/html/>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' > /etc/apache2/conf-available/allow-override.conf && \
    a2enconf allow-override

WORKDIR /var/www/html

# Copy application source code into image
COPY . /var/www/html/

# Create lowercase file symlinks inside Linux container for case-insensitive compatibility
RUN cd /var/www/html/application/controllers && \
    for f in *.php; do \
      low=$(echo "$f" | tr '[:upper:]' '[:lower:]'); \
      if [ "$f" != "$low" ] && [ ! -e "$low" ]; then \
        ln -s "$f" "$low"; \
      fi; \
    done && \
    cd /var/www/html/application/models && \
    for f in *.php; do \
      low=$(echo "$f" | tr '[:upper:]' '[:lower:]'); \
      if [ "$f" != "$low" ] && [ ! -e "$low" ]; then \
        ln -s "$f" "$low"; \
      fi; \
    done

# Set ownership and permissions for Apache web server
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html

EXPOSE 80
