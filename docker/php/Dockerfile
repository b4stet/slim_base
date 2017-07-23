FROM php:7.1-fpm

RUN apt-get update

WORKDIR /var/www/html
RUN set -ex \
	&& cd /usr/local/etc \
	&& {\
		echo '[global]'; \
		echo 'daemonize = no'; \
		echo; \
		echo '[www]'; \
		echo 'listen = 0.0.0.0:9000'; \
} | tee php-fpm.d/zz-docker.conf

RUN docker-php-ext-install pdo_mysql

EXPOSE 9000

CMD ["php-fpm"]