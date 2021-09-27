FROM php:8.0.2-cli

# change timezone from UTC to KST
RUN apt-get update && \
    apt-get install -y tzdata && \
    ln -fs /usr/share/zoneinfo/Asia/Seoul /etc/localtime && \
    dpkg-reconfigure --frontend noninteractive tzdata

# install ext-zip
#RUN apt-get update && \
#	apt-get install -y libzip-dev unzip && \
#	docker-php-ext-install zip

# install ext-opcache(JIT)
RUN apt-get update && \
	docker-php-ext-install opcache && \
	echo "opcache.enable_cli=1" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini && \
	echo "opcache.jit_buffer_size=256M" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini

# xdebug
RUN pecl install xdebug && \
	echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini
