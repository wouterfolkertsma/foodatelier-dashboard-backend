composer install
npm install
php artisan db:wipe
php artisan migrate
php artisan db:seed
php artisan make:user --type=employee --name=admin --lastname=admin --email=test@foodatelier.nl --password=test
npm run prod
php artisan cache:clear