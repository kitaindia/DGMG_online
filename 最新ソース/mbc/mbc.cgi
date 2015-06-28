#!/usr/bin/perl
# ª‚ÌƒpƒX‚Íİ’u‚·‚éƒT[ƒo[‚ÌŠÂ‹«‚É‡‚í‚¹‚Ä•ÏX‚µ‚Ä‚­‚¾‚³‚¢B
#````````````````````````````
# ‚Ü‚ë‚â‚©ƒ`ƒƒƒbƒg
$version = '1.20b'; # (2010/06/16 Update)
# Copyright(c) 2007-2010 tisa All rights reserved.
# 
# URL  : http://goo.gl/kxtdN
# MAIL : ari_tisa9@ahsic.com
# 
# Q‰ÁÒ•\¦•û–@
# —áF<script type="text/javascript" src="./mbc.cgi?mode=mem"></script>
#````````````````````````````

# İ’èƒtƒ@ƒCƒ‹
$config = './config.ini';

####¡ ˆÈ‰ºƒXƒNƒŠƒvƒg ¡####
#````````````````````````````
$ENV{'TZ'} = 'JST-9';

if (!(-e $config)) { die "Error: $configƒI[ƒvƒ“ƒGƒ‰["; } else { require $config; }
if (!(-e $system)) { die "Error: $systemƒI[ƒvƒ“ƒGƒ‰["; } else { require $system; }
if (!(-e $cgilib)) { die "Error: $cgilibƒI[ƒvƒ“ƒGƒ‰["; } else { require $cgilib; }
if (!(-e $jcode)) { die "Error: $jcodeƒI[ƒvƒ“ƒGƒ‰["; } else { require $jcode; }

