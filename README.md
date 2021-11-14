# PHPを使ったGoogle OAtuhの動作検証コード

## docker用環境

|||
|---|---|
| PHP | 8.0 |
| サーバ | nginx:latest |
| ログイン用の遷移画面| http://localhost/index.php |
| Google  redirect先 | http://localhost/google-post.php |
| Microsoft   redirect先 | http://localhost/microsoft-post.php |
| userページ | http://localhost/user.php |


## Google OAuthを使うための下準備

1. Google Cloud Platform ホームにprojectの用意
2. OAuth同意画面の用意
   (redirect先urlは「http://*****/profile.php」 )
3. APIとサービス(https://console.cloud.google.com/apis/)を開く
4. 認証情報から「認証情報を作成」
    1. タイプはOAuth 2.0 クライアント ID
    2. リダイレクトURIを設定「(仮)http://*****/google-post.php」
5. 作成後、OAuth 2.0 クライアント IDの対象から認証上のjsonファイルを取得
6. ``src/config/client_secret.json`` に4のjsonファイルから情報を取得して
   .envにGOOGLE_CLIENTとGOOGLE_SECRETを記述

## microsoft OAuthを使うための下準備

1. Microsoft Graph Quick Startへ
   https://developer.microsoft.com/ja-jp/graph/quick-start?platform=option-php
    1. 言語-> php
    2. アプリ->アカウントログイン (アプリ名とアプリIDを取得)


1. アジュールポータルを開きログインする （https://aad.portal.azure.com/）
2. Azure Active Directoryを開く
3. ナビゲーションメニューから[アプリの登録]をクリックします。
4. 「アプリの登録」画面で、[新規登録]をクリックします。
5. 「アプリケーションの登録」画面で、アプリケーションの名前を入力します。
    1. 名前は必ず設定します。
    2. サポートアカウントを「任意の組織ディレクトリ内のアカウント (任意の Azure AD ディレクトリ - マルチテナント) と個人の Microsoft アカウント (Skype、Xbox など)
       」
    3. リダイレクトURLは「(仮)http://*****/microsoft-post.php」
6. 設定内容を確認し、[登録]をクリックします。 Azure portalに、アプリの概要が表示され、「アプリケーション (クライアント) ID」が発行されるので .envに記入する
7. ナビゲーションメニューから[証明書とシークレット]をクリックします。
8. 「証明書とシークレット」画面で、「クライアント シークレット」の[新しいクライアント シークレット]をクリックします。
9. 「クライアント シークレットの追加」ダイアログで、クライアント シークレットの説明と有効期限を設定します。
10. 設定内容を確認し、[追加]をクリックします。 「クライアント シークレット」が発行されます。(値の方)
    クライアント シークレットの値の[クリップボードにコピー]をクリックし、.envに記載

