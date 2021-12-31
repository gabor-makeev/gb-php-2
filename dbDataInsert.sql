# Данные для наполнения тестовой и основной баз данных

drop database if exists gb_php_2_lesson_7;
create database gb_php_2_lesson_7;

# drop database if exists gb_php_2_lesson_7_test;
# create database gb_php_2_lesson_7_test;

use gb_php_2_lesson_7;
# use gb_php_2_lesson_7_test;

insert into company (name, history)
VALUES
    ('Apple', 'This company has some decent history'),
    ('Microsoft', 'This company has some great history');

insert into application (company_id_id, name, description)
VALUES
    (1, 'Pages', 'In this app you can write text content. Developed by Apple.'),
    (1, 'Numbers', 'In this app you can edit and create spreadsheets. Developed by Apple.'),
    (2, 'Microsoft Word', 'This is an app for document formatting and text editing and creation. Developed by Microsoft.'),
    (2, 'Microsoft Excel', 'App for spreadsheet editing and creation. Developed by Microsoft.');

insert into programming_lang (name)
values ('Objective-C'), ('C'), ('JavaScript'), ('C++');

insert into application_programming_lang (application_id, programming_lang_id)
VALUES (1, 1), (1, 2), (1, 3), (2, 1), (2, 2), (2, 3), (3, 4), (4, 4);