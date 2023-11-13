FROM yiisoftware/yii2-php:8.2-fpm-nginx

# Change document root for nginx
RUN sed -i -e 's|/app/web|/app/backend/web|g' /etc/nginx/conf.d/default.conf