%FORM = &decode; # ƒfƒR[ƒh
$host = &get_host; # ƒzƒXƒgæ“¾
%COOKIE = &get_cookie; # ƒNƒbƒL[ƒQƒbƒg

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
#````````````````````````````
# ¥ ƒgƒbƒvƒy[ƒW
#````````````````````````````
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
		[<a href="$script?mode=btotal" target="fbottom">íÑ</a>]
		[<a href="$script?mode=ranking" target="fbottom">ƒ‰ƒ“ƒLƒ“ƒO</a>]
		);
	}

	print qq([<a href="$script?mode=logrom" target="_block">ƒƒOŠÏ——</a>]) if ($wclog);
	print qq([<a href="$homeurl" target="_top">HOME</a>]) if ($homeurl);
	print qq(
	</small></td>
	</tr></table>
	<hr size="1" width="100%">
	<form action="$script" method="POST" enctype="multipart/form-data">
	<input type="hidden" name="mode" value="chat">
	<input type="hidden" name="in" value="1">
	<table cellpadding="4" cellspacing="0" border="0"><tr>
	<td nowrap>–¼‘O <input type="text" size="20" name="name" value="$COOKIE{'name'}"></td>
	<td nowrap><span class="bgc">
	);

	# ”­Œ¾•¶šF
	my $i = 1;
	foreach (0..$#fcolor) {
		print qq(<input type="radio" name="color" value="$_");
		print qq( checked) if (($COOKIE{'color'} eq '' && !$_) or ($COOKIE{'color'} ne '' && $_ == $COOKIE{'color'}));
		print qq(><font color="$fcolor[$_]">¡F$i</font>);
		$i++;
	}

	print qq(
	</span></td>
	<td></td>
	<td rowspan="3" class="formbg" valign="top">
	<font>
	<small>ƒpƒXƒ[ƒh‚ğ“ü—Í‚µ‚Ä‚¨‚­‚ÆA‚È‚è‚·‚Ü‚µ–h~‚É‚È‚è‚Ü‚·B
	);
	
	if ($useicon) {
		print qq(<br>‚Ü‚½ƒ}ƒCƒAƒCƒRƒ“‚Ìg—p‚ªo—ˆ‚é‚æ‚¤‚É‚È‚è‚Ü‚·B);
	}

	print qq(
	</small></font><br>
	ƒpƒXƒ[ƒh <input type="password" size="15" name="pass" value="$COOKIE{'pass'}">
	);

	if ($useicon) {
		print qq(
		<input type="checkbox" name="del" value="1">ƒ}ƒCƒAƒCƒRƒ“‚Ìíœ<br>
		ƒ}ƒCƒAƒCƒRƒ“ <input type="file" name="icon" size="50">
		);
		if ($COOKIE{'icon'} && -e "$icondir/$COOKIE{'icon'}") {
			my $time = time;
			print qq(
			<td rowspan="3" class="formbg" valign="top">
			<font><small>¥Œ»İ‚ÌƒAƒCƒRƒ“</small></font><br>);
			print qq(<img src="$icondir/$COOKIE{'icon'}?$time" alt="icon");
			print qq( width="$imgszwd") if ($imgszwd);
			print qq( height="$imgszhi") if ($imgszhi);
			print qq(></td>);
		}
	}

	print qq(
	</td>
	</tr><tr>
	<td nowrap>ˆ¥A <input type="text" size="20" name="greet" value=""></td>
	<td><input type="button" value="@“üº@" class="button" onClick="this.disabled='true'; this.form.submit();"></td>
	</tr><tr>
	<td valign="top">
	ƒŠƒ[ƒhŠÔ
	<select name="reload">
	<option value="none");
	print qq( selected) if (!$COOKIE{'reload'} || $COOKIE{'reload'} eq 'none');
	print qq(>‚È‚µ</option>);
	foreach (@reload) {
		print qq(<option value="$_");
		print qq( selected) if ($_ eq $COOKIE{'reload'});
		print qq(>$_</option>);
	}
	print qq(
	</select>
	</td><td valign="top">
	ƒƒO•\\¦”
	<select name="viewlog">
	<option value="max");
	print qq( selected) if (!$COOKIE{'viewlog'} || $COOKIE{'viewlog'} eq 'max');
	print qq(>Å‘å</option>);
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

#````````````````````````````
# ¥ ƒ`ƒƒƒbƒg‰æ–Ê
#````````````````````````````
sub chat {
	# ƒAƒNƒZƒXƒ`ƒFƒbƒN
	&access_check;
	if (!$FORM{'name'}) {
		&error("–¼‘O‚ğ“ü—Í‚µ‚Ä‚­‚¾‚³‚¢B");
	}

	# ƒƒ“ƒo[ƒtƒ@ƒCƒ‹“Ç‚İ‚İ
	my @mem = &file_read($member);

	foreach (@mem) {
		my ($tp, $tm, $ip, $nm, $cl) = split (/\t/, $_);
		if ($ip ne $host && $nm eq $FORM{'name'}) {
			&error("“¯–¼‚Ìl‚ª‚¢‚Ü‚·B");
		}
	}

	# ƒ†[ƒU[ƒtƒ@ƒCƒ‹“Ç‚İ‚İ
	my @user = &file_read($user);

	# ƒpƒXƒ[ƒh”FØ^ƒAƒCƒRƒ“ƒAƒbƒvƒ[ƒh
	my ($img, $name, $ext, $flg);
	foreach (@user) {
		# –¼‘O,‰æ‘œ–¼,Šg’£q,ƒpƒXƒ[ƒh,IP
		my @tmp = split (/\t/, $_);
		if ($tmp[0] eq $FORM{'name'}) {
			&pass_check($FORM{'pass'}, $tmp[3]); # ƒpƒXƒ[ƒhƒ`ƒFƒbƒN
			if ($incfn{'icon'} =~ /.+\.(gif|jpg|png)/) {
				$tmp[2] = $1; # Šg’£qæ“¾
				&img_write("$icondir/$tmp[1].$1", $FORM{'icon'}); # ‰æ‘œƒAƒbƒvƒ[ƒh
				$_ = join ("\t", @tmp);
			}
			($name, $ext) = @tmp[1, 2];
			$flg = 1;
			last;
		}
	}
	if ($FORM{'pass'} && !$flg) {
		my $pwd = &encrypt($FORM{'pass'}); # ˆÃ†‰»
		$name = (@user)+1; # ‰æ‘œ–¼
		if ($incfn{'icon'} =~ /.+\.(gif|jpg|png)/) {
			$ext = $1; # Šg’£qæ“¾
			&img_write("$icondir/$name.$ext", $FORM{'icon'}); # ‰æ‘œƒAƒbƒvƒ[ƒh
		}
		push (@user, "$FORM{'name'}\t$name\t$ext\t$pwd\t$host");
	}
	if ($FORM{'del'}) {
		unlink (<$icondir/$name.*>); # /
	} elsif ($name) {
		$img = "$name.$ext";
	}
	if ($FORM{'icon'} || !$flg) {
		# ƒtƒ@ƒCƒ‹‘‚«‚İ
		&lock if ($lock == 2);
		&file_write($user, @user);
		&unlock if ($lock == 2);
	}

	# ƒNƒbƒL[ƒZƒbƒg
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
	<input type="submit" value="”­Œ¾/ƒŠƒ[ƒh" class="button">
	<input type="button" value="‚³‚³‚â‚«XV" class="button" onclick="location.href='$script?mode=chat&size='+this.form.size.value+'&deco='+this.form.deco.value+'&wname='+this.form.wname.value+'&keep='+this.form.keep.checked+'&keep2='+this.form.keep2.checked+'&reload='+this.form.reload.value+'&viewlog='+this.form.viewlog.value+'&name=$FORM{'name'}&color=$FORM{'color'}&pass=$FORM{'pass'}'">
	‚³‚³‚â‚«
	<select name="wname">
	<option value="">‚È‚µ</option>
	<option value="all,‘Sˆõ">‘Sˆõ</option>
	);

	# ‚³‚³‚â‚«
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
	print qq(>ŒÅ’è</label>
	</td>
	</tr><tr>
	<td><input type="text" size="100" name="mess" value=""></td>
	<td align="right" valign="bottom" rowspan="4">
	);

	if ($minigame) {
		print qq(
		<small>
		[<a href="#" onClick="window.open('$battle?name=$FORM{'name'}', '_battle','directories=no,location=no,menubar=no,scrollbars=yes,status=no,resizable=no,width=570,height=570'); return false;">ƒoƒg‚é</a>]
		[<a href="$script?mode=how" target="fbottom">—V‚Ñ•û</a>]
		[<a href="$script?mode=btotal" target="fbottom">íÑ</a>]
		[<a href="$script?mode=ranking" target="fbottom">ƒ‰ƒ“ƒLƒ“ƒO</a>]
		</small>
		);
	}

	print qq(
	</td>
	</tr><tr>
	<td>
	‘•ü
	<select name="deco">
	<option value="">‚È‚µ</option>
	);

	foreach (0..$#decos) {
		print qq(<option value="$decov[$_]");
		print qq( selected) if ($FORM{'keep2'} && $decov[$_] eq $FORM{'deco'});
		print qq(>$decos[$_]</option>);
	}

	print qq(
	</select>
	•¶šƒTƒCƒY
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
	print qq(>ŒÅ’è</label>
	</td>
	</tr><tr>
	<td colspan="3"><hr size="1" width="100%"></td>
	</tr><tr>
	<td>
	ƒŠƒ[ƒhŠÔ
	<select name="reload" onchange="parent.fbottom.location.href='$script?mode=log&in=2&name=$FORM{'name'}&viewlog='+this.form.viewlog.value+'&reload='+this.form.reload.value+''">
	<option value="none");
	print qq( selected) if ($FORM{'reload'} eq 'none');
	print qq(>‚È‚µ</option>);
	foreach (@reload) {
		print qq(<option value="$_");
		print qq( selected) if ($_ eq $FORM{'reload'});
		print qq(>$_</option>);
	}
	print qq(
	</select>
	ƒƒO•\\¦”
	<select name="viewlog" onchange="parent.fbottom.location.href='$script?mode=log&in=2&name=$FORM{'name'}&viewlog='+this.form.viewlog.value+'&reload='+this.form.reload.value+''">
	<option value="max");
	print qq( selected) if ($FORM{'viewlog'} eq 'max');
	print qq(>Å‘å</option>);
	foreach (@reload) {
		print qq(<option value="$_");
		print qq( selected) if ($_ eq $FORM{'viewlog'});
		print qq(>$_</option>);
	}
	print qq(
	</select>
	);
	print qq([<a href="javascript:location.href='$script?mode=mdel&name=$FORM{'name'}&color=$FORM{'color'}&pass=$FORM{'pass'}&icon=$img&viewlog='+this.form.viewlog.value+'&reload='+this.form.reload.value+''">”­Œ¾íœ</a>]) if ($mdel);
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
	<input type="submit" value="@‘Şº@" class="button">
	</form>
	</td>
	</tr></table>
	</body></html>
	);
}

#````````````````````````````
# ¥ ‘Şºˆ—
#````````````````````````````
sub logout {
	# ƒtƒ@ƒCƒ‹“Ç‚İ‚İ
	my @clog = &file_read($clog);
	my @mem = &file_read($member);

	my $time = time;

	# Q‰ÁÒƒƒ“ƒo[‚©‚ç‚È‚­‚·
	my @newmem;
	foreach (@mem) {
		my ($type, $mtime, $mhost, $mname, $mcol) = split (/\t/, $_);
		if ($mhost ne $host && ($time-60*$timeout) < $mtime) {
			push (@newmem, $_);
		}
	}

	# ‘Şºˆ—
	my $days = &get_days;

	my $out = "1\t$FORM{'name'}\t$FORM{'icon'}\t$FORM{'color'}\t$FORM{'name'}‚³‚ñ‚ª‘Şº‚µ‚Ü‚µ‚½B\t$days\t$host";

	unshift (@clog, $out);

	# ƒtƒ@ƒCƒ‹‘‚«‚İ
	&lock if ($lock == 2);
	&file_write($member, @newmem);
	&file_write($clog, @clog);
	&unlock if ($lock == 2);

	&header();

	print qq(
	</head>
	<body class="fbottom">
	<div align="right">[<a href="$script?">ƒgƒbƒvƒy[ƒW‚Ö</a>]</div>
	);

	&view(@clog);
}

#````````````````````````````
# ¥ ƒƒO•\¦
#````````````````````````````
sub log {
	# ƒAƒNƒZƒXƒ`ƒFƒbƒN
	&access_check;

	# ƒtƒ@ƒCƒ‹“Ç‚İ‚İ
	my @clog = &file_read($clog);
	my @mem = &file_read($member);

	my $time = time;

	# Q‰ÁÒƒƒ“ƒo[‚ğŠm”F
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

	# Q‰ÁÒl”
	#my $memcnt = @newmem;

	# “ú•tƒZƒbƒg
	my $days = &get_days;

	# “üºˆ—
	if ($FORM{'in'} == 1) {
		unshift (@clog, "1\t$FORM{'name'}\t$FORM{'icon'}\t$FORM{'color'}\t$FORM{'name'}‚³‚ñ‚ª“üº‚µ‚Ü‚µ‚½B\t$days\t$host");

		if ($FORM{'greet'}) {
			unshift (@clog, "0\t$FORM{'name'}\t$FORM{'icon'}\t$FORM{'color'}\t$FORM{'greet'}\t$days\t$host\t\t");
		}
	}

	if ($FORM{'wname'} || $FORM{'mess'}) {
		if ($ENV{'REQUEST_METHOD'} ne 'POST') {
			&error("•s³‚ÈƒAƒNƒZƒX‚Å‚·B");
		}

		if ((split (/\t/, $clog[0]))[3] eq $FORM{'mess'}) {
			&error("“ñd‘—M‚Í‹Ö~‚µ‚Ä‚¢‚Ü‚·B");
		}

		# ‘•üE•¶šƒTƒCƒY
		my $mess = $FORM{'mess'};
		if ($FORM{'deco'} eq 'inv') {
			$mess = "<font color=\"$invcolor\">$FORM{'mess'}</font>";
		} elsif ($FORM{'deco'}) {
			$mess = "<$FORM{'deco'}>$FORM{'mess'}</$FORM{'deco'}>";
		}
		if ($FORM{'size'}) {
			$mess = "<font size=\"$FORM{'size'}\">$mess</font>";
		}

		# ”­Œ¾ˆ—
		if ($FORM{'wname'} && $FORM{'mess'}) {
			$mess =~ s/([^0-9A-Za-z_ ])/'%'.unpack('H2',$1)/ge;
			$mess =~ s/\s/+/g;
			$mess =~ tr/a-fA-F0-9/fedcbaFEDCBA9876543210/;

			my ($whost, $wname) = split (/\,/, $FORM{'wname'});

			# ‚³‚³‚â‚«
			unshift (@clog, "2\t$FORM{'name'}\t$FORM{'icon'}\t$FORM{'color'}\t$mess\t$days\t$host\t$whost\t$wname");
		} elsif ($FORM{'mess'}) {
			# ’Êí
			unshift (@clog, "0\t$FORM{'name'}\t$FORM{'icon'}\t$FORM{'color'}\t$mess\t$days\t$host\t\t");

			# ƒ_ƒCƒX
			if ($FORM{'mess'} eq 'dice!') {
				my $dice = int(rand(6)) + 1;
				unshift (@clog, "3\t$FORM{'name'}\t$FORM{'icon'}\t$FORM{'color'}\t$dice\t$days\t$host\t\t");
			}
		}
	}

	pop (@clog) if ((@clog) > $maxlog);

	# ƒtƒ@ƒCƒ‹‘‚«‚İ
	&lock if ($lock == 2);
	&file_write($member, @newmem);
	&file_write($clog, @clog);
	&unlock if ($lock == 2);

	&header();

	print qq(
	</head>
	<body class="fbottom">
	<small>Q‰ÁÒF$memcntl
	);
	print qq(ROMF$romctl) if ($romvw && !$rom);
	if ($FORM{'mode'} eq 'logrom') {
		print qq(
		<form action="$script">
		<input type="hidden" name="mode" value="logrom">
		ƒƒOF<select name="viewlog">
		<option value="max">Å‘å</option>);
		foreach (0..$#viewlog) {
			print qq(<option value="$viewlog[$_]");
			print qq( selected) if ($FORM{'viewlog'} eq $viewlog[$_] or (!$FORM{'viewlog'} && $_ == $#viewlog));
			print qq(>$viewlog[$_]</option>);
		}
		print qq(
		</select>
		<input type="submit" value="ƒŠƒ[ƒh" class="fbtm">
		</form>
		);
	}
	print qq(</small>);


	&view(@clog);
}

#````````````````````````````
# ¥ ƒƒO•\¦
#````````````````````````````
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
				print qq($img<font color="$fcolor[$color]">¡$name</font>‚³‚ñ‚©‚ç);
				print qq(‘Sˆõ‚Ö) if ($whst eq 'all');
				print qq(‚³‚³‚â‚«... &gt; $text <small>[$days]</small>\n);
			} elsif ($FORM{'in'} && $hst eq $host) {
				print qq($img<font color="$fcolor[$color]">¡$name</font> &gt; $wnam‚³‚ñ‚Ö‚³‚³‚â‚«... &gt; $text <small>[$days]</small>\n);
			} else {
				next;
			}
		} elsif ($type == 3) {
			print qq(<font color="#8A6E5C">DICE</font> > $text <small>[$days]</small>\n);
		} else {
			print qq($img<font color="$fcolor[$color]">¡$name</font> &gt; $text <small>[$days]</small>\n);
		}

		print qq(<hr size="1" width="100%">);

		last if ($FORM{'viewlog'} && $FORM{'viewlog'} ne 'max' && $i >= $FORM{'viewlog'});
		$i++;
	}

	&copy;

	print qq(</body></html>);
}

