FROM alpine:latest
LABEL author="Weronika Nowak"
RUN apk add apache2 php8-apache2 \
    && rm /var/www/localhost/htdocs/index.html
COPY ./index.php /var/www/localhost/htdocs/index.php
CMD echo Data i godzina uruchomienia > logi \
    && date >> logi \
    && echo Autor: Weronika Nowak >> logi \
    && echo Port TCP: 80 >> logi \
    && /usr/sbin/httpd -D FOREGROUND