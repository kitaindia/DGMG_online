#!/usr/bin/perl
# ���̃p�X�͐ݒu����T�[�o�[�̊��ɍ��킹�ĕύX���Ă��������B
#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
# �܂�₩�`���b�g
$version = '1.20b'; # (2010/06/16 Update)
# Copyright(c) 2007-2010 tisa All rights reserved.
# 
# URL  : http://goo.gl/kxtdN
# MAIL : ari_tisa9@ahsic.com
# 
# �Q���ҕ\�����@
# ��F<script type="text/javascript" src="./mbc.cgi?mode=mem"></script>
#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`

# �ݒ�t�@�C��
$config = './config.ini';

####�� �ȉ��X�N���v�g ��####
#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
$ENV{'TZ'} = 'JST-9';

if (!(-e $config)) { die "Error: $config�I�[�v���G���["; } else { require $config; }
if (!(-e $system)) { die "Error: $system�I�[�v���G���["; } else { require $system; }
if (!(-e $cgilib)) { die "Error: $cgilib�I�[�v���G���["; } else { require $cgilib; }
if (!(-e $jcode)) { die "Error: $jcode�I�[�v���G���["; } else { require $jcode; }

%FORM = &decode; # �f�R�[�h
$host = &get_host; # �z�X�g�擾
%COOKIE = &get_cookie; # �N�b�L�[�Q�b�g

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
#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
# �� �g�b�v�y�[�W
#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
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
		[<a href="$script?mode=btotal" target="fbottom">���</a>]
		[<a href="$script?mode=ranking" target="fbottom">�����L���O</a>]
		);
	}

	print qq([<a href="$script?mode=logrom" target="_block">���O�ϗ�</a>]) if ($wclog);
	print qq([<a href="$homeurl" target="_top">HOME</a>]) if ($homeurl);
	print qq(
	</small></td>
	</tr></table>
	<hr size="1" width="100%">
	<form action="$script" method="POST" enctype="multipart/form-data">
	<input type="hidden" name="mode" value="chat">
	<input type="hidden" name="in" value="1">
	<table cellpadding="4" cellspacing="0" border="0"><tr>
	<td nowrap>���O <input type="text" size="20" name="name" value="$COOKIE{'name'}"></td>
	<td nowrap><span class="bgc">
	);

	# ���������F
	my $i = 1;
	foreach (0..$#fcolor) {
		print qq(<input type="radio" name="color" value="$_");
		print qq( checked) if (($COOKIE{'color'} eq '' && !$_) or ($COOKIE{'color'} ne '' && $_ == $COOKIE{'color'}));
		print qq(><font color="$fcolor[$_]">���F$i</font>);
		$i++;
	}

	print qq(
	</span></td>
	<td></td>
	<td rowspan="3" class="formbg" valign="top">
	<font>
	<small>�p�X���[�h����͂��Ă����ƁA�Ȃ肷�܂��h�~�ɂȂ�܂��B
	);
	
	if ($useicon) {
		print qq(<br>�܂��}�C�A�C�R���̎g�p���o����悤�ɂȂ�܂��B);
	}

	print qq(
	</small></font><br>
	�p�X���[�h <input type="password" size="15" name="pass" value="$COOKIE{'pass'}">
	);

	if ($useicon) {
		print qq(
		<input type="checkbox" name="del" value="1">�}�C�A�C�R���̍폜<br>
		�}�C�A�C�R�� <input type="file" name="icon" size="50">
		);
		if ($COOKIE{'icon'} && -e "$icondir/$COOKIE{'icon'}") {
			my $time = time;
			print qq(
			<td rowspan="3" class="formbg" valign="top">
			<font><small>�����݂̃A�C�R��</small></font><br>);
			print qq(<img src="$icondir/$COOKIE{'icon'}?$time" alt="icon");
			print qq( width="$imgszwd") if ($imgszwd);
			print qq( height="$imgszhi") if ($imgszhi);
			print qq(></td>);
		}
	}

	print qq(
	</td>
	</tr><tr>
	<td nowrap>���A <input type="text" size="20" name="greet" value=""></td>
	<td><input type="button" value="�@�����@" class="button" onClick="this.disabled='true'; this.form.submit();"></td>
	</tr><tr>
	<td valign="top">
	�����[�h����
	<select name="reload">
	<option value="none");
	print qq( selected) if (!$COOKIE{'reload'} || $COOKIE{'reload'} eq 'none');
	print qq(>�Ȃ�</option>);
	foreach (@reload) {
		print qq(<option value="$_");
		print qq( selected) if ($_ eq $COOKIE{'reload'});
		print qq(>$_</option>);
	}
	print qq(
	</select>
	</td><td valign="top">
	���O�\\����
	<select name="viewlog">
	<option value="max");
	print qq( selected) if (!$COOKIE{'viewlog'} || $COOKIE{'viewlog'} eq 'max');
	print qq(>�ő�</option>);
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

#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
# �� �`���b�g���
#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
sub chat {
	# �A�N�Z�X�`�F�b�N
	&access_check;
	if (!$FORM{'name'}) {
		&error("���O����͂��Ă��������B");
	}

	# �����o�[�t�@�C���ǂݍ���
	my @mem = &file_read($member);

	foreach (@mem) {
		my ($tp, $tm, $ip, $nm, $cl) = split (/\t/, $_);
		if ($ip ne $host && $nm eq $FORM{'name'}) {
			&error("�����̐l�����܂��B");
		}
	}

	# ���[�U�[�t�@�C���ǂݍ���
	my @user = &file_read($user);

	# �p�X���[�h�F�؁^�A�C�R���A�b�v���[�h
	my ($img, $name, $ext, $flg);
	foreach (@user) {
		# ���O,�摜��,�g���q,�p�X���[�h,IP
		my @tmp = split (/\t/, $_);
		if ($tmp[0] eq $FORM{'name'}) {
			&pass_check($FORM{'pass'}, $tmp[3]); # �p�X���[�h�`�F�b�N
			if ($incfn{'icon'} =~ /.+\.(gif|jpg|png)/) {
				$tmp[2] = $1; # �g���q�擾
				&img_write("$icondir/$tmp[1].$1", $FORM{'icon'}); # �摜�A�b�v���[�h
				$_ = join ("\t", @tmp);
			}
			($name, $ext) = @tmp[1, 2];
			$flg = 1;
			last;
		}
	}
	if ($FORM{'pass'} && !$flg) {
		my $pwd = &encrypt($FORM{'pass'}); # �Í���
		$name = (@user)+1; # �摜��
		if ($incfn{'icon'} =~ /.+\.(gif|jpg|png)/) {
			$ext = $1; # �g���q�擾
			&img_write("$icondir/$name.$ext", $FORM{'icon'}); # �摜�A�b�v���[�h
		}
		push (@user, "$FORM{'name'}\t$name\t$ext\t$pwd\t$host");
	}
	if ($FORM{'del'}) {
		unlink (<$icondir/$name.*>); # /
	} elsif ($name) {
		$img = "$name.$ext";
	}
	if ($FORM{'icon'} || !$flg) {
		# �t�@�C����������
		&lock if ($lock == 2);
		&file_write($user, @user);
		&unlock if ($lock == 2);
	}

	# �N�b�L�[�Z�b�g
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
	<input type="submit" value="����/�����[�h" class="button">
	<input type="button" value="�����₫�X�V" class="button" onclick="location.href='$script?mode=chat&size='+this.form.size.value+'&deco='+this.form.deco.value+'&wname='+this.form.wname.value+'&keep='+this.form.keep.checked+'&keep2='+this.form.keep2.checked+'&reload='+this.form.reload.value+'&viewlog='+this.form.viewlog.value+'&name=$FORM{'name'}&color=$FORM{'color'}&pass=$FORM{'pass'}'">
	�����₫
	<select name="wname">
	<option value="">�Ȃ�</option>
	<option value="all,�S��">�S��</option>
	);

	# �����₫
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
	print qq(>�Œ�</label>
	</td>
	</tr><tr>
	<td><input type="text" size="100" name="mess" value=""></td>
	<td align="right" valign="bottom" rowspan="4">
	);

	if ($minigame) {
		print qq(
		<small>
		[<a href="#" onClick="window.open('$battle?name=$FORM{'name'}', '_battle','directories=no,location=no,menubar=no,scrollbars=yes,status=no,resizable=no,width=570,height=570'); return false;">�o�g��</a>]
		[<a href="$script?mode=how" target="fbottom">�V�ѕ�</a>]
		[<a href="$script?mode=btotal" target="fbottom">���</a>]
		[<a href="$script?mode=ranking" target="fbottom">�����L���O</a>]
		</small>
		);
	}

	print qq(
	</td>
	</tr><tr>
	<td>
	����
	<select name="deco">
	<option value="">�Ȃ�</option>
	);

	foreach (0..$#decos) {
		print qq(<option value="$decov[$_]");
		print qq( selected) if ($FORM{'keep2'} && $decov[$_] eq $FORM{'deco'});
		print qq(>$decos[$_]</option>);
	}

	print qq(
	</select>
	�����T�C�Y
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
	print qq(>�Œ�</label>
	</td>
	</tr><tr>
	<td colspan="3"><hr size="1" width="100%"></td>
	</tr><tr>
	<td>
	�����[�h����
	<select name="reload" onchange="parent.fbottom.location.href='$script?mode=log&in=2&name=$FORM{'name'}&viewlog='+this.form.viewlog.value+'&reload='+this.form.reload.value+''">
	<option value="none");
	print qq( selected) if ($FORM{'reload'} eq 'none');
	print qq(>�Ȃ�</option>);
	foreach (@reload) {
		print qq(<option value="$_");
		print qq( selected) if ($_ eq $FORM{'reload'});
		print qq(>$_</option>);
	}
	print qq(
	</select>
	���O�\\����
	<select name="viewlog" onchange="parent.fbottom.location.href='$script?mode=log&in=2&name=$FORM{'name'}&viewlog='+this.form.viewlog.value+'&reload='+this.form.reload.value+''">
	<option value="max");
	print qq( selected) if ($FORM{'viewlog'} eq 'max');
	print qq(>�ő�</option>);
	foreach (@reload) {
		print qq(<option value="$_");
		print qq( selected) if ($_ eq $FORM{'viewlog'});
		print qq(>$_</option>);
	}
	print qq(
	</select>
	);
	print qq([<a href="javascript:location.href='$script?mode=mdel&name=$FORM{'name'}&color=$FORM{'color'}&pass=$FORM{'pass'}&icon=$img&viewlog='+this.form.viewlog.value+'&reload='+this.form.reload.value+''">�����폜</a>]) if ($mdel);
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
	<input type="submit" value="�@�ގ��@" class="button">
	</form>
	</td>
	</tr></table>
	</body></html>
	);
}

#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
# �� �ގ�����
#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
sub logout {
	# �t�@�C���ǂݍ���
	my @clog = &file_read($clog);
	my @mem = &file_read($member);

	my $time = time;

	# �Q���҃����o�[����Ȃ���
	my @newmem;
	foreach (@mem) {
		my ($type, $mtime, $mhost, $mname, $mcol) = split (/\t/, $_);
		if ($mhost ne $host && ($time-60*$timeout) < $mtime) {
			push (@newmem, $_);
		}
	}

	# �ގ�����
	my $days = &get_days;

	my $out = "1\t$FORM{'name'}\t$FORM{'icon'}\t$FORM{'color'}\t$FORM{'name'}���񂪑ގ����܂����B\t$days\t$host";

	unshift (@clog, $out);

	# �t�@�C����������
	&lock if ($lock == 2);
	&file_write($member, @newmem);
	&file_write($clog, @clog);
	&unlock if ($lock == 2);

	&header();

	print qq(
	</head>
	<body class="fbottom">
	<div align="right">[<a href="$script?">�g�b�v�y�[�W��</a>]</div>
	);

	&view(@clog);
}

#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
# �� ���O�\��
#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
sub log {
	# �A�N�Z�X�`�F�b�N
	&access_check;

	# �t�@�C���ǂݍ���
	my @clog = &file_read($clog);
	my @mem = &file_read($member);

	my $time = time;

	# �Q���҃����o�[���m�F
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

	# �Q���Ґl��
	#my $memcnt = @newmem;

	# ���t�Z�b�g
	my $days = &get_days;

	# ��������
	if ($FORM{'in'} == 1) {
		unshift (@clog, "1\t$FORM{'name'}\t$FORM{'icon'}\t$FORM{'color'}\t$FORM{'name'}���񂪓������܂����B\t$days\t$host");

		if ($FORM{'greet'}) {
			unshift (@clog, "0\t$FORM{'name'}\t$FORM{'icon'}\t$FORM{'color'}\t$FORM{'greet'}\t$days\t$host\t\t");
		}
	}

	if ($FORM{'wname'} || $FORM{'mess'}) {
		if ($ENV{'REQUEST_METHOD'} ne 'POST') {
			&error("�s���ȃA�N�Z�X�ł��B");
		}

		if ((split (/\t/, $clog[0]))[3] eq $FORM{'mess'}) {
			&error("��d���M�͋֎~���Ă��܂��B");
		}

		# �����E�����T�C�Y
		my $mess = $FORM{'mess'};
		if ($FORM{'deco'} eq 'inv') {
			$mess = "<font color=\"$invcolor\">$FORM{'mess'}</font>";
		} elsif ($FORM{'deco'}) {
			$mess = "<$FORM{'deco'}>$FORM{'mess'}</$FORM{'deco'}>";
		}
		if ($FORM{'size'}) {
			$mess = "<font size=\"$FORM{'size'}\">$mess</font>";
		}

		# ��������
		if ($FORM{'wname'} && $FORM{'mess'}) {
			$mess =~ s/([^0-9A-Za-z_ ])/'%'.unpack('H2',$1)/ge;
			$mess =~ s/\s/+/g;
			$mess =~ tr/a-fA-F0-9/fedcbaFEDCBA9876543210/;

			my ($whost, $wname) = split (/\,/, $FORM{'wname'});

			# �����₫
			unshift (@clog, "2\t$FORM{'name'}\t$FORM{'icon'}\t$FORM{'color'}\t$mess\t$days\t$host\t$whost\t$wname");
		} elsif ($FORM{'mess'}) {
			# �ʏ�
			unshift (@clog, "0\t$FORM{'name'}\t$FORM{'icon'}\t$FORM{'color'}\t$mess\t$days\t$host\t\t");

			# �_�C�X
			if ($FORM{'mess'} eq 'dice!') {
				my $dice = int(rand(6)) + 1;
				unshift (@clog, "3\t$FORM{'name'}\t$FORM{'icon'}\t$FORM{'color'}\t$dice\t$days\t$host\t\t");
			}
		}
	}

	pop (@clog) if ((@clog) > $maxlog);

	# �t�@�C����������
	&lock if ($lock == 2);
	&file_write($member, @newmem);
	&file_write($clog, @clog);
	&unlock if ($lock == 2);

	&header();

	print qq(
	</head>
	<body class="fbottom">
	<small>�Q���ҁF$memcnt�l
	);
	print qq(ROM�F$romct�l) if ($romvw && !$rom);
	if ($FORM{'mode'} eq 'logrom') {
		print qq(
		<form action="$script">
		<input type="hidden" name="mode" value="logrom">
		���O�F<select name="viewlog">
		<option value="max">�ő�</option>);
		foreach (0..$#viewlog) {
			print qq(<option value="$viewlog[$_]");
			print qq( selected) if ($FORM{'viewlog'} eq $viewlog[$_] or (!$FORM{'viewlog'} && $_ == $#viewlog));
			print qq(>$viewlog[$_]</option>);
		}
		print qq(
		</select>
		<input type="submit" value="�����[�h" class="fbtm">
		</form>
		);
	}
	print qq(</small>);


	&view(@clog);
}

#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
# �� ���O�\��
#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
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
				print qq($img<font color="$fcolor[$color]">��$name</font>���񂩂�);
				print qq(�S����) if ($whst eq 'all');
				print qq(�����₫... &gt; $text <small>[$days]</small>\n);
			} elsif ($FORM{'in'} && $hst eq $host) {
				print qq($img<font color="$fcolor[$color]">��$name</font> &gt; $wnam����ւ����₫... &gt; $text <small>[$days]</small>\n);
			} else {
				next;
			}
		} elsif ($type == 3) {
			print qq(<font color="#8A6E5C">DICE</font> > $text <small>[$days]</small>\n);
		} else {
			print qq($img<font color="$fcolor[$color]">��$name</font> &gt; $text <small>[$days]</small>\n);
		}

		print qq(<hr size="1" width="100%">);

		last if ($FORM{'viewlog'} && $FORM{'viewlog'} ne 'max' && $i >= $FORM{'viewlog'});
		$i++;
	}

	&copy;

	print qq(</body></html>);
}

