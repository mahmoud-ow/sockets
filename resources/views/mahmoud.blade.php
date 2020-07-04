[program:websockets]
command=php /var/www/html/artisan websockets:serv
numprocs=1
autostart=true
autorestart=true
user=root


