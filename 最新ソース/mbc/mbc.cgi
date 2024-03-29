#!/usr/bin/perl
# ↑のパスは設置するサーバーの環境に合わせて変更してください。
#〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜
# まろやかチャット
$version = '1.20b'; # (2010/06/16 Update)
# Copyright(c) 2007-2010 tisa All rights reserved.
# 
# URL  : http://goo.gl/kxtdN
# MAIL : ari_tisa9@ahsic.com
# 
# 参加者表示方法
# 例：<script type="text/javascript" src="./mbc.cgi?mode=mem"></script>
#〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜

# 設定ファイル
$config = './config.ini';

####■ 以下スクリプト ■####
#〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜
$ENV{'TZ'} = 'JST-9';

if (!(-e $config)) { die "Error: $configオープンエラー"; } else { require $config; }
if (!(-e $system)) { die "Error: $systemオープンエラー"; } else { require $system; }
if (!(-e $cgilib)) { die "Error: $cgilibオープンエラー"; } else { require $cgilib; }
if (!(-e $jcode)) { die "Error: $jcodeオープンエラー"; } else { require $jcode; }

%FORM = &decode; # デコード
$host = &get_host; # ホスト取得
%COOKIE = &get_cookie; # クッキーゲット

if ($FORM{'mode'} eq 'top') {
	&top;
} elsif ($FORM{'mode'} eq 'chat') {
	&chat;
} elsif ($FORM{'mode'} eq 'log' || $FORM{'mode'} eq 'logrom') {
	&log;
} elsif ($FORM{'mode'} eq 'logout') {
	&logout;
} elsif ($FORM{'mode'} eq 'mdel') {
	&mdel;
} elsif ($FORM{'mode'} eq 'mem') {
	&mem;
} elsif ($FORM{'mode'} eq 'how') {
	&how;
} elsif ($FORM{'mode'} eq 'btotal') {
	&btotal;
} elsif ($FORM{'mode'} eq 'ranking') {
	&ranking;
} else {
	&frame;
}

exit;
#〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜
# ▼ トップページ
#〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜
sub top {
	&header;

	print qq(
	</head>
	<body class="ftop">
	<table cellpadding="0" cellspacing="0" width="100%"><tr>
	<td><b>$cgititle</b></td>
	<td align="right"><small>
	);

	if ($minigame) {
		print qq(
		[<a href="$script?mode=btotal" target="fbottom">戦績</a>]
		[<a href="$script?mode=ranking" target="fbottom">ランキング</a>]
		);
	}

	print qq([<a href="$script?mode=logrom" target="_block">ログ観覧</a>]) if ($wclog);
	print qq([<a href="$homeurl" target="_top">HOME</a>]) if ($homeurl);
	print qq(
	</small></td>
	</tr></table>
	<hr size="1" width="100%">
	<form action="$script" method="POST" enctype="multipart/form-data">
	<input type="hidden" name="mode" value="chat">
	<input type="hidden" name="in" value="1">
	<table cellpadding="4" cellspacing="0" border="0"><tr>
	<td nowrap>名前 <input type="text" size="20" name="name" value="$COOKIE{'name'}"></td>
	<td nowrap><span class="bgc">
	);

	# 発言文字色
	my $i = 1;
	foreach (0..$#fcolor) {
		print qq(<input type="radio" name="color" value="$_");
		print qq( checked) if (($COOKIE{'color'} eq '' && !$_) or ($COOKIE{'color'} ne '' && $_ == $COOKIE{'color'}));
		print qq(><font color="$fcolor[$_]">■色$i</font>);
		$i++;
	}

	print qq(
	</span></td>
	<td></td>
	<td rowspan="3" class="formbg" valign="top">
	<font>
	<small>パスワードを入力しておくと、なりすまし防止になります。
	);
	
	if ($useicon) {
		print qq(<br>またマイアイコンの使用が出来るようになります。);
	}

	print qq(
	</small></font><br>
	パスワード <input type="password" size="15" name="pass" value="$COOKIE{'pass'}">
	);

	if ($useicon) {
		print qq(
		<input type="checkbox" name="del" value="1">マイアイコンの削除<br>
		マイアイコン <input type="file" name="icon" size="50">
		);
		if ($COOKIE{'icon'} && -e "$icondir/$COOKIE{'icon'}") {
			my $time = time;
			print qq(
			<td rowspan="3" class="formbg" valign="top">
			<font><small>▼現在のアイコン</small></font><br>);
			print qq(<img src="$icondir/$COOKIE{'icon'}?$time" alt="icon");
			print qq( width="$imgszwd") if ($imgszwd);
			print qq( height="$imgszhi") if ($imgszhi);
			print qq(></td>);
		}
	}

	print qq(
	</td>
	</tr><tr>
	<td nowrap>挨拶 <input type="text" size="20" name="greet" value=""></td>
	<td><input type="button" value="　入室　" class="button" onClick="this.disabled='true'; this.form.submit();"></td>
	</tr><tr>
	<td valign="top">
	リロード時間
	<select name="reload">
	<option value="none");
	print qq( selected) if (!$COOKIE{'reload'} || $COOKIE{'reload'} eq 'none');
	print qq(>なし</option>);
	foreach (@reload) {
		print qq(<option value="$_");
		print qq( selected) if ($_ eq $COOKIE{'reload'});
		print qq(>$_</option>);
	}
	print qq(
	</select>
	</td><td valign="top">
	ログ表\示数
	<select name="viewlog">
	<option value="max");
	print qq( selected) if (!$COOKIE{'viewlog'} || $COOKIE{'viewlog'} eq 'max');
	print qq(>最大</option>);
	foreach (@reload) {
		print qq(<option value="$_");
		print qq( selected) if ($_ eq $COOKIE{'viewlog'});
		print qq(>$_</option>);
	}
	print qq(
	</select>
	</td></tr>
	</table>
	</form>
	</body></html>
	);
}

#〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜
# ▼ チャット画面
#〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜
sub chat {
	# アクセスチェック
	&access_check;
	if (!$FORM{'name'}) {
		&error("名前を入力してください。");
	}

	# メンバーファイル読み込み
	my @mem = &file_read($member);

	foreach (@mem) {
		my ($tp, $tm, $ip, $nm, $cl) = split (/\t/, $_);
		if ($ip ne $host && $nm eq $FORM{'name'}) {
			&error("同名の人がいます。");
		}
	}

	# ユーザーファイル読み込み
	my @user = &file_read($user);

	# パスワード認証／アイコンアップロード
	my ($img, $name, $ext, $flg);
	foreach (@user) {
		# 名前,画像名,拡張子,パスワード,IP
		my @tmp = split (/\t/, $_);
		if ($tmp[0] eq $FORM{'name'}) {
			&pass_check($FORM{'pass'}, $tmp[3]); # パスワードチェック
			if ($incfn{'icon'} =~ /.+\.(gif|jpg|png)/) {
				$tmp[2] = $1; # 拡張子取得
				&img_write("$icondir/$tmp[1].$1", $FORM{'icon'}); # 画像アップロード
				$_ = join ("\t", @tmp);
			}
			($name, $ext) = @tmp[1, 2];
			$flg = 1;
			last;
		}
	}
	if ($FORM{'pass'} && !$flg) {
		my $pwd = &encrypt($FORM{'pass'}); # 暗号化
		$name = (@user)+1; # 画像名
		if ($incfn{'icon'} =~ /.+\.(gif|jpg|png)/) {
			$ext = $1; # 拡張子取得
			&img_write("$icondir/$name.$ext", $FORM{'icon'}); # 画像アップロード
		}
		push (@user, "$FORM{'name'}\t$name\t$ext\t$pwd\t$host");
	}
	if ($FORM{'del'}) {
		unlink (<$icondir/$name.*>); # /
	} elsif ($name) {
		$img = "$name.$ext";
	}
	if ($FORM{'icon'} || !$flg) {
		# ファイル書き込み
		&lock if ($lock == 2);
		&file_write($user, @user);
		&unlock if ($lock == 2);
	}

	# クッキーセット
	&set_cookie($FORM{'name'}, $FORM{'color'}, $FORM{'reload'}, $FORM{'viewlog'}, $FORM{'pass'}, $img);

	&header(1);
	&java;

	print qq(</head><body class="ftop");
	print qq( onload="setTimeout('pageload()',1000)") if ($FORM{'in'});
	print qq(>
	<form action="$script" method="POST" name="form" target="fbottom" onsubmit="setTimeout('clear()', 100)">
	<input type="hidden" name="mode" value="log">
	<input type="hidden" name="in" value="2">
	<input type="hidden" name="name" value="$FORM{'name'}">
	<input type="hidden" name="color" value="$FORM{'color'}">
	<input type="hidden" name="icon" value="$img">
	<table cellpadding="2" width="100%"><tr>
	<td>
	<input type="submit" value="発言/リロード" class="button">
	<input type="button" value="ささやき更新" class="button" onclick="location.href='$script?mode=chat&size='+this.form.size.value+'&deco='+this.form.deco.value+'&wname='+this.form.wname.value+'&keep='+this.form.keep.checked+'&keep2='+this.form.keep2.checked+'&reload='+this.form.reload.value+'&viewlog='+this.form.viewlog.value+'&name=$FORM{'name'}&color=$FORM{'color'}&pass=$FORM{'pass'}'">
	ささやき
	<select name="wname">
	<option value="">なし</option>
	<option value="all,全員">全員</option>
	);

	# ささやき
	foreach (@mem) {
		($type, $mtime, $mhost, $mname, $col) = split (/\t/, $_);
		next if ($mhost eq $host || $type == 0);
		print qq(<option value="$mhost,$mname");
		print qq( selected) if ($FORM{'wname'} eq "$mhost,$mname");
		print qq(>$mname</option>);
	}

	print qq(
	</select>
	<label><input type="checkbox" name="keep" value="1" style="border: 1px;");
	print qq( checked) if ($FORM{'keep'} eq 'true');
	print qq(>固定</label>
	</td>
	</tr><tr>
	<td><input type="text" size="100" name="mess" value=""></td>
	<td align="right" valign="bottom" rowspan="4">
	);

	if ($minigame) {
		print qq(
		<small>
		[<a href="#" onClick="window.open('$battle?name=$FORM{'name'}', '_battle','directories=no,location=no,menubar=no,scrollbars=yes,status=no,resizable=no,width=570,height=570'); return false;">バトる</a>]
		[<a href="$script?mode=how" target="fbottom">遊び方</a>]
		[<a href="$script?mode=btotal" target="fbottom">戦績</a>]
		[<a href="$script?mode=ranking" target="fbottom">ランキング</a>]
		</small>
		);
	}

	print qq(
	</td>
	</tr><tr>
	<td>
	装飾
	<select name="deco">
	<option value="">なし</option>
	);

	foreach (0..$#decos) {
		print qq(<option value="$decov[$_]");
		print qq( selected) if ($FORM{'keep2'} && $decov[$_] eq $FORM{'deco'});
		print qq(>$decos[$_]</option>);
	}

	print qq(
	</select>
	文字サイズ
	<select name="size">
	);

	foreach (0..$#sizes) {
		print qq(<option value="$sizev[$_]");
		print qq( selected) if (($FORM{'keep2'} && $sizev[$_] eq $FORM{'size'}) or (!$sizev[$_] && !$FORM{'size'}));
		print qq(>$sizes[$_]</option>);
	}

	print qq(
	</select>
	<label><input type="checkbox" name="keep2" value="1" style="border: 1px;");
	print qq( checked) if ($FORM{'keep2'} eq 'true');
	print qq(>固定</label>
	</td>
	</tr><tr>
	<td colspan="3"><hr size="1" width="100%"></td>
	</tr><tr>
	<td>
	リロード時間
	<select name="reload" onchange="parent.fbottom.location.href='$script?mode=log&in=2&name=$FORM{'name'}&viewlog='+this.form.viewlog.value+'&reload='+this.form.reload.value+''">
	<option value="none");
	print qq( selected) if ($FORM{'reload'} eq 'none');
	print qq(>なし</option>);
	foreach (@reload) {
		print qq(<option value="$_");
		print qq( selected) if ($_ eq $FORM{'reload'});
		print qq(>$_</option>);
	}
	print qq(
	</select>
	ログ表\示数
	<select name="viewlog" onchange="parent.fbottom.location.href='$script?mode=log&in=2&name=$FORM{'name'}&viewlog='+this.form.viewlog.value+'&reload='+this.form.reload.value+''">
	<option value="max");
	print qq( selected) if ($FORM{'viewlog'} eq 'max');
	print qq(>最大</option>);
	foreach (@reload) {
		print qq(<option value="$_");
		print qq( selected) if ($_ eq $FORM{'viewlog'});
		print qq(>$_</option>);
	}
	print qq(
	</select>
	);
	print qq([<a href="javascript:location.href='$script?mode=mdel&name=$FORM{'name'}&color=$FORM{'color'}&pass=$FORM{'pass'}&icon=$img&viewlog='+this.form.viewlog.value+'&reload='+this.form.reload.value+''">発言削除</a>]) if ($mdel);
	print qq(
	</form>
	</td>
	<td align="right">
	<form action="$script" method="POST" target="_parent">
	<input type="hidden" name="mode" value="logout">
	<input type="hidden" name="in" value="2">
	<input type="hidden" name="name" value="$FORM{'name'}">
	<input type="hidden" name="color" value="$FORM{'color'}">
	<input type="hidden" name="viewlog" value="max">
	<input type="submit" value="　退室　" class="button">
	</form>
	</td>
	</tr></table>
	</body></html>
	);
}

#〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜
# ▼ 退室処理
#〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜
sub logout {
	# ファイル読み込み
	my @clog = &file_read($clog);
	my @mem = &file_read($member);

	my $time = time;

	# 参加者メンバーからなくす
	my @newmem;
	foreach (@mem) {
		my ($type, $mtime, $mhost, $mname, $mcol) = split (/\t/, $_);
		if ($mhost ne $host && ($time-60*$timeout) < $mtime) {
			push (@newmem, $_);
		}
	}

	# 退室処理
	my $days = &get_days;

	my $out = "1\t$FORM{'name'}\t$FORM{'icon'}\t$FORM{'color'}\t$FORM{'name'}さんが退室しました。\t$days\t$host";

	unshift (@clog, $out);

	# ファイル書き込み
	&lock if ($lock == 2);
	&file_write($member, @newmem);
	&file_write($clog, @clog);
	&unlock if ($lock == 2);

	&header();

	print qq(
	</head>
	<body class="fbottom">
	<div align="right">[<a href="$script?">トップページへ</a>]</div>
	);

	&view(@clog);
}

#〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜
# ▼ ログ表示
#〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜
sub log {
	# アクセスチェック
	&access_check;

	# ファイル読み込み
	my @clog = &file_read($clog);
	my @mem = &file_read($member);

	my $time = time;

	# 参加者メンバーを確認
	my @newmem;
	my $memcnt = ($FORM{'in'}) ? 1 : 0;
	my $romct = (!$FORM{'in'}) ? 1 : 0;
	foreach (@mem) {
		my ($type, $mtime, $mhost, $mname, $mcol) = split (/\t/, $_);
		if ($mhost ne $host) {
			if ($type && ($time-(60*$timeout)) < $mtime) {
				push (@newmem, $_);
				$memcnt++;
			} elsif (!$type && ($time-60) < $mtime) {
				push (@newmem, $_);
				$romct++;
			}
		}
	}
	my $type = ($FORM{'in'}) ? 1 : 0;
	push (@newmem, "$type\t$time\t$host\t$FORM{'name'}\t$FORM{'color'}");

	# 参加者人数
	#my $memcnt = @newmem;

	# 日付セット
	my $days = &get_days;

	# 入室処理
	if ($FORM{'in'} == 1) {
		unshift (@clog, "1\t$FORM{'name'}\t$FORM{'icon'}\t$FORM{'color'}\t$FORM{'name'}さんが入室しました。\t$days\t$host");

		if ($FORM{'greet'}) {
			unshift (@clog, "0\t$FORM{'name'}\t$FORM{'icon'}\t$FORM{'color'}\t$FORM{'greet'}\t$days\t$host\t\t");
		}
	}

	if ($FORM{'wname'} || $FORM{'mess'}) {
		if ($ENV{'REQUEST_METHOD'} ne 'POST') {
			&error("不正なアクセスです。");
		}

		if ((split (/\t/, $clog[0]))[3] eq $FORM{'mess'}) {
			&error("二重送信は禁止しています。");
		}

		# 装飾・文字サイズ
		my $mess = $FORM{'mess'};
		if ($FORM{'deco'} eq 'inv') {
			$mess = "<font color=\"$invcolor\">$FORM{'mess'}</font>";
		} elsif ($FORM{'deco'}) {
			$mess = "<$FORM{'deco'}>$FORM{'mess'}</$FORM{'deco'}>";
		}
		if ($FORM{'size'}) {
			$mess = "<font size=\"$FORM{'size'}\">$mess</font>";
		}

		# 発言処理
		if ($FORM{'wname'} && $FORM{'mess'}) {
			$mess =~ s/([^0-9A-Za-z_ ])/'%'.unpack('H2',$1)/ge;
			$mess =~ s/\s/+/g;
			$mess =~ tr/a-fA-F0-9/fedcbaFEDCBA9876543210/;

			my ($whost, $wname) = split (/\,/, $FORM{'wname'});

			# ささやき
			unshift (@clog, "2\t$FORM{'name'}\t$FORM{'icon'}\t$FORM{'color'}\t$mess\t$days\t$host\t$whost\t$wname");
		} elsif ($FORM{'mess'}) {
			# 通常
			unshift (@clog, "0\t$FORM{'name'}\t$FORM{'icon'}\t$FORM{'color'}\t$mess\t$days\t$host\t\t");

			# ダイス
			if ($FORM{'mess'} eq 'dice!') {
				my $dice = int(rand(6)) + 1;
				unshift (@clog, "3\t$FORM{'name'}\t$FORM{'icon'}\t$FORM{'color'}\t$dice\t$days\t$host\t\t");
			}
		}
	}

	pop (@clog) if ((@clog) > $maxlog);

	# ファイル書き込み
	&lock if ($lock == 2);
	&file_write($member, @newmem);
	&file_write($clog, @clog);
	&unlock if ($lock == 2);

	&header();

	print qq(
	</head>
	<body class="fbottom">
	<small>参加者：$memcnt人
	);
	print qq(ROM：$romct人) if ($romvw && !$rom);
	if ($FORM{'mode'} eq 'logrom') {
		print qq(
		<form action="$script">
		<input type="hidden" name="mode" value="logrom">
		ログ：<select name="viewlog">
		<option value="max">最大</option>);
		foreach (0..$#viewlog) {
			print qq(<option value="$viewlog[$_]");
			print qq( selected) if ($FORM{'viewlog'} eq $viewlog[$_] or (!$FORM{'viewlog'} && $_ == $#viewlog));
			print qq(>$viewlog[$_]</option>);
		}
		print qq(
		</select>
		<input type="submit" value="リロード" class="fbtm">
		</form>
		);
	}
	print qq(</small>);


	&view(@clog);
}

#〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜
# ▼ ログ表示
#〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜
sub view {
	print qq(
	<hr size="1" width="100%">
	);

	$FORM{'viewlog'} ||= $viewlog[$#viewlog];
	my $i = 1;
	foreach (@_) {
		chomp;
		my ($type, $name, $icon, $color, $text, $days, $hst, $whst, $wnam) = split (/\t/, $_);

		my $img;
		if ($icon && -e "$icondir/$icon") {
			my $time = time;
			$img = qq(<img src="$icondir/$icon?$time" alt="icon");
			$img .= qq( width="$imgszwd") if ($imgszwd);
			$img .= qq( height="$imgszhi") if ($imgszhi);
			$img .= qq(>);
		}

		if ($type == 1) {
			print qq($img<b><font color="#8A6E5C">$text <small>[$days]</small></font></b>\n);
		} elsif ($type == 2) {
			$text = &decode2($text);

			if ($FORM{'in'} && ($whst eq $host || $whst eq 'all')) {
				print qq($img<font color="$fcolor[$color]">■$name</font>さんから);
				print qq(全員へ) if ($whst eq 'all');
				print qq(ささやき... &gt; $text <small>[$days]</small>\n);
			} elsif ($FORM{'in'} && $hst eq $host) {
				print qq($img<font color="$fcolor[$color]">■$name</font> &gt; $wnamさんへささやき... &gt; $text <small>[$days]</small>\n);
			} else {
				next;
			}
		} elsif ($type == 3) {
			print qq(<font color="#8A6E5C">DICE</font> > $text <small>[$days]</small>\n);
		} else {
			print qq($img<font color="$fcolor[$color]">■$name</font> &gt; $text <small>[$days]</small>\n);
		}

		print qq(<hr size="1" width="100%">);

		last if ($FORM{'viewlog'} && $FORM{'viewlog'} ne 'max' && $i >= $FORM{'viewlog'});
		$i++;
	}

	&copy;

	print qq(</body></html>);
}

#〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜
# ▼ 発言削除
#〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜
sub mdel {
	# ファイル読み込み
	my @clog = &file_read($clog);

	&header(1);
	&java;

	print qq(
	</head>
	<body class="ftop");
	print qq( onload="setTimeout('pageload()',1000)") if ($FORM{'write'});
	print qq(>
	発言削除
	<hr size="1" width="100%">
	<form action="$script" method="POST">
	<input type="hidden">
	$FORM{'name'}さんの発言ログ<br>
	<input type="hidden" name="mode" value="mdel">
	<input type="hidden" name="write" value="1">
	<input type="hidden" name="in" value="2">
	<input type="hidden" name="name" value="$FORM{'name'}">
	<input type="hidden" name="color" value="$FORM{'color'}">
	<input type="hidden" name="viewlog" value="$FORM{'viewlog'}">
	<input type="hidden" name="reload" value="$FORM{'reload'}">
	<input type="hidden" name="pass" value="$FORM{'pass'}">
	<input type="hidden" name="icon" value="$FORM{'icon'}">
	<select name="delmess">
	);

	my @newclog;
	foreach (@clog) {
		my ($type, $text, $hst) = (split (/\t/, $_))[0, 4, 6];

		$text = &decode2($text) if ($type == 2);
		$text =~ s/<.+?>//g;

		if (($type == 2 || $type == 0) and $hst eq $host) {
			next if ($text eq $FORM{'delmess'});

			print qq(<option value="$text">$text</option>);
		}

		push (@newclog, $_);
	}

	# ファイル書き込み
	if ($FORM{'write'}) {
		&lock if ($lock == 2);
		&file_write($clog, @newclog);
		&unlock if ($lock == 2);
	}

	print qq(
	</select>
	<input type="submit" value=" 削除 " class="button"><br>);
	print qq(<font color="#CC0000">[発言を削除しました。]</font>) if ($FORM{'write'});
	print qq(
	<br>
	[<a href="$script?mode=chat&name=$FORM{'name'}&color=$FORM{'color'}&viewlog=$FORM{'viewlog'}&reload=$FORM{'reload'}&pass=$FORM{'pass'}&icon=$FORM{'icon'}">発言画面へ</a>]
	</form>
	</body></html>
	);
}

#〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜
# ▼ 戦績
#〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜
sub btotal {
	# ファイル読み込み
	my @btllog = &file_read($btllog);

	&header;
	print qq(
	</head><body class="ftop">
	<table align="center" cellpadding="5" width="500">
	<tr class="bgc">
	<td align="center" colspan="3"><b>戦績</b></td>
	</tr>
	);

	foreach (@btllog) {
		my ($name, $name2, $win, $days) = split (/\t/, $_);

		print qq(
		<tr class="bgc">
		<td align="center">
		);

		if ($win == 1) {
			print qq(<font color="#0033CC">Win!</font> <big>$name</big>);
		} else {
			print qq(<font color="#CC3333">Lose!</font> $name);
		}

		print qq( <b>vs</b> );

		if ($win == 0) {
			print qq(<big>$name2</big> <font color="#0033CC">Win!</font>);
		} else {
			print qq($name2 <font color="#CC3333">Lose!</font>);
		}

		print qq(
		<br><small>$days</small></td>
		</tr>
		);
	}

	print qq(
	</table>
	);

	&copy;

	print qq(
	</body></html>
	);
}

#〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜
# ▼ ランキング
#〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜
sub ranking {
	# ファイル読み込み
	my @btotal = &file_read($btotal);

	&header;

	print qq(
	</head><body class="ftop">
	<table align="center" cellpadding="5" width="500">
	<tr class="bgc">
	<td align="center" colspan="3"><b>ランキング</b></td>
	</tr>
	<tr class="bgc">
	<td align="center"><small><b>名前</b></small></td>
	<td><small><b>勝利</b></small></td>
	<td><small><b>敗北</b></small></td>
	</tr>
	);

	foreach (sort { (split (/\t/, $b))[1] <=> (split (/\t/, $a))[1] || (split (/\t/, $a))[2] <=> (split (/\t/, $b))[2] || (split (/\t/, $a))[0] cmp (split (/\t/, $b))[0] } @btotal) {
		my ($name, $win, $lose) = split (/\t/, $_);

		print qq(
		<tr class="bgc">
		<td align="center">$name</td>
		<td><font color="#0033CC">$win</font></td>
		<td><font color="#CC3333">$lose</font></td>
		</tr>
		);
	}

	print qq(
	</table>
	);

	&copy;

	print qq(
	</body></html>
	);
}

#〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜
# ▼ JavaScript
#〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜
sub java {
	print <<"JAVA";
<script language="JavaScript">
<!--
if ($rom) {
	parent.document.getElementsByTagName("frameset")[0].rows = "140, *";
}
function pageload(){
	parent.fbottom.location.href = '$script?mode=log&in=$FORM{'in'}&name=$FORM{'name'}&greet=$FORM{'greet'}&color=$FORM{'color'}&reload=$FORM{'reload'}&viewlog=$FORM{'viewlog'}';
}
function clear(){
	document.form.mess.value = '';
	if (document.form.keep.checked == false) {
		document.form.wname.options[0].selected = true;
		document.form.mess.focus();
	}
	if (document.form.keep2.checked == false) {
		document.form.deco.options[0].selected = true;
		for (i = 0; i < document.form.size.length; i++) {
			if (document.form.size.options[i].value == '') {
				document.form.size.options[i].selected = true;
			}
		}
	}
}
//-->
</script>
JAVA
}

#〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜
# ▼ フレーム
#〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜
sub frame {
	&deny; # アクセス制限

	print "Content-type: text/html\n\n";
	print qq(
	<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=Shift_JIS">
	<title>$cgititle</title>
	</head>
	<frameset rows=");
	($rom) ? print "100%, *" : print "150, *";
	print qq(" name="main">
	<frame src="$script?mode=top" name="ftop" scrolling="no" marginheight="10" marginwidth="10">
	<frame src="$script?mode=log" name="fbottom" marginheight="10" marginwidth="10">
	<noframes>[フレーム対応のブラウザでご覧ください。]</noframes>
	</frameset>
	</html>
	);
}

#〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜
# ▼ 遊び方
#〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜
sub how {
	&header;

	print <<"_HTML_";
</head><body class="ftop">
<table align="center" cellpadding="5" width="600">
	<tr class="bgc">
		<td align="center" colspan="3"><b>遊び方</b></td>
	</tr>
	<tr class="bgc">
		<td style="padding: 20px 30px;">
		■ 参戦
		<blockquote>
		<small>
		チャットに入室したまま「バトる」をクリックします。<br>
		購入画面が出ますので好きな装備を選び「この装備でバトる!」をクリック。<br>
		対戦相手がいなければ待機状態になります。対戦相手がすでにいればバトル開始！<br>
		バトらずに終了する場合は必ず<font color="#CC0033">「リロード」の隣の「閉じる」ボタンを押してください。</font>
		</small>
		</blockquote>
		■ 画面説明/ステータス
		<blockquote>
		<small>
		hp = 0になると敗北。<br>
		cp = 魔法に使用します。毎ターン回復。<br>
		<br>
		<img src="$imgdir/atk.gif" width="24" height="24" align="middle"> = 通常攻撃<br>
		<img src="$imgdir/mgc.gif" width="24" height="24" align="middle"> = 魔法（cpを消費）<br>
		<img src="$imgdir/prt.gif" width="24" height="24" align="middle"> = 防御（ダメージ軽減/cp獲得up）<br>
		<img src="$imgdir/ac_item.gif" width="24" height="24" align="middle"> = 道具（消耗品）<br>
		<br>
		<img src="$imgdir/s_up.gif" width="24" height="24" align="middle"> = 攻撃力上昇中<br>
		<img src="$imgdir/m_up.gif" width="24" height="24" align="middle"> = 魔法攻撃力上昇中<br>
		<img src="$imgdir/d_up.gif" width="24" height="24" align="middle"> = 防御力上昇中<br>
		<img src="$imgdir/poizn.gif" width="24" height="24" align="middle"> = 毒状態（毎ターン5〜10ダメージ）
		</small>
		</blockquote>
		■ バトル
		<blockquote>
		<small>
		先に待機していたほうが先制し、反対の相手にはハンデとしてcp+30が付与されます。<br>
		相手を倒せば勝利！
		</small>
		</blockquote>
		</td>
	</tr>
	<tr class="bgc">
		<td style="padding: 20px 30px;">
		<small>
		ゲームの画像は以下のサイトからいただいてます。無断で使用しないでください。<br>
		<a href="http://neko.moo.jp/BS/" target="blank"><img src="img/banner.gif" width="88" height="31"></a>
		化け猫缶素材屋
		</small>
		</td>
	</tr>
</table>
_HTML_

	&copy;

	print qq(
	</body></html>
	);
}