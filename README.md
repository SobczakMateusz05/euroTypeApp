# EURO TYPE APP

## ENGLISH

## Project assumptions

This web application was created to **typing euro 2024 matches** for closed group of friends. Can be user to bigger group and diffrent matches. Created in polish language (you can translate all to your own language). 

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

## System implementation

First import database (euro_database.sql) to your MySQL or MariaDB Server. **You can change data to your tournament matches in admin panel**. You have to change db information about your databse in **connect.php** and **connectlogin.php** ($db_host is your server link, $db_user is your db user, $db_pass is your db user pass, $db_name is name of your db). Then configure web engine (for example Apache2 or NGINX) with php engine (the best version 8). Add all file except euro_database.sql, README.md and .gitattributes to your hosted by web engine folder. 

## Polski

## Założenia projektu
Ta aplikacja internetowa została stworzona do **typowania meczów Euro 2024** dla zamkniętej grupy przyjaciół. Może być używana przez większe grupy oraz do innych meczów. Została stworzona w języku polskim (można przetłumaczyć wszystko na własny język).

## Technology Stack

### Języki

- **HTML**
- **CSS**
- **JavaScript**
- **PHP**
- **SQL**

### Bazy danych
- **MariaDB**
- **MySQL**

### Implementacja systemu

Najpierw zaimportuj bazę danych (euro_database.sql) do swojego serwera MySQL lub MariaDB. **Możesz zmienić dane dotyczące meczów turnieju w panelu administratora**. Musisz zmienić informacje o bazie danych w plikach **connect.php** oraz **connectlogin.php** ($db_host to link do twojego serwera, $db_user to użytkownik bazy danych, $db_pass to hasło użytkownika bazy danych, $db_name to nazwa twojej bazy danych). Następnie skonfiguruj silnik webowy (na przykład Apache2 lub NGINX) z silnikiem PHP (najlepsza wersja to 8). Przenieś wszystkie pliki oprócz euro_database.sql, README.md i .gitattributes do folderu hostowanego przez silnik webowy.