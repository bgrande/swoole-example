FROM phpswoole/swoole:4.6.4-php8.0-alpine

RUN docker-php-ext-install pdo pdo_mysql

CMD [ "php", "./app.php" ]