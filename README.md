# template_wp-env_project
wp-envを使用したテンプレート

# 事前準備
1. `.wp-env.json`のポート番号部分を変更
```
"port": 54321,
"mysqlPort": 53306,
```
2. mappingsのテーマディレクトリの名前を変更
```
"mappings": {
	"wp-content/themes/wp-theme-name/": "./dist/wp-theme-name/",
	"sql": "./sql"
}
```

## 立ち上げ
1. ルートディレクトリで`npm i` - （**wp-env関連の**node_moduleインストール）
2. ルートディレクトリで`npm run start` - （DockerにWordPress）インストール
3. `cd ./dist/wp-theme-name/gulp`でgulpディレクトリに移動
4. `npm i`**gulp関連の**node_moduleインストール
5. `npx gulp dev`でgulp起動

## WordPressログイン
ユーザー名：`admin`

パスワード：`password`

## よく使うコマンド
### ルートディレクトリ
- Docker起動
```
npm run start
```
- Docker停止
```
npm run stop
```
- データベースエクスポート
```
npm run export
```
- データベースインポート
```
npm run import
```