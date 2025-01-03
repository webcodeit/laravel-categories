php artisan make:migration create_categories_table
php artisan make:migration create_products_table
php artisan make:migration create_category_product_table



php artisan make:controller ProductController --resource


php artisan make:factory CategoryFactory

php artisan make:seeder CategoryTableSeeder

php artisan db:seed --class=CategoryTableSeeder



1) php artisan make:model Post -mcr
    this comand use create Post modal,  post migrate table file , Porstcontroller resource  
