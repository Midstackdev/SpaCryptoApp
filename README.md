## About Laravel

SPACrypto is a single page crpto-currency wallet application build with Laravel API and the Vue.js framework and Bitgo API.

## Features
- Laravel 6
- Vue.js
- Bulma css
- Bitgo Express Server Api
- Authy 
- JWT Authentication 
- Mailtrap 


## Installation
- Clone the repo
- Copy .env.example to .env
- Configure .env
- Run composer install
- Run php artisan key:generate
- Run php artisan migrate
- Run php db seed
- Run npm install


## Setup
- Set your JWT_SECRET in .env
- Set your AUTHY_SECRET in .env
- Set your BITGO_SECRET in .env
- Make sure you have bitgo express server running locally
- Run php artisan queue:listen in the background to queue mails
- You are ready to begin testing
