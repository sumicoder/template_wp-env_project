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
1. ルートディレクトリで`npm i` - （node_moduleインストール）
2. ルートディレクトリで`npm run start` - （DockerにWordPress）インストール

## WordPressログイン
ユーザー名：`admin`

パスワード：`password`