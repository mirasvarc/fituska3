# Fituška 3
Portál pro studenty FIT VUT v Brně.

### Požadavky

- PHP 7.4
- MySQL ^5.6
- Composer 2.0
- Git

### Instalace
1. Stažení repozitáře z GitHubu
    git clone git@github.com:mirasvarc/fituska3.git  

2. Ve kořenové složce projektu nainstalovat závislosti
    composer install  

3. Spustit migrace, nebo importovat soubor fituska.sql do databáze  
    Spuštění migrací:  
    php artisan migrate  

4. Do .env souboru vyplnit údaje k databázi
    >DB_CONNECTION=mysql  
    >DB_HOST=127.0.0.1  
    >DB_PORT=3306  
    >DB_DATABASE=fituska  
    >DB_USERNAME=root  
    >DB_PASSWORD=  

5. Spuštění aplikace na lokálním stroji
    php artisan serve  
Poté aplikace běží na adrese [http://127.0.0.1:8000/](http://127.0.0.1:8000/)



## Discord robot

### Požadavky
- Python >= 3.7
- discord.py library
- Quart library

### Spuštění

Pro plnou funkčnost je potřeba spustit oba skripty ve složce *fituska_bot*  

    $ python fituska.py  
    $ python fituska_api.py  

A oba skripty nechat běžet v pozadí.  
