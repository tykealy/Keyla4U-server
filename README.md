<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About project

Kayla4U is an innovative platform that allows users to easily book sports courts such as football and badminton. With a user-friendly interface, users can view a map of nearby sports clubs and check the availability and hourly rates of each court. With just one click, users can book their desired court and make a secure payment through the platform. In addition, users can also post on the website to find opponent teams for their games. Club owners and administrators can manage court availability and pricing through the platform. When a user books a court, both the club owner and user receive an SMS notification to confirm the booking. The system automatically updates court availability to ensure a seamless booking experience.


# Things to do

sign in with [mailstrap](https://mailtrap.io/)

go to email Testing > inbox > SMTP setting > Integrations >laravel 7+

copy the configuration and you can configure your mailing configuration by setting these values in the .env file in the root directory of your project.
```
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=dbab18ce2fbcef
MAIL_PASSWORD=c3b13822295bed
MAIL_ENCRYPTION=tls
```

## seeding data
```
php artisan db:seed --class=Account_typeTableSeeder
php artisan db:seed --class=UserTableSeeder
php artisan db:seed --class=ClubTableSeeder
php artisan db:seed --class=FavoriteTableSeeder
php artisan db:seed --class=Court_categoryTableSeeder
php artisan db:seed --class=CourtTableSeeder
php artisan db:seed --class=PitchTableSeeder
php artisan db:seed --class=Pitch_avalible_timesTableSeeder
php artisan db:seed --class=OrdersTableSeeder
```

## Running project

**Running project**

```
npm run dev
php artisan serve
```

**Build production**

```
npm run build
```

##

## License
[tk] "https://github.com/tykeaboyloy"

