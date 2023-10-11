# 就職者情報閲覧サイト

Laravel 10 + Vue 3 + Inertia.js で作成

|使用パッケージ|説明|
|---|---|
|vue-chartjs|統計グラフ作成に使用|
|chartjs-plugin-datalabels|Chart.jsのグラフ上にラベルを追加|
|@vueform/toggle|Vue3で使用できるトグルボタンコンポーネント|
|vue-select@beta|複数選択可能なタグ付きセレクトボックスコンポーネント|
|vue-i18n@9|Vueの多言語化対応($t()で言語切り替え)|
|@intlify/unplugin-vue-i18n|多言語対応で使用するメッセージ定義を用意する|

## 動作環境

- PHP Ver8.1以上
- composer 2.2.6
- Node.js v16.20.0
- git

## 実行方法

任意のフォルダでプロジェクトをクローンし、composerでPHPライブラリを、npmでNode.jsパッケージをインストールする。

```bash
git clone https://github.com/shibamirai/job-finder.git
cd job-finder
composer install
npm install
```

.env_sampleをコピーして.envを作成する。  

SQLiteを使用する場合は、.envのデータベース接続情報を下記のように修正する。(下記以外のDB_xxxxという項目はすべて削除)

```conf
DB_CONNECTION=sqlite
```

また、databaseフォルダの中に database.sqlite という名前で空のファイルを作成する。

```bash
job-finder
 └─ database
     ├─ factories
     ├─ migrations
     ├─ seeders
     └─ database.sqlite   <-- 新規作成
```

マイグレーション。

```bash
php artisan migrate
```

Laravelアプリを最初に立ち上げるときはアプリケーションキーを作る必要があるため、以下を実行して作成する。

```bash
php artisan key:generate
```

起動する。

```bash
php artisan serve
```

[http://localhost:8000](http://localhost:8000)で閲覧できる。(ただしデータは空っぽ)

## 管理者ユーザの作成

ログインしないとデータの入力ができないため、シーダーを使って管理者ユーザを作成する。(権限を設定しているわけではないので、厳密には管理者ではなくただの初期ユーザ)  
.envに下記設定を追加すると、シーダーでユーザを作成できるようにしている。

```bash
MANAGER_NAME=名前
MANAGER_EMAIL=メールアドレス
MANAGER_PASSWORD=パスワード
```

シーダー実行

```bash
php artisan db:seed
```

このアカウント情報で画面右上の```ログイン```からログインできる。

## ダミーデータの作成

ダミーデータ用シーダーを実行する

```bash
php artisan db:seed --class DummySeeder
```
