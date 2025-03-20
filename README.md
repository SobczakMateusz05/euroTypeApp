<h1 align="center"> EURO TYPE APP </h1> <br>

## Table of Contents/Spis treści
- [ENGLISH](#english)
   - [Project Assumptions](#project-assumptions)
   - [Technology Stack](#technology-stack)
      - [Languages](#languages)
      - [Databasese](#databases)
   - [System Implementation](#system-implementation)
- [POLSKI](#polski)
   - [Założenia Projektu](#założenia-projektu)
   - [Technology Stack](#technology-stack-1)
      - [Języki](#języki)
      - [Bazy Danych](#bazy-danych)
   - [Implementacja Systemu](#implementacja-systemu)

## ENGLISH

## Project Assumptions

This web application was created to **typing euro 2024 matches** for closed group of friends. Can be use for bigger group and diffrent matches. Created in polish language (you can translate all to your own language). 

## Technology Stack

### Languages

- **HTML**
- **CSS**
- **JavaScript**
- **PHP**
- **SQL**

### Databases

- **MariaDB**
- **MySQL**

## System Implementation

1. Import database (euro_database.sql) to your MySQL or MariaDB Server ( **You can change data to your tournament matches in admin panel**)
2. change db information about your databse in **connect.php** and **connectlogin.php** ($db_host is your server link, $db_user is your db user, $db_pass is your db user pass, $db_name is name of your db).
3. configure web engine (for example Apache2 or NGINX) with php engine (the best version 8).
4. Add all file except euro_database.sql, README.md and .gitattributes to your hosted by web engine folder.
   
## POLSKI

## Założenia Projektu
Ta aplikacja internetowa została stworzona do **typowania meczów Euro 2024** dla zamkniętej grupy przyjaciół. Może być używana przez większe grupy oraz do innych meczów. Została stworzona w języku polskim (można przetłumaczyć wszystko na własny język).

## Technology Stack

### Języki

- **HTML**
- **CSS**
- **JavaScript**
- **PHP**
- **SQL**

### Bazy Danych
- **MariaDB**
- **MySQL**

## Implementacja Systemu

1. Zaimportuj bazę danych (euro_database.sql) do swojego serwera MySQL lub MariaDB (**Możesz zmienić dane o swoich meczach turniejowych w panelu administratora**).
2. Zaktualizuj informacje o bazie danych w **connect.php** i **connectlogin.php** ($db_host to link do twojego serwera, $db_user to użytkownik bazy danych, $db_pass to hasło użytkownika bazy danych, $db_name to nazwa twojej bazy danych).
3. Skonfiguruj silnik webowy (np. Apache2 lub NGINX) z silnikiem PHP (najlepiej wersja 8).
4. Dodaj wszystkie pliki oprócz euro_database.sql, README.md i .gitattributes do folderu obsługiwanego przez twój silnik webowy.
