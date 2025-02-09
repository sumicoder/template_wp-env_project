# template_wp-env_project

wp-env を使用したテンプレート

ご自身の作業ディレクトリにクローンしてください。

# 事前準備

1. Docker Desktop 起動
2. `/dist/`にあるテーマファイル名を開発テーマ名にする
3. `.wp-env.json`にある`"mappings"`のオブジェクトにあるテーマファイル名を`/dist/`にあるテーマファイル名に合わせる

```json
    "mappings": {
        "wp-content/themes/wp-theme-name/": "./dist/wp-theme-name/",
        :
    }
```

↑`/wp-theme-name/`の部分 2 箇所

4. `package.json`にあるテーマファイル名を`/dist/`にあるテーマファイル名に合わせる

```json:package.json
"env:init": "wp-env start && wp-env run cli wp theme activate wp-theme-name && wp-env run cli wp theme delete --all && wp-env run cli wp option update timezone_string 'Asia/Tokyo'"
```

↑`&& wp-env run cli wp theme activate wp-theme-name`の`wp-theme-name`の部分 1 箇所

5. `.gitignore`の除外ディレクトリを環境変数に合わせる

```.gitignore
/dist/wp-theme-name/assets/css
/dist/wp-theme-name/assets/js
/dist/wp-theme-name/assets/images
```

↑`/wp-theme-name/`の部分 3 箇所

## 立ち上げ

### wp-env の起動

1. ルートディレクトリで`npm i`（**wp-env 関連の**node_module インストール）
2. ルートディレクトリで`npm run env:init`

### Gulp がある場合

1. `cd ./dist/wp-theme-name/gulp`で gulp ディレクトリに移動
2. `npm i`**gulp 関連の**node_module インストール
3. `npx gulp dev`で Gulp 起動

### ２回目以降の起動方法

1. Docker Desktop 起動
2. Docker Containers の中にある該当の Name を起動する
3. 更新がある場合
    - Git から更新内容をプルする
    - `npm run import`でデータベースを更新する
4. タスクランナーなどの起動

## WordPress ログイン

### wp-env(Docker)側の URL

サイト URL：`http://localhost:12345/`

管理画面 URL：`http://localhost:12345/wp-admin/`

ユーザー名：`admin`

パスワード：`password`

### タスクランナーがある場合はそれに準ずる

例：`http://localhost:3000/`

## よく使うコマンド

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

> 注意
> `npm run start`や`npm run update`をすると`.wp-env.json`の内容で WordPress がインストールされるので、初期テーマなどが再度インストールされます。

### Docker コンテナの名前変更

```
# docker rename old_container_name new_container_name
```
