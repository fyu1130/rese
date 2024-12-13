# rese（飲食店予約アプリ）

## 作成した目的

-外部の飲食店予約サービスは手数料を取られるので自社で予約サービスを持ちたい。

## 機能一覧

会員登録
ログイン
ログアウト
お気に入り機能
検索機能
飲食店予約機能
予約変更機能
評価機能
権限別機能
ストレージ保存
メール認証
メール送信
リマインダー
QRコード生成
QRコード確認

## ER 図

![image](https://github.com/user-attachments/assets/19151a66-c5e8-423c-84e6-383d40d54f6d)

## セットアップ手順

## Laravel Docker 環境構築

このプロジェクトは、Laravel 開発のための Docker 環境を提供します。以下のサービスが含まれています：

- **Nginx**: Laravel アプリケーションを提供する Web サーバー。
- **PHP-FPM**: PHP 7.4 実行環境。
- **MySQL**: UTF-8 設定済みのデータベースサーバー。
- **PhpMyAdmin**: データベース管理ツール。
- **Mailhog**: メールテスト用ツール。
- **App**: Laravel アプリケーションコンテナ。

---

## 必要条件

以下がシステムにインストールされていることを確認してください：

- Docker: [インストールガイド](https://docs.docker.com/get-docker/)
- Docker Compose: [インストールガイド](https://docs.docker.com/compose/install/)

---

## 環境構築

**Docker ビルド**

1. `git clone git@github.com:fyu1130/rese.git`
2. DockerDesktop アプリを立ち上げる
3. `docker-compose up -d --build`

> _Mac の M1・M2 チップの PC の場合、`no matching manifest for linux/arm64/v8 in the manifest list entries`のメッセージが表示されビルドができないことがあります。
> エラーが発生する場合は、docker-compose.yml ファイルの「mysql」内に「platform」の項目を追加で記載してください_

```bash
mysql:
    platform: linux/x86_64(この文追加)
    image: mysql:8.0.26
    environment:
```

**Laravel 環境構築**

1. `docker-compose exec php bash`
2. `composer install`
3. 「.env.example」ファイルを 「.env」ファイルに命名を変更。または、新しく.env ファイルを作成
4. .env に以下の環境変数を追加

```text
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass

MAIL_FROM_ADDRESS=test@icloud.com
```

5. アプリケーションキーの作成

```bash
php artisan key:generate
```

6. マイグレーションの実行

```bash
php artisan migrate
```
6. シードの実行

```bash
php artisan DB:seed
```

## 使用技術

### **バックエンド**
- **PHP**: 7.4.9  
  サーバーサイドの処理全般を担当。
- **Laravel**: 8.83.27  
  フルスタックのPHPフレームワーク。
- **Laravel Fortify**: 最新版  
  ユーザー認証機能（ログイン、登録、メール認証、パスワードリセット）を提供。
- **Simple QrCode**: 最新版  
  QRコード生成のためのライブラリ。

---

### **フロントエンド**
- **HTML5/CSS3**: スタイルとレイアウトを担当。
- **Bootstrap**: 5.x  
  レスポンシブデザインの実現。
- **JavaScript**: ES6+  
  動的な操作やUI/UX向上のためのスクリプト。

---

### **インフラストラクチャー**
- **Docker**: 20.10.x  
  開発環境の仮想化を担当。
- **Docker Compose**: 1.29.x  
  マルチコンテナ環境を簡単に管理。
- **Nginx**: 1.21.1  
  Webサーバーとしてリクエストの処理を担当。
- **MySQL**: 8.0.26  
  データベース管理システム（DBMS）。
- **phpMyAdmin**: 最新版  
  データベースの管理インターフェース。
- **Mailhog**: 最新版  
  ローカル環境でのメール送信の確認。


## URL

- 開発環境：http://localhost/
- phpMyAdmin:：http://localhost:8080/
- mailhog::http://localhost:8025/
