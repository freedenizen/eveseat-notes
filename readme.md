[![Latest Stable Version](https://poser.pugx.org/freedenizen/eveseat-notes/v/stable)](https://packagist.org/packages/freedenizen/eveseat-notes)
[![Latest Unstable Version](https://poser.pugx.org/freedenizen/eveseat-notes/v/unstable)](https://packagist.org/packages/freedenizen/eveseat-notes)
[![License](https://poser.pugx.org/freedenizen/eveseat-notes/license)](https://packagist.org/packages/freedenizen/eveseat-notes)

This repository contains a note add-on for [SeAT](https://github.com/eveseat/seat)  

## documentation & installation
In your seat installation directory e.g. /var/www/seat: 
* Run: `composer require freedenizen/eveseat-notes`
* Modify `config/app.php`
** After `Seat\Web\WebServiceProvider::class,` add: `Seat\Notes\NotesServiceProvider::class,`
* run `php artisan vendor:publish --force`
* run `php artisan migrate` 
