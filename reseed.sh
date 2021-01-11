php artisan cache:clear
php artisan config:clear
php artisan db:wipe
php artisan migrate
rm storage/app/storage/*
rm storage/app/storage/avatars/*
php artisan storage:link
php artisan db:seed
