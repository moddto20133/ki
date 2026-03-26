FROM php:8.2-cli
WORKDIR /app
COPY . .
RUN composer install --working-dir=c2-server --no-interaction
CMD ["php", "-S", "0.0.0.0:10000", "-t", "c2-server"]
