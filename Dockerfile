FROM php:8.2-cli

# تثبيت Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app

COPY . .

RUN composer install --working-dir=c2-server --no-interaction

CMD ["php", "-S", "0.0.0.0:10000", "-t", "c2-server"]
