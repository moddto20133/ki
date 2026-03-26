FROM php:8.2-cli

# تثبيت Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

# نسخ الملفات
COPY . .

# تثبيت dependencies
RUN composer install --working-dir=c2-server --no-interaction

# تشغيل الخادم
CMD ["php", "-S", "0.0.0.0:10000", "-t", "c2-server"]
