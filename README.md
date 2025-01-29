# template_wp-env_project

wp-env を使用したテンプレート

ご自身の作業ディレクトリにクローンしてください。

# 事前準備

1. Docker Desktop 起動
2. `.env`を作成（`.env.sample`を参照）
3. `.env`の環境変数を変更

```:.env
WP_THEME_NAME=wp-theme-name
```

4. `/dist/`にあるテーマファイル名を環境変数に合わせる
5. `package.json`にあるテーマファイル名を環境変数に合わせる

```
"env:init": "node generate-wp-env.js && wp-env start && wp-env run cli wp theme activate wp-theme-name && wp-env run cli wp theme delete --all && wp-env run cli wp option update timezone_string 'Asia/Tokyo'"
```

↑`&& wp-env run cli wp theme activate wp-theme-name`の`wp-theme-name`の部分

## 立ち上げ

1. ルートディレクトリで`npm i`（**wp-env 関連の**node_module インストール）
2. ルートディレクトリで`npm run env:init`

### Gulp がある場合

1. `cd ./dist/wp-theme-name/gulp`で gulp ディレクトリに移動
2. `npm i`**gulp 関連の**node_module インストール
3. `npx gulp dev`で Gulp 起動

## WordPress ログイン

サイトURL：`http://localhost:12345/`

管理画面 URL：`http://localhost:12345/wp-admin/`

ユーザー名：`admin`

パスワード：`password`

## よく使うコマンド

### ルートディレクトリ

-   初回起動

```
npm run env:init
```

-   データベースエクスポート

```
npm run export
```

-   データベースインポート

```
npm run import
```

:::note warn
注意
`npm run start`や`npm run update`をすると`.wp-env.json`の内容で WordPress がインストールされるので、初期テーマなどが再度インストールされます。
:::
