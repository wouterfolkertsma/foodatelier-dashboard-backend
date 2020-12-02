php artisan cache:clear
php artisan config:clear
php artisan db:wipe
php artisan migrate
rm storage/app/storage/*
php artisan storage:link
php artisan db:seed
php artisan make:user --type=employee --name=admin --lastname=admin --email=test@foodatelier.nl --password=test
php artisan make:user --type=client --name=client --lastname=client --email=client@foodatelier.nl --password=test