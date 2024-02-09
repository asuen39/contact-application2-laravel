# お問い合わせフォーム

## 環境構築
- git clone リンク: git@github.com:asuen39/contact-application2-laravel.git</a>
- docker-compose up -d --build
- ※Mysqlは環境によって起動しない場合があります。それぞれの環境に合わせてdocker-compose.ymlの編集を行ってください。
- ※osによってファイルの権限の指定する可能性があります。sudo chmod -R 777 * 等環境に合わせて指定してください。

### laravel環境構築
- docker-compose exec php bash
- composer install
- .env.exampleからコピーして.env ファイル作成。環境変数を設定。データベースが作成されているか確認。
- php artisan key:generate
- php artisan migrate -テーブル作成
- php artisan db:seed　テーブルへデータの挿入

## 使用技術(実行環境)
- PHP 8.0
- Laravel  8.83
- Mysql 8.0

## URL
- お問い合わせフォーム入力ページ: /
- お問い合わせフォーム確認ページ: /confirm
- サンクスページ: /thanks
- 管理画面: /admin
- ユーザ登録ページ: /register
- ログインページ: /login
