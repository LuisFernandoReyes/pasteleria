FROM mysql:5.7

ENV MYSQL_ROOT_PASSWORD=bd

EXPOSE 3306

COPY C:/BaseDatos /var/lib/mysql