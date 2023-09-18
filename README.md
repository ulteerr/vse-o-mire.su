### start

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
