


# PHPを使ったGoogle OAtuhの動作検証コード

## docker用環境

|||
|---|---|
| PHP | 7.4 |
| サーバ | nginx:latest |
| ログイン用の遷移画面| http://localhost/index.php |
| redirect先|http://localhost/profile.php |


## Google OAuthを使うための下準備
1. Google Cloud Platform ホームにprojectの用意
2. OAuth同意画面の用意
   (redirect先urlは「http://*****/profile.php」　)
3. 認証情報から「認証情報を作成」　タイプはOAuth 2.0 クライアント ID
4. 作成後、OAuth 2.0 クライアント IDの対象から認証上のjsonファイルを取得
5. ``src/config/client_secret.json`` に4のjsonファイルをリネームして置く


