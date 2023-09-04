# 洛嬉遊戲 LSGames 討論板後端專案

> [返回根目錄](https://github.com/samuikaze/my-work-2023)

這是洛嬉遊戲的討論板後端專案，使用 Lumen Framework (PHP) 撰寫而成

## 說明

本專案是從[洛嬉遊戲 LSGames 後端專案](https://github.com/samuikaze/my-work-2023-lsgame-backend)所拆分出來其中一個專案，讓開發與維護可以更專注於最新消息這個領域。

## 事前準備

使用本專案前請先安裝以下軟體

- php 8.1 或以上
- composer 2.0 或以上
- MySQL 或 MariaDB
- Nginx 或 Apache

## 本機除錯

可以遵循以下步驟在本機進行除錯或檢視

> ⚠️請注意，`.env` 檔中的相關設定請依據需求作修改

1. `git clone` 將本專案 clone 到本機
2. 打開終端機，切換到本專案資料夾
3. 執行指令 `composer install && composer dump-autoload`
4. 啟動 `nginx` 或 `Apache` 伺服器

  > 也可使用 `php artisan serve` 啟動服務，但此方式在 CORS 預檢請求會得到 404 回應，目前仍未找出問題...
