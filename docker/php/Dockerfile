FROM php:7.4.9-fpm

# php.ini のコピー
COPY php.ini /usr/local/etc/php/

# 必要なパッケージをインストール
RUN apt-get update \
    && apt-get install -y \
    default-mysql-client \
    zlib1g-dev \
    libzip-dev \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql zip gd

# Composer のインストール
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer \
    && composer self-update

# 作業ディレクトリを設定
WORKDIR /var/www

# Laravelプロジェクトの依存関係インストール
COPY ./src /var/www
RUN composer install --no-dev \
    && composer require laravel/fortify \
    && composer require simplesoftwareio/simple-qrcode \
    && composer require stripe/stripe-php # Stripeライブラリのインストールを追加

# Fortifyの設定ファイルを公開
RUN php artisan vendor:publish --provider="Laravel\Fortify\FortifyServiceProvider"

# 必要な設定ファイルのコピー（事前に作成しておいた.envなど）
COPY ./docker/php/php.ini /usr/local/etc/php/

# 権限設定
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# タイムゾーン設定
ENV TZ=Asia/Tokyo
RUN echo "date.timezone = Asia/Tokyo" >> /usr/local/etc/php/conf.d/timezone.ini
