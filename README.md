
## Getting started
step 1
```sh
git clone https://github.com/Azerdaoui/Coding-Challenge-NM.git
```
step 2
```sh
composer install
```
step 3
```sh
npm install & npm run dev
```

## Create/Delete Product from command line

### Create a new product
```sh
php artisan create:product 
```
The command prompt will ask you for the product details (name, price, category, description).
A message of success will be prompted if the product was created successfully.

### Delete a product
```sh
php artisan delete:product 
```
The command prompt will ask you for the product name
A message of success will be prompted if the product was created successfully.

## Create/Delete Category from command line

### Create a new Category
```sh
php artisan create:category {category_name}
```

The command prompt will ask you for the category details (name, parent_id).
A message of success will be prompted if the product was created successfully.

### Delete a product
```sh
php artisan delete:category 
```
The command prompt will ask you for the category name
A message of success will be prompted if the product was created successfully.

## Create new Product test.

### run test
```sh
php artisan test
```