-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2015 年 6 朁E27 日 05:23
-- サーバのバージョン： 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `laa0535115-dbname`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `avatar_shop`
--

CREATE TABLE IF NOT EXISTS `avatar_shop` (
  `VALUE` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `PARTS_NAME` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `PARTS_CATEGORY` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='アバターアイテムと所持しているユーザー';

--
-- テーブルのデータのダンプ `avatar_shop`
--

INSERT INTO `avatar_shop` (`VALUE`, `PARTS_NAME`, `PARTS_CATEGORY`) VALUES
('maid_headband_blue', '清潔感のある青いカチューシャ', 'akuse'),
('maid_headband_white', 'シンプルな白いカチューシャ', 'akuse'),
('miko_kamikazari', '巫女の髪飾り', 'akuse'),
('santa_hat', 'サンタの帽子', 'akuse'),
('hada_akarume', '明るめの肌', 'hada'),
('hada_akarume_kage', '明るめの肌（影あり）', 'hada'),
('hada_kage', '少し焼けた肌(影あり)', 'hada'),
('hada_sukosikurai', '少し焼けた肌', 'hada'),
('default_tshirt', '白いTシャツ', 'huku'),
('maid_winered', 'ワインレッドのメイド服', 'huku'),
('miko_kimono', '巫女の着物', 'huku'),
('santa_jacket', 'サンタのジャケット', 'huku'),
('longstraight_black', 'ロングストレート(黒)', 'kami'),
('semishort_black', 'セミショート(黒)', 'kami'),
('semishort_gold', 'セミショート(ゴールド)', 'kami'),
('short_darkbrown', 'セミショート(ダークブラウン)', 'kami'),
('hohoemi', '微笑んでる', 'kao'),
('komaru', '少し困ってる', 'kao'),
('mythsteriouseyes', '妖艶', 'kao'),
('yelloweyes', 'イエローアイズ', 'kao'),
('default_kutu', '白い靴', 'kutu'),
('santa_zubon', 'サンタの足元', 'kutu'),
('tabi', '巫女の足袋', 'kutu'),
('whitesocks', '白い靴下', 'kutu'),
('whitesocks2', '青っぽい靴下', 'kutu'),
('default_map', '丸めた地図', 'mochimono'),
('miko_sensu', '巫女の扇子', 'mochimono'),
('santa_present', 'サンタの袋', 'mochimono'),
('tonakai_hat', 'トナカイの帽子', 'akuse'),
('hada_tonakai', 'クリーム色の肌', 'hada'),
('tonakai_huku', 'もこもこレィンディアウェア', 'huku'),
('tonakai_kami', '黄金色ショート', 'kami'),
('tonakai_kao', '碧色（へきしょく）の眼', 'kao'),
('tonakai_kutusita', '星柄の靴下', 'mochimono'),
('tonakai_kutu', 'トナカイちゃんタイツ', 'kutu'),
('hituji_tuno', 'ひつじホーン', 'akuse'),
('hituji_hada', 'オレンジクリーム', 'hada'),
('hituji_mokohuku', 'もこもこひつじウェア', 'huku'),
('airly_brwon', 'エアリーブラウン', 'kami'),
('blue_belly_eyes', 'ブルーベリーアイズ', 'kao'),
('hituji_kutu', 'もこもこひつじズボン', 'kutu'),
('hituji_makura', 'ぐっすりヒツジまくら', 'mochimono'),
('akuse_kakubaribousi', '角ばった防寒帽', 'akuse'),
('hada_silk', '雪のように白い肌', 'hada'),
('huku_ice', '氷の国の王子', 'huku'),
('kami_naiagara', 'ナイアガラブルー', 'kami'),
('kao_sikameteiru', '未来を見つめる', 'kao'),
('kutu_huyu', 'あったかズボン&くつ', 'kutu'),
('mochimono_icesword', '氷の短刀', 'mochimono'),
('akuse_mimiate', 'ヴァーミリオン・イヤーマフ', 'akuse'),
('hada_daizu', '大豆色の肌', 'hada'),
('huku_toaru', 'とある少数民族の衣装', 'huku'),
('kami_short_purple', 'ショート(紫)', 'kami'),
('kao_osanago', '希望に満ちている', 'kao'),
('kutu_choucho', 'クラシカルモダン', 'kutu'),
('mochimono_hand_armar', '王家の篭手', 'mochimono'),
('akuse_yellow_ribon', 'おおきなリボン(イエロー)', 'akuse'),
('akuse_head_far', 'とある先住民の髪飾り', 'akuse'),
('', '', ''),
('', '', ''),
('hada_hiyake_brown', 'ワイルドスキン', 'hada'),
('hada_irojiro', '絹色', 'hada'),
('huku_green_coat', 'リッチなウィンターコート', 'huku'),
('huku_senjumin', 'とある先住民の衣装', 'huku'),
('kami_golden_hotare', '金色の穂垂れ髪', 'kami'),
('kami_uchimaki', '内巻きゴールド', 'kami'),
('kao_opened_mouth', 'お口パカッとお目目パッチリ', 'kao'),
('kao_blue_niko', 'にっこりブルーアイズ', 'kao'),
('kutu_senju', 'とある先住民の靴', 'kutu'),
('kutu_y_p', '金細工を施したブーツ', 'kutu'),
('mochimono_icerod', '氷のステッキ', 'mochimono'),
('motu_golden_ax', '神々の斧', 'mochimono'),
('akuse_pilot', 'フライトキャップ', 'akuse'),
('hada_hoppe_red', '少しほっぺ染まる', 'hada'),
('huku_coat_beige', '淡いピンクのショートコート', 'huku'),
('kami_long_beige', '亜麻色のロングヘアー', 'kami'),
('kao_pokan', 'ぽかーん', 'kao'),
('kutu_boot_brown', '皮のブーツ', 'kutu'),
('motu_iceseald', '氷の盾', 'mochimono'),
('akuse_panda', 'パンダのダンピィ', 'akuse'),
('hada_baby_peach', 'ベイビーピーチ', 'hada'),
('huku_haori', '紫の羽織', 'huku'),
('kami_silver_airly', 'いぶし銀色の乱れ髪', 'kami'),
('kao_otokomae', '二枚目色男', 'kao'),
('kutu_nobakama', '紫の野袴', 'kutu'),
('motu_tue_gin', '鉄の戒杖(かいじょう)', 'mochimono'),
('akuse_purple_taban', '紫染めのターバン', 'akuse'),
('hada_silky_orange', 'シルキーオレンジ', 'hada'),
('huku_haori_miyabi', '小粋で雅な羽織', 'huku'),
('kami_murasaki', '流浪人のザンバラ髪', 'kami'),
('kao_otokomae2', '眉目秀麗(びもくしゅうれい)', 'kao'),
('kutu_musubiashi', '流浪人の長足袋', 'kutu'),
('motu_icedouble', '雪降らしの氷杖(ひょうじょう)-白樺-', 'mochimono'),
('akuse_era', 'シードラゴンイヤー', 'akuse'),
('hada_ningyo', '真珠肌', 'hada'),
('huku_nngyo', 'マーメイドフルドレス', 'huku'),
('kami_ningyo', 'トロピカルイエロー', 'kami'),
('kao_ningyo', '優しき人魚の瞳', 'kao'),
('kutu_ningyo', 'マーメイドテイル', 'kutu'),
('motu_ningyo', '海草、それは海からの贈り物', 'mochimono'),
('akuse_akuma', 'ダークアンテナ', 'akuse'),
('hada_akuma', 'アンチフレイムスキン', 'hada'),
('huku_akuma', 'ブラックキャミソール', 'huku'),
('kami_akuma', 'ブラッディレッド', 'kami'),
('kao_akuma', '緋色の眼', 'kao'),
('kutu_akuma', 'モンスターフット', 'kutu'),
('mochimono_akuma', '煉獄のキャンドルフレイム', 'mochimono'),
('akuse_maru', 'いぬのマル', 'akuse'),
('hada_6packs', 'シックスパック', 'hada'),
('huku_yusha', '伝説の勇者の軽装', 'huku'),
('kami_yusha', 'サファイアショート', 'kami'),
('kao_yusha', 'キリ眉クール', 'kao'),
('kutu_yusha', '伝説の勇者のボトムス', 'kutu'),
('motu_yusha', 'ダマスカス鋼の黒剣', 'mochimono'),
('default_backimg', '背景（ノーマル）', 'backimg'),
('redworld', '紅い世界', 'backimg'),
('oldbackimg', 'シルドラと古地図', 'backimg'),
('egg_syldra', 'シルドラのたまご', 'backimg'),
('classroom', '西日の差す教室', 'backimg'),
('howahowa', 'ほわほわ', 'backimg'),
('forest', '憩いの散歩道', 'backimg'),
('akuse_brossam', 'ブロッサムヘアーゴム', 'akuse'),
('akuse_zukin', '木こりのずきん', 'akuse'),
('hada_milk', 'ぷに肌みるきぃ～こぉ～てぃんぐ♪', 'hada'),
('hada_nazo', 'フェアリーカラー', 'hada'),
('huku_kenpou', '山奥の祈祷師', 'huku'),
('huku_classicskirt', '英国の伯爵家に仕える、うら若き家庭教師風', 'huku'),
('kami_pattun', 'ぱっつん（モカ）', 'kami'),
('kami_pinky', 'ぴんくのとるねぇ～ど♥ぐるぐるどっか～ん', 'kami'),
('kao_raugh', 'ウケるんですけどｗ', 'kao'),
('kao_pinkyeye', 'キャンディーピンク', 'kao'),
('kutu_tobi', '占術師の野袴', 'kutu'),
('kutu_pink', '春の訪れは足元から', 'kutu'),
('pinkylight', 'もう怒ったぞ！ぷんぷん怒りのピ～チばぁ～すと♪', 'mochimono'),
('mochimono_nazo', '湖畔で拾ったパドル', 'mochimono'),
('akuse19', '炎龍の枯れ鱗のヘアピン', 'akuse'),
('hada19', '英気をまとう肌', 'hada19'),
('huku19', '蒼き武勲', 'huku'),
('kami19', 'ヨーロピアカラー', 'kami'),
('motu19', 'かもめ落とし', 'mochimono'),
('kutu19', 'ウォータプルーフブーツ', 'kutu'),
('kao19', 'ラブリークール', 'kao'),
('hada19', '英気を纏いし肌', 'hada'),
('haikei7', 'ピンクのチェックステッチ', 'backimg'),
('haikei8', 'ブルーロード', 'backimg'),
('haikei9', 'メルティングギャラクシー', 'backimg'),
('haikei10', 'セピアイメージ', 'backimg'),
('haikei11', '鉄格子と空', 'backimg'),
('haikei12', 'オレンジウッドパネル', 'backimg'),
('haikei13', 'クリスタルジャム', 'backimg'),
('haikei14', 'アカシックレコード', 'backimg'),
('haikei15', '光の故郷', 'backimg'),
('haikei16', 'アーティカルプラネット', 'backimg'),
('haikei17', '紫昼夢', 'backimg'),
('haikei18', 'ライン・オン・ザ・リキッド', 'backimg'),
('haikei19', 'プログラミカルグラフィティ', 'backimg'),
('akuse20', '桜のヘアーエンブレム', 'akuse'),
('huku20', 'カジュアルナイトウェア', 'huku'),
('kami20', 'キャロットロング', 'kami'),
('motu20', 'ガイアブレード', 'mochimono'),
('kutu20', 'レッドゼブラタイツ', 'kutu'),
('kao20', '孤独の戦士', 'kao'),
('hada20', '百戦錬磨の無傷の肌', 'hada'),
('haikei20', 'レインマーブル', 'backimg'),
('haikei21', 'メイプルドロップ', 'backimg'),
('haikei22', 'ミントキャンディ', 'backimg'),
('akuse21', '黒ぶち眼鏡', 'akuse'),
('huku21', '魔導師のホワイトローブ', 'huku'),
('motu21', '叡智のエメラルドロッド', 'mochimono'),
('kutu21', 'ブラックレザーボトム', 'kutu'),
('kami21', 'スノーキャップ', 'kami'),
('hada21', 'アストラルスキン', 'hada'),
('kao21', '賢者の瞳', 'kao'),
('huku22', 'バトルスタイルプリンセス', 'huku'),
('kutu22', '寂寞のブーツ', 'kutu'),
('hada22', '魔斥の威圧', 'hada'),
('kao22', 'アメジストアイズ', 'kao'),
('motu22', ' 疾風のダンサブルランス', 'mochimono'),
('akuse22', '護頭帯（ごとうたい）', 'akuse'),
('kami22', '藤染めの髪', 'kami'),
('motu23', '地割りの大鉈', 'mochimono'),
('kami23', 'ライトブラウンのセミショート', 'kami'),
('huku23', 'カジュアルなソルジャーウェア', 'huku'),
('kutu23', 'アルマジロアーマーブーツ', 'kutu'),
('akuse23', '翡翠（ひすい）の耳飾り', 'akuse'),
('kao23', '焦り戸惑う', 'kao'),
('hada23', '自己治癒の肌', 'hada'),
('akuse24', 'ハムスターのサミィー', 'akuse'),
('motu24', '静寂の弓', 'mochimono'),
('huku24', '闇市商人の着物', 'huku'),
('kami24', 'やんごとなき黒髪', 'kami'),
('kao24', '妖魔のたくらみ', 'kao'),
('kutu24', '世捨ての足袋', 'kutu'),
('hada24', '月光返しの肌', 'hada'),
('kami25', 'ライトライムグリーン', 'kami'),
('motu25', '黒曜石のダークカリバー', 'mochimono'),
('huku25', '耐火のゴールドアーマー', 'huku'),
('kutu25', 'ヘヴィメタルブーツ', 'kutu'),
('akuse25', 'バタフライりぼん', 'akuse'),
('hada25', 'ロシアンホワイト', 'hada'),
('kao25', '蒼炎の眼', 'kao'),
('akuse26', '檜（ひのき）の綱巻き笠', 'akuse'),
('huku26', '一匹狼の雑兵(ぞうひょう)', 'huku'),
('kutu26', '新緑の野袴', 'kutu'),
('motu26', '鉄燕の三方槍（てつつばめのさんぽうそう）', 'mochimono'),
('kami26', '深緑の枝垂れ髪', 'kami'),
('kao26', '八の字の虚ろ眼（やのじのうつろめ）', 'kao'),
('hada26', '砂塵の肌', 'hada'),
('huku27', 'レッドマフラー＆ハーフメイル', 'huku'),
('kutu27', 'レッドサスペンダーのジェントルボーイ', 'kutu'),
('kami27', 'ブルーウルフ', 'kami'),
('kao27', '妖しき虎の眼', 'kao'),
('motu27', 'ラビ印のロリポップハンマー', 'mochimono'),
('akuse27', '祭祀の紋様と耳飾り', 'akuse'),
('hada27', '香油の香る肌', 'hada'),
('hada28', '青ざめた死の肌', 'hada'),
('akuse28', '紅玉のサードアイ', 'akuse'),
('huku28', '擦り切れた古布', 'huku'),
('kami28', '不毛地帯', 'kami'),
('kao28', '叫喚の血眼', 'kao'),
('motu28', '夏祭りの儚き思い出', 'mochimono'),
('kutu28', '負傷の包帯ずぼん', 'kutu'),
('akuse29', 'ヨモガオ', 'akuse'),
('motu29', 'ヨモイヌ', 'mochimono'),
('huku29', 'ヨモボディ', 'huku'),
('kutu29', 'ヨモアシ', 'kutu'),
('kao29', '闇猫の眼', 'kao'),
('kami29', 'ブルーファイア', 'kami'),
('hada29', 'クリームシャーベット', 'hada'),
('akuse30', '森人の耳', 'akuse'),
('hada30', 'ウッディスキン', 'hada'),
('huku30', '冥界の番人', 'huku'),
('kami30', 'ココアツイン', 'kami'),
('kao30', '明朗活発', 'kao'),
('kutu30', 'シャドーブーツ', 'kutu'),
('motu30', '神霊を呼ぶ杖', 'mochimono'),
('akuse31', 'よもよもエクステンション', 'akuse'),
('hada31', 'パッチングドールスキン', 'hada'),
('huku31', 'チェインダイアのコーデ', 'huku'),
('kami31', 'ホワイトシェルヘアー', 'kami'),
('kao31', 'トリックスター', 'kao'),
('kutu31', 'カイザーキュートブーツ', 'kutu'),
('motu31', '白金十字刀', 'mochimono'),
('akuse32', '水と太陽のヘッドスカーフ', 'akuse'),
('hada32', 'クリオネブルー', 'hada'),
('huku32', '水姫のアクアキャミソール', 'huku'),
('kami32', 'スプラッシュウォーター', 'kami'),
('kao32', 'ナチュラルラフ', 'kao'),
('kutu32', 'サファイアパワーのセイントヒール', 'kutu'),
('motu32', '超高純度の水晶のステッキ', 'mochimono');

-- --------------------------------------------------------

--
-- テーブルの構造 `avatar_user_belongings`
--

CREATE TABLE IF NOT EXISTS `avatar_user_belongings` (
  `USER_ID` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `VALUE` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `PARTS_NAME` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `PARTS_CATEGORY` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='アバターアイテムと所持しているユーザー';

-- --------------------------------------------------------

--
-- テーブルの構造 `avatar_user_visual`
--

CREATE TABLE IF NOT EXISTS `avatar_user_visual` (
  `USER_ID` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `KAO` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `KAMI` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `HUKU` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ACCESSORY` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `KUTU` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `MOCHIMONO` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `HADA` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `BACKIMG` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `chat`
--

CREATE TABLE IF NOT EXISTS `chat` (
  `id` int(11) NOT NULL,
  `name` varchar(8) NOT NULL,
  `comment` varchar(1000) NOT NULL,
  `time` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `chat_hituser`
--

CREATE TABLE IF NOT EXISTS `chat_hituser` (
  `KEYWORD` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `USERNAME` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci

;

-- --------------------------------------------------------

--
-- テーブルの構造 `chat_keyword`
--

CREATE TABLE IF NOT EXISTS `chat_keyword` (
  `INDEX` int(10) unsigned NOT NULL,
  `KEYWORD` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `chatters`
--

CREATE TABLE IF NOT EXISTS `chatters` (
  `name` text CHARACTER SET latin1 NOT NULL,
  `seen` varchar(20) CHARACTER SET latin1 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `db_login`
--

CREATE TABLE IF NOT EXISTS `db_login` (
  `id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `db_search`
--

CREATE TABLE IF NOT EXISTS `db_search` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `word` varchar(3000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `db_user`
--

CREATE TABLE IF NOT EXISTS `db_user` (
  `id` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `seibetu` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `shokui` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `job` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `comment` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sirudoru` int(100) NOT NULL DEFAULT '10',
  `CHAT_COUNT` int(11) NOT NULL DEFAULT '0',
  `guildmember` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `db_user`
--

INSERT INTO `db_user` (`id`, `name`, `pass`, `seibetu`, `shokui`, `job`, `comment`, `sirudoru`, `CHAT_COUNT`, `guildmember`) VALUES
('testuser1', 'テストユーザー１', 'pass1', '♀', 'メンバー', 'ナイト', 'テストユーザー１です。', 1000000, 0, 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `dot_dots_position`
--

CREATE TABLE IF NOT EXISTS `dot_dots_position` (
  `SUBJECT_ID` int(11) NOT NULL COMMENT '題目のID',
  `POSITION_X` int(11) NOT NULL COMMENT 'ドットのX座標',
  `POSITION_Y` int(11) NOT NULL COMMENT 'ドットのY座標',
  `USER_ID` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ドットを打ったユーザーのID',
  `DOTTED_DATE` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ドットが打たれた日時'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='ドットの座標テーブル';

-- --------------------------------------------------------

--
-- テーブルの構造 `dot_image`
--

CREATE TABLE IF NOT EXISTS `dot_image` (
  `SUBJECT_ID` int(100) NOT NULL COMMENT 'この画像を使用している題目のID',
  `IMAGE_DAT` mediumblob NOT NULL COMMENT '画像データ',
  `MINETYPE` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'マインタイプ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='題目画像保存用テーブル';

-- --------------------------------------------------------

--
-- テーブルの構造 `dot_subject`
--

CREATE TABLE IF NOT EXISTS `dot_subject` (
  `SUBJECT_ID` int(100) NOT NULL COMMENT '題目のID',
  `SUBJECT_TITLE` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '題目のタイトル',
  `USER_ID` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '投稿したユーザーのID',
  `CREATE_DATE` date NOT NULL COMMENT '題目作成日',
  `COUNT_DOTS` int(11) NOT NULL DEFAULT '0' COMMENT '最新のドット数'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='題目の情報';

-- --------------------------------------------------------

--
-- テーブルの構造 `house_location`
--

CREATE TABLE IF NOT EXISTS `house_location` (
  `USER_ID` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `X` int(100) NOT NULL,
  `Y` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `log_login`
--

CREATE TABLE IF NOT EXISTS `log_login` (
  `USER_ID` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `LOGIN_DATE` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `name` text CHARACTER SET latin1 NOT NULL,
  `msg` text CHARACTER SET latin1 NOT NULL,
  `posted` varchar(20) CHARACTER SET latin1 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `mst_items`
--

CREATE TABLE IF NOT EXISTS `mst_items` (
  `id` int(11) unsigned NOT NULL,
  `MINE` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ITEM_IMG` mediumblob NOT NULL,
  `ITEM_NAME` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ITEM_YOMI` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ITEM_COMMENT` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `ITEM_CATEGORY` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ITEM_PRICE` int(100) NOT NULL,
  `ITEM_DATE` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='販売アイテムのマスタ';

--
-- テーブルのデータのダンプ `mst_items`
--

INSERT INTO `mst_items` (`id`, `MINE`, `ITEM_IMG`, `ITEM_NAME`, `ITEM_YOMI`, `ITEM_COMMENT`, `ITEM_CATEGORY`, `ITEM_PRICE`, `ITEM_DATE`) VALUES
(0, 'image/png', 0x89504e470d0a1a0a0000000d49484452000000280000002808060000008cfeb86d000000097048597300002e2300002e230178a53f760000001b74455874536f6674776172650043656c7379732053747564696f20546f6f6cc1a7e17c000001854944415458c3d5d8a192c32010066056d4a06b32957d85d3adbe27aeeee933676f069989a98ea9e0041d1a088465d96d394c3b99886f9690ecfe60ad553d2f48022f5feb8b9f27e80398c2bd111b0231b817439fc05adc8ba03c4041241f5008c9069ccf07ff5feb23740a1c9452537fc067f586c7efc456c9b6d7ccaa7acb35f5018c715adfd53cefd890ac40adefeeda03e8b0b72624ed5387aade124c479281295c5c3d7fef7c231f1a7c3753818b812d55ac02a64e2b06d7824c028d31f6f83b2e601fab7bc22d2ce3a848c875d4c6183bf8620d1b5b87c7519048a0525aefb3b01a5ceda181ad992457452a8c8284d2d084dd6a2ab2191823e3ad96460276ec2c3d935248a8998ba52ae90e5cbab180dac15d02c90a94407ae0755ccd35408d3e389101301abea0259be14006cd2d379003e9dbb3eb77727c058e748b8a0c7ac7cb8f1c9082c4e0588135c82c4e1a58422e0f847beec66274021209ab43a6ba9f0c6c23d701a90838fe76676185d00944336a86b416c443f4c6bc1bfe67cadfd1fa03ed1c84c003560c600000000049454e44ae426082, 'ライトピンクのクレヨン', 'ﾗｲﾄﾋﾟﾝｸﾉｸﾚﾖﾝ', '練成に使ったり、チャットの名前の<br>色を変えたりできる。', 'クレヨン', 1, '2014-11-04'),
(1, 'image/png', 0x89504e470d0a1a0a0000000d49484452000000280000002808060000008cfeb86d000000097048597300002e2300002e230178a53f760000001b74455874536f6674776172650043656c7379732053747564696f20546f6f6cc1a7e17c0000018d4944415458c3d5d82176c3300c0660098c188f6474bbccae313c525c3c5c523cb243e432356d4871488107b264ae63c7b22c759e49fbf202be27c789f4a3730e5a5e18039e76c7d5c597c33b36018ce1fe127b03a4e0ee0d5d80a5b87b4145809a4831a016520cf8f4f1bafc37e6191b05760030b407fcad5ef7f33b8855b2ea35b3ae9ebf86368021ce982b8ce38318521468cc150060014ed84b1592f5a9a355cf07f3916c600c17566f5ee378611f1a723753820b8135552c02c64e2b0557838c02adb5ce1d7b0ff6b6bae7760bf3382e12531db5b5d6754bb1ba8dada3e338482210c098c724ac04577a68706b264955910be32031373451b79a8bac0686c870abb591481d3b73cfa416124be662ad4a4e072ede5860e9e0ae8114056a2067e079dfafe61ae4461f92481f180e5f5893cd4820fde6561c28819c81e7fd67747c4589748b8bf47bc7d3ee4b0fc8415270a2c012640aa70ecc21fd03313d777d363a418d847542c6ba9f386c2bd741ad0838fc76a760b9d00935336a89b416b543f4dabc1bff65cadfd2fa065b5896c022073cb30000000049454e44ae426082, 'パールバイオレットのクレヨン', 'ﾊﾟｰﾙﾊﾞｲｵﾚｯﾄﾉｸﾚﾖﾝ', '練成に使ったり、チャットの名前の<br>色を変えたりできる。', 'クレヨン', 1, '2014-11-04'),
(2, 'image/png', 0x89504e470d0a1a0a0000000d49484452000000280000002808060000008cfeb86d000000097048597300002e2300002e230178a53f760000001b74455874536f6674776172650043656c7379732053747564696f20546f6f6cc1a7e17c000001884944415458c3d5d82196c32010066046ac41af89aed96b54f726d53d466bf726abd7ec2162d031d5311554d0470381300c335d8a695f5ec4f78690ccfc60ad553d2f48028f3feb8bdf07e80398c2fd23360462702f863e81b5b81741798082483ea010920d389fbffc7fad77d02970504a4dfd019fd51b1ebf135b25db5e33abea2dd7d40730c6697d53f3fcc18664056a7d73d71e4087bd3621699f3a54f596603a920c4ce1e2eaf97be72bf9d0e0bb990a5c0c6ca9621530755a31b8166412688cb1bbcbb880ed57f7845b58c6519190eba88d3176f0c51a36b60e8fa3209140a5b4feccc26a70b58706b666925c15a9300a124a431376aba9c866608c8cb75a1a09d8b1b3f44c4a21a1662e96aaa43b70e9c6026a077709242b5002e981a77135d70035fae04406c068f882966c86031934b7dc400ea46fcf4ebfc9f11538d22d2a32e81d8f7f72400a12836305d620b338696009b93c10eeb91b8bd1094824ac0e99ea7e32b08d5c07a422e0f8db9d8515422710cda819d25a100fd11bf36e78cf94bfa37507931d84c01425ae6a0000000049454e44ae426082, 'ホットピンクのクレヨン', 'ﾎｯﾄﾋﾟﾝｸﾉｸﾚﾖﾝ', '練成に使ったり、チャットの名前の<br>色を変えたりできる。', 'クレヨン', 1, '2014-11-04'),
(3, 'image/png', 0x89504e470d0a1a0a0000000d49484452000000280000002808060000008cfeb86d000000097048597300002e2300002e230178a53f760000001b74455874536f6674776172650043656c7379732053747564696f20546f6f6cc1a7e17c000001884944415458c3d5d82196c32010066046d4a0b722aaa297e815f61aab7b9cea9a3d444e835815d1ea980a56d0470381300c335d16d3bebc88ef0d2199f9c15aab7a5e9004ee2feb8bb733f4014ce1fe101b0231b837435fc05adc9ba03c4041241f5008c9069c7f3efd7fad8fd02970504a4dfd015fd51b9ebf135b25db5e33abea2dd7d40730c669fd50f3bc6343b202b57eb86b4fa0c3de9b90b44f1daa7a4b301d4906a67071f5fcbdf39d7c68f0dd4c052e06b654b10a983aad185c0b320934c6d8e3695cc0be56f7845b58c6519190eba88d3176f0c51a36b60e8fa3209140a5b4fec8c26a70b58706b666925c15a9300a124a431376aba9c866608c8cb75a1a09d8b1b3f44c4a21a1662e96aaa43b70e9c6026a077709242b5002e981877135d70035fae04406c068f882966c86031934b7dc400ea46fcf0ed7e4f80a1ce9161519f48efb6f39200589c1b1026b90599c34b0845c1e08f7dc8dc5e804241256874c753f19d846ae03521170fcedcec20aa1138866d40c692d8887e88d7937fccf94bfa3f50bcd6f84c04c9745960000000049454e44ae426082, 'ディープピンクのクレヨン', 'ﾃﾞｨｰﾌﾟﾋﾟﾝｸﾉｸﾚﾖﾝ', '練成に使ったり、チャットの名前の<br>色を変えたりできる。', 'クレヨン', 1, '2014-11-04'),
(4, 'image/png', 0x89504e470d0a1a0a0000000d49484452000000280000002808060000008cfeb86d000000097048597300002e2300002e230178a53f760000001b74455874536f6674776172650043656c7379732053747564696f20546f6f6cc1a7e17c000001924944415458c3d5d8b14ec3301006e0bb81c533aa94ad123b333c09afc1cc0330b3f0107993cedd2db14582ce593a982124b8ce39b6cf77c578691565f8748e93bb1f9d73d0f2420a78d8bdae2e3e7cbe6013400af797d80b600eeedad005588abb165404a88914036a21c580f71f4fcb7f63eeb051600700437bc0dfea753fbf835825ab5e33ebeaf96b680318e28c39c338de88214581c69c010016e0843d5521599fbabceaf9603e920da47061f5e6358e27f6a1c9ee664a7021b0a68a4540eab4e6e06a9024d05aebbe1e7b0ff6bcbae7720bd3382e12631db5b5d6754bb1ba8dadcbc77190994000636ea3b0125ce9a1c1ad992456452e8c83c4d4d094bbd55c64353044865bad8dc4dcb133f54c6a21b1642ed6aae474e0e8c6024b07770da428500339038ffb7e35d72037fa9044fac070f8c29a6c4602e937b7e24009e40c3ceedfc8f11525d22d2ed2ef1d0fbb773d2007998313059620633875600ae91f88e9b9eb93d1096a24ac1392ea7e68d856ae835a1170f8ed8ec152a1136a66d412692d6a87e8b57937fecb94bfa5f50d7ac296c0e7515af80000000049454e44ae426082, 'ミディアムバイオレットレッドのクレヨン', 'ﾐﾃﾞｨｱﾑﾊﾞｲｵﾚｯﾄﾉｸﾚﾖﾝ', '練成に使ったり、チャットの名前の<br>色を変えたりできる。', 'クレヨン', 1, '2014-11-04'),
(5, 'image/png', 0x89504e470d0a1a0a0000000d49484452000000280000002808060000008cfeb86d000000097048597300002e2300002e230178a53f760000001b74455874536f6674776172650043656c7379732053747564696f20546f6f6cc1a7e17c000001864944415458c3d5d8317283301005d0fd451ab94d439d1c2bd770eda1769343702dd5346e43e342290844160249ab5d4751630f43f1668560f7c339472d2fc4803dfacdc58bbba009600cf797d807600eeed9d015588a7b165404a88914036a21c580e7af8ff5bf316f6814d811d1d81ef0b77addcfef2856c9aad7ccb67afe1adb00863863ee344d2f624851a0317722a21538636f5548d6a72eaf7a3e988f640363b8b07acb9aa61bfbd064773325b8105853c52260ecb4e6e06a9051a0b5d60def83073b6fee79dcc2348e8bc45e476dad75dd5aacee60ebf2711c642690c898d75d5809aef4d0e06826d9ab2217c641223534e56e3517590d0c91e1566b23913b76a69e492d244ae662ad4ace072ede58a07470d7408a0235900bf07a1a36730db8d18724d20786c3176ab21909a4dfdc8a0325900bf07aba46c75748a45b5ca4df3bf6f8d40372903938516009720fa70e4c21fd03313f7743323a8146c23a2363dd4f1c7694eb402b020ebfdd7bb054e804cd8c5a22ad8576885e9b77e35fa6fc2dad6f05db96c00180f1d40000000049454e44ae426082, 'パープルのクレヨン', 'ﾊﾟｰﾌﾟﾙﾉｸﾚﾖﾝ', '練成に使ったり、チャットの名前の<br>色を変えたりできる。', 'クレヨン', 1, '2014-11-04'),
(6, 'image/png', 0x89504e470d0a1a0a0000000d49484452000000280000002808060000008cfeb86d000000097048597300002e2300002e230178a53f760000001b74455874536f6674776172650043656c7379732053747564696f20546f6f6cc1a7e17c000001874944415458c3d5d8317683300c0660fd431767edc2dc5ea8d7c89c633067e92138916796ac65c9e00e14ea18836d594a5d2fc9e3317c4fc620fd70ce51cb0b31608f7e73f1e22e680218c3fd25f60198837b36740596e29e0515016a22c5805a4831e0f9eb63fd6fcc1b1a05764434b607fcad5ef7f33b8a55b2ea35b3ad9ebfc6368021ce983b4dd38b18521468cc9d886805ced85b1592f5a9cbab9e0fe623d9c0182eacdeb2a6e9c63e34d9dd4c092e04d654b108183bad39b81a641468ad75c3fbe0c1ce9b7b1eb7308de322b1d7515b6b5db716ab3bd8ba7c1c0799092432e6751756822b3d34389a49f6aac8857190480d4db95bcd4556034364b8d5da48e48e9da967520b8992b958ab92f3818b3716281ddc3590a2400de402bc9e86cd5c036ef42189f481e1f0859a6c4602e937b7e24009e402bc9eaed1f11512e91617e9f78e3d3ef5801c640e4e145882dcc3a9035348ff40cccfdd908c4ea091b0cec858f713871de53ad08a80c36ff71e2c153a4133a396486ba11da2d7e6ddf897297f4beb1b5a6b96c09e9febed0000000049454e44ae426082, 'ダークマジェンタのクレヨン', 'ﾀﾞｰｸﾏｼﾞｪﾝﾀﾉｸﾚﾖﾝ', '練成に使ったり、チャットの名前の<br>色を変えたりできる。', 'クレヨン', 1, '2014-11-04'),
(7, 'image/png', 0x89504e470d0a1a0a0000000d49484452000000280000002808060000008cfeb86d000000097048597300002e2300002e230178a53f760000001b74455874536f6674776172650043656c7379732053747564696f20546f6f6cc1a7e17c000001994944415458c3ed98db0ec2200c864b820f85897b784de4a1468217b38695430b2b469371e392d1f5f3a785161363845f1ee6043c01ff19d018130100628c66d49eb355012c8d9a636a331df079df9edd2d9077b60cbe26732e3ce461c01803f8c706e31c9960436e142c780f9ff9e6320910d5bb2e7b55b24121bf018871240204d801a5cfb8cc530031f6248008998500f090c38034d87b549c0a888981f124056ca9380730d8dcc9a08a6a8054bd5491592a8e01bed5a3ce66a828062cc51e056c652aa762ed54e9074c62afe648534511602d319af1b4eaa8380df0796f2fb7345958c01a9ce874588f67f434c09eada764874bdd043c02d73b8f26d07561005b703d8e7b975a0488d58abb1d079440e2b7f0978d414ebd91a59340968ad80c5002370a88452eb56b55d83bc05d13e4f87fcbcdabed8fa91d57617f00d3329e738a8ea4d5340d7e844c47ad3fc9149438dc3e14c018dbb5cf79bf0162fb29699e3240dabb6a02a690d2feb89ac52d500d40fc3ed7bcb32749ed466014108154af3e9a7730ab2e90eacd8274eee8edd779817902fec27801b4cff7c0d9ca4dc30000000049454e44ae426082, 'くつろぎテント', 'ｸﾂﾛｷﾞﾃﾝﾄ', '普通のテント。<br>その普通っぷりが、普通程度の人気。<br>設置には普通程度の時間がかかる。', '冒険アイテム', 5, '2014-11-04'),
(8, 'image/png', 0x89504e470d0a1a0a0000000d49484452000000280000002808060000008cfeb86d000000097048597300002e2300002e230178a53f760000001b74455874536f6674776172650043656c7379732053747564696f20546f6f6cc1a7e17c000002a34944415458c3edd83d4c54411007f099d869d0ca82607b8f6be9b5a2c5232624d416262690d0df597af4142424141656262604b4a0b1d296d0e2d14aa839020985590b987576dfececec725113d9e6729ff9dd7f7667f73d74cec1bf3cf0bf0522a2f8c3ce39fcab4082b9f541fbbdfeb0183a51a08693a016643130553a09767cf21d3a33b3feb10669067298fbf9367cefde9b6220212702f4a58b601c2895d502cca5a80273300d67015a524c02adb8d4a2b0e2aa134444a7e1b4f4783b492da25b2d9249e0dcf10e60e7857fac6dda55400b0e000220bde65faf6dd4b50b23d82518a6f5dd9b346f05acc5496949c092fdb808985ab5d81faaa8daf4b2c04f9f7fc0f38527599c5656be404a4f3226606f712bb9d7a6da89b45a11d1a9fd4ed8e39d7368068e5696fc679acd8fc177cede6d07cf1fbd7c6586715c333fe55f1b7d39cf03e3b9f77b951edd94afdbc23d7cfa8c95b7ab965682112e99a0861cad2cf9f408c9c7f8dbd70048480948b8e58d0600000ef74e5be915356a4a919029a094620c8c711cc871c53b09ef81d7ade5e81ac0b03132066a3833907e686ff7b56f3312309e930000707109e3c38300c8e721223a2bce048c476f71ab856c95fbe212e0c1fd00c857b534ef8a81292407f252fb720a73133b5d70eb03ff8796371a13ce7ca2e648ea8b123206d2730e4ce152eda8e89a84a09422f6874132546e0ee34dbe33330bd81f8a7d2fd92b73477e3e77aca7640ea5cfd0d13f066ae9a9e7419a2b1fd646c10a1c9c3d8683f7630000d85fbd52f7679e9c06345d93c4301a3960ee4e427cd1c481b9f45a0922a26be6a760ae371d007999393095620a589a9e08d4366f008018c893b4dc342a494f9d8325c8fdd52b3f5f53a3646198aeea2424fff1782e4afd4d1a253873a39ee4f823373053c7f3bb7bd477c08af10be04201de02af8c750000000049454e44ae426082, '食人植物バクレシア', 'ｼｮｸｼﾞﾝｼｮｸﾌﾞﾂﾊﾞｸﾚｼｱ', '部屋に置けば空き巣を撃退してくれる。<br>ペットが食べられないように注意。', 'インテリア', 5, '2014-11-04'),
(9, 'image/png', 0x89504e470d0a1a0a0000000d49484452000000280000002808060000008cfeb86d000000097048597300002e2300002e230178a53f760000001b74455874536f6674776172650043656c7379732053747564696f20546f6f6cc1a7e17c000000e84944415458c3ed974d0e84300885e5562e3cfe2ce656b8304e9a4ab1fcc860da6e4cac245f1ebcf004445c321fb00002005b8c88f037c013ae550f002e9062c052b5b2f6fb3938d60d2f901650152055430196a08f03b694ebac552b2902e4bee514b428e906d8abe4988014dcd952aaaddc9d14d204b86ef87bf6de850146b55935835c0bb936879aa404e04ebd59425d7c07699d3ff1aaa302420b92dac99a75a70e0b02e563c342fab87507ea05e606581bc812adc200532be81152c756f01533384d324d326770028e14165a3f54695c5c03a65730e50cbe4ac1943348bd4fb5499e3ce90177dcf49ec0ef80a3db0000000049454e44ae426082, '部屋の鍵', 'ﾍﾔﾉｶｷﾞ', '平和なこの地域にも、空き巣被害が増えてきた。<br>お家のセキュリティーにはぜひ。', 'インテリア', 3, '2014-11-04'),
(10, 'image/png', 0x89504e470d0a1a0a0000000d49484452000000280000002808060000008cfeb86d000000097048597300002e2300002e230178a53f760000001b74455874536f6674776172650043656c7379732053747564696f20546f6f6cc1a7e17c000000ac4944415458c3ed97db0e80200c43ddff7f747d3241326e32c794ee11c49cb42b1902e0885c62012822b79f00903080399c35e4634045b56bdd147418b0a2980a380b3a045882ebad279066802d05970386531040552ded3b77c064bd6879babfc462adf72caf9c7ff660cbde1016f79ecbacf7b5b875d6bd0747949c55ce7c58b00cc61ee356c572b36195800424209f9d0e77e17e0a32244c3153cc1413f003290e3df2874cf19b151ef004d53735c0aa61c1b90000000049454e44ae426082, '泥棒の鍵', 'ﾄﾞﾛﾎﾞｳﾉｶｷﾞ', 'お人よしが多いこの地域にも、近頃お家に鍵をかける習慣が広まってきた。<br>空き巣の方はぜひ。', 'インテリア', 8, '2014-11-04'),
(11, 'image/png', 0x89504e470d0a1a0a0000000d49484452000000280000002808060000008cfeb86d000000097048597300002e2300002e230178a53f760000001b74455874536f6674776172650043656c7379732053747564696f20546f6f6cc1a7e17c000003124944415458c3cdd8b14f53411c07f0ef2f51707075a22d25b233ebe0a4c6041212186a8d91488081cdca26ed405db5b23080814888e8e0408246ac9303cc1d48971a6b1fc6f81f143b9c437b8f7bf7eedebbbb5795dbfa5edbf7c9f7defdeef71e31c6709e07fd2fe05e8d42179e1c63742e80326e728c91784c848681de49f7403a457f13a74a8b9f3703caa30fe0bd1ab1f7af320080f5e7df43ffb7501866e333ad980439520439a65a5e186500d05a6b20b3380aef720700303ed30a4ce54261388010f16640dd310044147913afcc5f456bad0100c82c8ea2b8de20dd2251a5eb0ce430c6dea9cb034d87a0007c60f232a349cc0417f89be63ed2d9091fcc18eb0330e29e232276daae6160b0110078cdfde09aca4e6853b54146af62094844ac581cc2f2930ff8f5f385d50ae660a2e90440b9c46880f3b3b72d719bf09ab3fee7ccc89631520fd4e0005801d3d9cddeadd00f60d41713a4a7029ade8b4640d7f454d36b9b622c90971497f4fe199031a6bc88cbf4da4e732490e374174902dcd8fc8472f9873bf06cb7704b2f6a7a13036db632795b33492f1130ae3be1a3f5eda1766beb6e7fd1d30bc01e4844eccdeb9b4669ddbdf759893d834e45a6670d1471d7afa5638187479e16cb917203613bbd3e50c66defb463810fee5fd26245a40aea0c9471220240e0dc727117731d869717c99f620ee589aad2b499de10f0b85ec7e0c00d254e2eb0007ce0d3723ef01b112a23130101a0f1f58a16c871739d5ef15eade060a9e003e5e40f8f3c3fcd6ec99a42a99432c62981c7f5ba72cf1571de6a0500f0f1f12310516015cbb788982663cc0d28af62153233b285b90ec3c605e0ceb38a7ffc60a910aa89225446168b43c981b97c15a5522a80ec751f00ec802aa4b649503c0b690b752e5f0d155aa103e1df57ee2a26493a014d9294577214ce192820b5cd421cd2746cefb471fafb4bf7e17de5046f776fa981627ac2337964bb25efcb265ba06edfd502550f6a2640b1b37185aa70a1294e0274818a280e03a0c6f5fb15b0dc2bcae05cbe1afa0d87b9e012bf028e03cbad982daeefefa855ddb80bea5cbce5371d7f00ae25f6cfee19bae60000000049454e44ae426082, '御加護の鈴', 'ｺﾞｶｺﾞﾉｽｽﾞ', '伝説の鈴職人が夜な夜な手作りした鈴。<br>気品に満ちたその音色は、音色のチェックをしている当の本人の表情も緩ませる。<br>魔物も退けてくれる。', '冒険アイテム', 5, '2014-11-04'),
(12, 'image/png', 0x89504e470d0a1a0a0000000d49484452000000280000002808060000008cfeb86d000000097048597300002e2300002e230178a53f760000001b74455874536f6674776172650043656c7379732053747564696f20546f6f6cc1a7e17c000001d64944415458c3edd8a15203311000d09c04c9f503ea8aaac780a847c21f20000383ea3008a653c550532af88322eb119cc1a338d70f28482a0f959b746f77b3c925379d83a8cef43279d9dde472498aa250dbdc92d602df9f1e373af65e9e37fecf4fce2a7d0e2eae93468010e7d25c91b58192015d9f0f067419cca74f3b81bee9f2edd70ee0f7d17eb4cd72efed33a9058c8993208300778e4fd9ffd78b791c20864bb3bcfcfdf370e714290e4a21bd81b797e76ad8ed8822a4233c5eaed4683a534a29f575d88b03d4038e972b35ec76489c19693d21dd46d3597d208733a30107c280fa19b356b18961486fe07a31af444982d591bcfa780d0fd4b8dd9b7bb48f098478986eac3c8200cd4297006154d32caf0fa4d23be90f2ae9e120149a02624827a0597fd442b0a5182e185b14bd811c4ed2bc81dcab8d5a24d2e861fba26d353b03b945a2b136a0c649de2a4ec0497f5016b7b90860bad32c2f07c5160b9ca83710db88619ab1fab3ed81dc2b8f05c2e851b3b7bdea24402a7a10c90225b54801b1144ba21f04686edad886cb9d64b8d40603626742ec94024fdae6f6e40c74891eac4ddb915f72a8a5905e40e9f7890f2a3a30f4d7de3ff0ef00b70d89ee834d5f79d4fa688a71a164bb280a7681d964fb05361906cf32ccf7980000000049454e44ae426082, '店主の気まぐれ福袋', 'ﾃﾝｼｭﾉｷﾏｸﾞﾚﾌｸﾌﾞｸﾛ', '店主がセレクトしたアイテム３つが入っている。<br>中身によってはただのゴミ袋かもしれない。', 'その他', 15, '2014-11-04'),
(13, 'image/png', 0x89504e470d0a1a0a0000000d49484452000000280000002808060000008cfeb86d000000097048597300002e2300002e230178a53f760000001b74455874536f6674776172650043656c7379732053747564696f20546f6f6cc1a7e17c000001c94944415458c3edd83d7683300c0060d45e220b77e0081db948f78c191919d9bbf4081d193982c7ee5d7289d61d821cd9965df9873cfa1e1e6d021f96259b80d6bad97383037800ff231000ac1f69ad6117400a1ba7d9f45fcefd6650113004a30d91b5a151a00486ed73b98dbf7f4cde58099805a6c0288e02e74599befea5cbc67a40c4496088a3b38630a5ae4dd79dac6b119a826481521c5d7714c68d87da5f580b28c5e1836918298c5e73be0c56ff340e49500f28096fd79d3c10f712144761d8ef62396451886338fdfdd6c0f3ab014de360fa42703130254962c0e6a96f005a6fdc0d3b4245c0d25934bbca0abcddaf6551ee2c3e1e88f75bc3ca258809bf24494a919818a14cbdcdd21779469b96c5b9c85049f1d61899551afe6ca014e99614aeac784021b218c8ed165c593189e0225728409b078c21efe7c0755dfdcc6c42708519a1582bb3431c4386f65a2e5152768fa213f5bca846a9ab57efdc5a67ad39326e853a12da22a075748a00b982adb50600d034c4d580742b8c85d10392828d406998ab7cd5854a4c0a865e47afa9f25dec22b28ef66bd8dd903ff4c33df6229bce600a8edb8babafc15c20b7d5552d3335c3bb491ddc0cbb37e0f1f7db013c8015db2f93f8f5c08678d2fa0000000049454e44ae426082, 'シルドラスナック', 'シルドラスナック', 'シルドラの好きなお菓子。HPが回復する。<br>与えすぎるとデブドラになる恐れがある。', '冒険アイテム', 2, '2014-11-04'),
(14, 'image/png', 0x89504e470d0a1a0a0000000d49484452000000280000002808060000008cfeb86d000000097048597300002e2300002e230178a53f760000001b74455874536f6674776172650043656c7379732053747564696f20546f6f6cc1a7e17c000001744944415458c3edd8214fc3401407f0ff330c359629048ef60b60486a0816418241e108991b09c9f482edd4700bc8290cc9be01a609864f501c490982006e9887ba861e57b85eafe136aeaecdddbb5fdfbd975c8e98192e3fe4811ee8811ac0344d9d54064140c4cc2022762d934404665e20e0f8cd2de0e9da7f00f6dbc0c5bbcfa01bc0cdd70f00c04367c5038d8102b73c35d86497d602caf5d0f4a34a845340a30cfe25cea8496c655537cee2036faeb77070785f69db75ba5eb77cb48162515b7529ffb851178b4000f260f2bb4da0710d7e0d660254611a0556cd9e98631247bb8b558b5401ca592fdb09e3d38c0858b6bd3f75ae8ce9b781dd2bcb40d5b6e8d663590655f36a1db7ca8a5d1729c67467d3fcfbcbfe9139703e1901005abd41ed6e14e3bab329922401004451842ccb0a6bfcda24711ce7136c038f57cf00a00004f00d399f8cd0ea0db0f79c220cc322f0f1eed2a913f5c6f64911f8747bee14707d675804ba78bb9503fd05e632033f01d22410cf37531b330000000049454e44ae426082, '大きい水槽', 'ｵｵｷｲｽｲｿｳ', '池で釣った魚を育てられる。<br>意外なほどに大きく、玄関に入らない可能性がある。', 'インテリア', 10, '2014-11-04'),
(15, 'image/png', 0x89504e470d0a1a0a0000000d49484452000000280000002808060000008cfeb86d000000097048597300002e2300002e230178a53f760000001b74455874536f6674776172650043656c7379732053747564696f20546f6f6cc1a7e17c000001e44944415458c3edd8bd6a02411007f0ff1681a45009a4b0b3901441b848405286b4790213f02d0e924748c017481d505fc352048982588414e95204c4581848b129c2c9baceeceddead1fc54d77e7dcde8fb99d75ef849412fb1c220366c00c9802288458f9514a296cf292e4b3b914301ae04b4a1400cc009c08410ea2e742c9e76e2c8490fad86cae0e8cbb21156a2e125c63421a81db0c6b2037477c83a9ea5a3d62d3a4fe5572678e20750a1c18e65ce265469dd86980a686cb803b01aa0de3ab51d4068983b2400a56d0d6b9a44d327380b2cb4c77b1bd75f0ea48b82d3371c0ca217d7efc03eb6bf45c0ec9fe93741712fdb73900a0769adb48e5d4f19d80cdd1f74eb65661905f436e0c582dfe57fdf573ee0f183d5e1760b59823111b037238ee861cd0a5b2eab930c8fb05fa78f4a981d34188e38ba6f19c7a4ce5dba26381d41c9c0e42005801a8c76981a9bb98025280284fc77b0736da3d00c079e56c0d686a0aaab2360d351c4f00002fb797f6ff241cf2fae6d90854713a8802aa38e77792081941e32a1407a460269cf576abd1eead54d216688ae178b284396fb73868bfd332e6be7f8c0000e55260ccabd5efd26f583968bfd35a425ca35c0a9638efef2454453b4f0f56d7d4ef1fad2be6edeb16f7c1880b5758f67d3003ee4bfc011993f6c04e3664ed0000000049454e44ae426082, '小さい水槽', 'ﾁｲｻｲｽｲｿｳ', '池で釣った魚を中で育てられる。<br>意外なほどに小さく、ペン立てなどにしてしまいがち。', 'インテリア', 5, '2014-11-04'),
(16, 'image/png', 0x89504e470d0a1a0a0000000d49484452000000280000002808060000008cfeb86d000000097048597300000b1200000b1201d2dd7efc0000001b74455874536f6674776172650043656c7379732053747564696f20546f6f6cc1a7e17c000002374944415458c3edd83f481b511c07f0ef1383e02c081d523a650859443b586a0b82ffc00c8e2e92c1e520e01f28850a2268290e0a3948318bb8384910821a8533a074102550244307dbe6864025b3d6be8bcfe9cedce5729eb93f79587f4bc2bb1fc7876f5e787f08630c3c177103f8616642f792e5950dc20d901062fa02c618e10678363f86c8cd1f00c0795b27ba17d27c0107bb42bab1fdfc0f7e8046a49b38d712bcf9f806812511f4531cd183325f091242d86d250f00fc018de9a9e526d231b03a3dae80f5d2731be908a8a687e2b6ee194d49cd05aae9d1c51c00a05d5eace9a129096d5fbe395e551c01034ba269826ea6e85982d529fa0a543707e160074e7e962c8191f7490040412e378c6c0828ffce60b82f66ab3fbd3587d0eb297f810afb8e5251b6d57f7d79d11ca0ddba38cd21dc3b0b4a157f8081402bfb4bf3cf40c7c05d611a0030925cd5be9b55281645b877168a52d18dc7e3f7cba3288ada582291209e25b82b4c6be091e4aa2e41493a44cfdb3ecb77b7b7909a3f932b403b09fa0e34fec4f53eed02cd709e24689c93dc00d539671cb703ac87e3660e7a02349b835609a627dfd53c1f4d4ac808fd887e3df406a8a2ec2448a90200c808fdb671beae245739a1e65976b3f01f02d5fd2000bc7819b4ec2d15656dbbf5ef38fe685cc3c070b00300b077b46ed9ab6e6a0b7259b7f656afc19e00955f9fd1121c42e4d580656f7e3ca41d9c1abd43740404805b395bb7b7b2b6e3f864f7f48056773266e5fbb1d378fc7ca89a7637e357dd01f33271cf0a836c870000000049454e44ae426082, '蜂蜜蒸留酒', 'ﾊﾁﾐﾂｼﾞｮｳﾘｭｳｼｭ', 'ハチに刺されたかのような刺激のあるお酒。<br>舌に残る謎のざらつきは気にしないこと。', '冒険アイテム', 5, '2014-11-04'),
(17, 'image/png', 0x89504e470d0a1a0a0000000d49484452000000280000002808060000008cfeb86d000000097048597300000b1200000b1201d2dd7efc0000001b74455874536f6674776172650043656c7379732053747564696f20546f6f6cc1a7e17c000001774944415458c3edd8314bc3401407f0ff0d2d3809d9325a103a068b4b3f49b15f403f834b967c86f8052c7e129792e0581074742b642a98e139c83b9ef1e21993e60eb9b764489afcfafadebd4b1511c1e75043029552c69b11911a0dd886e088921cafdb6b9c5dde0100f64f37e303ab9a703a5188925c23a224d747e740c6c890686f80fc60f9b37b096c9ef312686b9ebf22070536b3c7d1278b011880b6294244cad6207d1aa533b0aa09f3ac0400bca50b0d6ccb5edf2c0e96412f808c8cd34267cf567f4e803c7703f0df02bdaf4109949d5dd56404cabd635764af2d3f0369ff8cf57285cdae307ee66abec0fde30354747e7ca009cc80f57265bc86cf6d76853be06f22006d35d90695b5e90478a83fef7132313ffb50136659f96569720234c52c2bf1727ba1bf8013609c7e5f5e18c540a7198cd342239a4709f622832628873320d7e03b8069a3febcc8a09cc553c335b2bb9d2ed43fcde2304902f05840d928b6593cca8ebaeb7b739fbfde06071e233e00227959cf8a675fbc0000000049454e44ae426082, 'のどにプシュッと１００ml', 'ﾉﾄﾞﾆﾌﾟｼｭｯﾄﾋｬｸﾐﾘﾘｯﾄﾙ', '謎の成分が謎のメカニズムで喉の炎症をやわらげてくれる。', '冒険アイテム', 5, '2014-11-04'),
(18, 'image/png', 0x89504e470d0a1a0a0000000d49484452000000280000002808060000008cfeb86d000000097048597300000b1200000b1201d2dd7efc0000001b74455874536f6674776172650043656c7379732053747564696f20546f6f6cc1a7e17c000001df4944415458c3edd82d56c4301000e0c92d38c23a2a917544d6511989238eca95382a7154ae035959b9b2728fc02d826007a6dda4f967fb60e3f6a7afdf9b4c329330a514ac79b03f09648c393da49462bf0a4498a8a4d3ffbbf7361aac059a22d40f2300008ce34750341ac9bda1462062e80885c5408dc0a7b687ee4582b86fb3247f23793cd0753c3edc02630c7c9e298a2be06561452601e2945d8017a00668dbe4cf0644e47c20da0aa49fb1726c4a9e7cbb390cfda4eacca77cb1d4f946320606e3ee0b787db70ee0770e1e6162bb87d7b767e6dd2ce8eab20b1a23544b01bbb63b4911ba4830858280a1116d24075149a8a53881201491a2925a9c171023e9bbbafb61fc99caa29e4029deb41f5a7390b659be1d0d058a4a42b7bd39ce6f3d69e196366c2390b65c31fd1f05e2d8941c0e433f696883803ef9669a7efc4d5472b248101854ea10a86bede94bf0e54b9136e19300e7dfd128e0f4c574db2e48a7558cd19c472f7613cf0eb49dee6cb53b2b90e6d7522a9c1598a261f83fc01c5d4d349096ba5487f6a4fb606ca9cb06445c0e986907f0aac5a632371fb514511584bec37413e675bba5bbed4a05a4501acde01bd69834d055a1a0535d2a1c9e4f4cd319dc51db807818f2b9654d7281e97a3e7119b1f7d4abbfe5ff04aa242ccf02c940720000000049454e44ae426082, 'ふわもこシルドラ', 'ﾌﾜﾓｺｼﾙﾄﾞﾗ', 'シルドラのぬいぐるみ。<br>売り上げの一部はシルドラ本人の<br>懐に入っているらしい。', 'インテリア', 5, '2014-11-04');

-- --------------------------------------------------------

--
-- テーブルの構造 `mst_user`
--

CREATE TABLE IF NOT EXISTS `mst_user` (
  `USER_ID` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ユーザーID',
  `USER_PASS` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ユーザーパスワード',
  `USER_NAME` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ユーザー名',
  `REG_DATE` date NOT NULL COMMENT 'アカウント登録日'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='登録ユーザーの基本情報';

-- --------------------------------------------------------

--
-- テーブルの構造 `mypage_items`
--

CREATE TABLE IF NOT EXISTS `mypage_items` (
  `USER_ID` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ITEM_IMG` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ITEM_NAME` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ITEM_QTY` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='ユーザー毎のアイテムとアイテム所持数';

-- --------------------------------------------------------

--
-- テーブルの構造 `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `ID` bigint(20) unsigned NOT NULL,
  `imgdat` mediumblob NOT NULL,
  `mine` varchar(64) NOT NULL,
  `TITLE` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `USER_NAME` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `syldra_word`
--

CREATE TABLE IF NOT EXISTS `syldra_word` (
  `ID` int(100) NOT NULL,
  `WORD` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `CATEGORY` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `USER_NAME` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `tamago_born`
--

CREATE TABLE IF NOT EXISTS `tamago_born` (
  `num` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `test_game`
--

CREATE TABLE IF NOT EXISTS `test_game` (
  `USER_ID` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `POINTS` int(100) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `user_detail`
--

CREATE TABLE IF NOT EXISTS `user_detail` (
  `USER_ID` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ユーザーID',
  `USER_NAME` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ユーザー名',
  `USER_LEVEL` int(100) NOT NULL COMMENT 'ユーザーのレベル',
  `USER_COIN` int(100) NOT NULL COMMENT 'ユーザーの所持金貨枚数',
  `USER_POINT` int(100) NOT NULL COMMENT 'ユーザーの所持ポイント',
  `USER_COMMENT` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ユーザーの自己紹介文',
  `USER_SEX` int(10) NOT NULL COMMENT 'ユーザーの性別'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='ユーザー情報の詳細';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_keyword`
--
ALTER TABLE `chat_keyword`
  ADD PRIMARY KEY (`INDEX`);

--
-- Indexes for table `dot_image`
--
ALTER TABLE `dot_image`
  ADD PRIMARY KEY (`SUBJECT_ID`);

--
-- Indexes for table `mst_items`
--
ALTER TABLE `mst_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `syldra_word`
--
ALTER TABLE `syldra_word`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `chat_keyword`
--
ALTER TABLE `chat_keyword`
  MODIFY `INDEX` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dot_image`
--
ALTER TABLE `dot_image`
  MODIFY `SUBJECT_ID` int(100) NOT NULL AUTO_INCREMENT COMMENT 'この画像を使用している題目のID';
--
-- AUTO_INCREMENT for table `mst_items`
--
ALTER TABLE `mst_items`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `syldra_word`
--
ALTER TABLE `syldra_word`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
