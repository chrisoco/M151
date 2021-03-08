# M151
Datenbanken in Webauftritt einbinden

## Installation

Installations voraussetzungen

- Xampp
- Composer
- git

Konsole an gewünschtem Ort öffnen und folgende Befehle ausführen

- `git clone https://github.com/chrisoco/M151.git`
- `cd M151/m151`
- `composer install`
- `copy .env.example .env`
- `php artisan key:generate`
- Leere Db erstellen und .env ergänzen
- `php artisan migrate`
- `php artisan db:seed`

Umbedingt den Ordner M151 umbenennen zu m151 oder einen virtuellen Host erstellen!

Die Installation kann überprüft werden indem man den Server startet

`xampp: Apache & MySQL müssen gestartet werden`

Danach erscheint eine URL die man öffnen kann.

## Tipps und Bugs

Um die Datenbank zu leeren und die Migrations und den Seeder auszuführen: 
`php artisan migrate:fresh --seed`

Falls Seeder nicht erkannt werden hilft:
`composer dump-autoload`
