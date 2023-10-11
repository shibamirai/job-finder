# 就職者情報閲覧サイト

Laravel 10 で作成

## 動作環境

- PHP Ver8.1以上
- composer 2.2.6
- Node.js v16.20.0
- git

## 実行方法

任意のフォルダでプロジェクトをクローンし、composerでPHPライブラリを、npmでNode.jsパッケージをインストールする。

```cmd
> git clone https://github.com/shibamirai/job-finder.git
> cd job-finder
> composer install
> npm install
```

.env_sampleをコピーして.envを作成する。  

SQLiteを使用する場合は、.envのデータベース接続情報を下記のように修正する。(下記以外のDB_xxxxという項目はすべて削除)

```conf
DB_CONNECTION=sqlite
```

また、databaseフォルダの中に database.sqlite という名前で空のファイルを作成する。

```cmd
job-finder
 └─ database
     ├─ factories
     ├─ migrations
     ├─ seeders
     └─ database.sqlite   <-- 新規作成
```

マイグレーション。

```cmd
> php artisan migrate
```

Laravelアプリを最初に立ち上げるときはアプリケーションキーを作る必要があるため、以下を実行して作成する。

```cmd
> php artisan key:generate
```

起動する。

```cmd
> php artisan serve
```

[http://localhost:8000](http://localhost:8000)で閲覧できる。(ただしデータは空っぽ)

## 管理者ユーザの作成

ログインしないとデータの入力ができないため、シーダーを使って管理者ユーザを作成する。(権限を設定しているわけではないので、厳密には管理者ではなくただの初期ユーザ)  
.envに下記設定を追加すると、シーダーでユーザを作成できるようにしている。

```cmd
MANAGER_NAME=名前
MANAGER_EMAIL=メールアドレス
MANAGER_PASSWORD=パスワード
```

シーダー実行

```cmd
> php artisan db:seed
```

このアカウント情報で画面右上の```ログイン```からログインできる。

## ダミーデータの作成

ダミーデータ用シーダーを実行する

```cmd
php artisan db:seed --class DummySeeder
```
