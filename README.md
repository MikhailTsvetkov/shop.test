## Требования

* Docker

## Развертывание

#### Запуск Docker compose

```
docker compose up -d
```

#### Настройка переменных окружения

Скопируйте файл .env.example в файл .env
```
cp .env.example .env
```
Параметры подключения к бд уже настроены для контейнера mysql.

#### Создание базы данных

Файл дампа dump.sql бд находится в корневой директории проекта.

#### Имя домена
В файле C:\Windows\System32\drivers\etc\hosts
добавить запись:
```
127.0.0.1 shop.test
```
Сайт будет доступен по url:
```
http://shop.test
```

## Описание задания

Тестовое задание можно выполнять с использованием любых библиотек, но базовые технологии: PHP - MySQL - Javascript.
Обращать внимание при оценке будем в первую очередь на работоспособность и архитектурные наработки.


Нужно сделать следующее:
* На странице вывести плитку из товаров (3-5 штук). Каждый товар - картинка, цена, название
* При клике на плитку переход на страницу товара
* На странице товара - всё та же информация по товару и блок с отзывами
* В блоке с отзывами нужно иметь возможность оставить отзыв, который в последствии должен выводится на странице товара

Дизайн не принципиален, но качественное исполнение будет плюсом, вёрстка нужна адаптивная.