#````````````````````````````
# ¥ ”­Œ¾íœ
#````````````````````````````
sub mdel {
	# ƒtƒ@ƒCƒ‹“Ç‚İ‚İ
	my @clog = &file_read($clog);

	&header(1);
	&java;

	print qq(
	</head>
	<body class="ftop");
	print qq( onload="setTimeout('pageload()',1000)") if ($FORM{'write'});
	print qq(>
	”­Œ¾íœ
	<hr size="1" width="100%">
	<form action="$script" method="POST">
	<input type="hidden">
	$FORM{'name'}‚³‚ñ‚Ì”­Œ¾ƒƒO<br>
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

	# ƒtƒ@ƒCƒ‹‘‚«‚İ
	if ($FORM{'write'}) {
		&lock if ($lock == 2);
		&file_write($clog, @newclog);
		&unlock if ($lock == 2);
	}

	print qq(
	</select>
	<input type="submit" value=" íœ " class="button"><br>);
	print qq(<font color="#CC0000">[”­Œ¾‚ğíœ‚µ‚Ü‚µ‚½B]</font>) if ($FORM{'write'});
	print qq(
	<br>
	[<a href="$script?mode=chat&name=$FORM{'name'}&color=$FORM{'color'}&viewlog=$FORM{'viewlog'}&reload=$FORM{'reload'}&pass=$FORM{'pass'}&icon=$FORM{'icon'}">”­Œ¾‰æ–Ê‚Ö</a>]
	</form>
	</body></html>
	);
}

#````````````````````````````
# ¥ íÑ
#````````````````````````````
sub btotal {
	# ƒtƒ@ƒCƒ‹“Ç‚İ‚İ
	my @btllog = &file_read($btllog);

	&header;
	print qq(
	</head><body class="ftop">
	<table align="center" cellpadding="5" width="500">
	<tr class="bgc">
	<td align="center" colspan="3"><b>íÑ</b></td>
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

#````````````````````````````
# ¥ ƒ‰ƒ“ƒLƒ“ƒO
#````````````````````````````
sub ranking {
	# ƒtƒ@ƒCƒ‹“Ç‚İ‚İ
	my @btotal = &file_read($btotal);

	&header;

	print qq(
	</head><body class="ftop">
	<table align="center" cellpadding="5" width="500">
	<tr class="bgc">
	<td align="center" colspan="3"><b>ƒ‰ƒ“ƒLƒ“ƒO</b></td>
	</tr>
	<tr class="bgc">
	<td align="center"><small><b>–¼‘O</b></small></td>
	<td><small><b>Ÿ—˜</b></small></td>
	<td><small><b>”s–k</b></small></td>
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

#````````````````````````````
# ¥ JavaScript
#````````````````````````````
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

#````````````````````````````
# ¥ ƒtƒŒ[ƒ€
#````````````````````````````
sub frame {
	&deny; # ƒAƒNƒZƒX§ŒÀ

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
	<noframes>[ƒtƒŒ[ƒ€‘Î‰‚Ìƒuƒ‰ƒEƒU‚Å‚²——‚­‚¾‚³‚¢B]</noframes>
	</frameset>
	</html>
	);
}

#````````````````````````````
# ¥ —V‚Ñ•û
#````````````````````````````
sub how {
	&header;

	print <<"_HTML_";
</head><body class="ftop">
<table align="center" cellpadding="5" width="600">
	<tr class="bgc">
		<td align="center" colspan="3"><b>—V‚Ñ•û</b></td>
	</tr>
	<tr class="bgc">
		<td style="padding: 20px 30px;">
		¡ Qí
		<blockquote>
		<small>
		ƒ`ƒƒƒbƒg‚É“üº‚µ‚½‚Ü‚Üuƒoƒg‚év‚ğƒNƒŠƒbƒN‚µ‚Ü‚·B<br>
		w“ü‰æ–Ê‚ªo‚Ü‚·‚Ì‚ÅD‚«‚È‘•”õ‚ğ‘I‚Ñu‚±‚Ì‘•”õ‚Åƒoƒg‚é!v‚ğƒNƒŠƒbƒNB<br>
		‘Îí‘Šè‚ª‚¢‚È‚¯‚ê‚Î‘Ò‹@ó‘Ô‚É‚È‚è‚Ü‚·B‘Îí‘Šè‚ª‚·‚Å‚É‚¢‚ê‚Îƒoƒgƒ‹ŠJnI<br>
		ƒoƒg‚ç‚¸‚ÉI—¹‚·‚éê‡‚Í•K‚¸<font color="#CC0033">uƒŠƒ[ƒhv‚Ì—×‚Ìu•Â‚¶‚évƒ{ƒ^ƒ“‚ğ‰Ÿ‚µ‚Ä‚­‚¾‚³‚¢B</font>
		</small>
		</blockquote>
		¡ ‰æ–Êà–¾/ƒXƒe[ƒ^ƒX
		<blockquote>
		<small>
		hp = 0‚É‚È‚é‚Æ”s–kB<br>
		cp = –‚–@‚Ég—p‚µ‚Ü‚·B–ˆƒ^[ƒ“‰ñ•œB<br>
		<br>
		<img src="$imgdir/atk.gif" width="24" height="24" align="middle"> = ’ÊíUŒ‚<br>
		<img src="$imgdir/mgc.gif" width="24" height="24" align="middle"> = –‚–@icp‚ğÁ”ïj<br>
		<img src="$imgdir/prt.gif" width="24" height="24" align="middle"> = –hŒäiƒ_ƒ[ƒWŒyŒ¸/cpŠl“¾upj<br>
		<img src="$imgdir/ac_item.gif" width="24" height="24" align="middle"> = “¹‹ïiÁ–Õ•ij<br>
		<br>
		<img src="$imgdir/s_up.gif" width="24" height="24" align="middle"> = UŒ‚—Íã¸’†<br>
		<img src="$imgdir/m_up.gif" width="24" height="24" align="middle"> = –‚–@UŒ‚—Íã¸’†<br>
		<img src="$imgdir/d_up.gif" width="24" height="24" align="middle"> = –hŒä—Íã¸’†<br>
		<img src="$imgdir/poizn.gif" width="24" height="24" align="middle"> = “Åó‘Ôi–ˆƒ^[ƒ“5`10ƒ_ƒ[ƒWj
		</small>
		</blockquote>
		¡ ƒoƒgƒ‹
		<blockquote>
		<small>
		æ‚É‘Ò‹@‚µ‚Ä‚¢‚½‚Ù‚¤‚ªæ§‚µA”½‘Î‚Ì‘Šè‚É‚Íƒnƒ“ƒf‚Æ‚µ‚Äcp+30‚ª•t—^‚³‚ê‚Ü‚·B<br>
		‘Šè‚ğ“|‚¹‚ÎŸ—˜I
		</small>
		</blockquote>
		</td>
	</tr>
	<tr class="bgc">
		<td style="padding: 20px 30px;">
		<small>
		ƒQ[ƒ€‚Ì‰æ‘œ‚ÍˆÈ‰º‚ÌƒTƒCƒg‚©‚ç‚¢‚½‚¾‚¢‚Ä‚Ü‚·B–³’f‚Åg—p‚µ‚È‚¢‚Å‚­‚¾‚³‚¢B<br>
		<a href="http://neko.moo.jp/BS/" target="blank"><img src="img/banner.gif" width="88" height="31"></a>
		‰»‚¯”LŠÊ‘fŞ‰®
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