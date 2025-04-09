# 実践学習ターム 模擬案件初級_フリマアプリ

## 環境構築

Dockerビルド

1. `git@github.com:seiko01/mogi1.git`
2. DockerDesktopアプリの立ち上げ
3. `docker-compose up -d --build`

> *Mac の M3 チップの PC の場合、ビルドができないエラーが出た際は、docker- compose.ymlファイルの「mysql」内に「platform」の項目を追加で記載してください*

```bash
    mysql:
    image: mysql:8.0.26
    platform: linux/amd64
    environment:
```
Laravel環境構築
1. `docker-compose exec php bash`
2. `composer install`
3. 「.env.example」ファイルから「.env」を作成
4. 「.env」に以下の環境変数を追加

```bash
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```

5. アプリケーションキーの作成
```bash
php artisan key:generate
```
6. マイグレーションの実行
```bash
php artisan migrate
```
7. シーディングの実行
```bash
php artisan db:seed
```

## 使用技術(実行環境)
* PHP 7.4.9
* Laravel 8.83.29
* mysql 8.0.26

## ER図
![ER図](./img/drawio.png)

## URL
* 開発環境：http://localhost/
* phpMyAdmin：http://localhost:8080/
