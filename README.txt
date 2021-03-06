        Задание
1. Напишите DDL для базы "Библиотека Компании". 
База должна содержать следующие таблицы:
•	Книга (название, дата создания записи, дата изменения)
•	Авторы (имя, дата создания записи, дата изменения)
•	Читатели  (имя, дата создания записи, дата изменения)
Дамп должен быть готов к использованию в «боевой» выкладке.

2. Используя фреймворк Yii реализуйте CRUD сценарии для работы с базой "Библиотека Компании".

3. Создайте контроллер отчета, реализующий следующие сценарии:
•	Вывод списка книг, находящихся на руках у читателей, и имеющих не менее трех со-авторов.
•	Вывод списка авторов, чьи книги в данный момент читает более трех читателей.
•	Вывод пяти случайных книг.

4. Залейте исходный код на ваш аккаунт Github, предоставьте доступ для аккаунта yelsukov

5. Опишите, наиболее быстрый и производительный, на ваш взгляд, способ полнотекстового поиска по таблицам книг и авторов. Большим плюсом будет реализация в коде тестового задания.

6. Есть web-ресурс с высокой посещаемостью. Ресурс работает на nginx + php-fpm. Необходимо реализовать счетчик уникальных посещений. Опишите ваш вариант реализации данного счетчика. Только описание, реализации в коде не надо.

----------------------------------------------------------------------------------------------------------------------
Для развертывания проекта:
репозиторий: git@github.com:ivanzamorano82/library_company.git
сам фреймворк должен лежать по пути dirname(__FILE__).'/../yii/framework/yii.php';

Решения:

1. Создал миграцию для создания боевой структуры БД - можно запустить ее. Либо можно воспользоваться дампом /protected/data/library_company.sql
2. Реализован
3. Реализован
4. Реализован
5. Для полнотекстового поиска по таблицам типа MyIsam есть способ определения  тектстовых столбцов как индексы типа FULLTEXT, но таблицы типа InnoDB такой возможности лишены.
    Тот метод, который бы я реализовывал: разбиение входящую фразу на пробелы и формирование запроса с помощью like, но сравнительные характеристики показывают, что подобный метод очень уступает
    предидущему во времени. Также существуют сторонние решения Sphinx и проекты на базе Apache Lucene. Сообщество хвалит и советует один из них. Могу попробовать, если посоветуете на каком варианте остановится.
6. Реализация счетчика:
    Сразу нужно определить для себя, что такое уникальность: разные айпишники либо разные посетители с разных браузеров. 
    Также необходимо знать - за какой период считать уникального посетителя. Предположим T часов.
    Пусть глобальный счетчик (хронимый, где нибудь в базе) будет Count=0;
    В первом случае я бы на входящем скрипте поставил шпиона, который бы проверял наличие входящего айпишника и очищал информацию о посетителях по
истечению срока записи на время T (если это необходимо). Если уже такой айпишники
существует в таблице уникальных посетителей и время его жизни меньше T, то счетчик не инкрементировать. Если же время пребывания определенного
посетителя (айпишника) больше T, то произвести инкремент Count.
    Во втором случае тоже самое, только при заходе уникально постетителя создавать кук со временем жизни T. Пока кук живой счетчик не увеличивается.
    Счетчик увеличивается только при создании кука.
    Второй способ - плох тем, что со стороны клиента можно стереть куки, и счетчик с данным клиентом уже отработает не совсем честно.
Для того, чтобы клиент был еще более уникальным, нужно еще проверять на входящий браузер и устройство, потому что возможен вариант вхождения
с одного роутера (у которых один айпишник). В данном случае конечно удобнее использовать куки, но я уже писал о его недостатке.
Функциональность учета посещения можно расширить записывая информации о входящих посетителях в БД. Таким образом можно создать различные статистки посещений:
за период с полной информацией о посетителе. 
Таким же образом можно осуществить учет посещений всех страниц сайта в отдельности.

p.s.: YII в бою использовал первый раз, возможно не всегда правильно использовал методику данного фреймворка. 
Старался не уходить за рамки его функционала.

