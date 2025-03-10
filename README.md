﻿# SQL queries store

# Project Overview:
```
Application for testing the sql queries.
```

# Technologies Used
Backend: PHP, PDO, MySQL.
Frontentd: Javascript, jQuery 3+, Bootstrap 4.3.
Authentication: no.
Data format: JSON.
Deployment: GitHub.

# Application features
- The settings for connecting to the database are stored in the .env file. ./vendor/autoload.php create array $_ENV.
- Header. It imported into each page. :hover styles, the active page is highlighted.
- Header has log-in select
![screen](https://github.com/bart-git21/JS-PHP-MySQL--sql-queries-testing/blob/main/login.jpg)
- The selected user is stored in localStorage. It is displayed when you navigate between pages. 
- Intro page show all user queries.
![screen](https://github.com/bart-git21/JS-PHP-MySQL--sql-queries-testing/blob/main/intro.jpg)
- Queries page show queries for logged user
![screen](https://github.com/bart-git21/JS-PHP-MySQL--sql-queries-testing/blob/main/select.jpg)