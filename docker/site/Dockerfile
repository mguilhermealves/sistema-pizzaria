FROM php:7.2-apache
COPY gerenciador.conf /etc/apache2/sites-available/gerenciador.conf
RUN a2ensite gerenciador.conf
RUN apt-get update 
RUN docker-php-ext-install mysqli 
RUN a2enmod headers rewrite
#RUN usermod -u root www-data