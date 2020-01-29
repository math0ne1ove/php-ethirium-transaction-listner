##Setup
**Create .env file like .env.example** 
##Install

**Run the following commands**

```bash
cd to/project/path/docker
docker-compose build
docker-compose up -d
docker exec -it workspace /bin/bash
composer install
php artisan migrate
```
**Connect to websocket server**

```bash
php artisan websocket:connect
```

