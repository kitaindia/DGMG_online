<?php
/**
 * PHP掲示板設定ファイル
 * 
 * PHP version 5
 */

/**
 * PHP掲示板 設定値
 * 
 * @since Ver.0.20
 */
class JbBbsConf
{
    // {{{ 1. 管理
    /**
     * 管理者パスワード
     * 
     * 空白の場合、管理者による削除機能は利用できません
     */
    const ADMIN_PASSWORD = '0606';
    /**
     * 投稿文中にURLが含まれる場合に拒否するかどうか
     * 
     * 0: 拒否しない, 1: 管理者パスワード入力時のみ許可, 2: 全て拒否する
     * 
     * スパム投稿本文にはURLが含まれることが多いことから、この機能を有効にする(1,2)ことで
     * シンプルにスパム投稿を除外することができます。
     * 
     * @since Ver.0.20
     */
    const REJECT_URL = 1;
    /**
     * [スパム投稿対策機能] akismet APIキー 【※設定推奨】
     * 
     * この値を設定すると投稿データがスパムでないかakismetのAPIを使用してチェックします
     * PHP掲示板設置サーバーからakismetサーバーにHTTP通信が可能である必要があります。
     * 
     * APIキーは下記より取得できます(英語)
     * https://akismet.com/signup/
     * APIキー取得に際しては下記説明ページもご覧ください
     * http://jubei.co.jp/bbs/akismet.html
     * 
     * @since Ver.0.20
     */
    const AKISMET_APIKEY = '';
    /**
     * スパム投稿排除機能を使用するかどうか
     * 
     * 0: 使用しない, 1: 使用する(既定値)
     * 
     * akismet APIによるスパム投稿排除処理を実行します
     * 
     * @since Ver.0.20
     */
    const USE_ANTISPAM = 1;
    /**
     * bbs.phpトップページのURL
     * 
     * レンタルサーバーの共用SSLで使用する場合などに設定する
     * 
     * @since Ver.0.20
     */
    const SCRIPT_URL = '';
    /**
     * 著作者表示(ページ下部自動挿入)の表示色設定
     * 
     * 1:白背景・黒文字、2:黒背景、白文字
     * 
     * @since Ver.0.23
     */
    const SIGN_COLOR = 1;
    /**
     * ビジネスライセンス シリアルキー
     * 
     * ビジネスライセンスについては下記を御覧ください
     * http://jubei.co.jp/php/license.html
     * 
     * @since Ver.0.20
     */
    const SERIAL_KEY = '';
    /**
     * タイムゾーン
     * 
     * GMTに対する時差を時間単位で指定する
     * 
     * @since Ver.0.11b
     */
    const TIMEZONE_HOURS = +9.0;
    /**
     * gzip転送の可否
     * 
     * 0: しない、1: する
     * 転送内容を圧縮して帯域を節約する。XREA、@PAGES、land.toなど、
     * Apache mod_layoutによる広告挿入が行われるサービスでは1にできません(2007-11現在)
     * 
     * @since Ver.0.11b
     */
    const GZIP_ENCODING = 0;
    /**
     * 基本エラーのチェックと表示
     * 
     * 0:しない、1:する
     * 文字コードチェック、データファイルの書き込み不可チェック
     * 
     * @since Ver.0.13b
     */
    const ADVISE_ERROR = 1;
    // }}}

    // {{{ . データファイルパス
    // 投稿データを記録します。dataフォルダには書き込み可能属性が必要です。
    // Webブラウザからアクセスできないパスに変更することを推奨します
    /**
     * 最新投稿を保存するファイル
     */
    const DATA_FILE = 'data/data.txt';
    /**
     * 過去ログを保存するファイル
     * 
     * 末尾に拡張子(.txt)をつけてください
     */
    const ARCHIVE_FILE = 'data/archive.txt';
    /**
     * ファイルアップロード物理パス
     * 
     * Webに公開されているパスである必要があります
     * 
     * @since Ver.0.20
     */
    const FILES_DIRPATH = 'files/';
    // }}}
    
    // {{{ . テンプレートHTMLファイル
    // デザインを変更するときは、以下のテンプレートファイルを変更してください。
    // テンプレートファイルは通常のHTMLですが、変数表記部分が実際の投稿データ
    // などに置き換わります。
    // 利用可能な変数表記：http://jubei.co.jp/bbs/designing.html
    /**
     * トップ
     */
    const TEMPLATE_TOP = '_top.html';
    /**
     * 個別投稿ページ
     */
    const TEMPLATE_DATA = '_data.html';
    /**
     * 過去ログページ
     */
    const TEMPLATE_ARCHIVE = '_archive.html';
    /**
     * 投稿確認ページ
     */
    const TEMPLATE_CONFIRM = '_confirm.html';
    /**
     * 削除キー入力ページ
     */
    const TEMPLATE_KEY = '_key.html';
    // }}}
    
    // {{{ . 投稿項目が空欄だった場合の既定値
    /**
     * 名前
     */
    const DEFAULT_NAME = '名無しさん';
    /**
     * 投稿タイトル
     */
    const DEFAULT_SUBJECT = '無題';
    /**
     * 本文
     */
    const DEFAULT_BODY = '本文なし';
    // }}}

    // {{{ . RSS
    /**
     * RSSタイトル
     */
    const RSS_TITLE = 'PHP掲示板 最新投稿';
    // }}}
    
}