#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
# �� �����폜
#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
sub mdel {
	# �t�@�C���ǂݍ���
	my @clog = &file_read($clog);

	&header(1);
	&java;

	print qq(
	</head>
	<body class="ftop");
	print qq( onload="setTimeout('pageload()',1000)") if ($FORM{'write'});
	print qq(>
	�����폜
	<hr size="1" width="100%">
	<form action="$script" method="POST">
	<input type="hidden">
	$FORM{'name'}����̔������O<br>
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

	# �t�@�C����������
	if ($FORM{'write'}) {
		&lock if ($lock == 2);
		&file_write($clog, @newclog);
		&unlock if ($lock == 2);
	}

	print qq(
	</select>
	<input type="submit" value=" �폜 " class="button"><br>);
	print qq(<font color="#CC0000">[�������폜���܂����B]</font>) if ($FORM{'write'});
	print qq(
	<br>
	[<a href="$script?mode=chat&name=$FORM{'name'}&color=$FORM{'color'}&viewlog=$FORM{'viewlog'}&reload=$FORM{'reload'}&pass=$FORM{'pass'}&icon=$FORM{'icon'}">������ʂ�</a>]
	</form>
	</body></html>
	);
}

#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
# �� ���
#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
sub btotal {
	# �t�@�C���ǂݍ���
	my @btllog = &file_read($btllog);

	&header;
	print qq(
	</head><body class="ftop">
	<table align="center" cellpadding="5" width="500">
	<tr class="bgc">
	<td align="center" colspan="3"><b>���</b></td>
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

#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
# �� �����L���O
#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
sub ranking {
	# �t�@�C���ǂݍ���
	my @btotal = &file_read($btotal);

	&header;

	print qq(
	</head><body class="ftop">
	<table align="center" cellpadding="5" width="500">
	<tr class="bgc">
	<td align="center" colspan="3"><b>�����L���O</b></td>
	</tr>
	<tr class="bgc">
	<td align="center"><small><b>���O</b></small></td>
	<td><small><b>����</b></small></td>
	<td><small><b>�s�k</b></small></td>
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

#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
# �� JavaScript
#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
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

#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
# �� �t���[��
#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
sub frame {
	&deny; # �A�N�Z�X����

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
	<noframes>[�t���[���Ή��̃u���E�U�ł������������B]</noframes>
	</frameset>
	</html>
	);
}

#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
# �� �V�ѕ�
#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
sub how {
	&header;

	print <<"_HTML_";
</head><body class="ftop">
<table align="center" cellpadding="5" width="600">
	<tr class="bgc">
		<td align="center" colspan="3"><b>�V�ѕ�</b></td>
	</tr>
	<tr class="bgc">
		<td style="padding: 20px 30px;">
		�� �Q��
		<blockquote>
		<small>
		�`���b�g�ɓ��������܂܁u�o�g��v���N���b�N���܂��B<br>
		�w����ʂ��o�܂��̂ōD���ȑ�����I�сu���̑����Ńo�g��!�v���N���b�N�B<br>
		�ΐ푊�肪���Ȃ���Αҋ@��ԂɂȂ�܂��B�ΐ푊�肪���łɂ���΃o�g���J�n�I<br>
		�o�g�炸�ɏI������ꍇ�͕K��<font color="#CC0033">�u�����[�h�v�ׂ̗́u����v�{�^���������Ă��������B</font>
		</small>
		</blockquote>
		�� ��ʐ���/�X�e�[�^�X
		<blockquote>
		<small>
		hp = 0�ɂȂ�Ɣs�k�B<br>
		cp = ���@�Ɏg�p���܂��B���^�[���񕜁B<br>
		<br>
		<img src="$imgdir/atk.gif" width="24" height="24" align="middle"> = �ʏ�U��<br>
		<img src="$imgdir/mgc.gif" width="24" height="24" align="middle"> = ���@�icp������j<br>
		<img src="$imgdir/prt.gif" width="24" height="24" align="middle"> = �h��i�_���[�W�y��/cp�l��up�j<br>
		<img src="$imgdir/ac_item.gif" width="24" height="24" align="middle"> = ����i���Օi�j<br>
		<br>
		<img src="$imgdir/s_up.gif" width="24" height="24" align="middle"> = �U���͏㏸��<br>
		<img src="$imgdir/m_up.gif" width="24" height="24" align="middle"> = ���@�U���͏㏸��<br>
		<img src="$imgdir/d_up.gif" width="24" height="24" align="middle"> = �h��͏㏸��<br>
		<img src="$imgdir/poizn.gif" width="24" height="24" align="middle"> = �ŏ�ԁi���^�[��5�`10�_���[�W�j
		</small>
		</blockquote>
		�� �o�g��
		<blockquote>
		<small>
		��ɑҋ@���Ă����ق����搧���A���΂̑���ɂ̓n���f�Ƃ���cp+30���t�^����܂��B<br>
		�����|���Ώ����I
		</small>
		</blockquote>
		</td>
	</tr>
	<tr class="bgc">
		<td style="padding: 20px 30px;">
		<small>
		�Q�[���̉摜�͈ȉ��̃T�C�g���炢�������Ă܂��B���f�Ŏg�p���Ȃ��ł��������B<br>
		<a href="http://neko.moo.jp/BS/" target="blank"><img src="img/banner.gif" width="88" height="31"></a>
		�����L�ʑf�މ�
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