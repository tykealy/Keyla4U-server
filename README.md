<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About project

Kayla4U is an innovative platform that allows users to easily book sports courts such as football and badminton. With a user-friendly interface, users can view a map of nearby sports clubs and check the availability and hourly rates of each court. With just one click, users can book their desired court and make a secure payment through the platform. In addition, users can also post on the website to find opponent teams for their games. Club owners and administrators can manage court availability and pricing through the platform. When a user books a court, both the club owner and user receive an SMS notification to confirm the booking. The system automatically updates court availability to ensure a seamless booking experience.



# Domain
www.admin.keyla4u.store

# Getting start

Install composer and node module.
```
composer i
npm i
```

# create database name keyla4U
### migrate database
```
php artisan migrate
```

## seeding user
```
php artisan db:seed --class=UserTableSeeder
```
**superadmin role: superadmin@gmail.com password:12345678**

**admin role: admin@gmail.com password:12345678**

**user role: user@gmail.com password:12345678**


## Running project

```
npm run dev
php artisan serve
```

## Build production

```
npm run build
```

##

## License
[VT](https://github.com/vathantork)
