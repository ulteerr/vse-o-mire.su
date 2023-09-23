### Установка редис
	https://www.dmosk.ru/miniinstruktions.php?mini=redis-ubuntu

	apt-get update

	apt-get install redis-server

	nano /etc/redis/redis.conf
	Меняем значение для директивы supervised:
	supervised systemd

	systemctl enable redis-server

	systemctl restart redis-server

	nano /etc/redis/redis.conf

### start

	sudo apt-get install php-igbinary
	sudo apt-get install php-redis

	run composer install
	run npm i
	run npm run build for prod or npm run watch for dev
	php app/lib/migrate.php up
	php app/lib/faker.php

### env 

	create .env file and copy env-example
	
### Если проблемы с npm

	npm cache clean --force
	rm -rf node_modules
	rm -rf package-lock.json
	npm install
