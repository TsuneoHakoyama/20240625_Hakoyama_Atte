# Atte
###### 概要:勤怠管理アプリ
![top-view](https://github.com/TsuneoHakoyama/Atte/assets/155647560/b9239e68-135f-47ea-b056-ac7cea2daa8b)

## 作成目的
###### 人事評価に必要な勤怠管理アプリ導入のため

## アプリケーションURL
###### 開発環境：http://localhost/
###### phpMyAdmin: http://localhost:8080
###### MailHog: http://localhost:8025

## 他のリポジトリ
###### なし

## 機能一覧
###### 会員登録：ユーザー名、メールアドレス、パスワードを使ったユーザー登録機能。新規登録時にメールアドレス確認を行う。
###### ログイン：メールアドレスとパスワードによる認証機能。
###### ログアウト：ログアウト機能。
###### 勤務時間の記録：勤務開始及び勤務終了時に時刻を記録する。日を跨いだ時点で翌日の出勤操作に切り替える。
###### 休憩時間の記録：休憩開始及び休憩終了時に時刻を記録する。1日に何度も休憩が可能。
###### 日付別勤怠情報の表示：任意の日時の全ユーザーの勤怠情報をページ当たり5件ずつ表示。前日または翌日に遷移可。
###### ユーザー一覧表示：登録ユーザーの情報をページ当たり5件ずつ表示。任意のユーザーの勤怠情報に遷移可。
###### ユーザーの勤怠情報表示：任意のユーザーの勤怠情報をページ当たり5件ずつ表示。

## 使用技術
###### Docker version 26.1.1
###### Docker Compose version v2.27.0
###### nginx 1.21.1
###### PHP 7.4.9
###### Laravel 8.83.8
###### fortify 1.19.1
###### MySQL 8.0.26
###### MailHog

## テーブル設計
![table-design](https://github.com/TsuneoHakoyama/Atte/assets/155647560/6e261c54-d238-445e-b85b-da8464ca5ce6)

## ER図
![ER](https://github.com/TsuneoHakoyama/Atte/assets/155647560/0e5513f9-d347-40af-bb1d-2b4cfc012516)

## 環境構築
###### Dockerビルド
###### 1. git clone git@github.com:TsuneoHakoyama/20240615_Hakoyama_Atte.git
###### 2. docker compose up -d --build

###### Laravel環境構築
###### 1. docker compose exec php bash
###### 2. composer install
###### 3. cp .env.sample .env
###### 4. 環境変数の設定
###### 5. php artisan key:generate
###### 6. php artisan migrate --seed
###### 7. composer require laravel/fortify
###### 8. php artisan vendor:publish --provider="Laravel\Fortify\FortifyServiceProvider"
###### 9. localhostアクセス時にpermission deniedのエラーが出る場合は"$ sudo chmod -R 777 src/*"を実行
