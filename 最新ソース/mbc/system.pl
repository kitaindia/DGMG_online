#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
# �� �f�R�[�h
#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
sub decode {
	&ReadParse;

	foreach (keys %in) {
		if ($_ ne 'icon') {

			$in{$_} =~ tr/+/ / if ($_ ne 'size');

			$in{$_} =~ s/%([a-fA-F0-9][a-fA-F0-9])/pack("C", hex($1))/eg;
			$in{$_} =~ s/&/&amp;/g;
			$in{$_} =~ s/\t/  /g;
			$in{$_} =~ s/\0//g;
			$in{$_} =~ s/</&lt;/g;
			$in{$_} =~ s/>/&gt;/g;

			# �^�O����
			if (!$notag) {
				my $tag = join ('|', @oktag);
				$in{$_} =~ s/&lt;(\/?($tag).*?)&gt;/<$1>/ig;
			}

			# �n�C�p�[�����N
			$in{$_} =~ s/(http:\/\/[a-zA-Z0-9\.\/\-+#_!?~&%=^\@:;,'*\(\)]+)/<a href="$1">$1<\/a>/g;

			&jcode::convert(\$in{$_},'sjis');
		}
	}

	return %in;
}

sub decode2 {
	$_[0] =~ tr/a-fA-F0-9/fedcbaFEDCBA9876543210/;
	$_[0] =~ s/%([a-fA-F0-9][a-fA-F0-9])/pack("C", hex($1))/eg;
	$_[0] =~ tr/+/ /;
	return $_[0];
}

#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
# �� �X�e�[�^�X
#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
sub stc {
	my ($val, $st) = @_;
	if ($st =~ s/(.+?)(\d+)//) {
		if ($1 eq '+') { $val += $2; }
		elsif ($1 eq '-') { $val -= $2; }
	}
	return $val;
}

#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
# �� �z�X�g�����l��
#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
sub get_host {
	my ($addr, $host) = ($ENV{'REMOTE_ADDR'}, $ENV{'REMOTE_HOST'});

	if ($host eq $addr || !$host) {
		$host = gethostbyaddr(pack("C4", split(/\./,$addr)), 2) || $addr;
	}

	#return $ENV{'HTTP_USER_AGENT'};
	return $host;
}

#==============================================
# �� �A�N�Z�X�`�F�b�N
#==============================================
sub access_check {
	#if ($refurl && (!$ENV{'HTTP_REFERER'} or $ENV{'HTTP_REFERER'} !~ /^$refurl/) || $ENV{'REQUEST_METHOD'} ne 'POST') {
	#if ($refurl && (!$ENV{'HTTP_REFERER'} or $ENV{'HTTP_REFERER'} !~ /^(http:\/\/$ENV{'SERVER_NAME'}$ENV{'SCRIPT_NAME'})/)) {
	if ($refurl && (!$ENV{'HTTP_REFERER'} or $ENV{'HTTP_REFERER'} !~ /^$refurl/)) {
		&error("�s���ȃA�N�Z�X�ł��B");
	}
}

#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
# �� �A�N�Z�X����
#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
sub deny {

	my $denyflg;
	for (my $i = 0; $i < ((@deny)+(@deny2)); $i++) {
		# IP�z�X�g����
		if ($deny[$i]) {
			$deny[$i] =~ s/\./\\./g; $deny[$i] =~ s/\*/\.\*/g;
			if ($host =~ /$deny[$i]/i) { $denyflg = 1; last; }
		}

		# Cookie����
		if ($deny2[$i]) {
			if ($COOKIE{'name'} eq $deny2[$i]) { $denyflg = 1; last; }
		}
	}

	if ($denyflg) {
		&error($denyms);
	}
}

#==============================================
# �� �N�b�L�[�����o��
#==============================================
sub set_cookie {
	my ($name, $color, $reload, $viewlog, $pass, $icon) = @_;
	my (@mons, @week, $date, $cook);
	my ($sec, $min, $hour, $mday, $mon, $year, $wday) = gmtime(time + 365*24*60*60);

	@mons = ('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
	@week = ('Sun','Mon','Tue','Wed','Thu','Fri','Sat');
	$date = sprintf("%s, %02d\-%s\-%04d %02d:%02d:%02d GMT",
						$week[$wday], $mday, $mons[$mon], $year+1900, $hour, $min, $sec);

	print "Set-Cookie: MBC=name\:$name\,color\:$color\,reload\:$reload\,viewlog\:$viewlog\,pass\:$pass\,icon\:$icon; expires=$date\n";
}

#==============================================
# �� �N�b�L�[�ǂݏo��
#==============================================
sub get_cookie {
	my ($name, $value, @pairs, %DUMMY, %COOKIE);

	@pairs = split(/\;/, $ENV{'HTTP_COOKIE'});

	foreach (@pairs) {
		($name, $value) = split(/\=/, $_);
		$name =~ s/ //g;
		$DUMMY{$name} = $value;
	}

	@pairs = split(/\,/, $DUMMY{'MBC'});

	foreach (@pairs) {
		($name, $value) = split(/\:/, $_);
		$COOKIE{$name} = $value;
	}

	return %COOKIE;
}

#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
# �� �摜�A�b�v���[�h
#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
sub img_write {
	my ($name, $img) = @_;

	if (length ($img) > ($imgmxsz * 1024)) {
		&error("�摜�̃t�@�C���T�C�Y���傫�߂��܂��B");
	}

    open(OUT,">$name");
    binmode OUT;
    print OUT $img;
    close(OUT);
}

#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
# �� �t�@�C���ǂݍ���
#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
sub file_read {
	my ($file) = @_;

	open(FILE, "$file") || &error("�t�@�C��\"$file\"���J���܂���ł����B");
		my @line = <FILE>;
	close(FILE);

	chomp (@line);

	return @line;
}

#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
# �� �t�@�C����������
#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
sub file_write {
	my ($file, @data) = @_;

	open(FILE, ">$file") || &error("�t�@�C��\"$file\"���J���܂���ł����B");
		flock (FILE, 2) if ($lock == 1); # ���b�N
		foreach (@data) {
			print FILE "$_\n";
		}
		seek (FILE, 0, 0) if ($lock == 1); # ���b�N����
	close(FILE);
}

#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
# �� �p�X���[�h���Í���
#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
sub encrypt {
	my ($pass) = @_;
	my ($xx, $salt, $pwd);

	$xx = "ABCDEFGHIJKLMNOPQRSTUVWXYZ"
	      . "abcdefghijklmnopqrstuvwxyz"
                 . "0123456789./";
	$salt = substr($xx, int(rand(64)), 1);
	$salt .= substr($xx, int(rand(64)), 1);
	$pwd = crypt($pass, $salt);

	return $pwd;
}

#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
# �� �F�؊m�F
#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
sub pass_check {
	my ($pass, $pwd) = @_;

	my $salt = substr($pwd,0,2);

	if (!$pwd) {
		&error("�p�X���[�h�͓o�^����Ă��܂���B");
	} elsif ($pwd ne crypt($pass, $salt)) {
		&error("�p�X���[�h���Ԉ���Ă��܂��B");
	}
}

#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
# �� ���t���l��
#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
sub get_days {
	my ($sec, $min, $hour, $dy, $mon, $year, $wday, $yday, $isdst) = gmtime(time+60*60*9);
	my @week = ('��','��','��','��','��','��','�y');

	$days = sprintf("%04d/%01d/%01d\(%s\) %02d:%02d", $year+1900, $mon+1, $dy, $week[$wday], $hour, $min);

	return $days;
}

#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
# �� �O���Ăяo��
#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
sub mem {
	# �t�@�C���ǂݍ���
	my @mem = &file_read($member);

	my $i = 0;
	my $tmp;
	if ($memnam) {
		foreach (@mem) {
			chomp;
			my ($type, $mtime, $mhost, $mname, $mcol) = split (/\t/, $_);

			$tmp .= " <font color=\"$fcolor[$mcol]\">$mname</font>";

			$i++ if ($type);
		}

		$tmp &&= "<br>$tmp";
	}

	# �o��
	print "Content-type: text/javascript\n\n";
	print "document.write('<small>�`���b�g�Q���� <b>$i</b>�l$tmp</small>');";
}

#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
# �� �w�b�_�[
#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
sub header {
	print "Content-type: text/html\n\n";

	print qq(
	<html><head>
	<meta http-equiv="Content-type" content="text/html; charset=shift_jis">
	);

	if ($_[1]) {
		print qq(<meta http-equiv="refresh" content="$_[1];URL=$battle?mode=reload&name=$FORM{'name'}&no=$_[0]&reload=&viewlog=">);
	} elsif (!$_[0] && $FORM{'reload'} ne '' && $FORM{'reload'} ne 'none') {
		print qq(<meta http-equiv="refresh" content="$FORM{'reload'};URL=$script?mode=log&name=$FORM{'name'}&reload=$FORM{'reload'}&viewlog=$FORM{'viewlog'}&in=2">);
	}

	print qq(
	<title>$cgititle</title>
	<link rel="stylesheet" type="text/css" href="$style">
	);
}

#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
# �� ���쌠
#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
sub copy {
	print <<"_HTML_";
<div align="right">
<font size="1">
<a href="http://goo.gl/kxtdN" target="_blank">�܂�₩�`���b�g Ver$version</a>
</font>
</div>
_HTML_
}

#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
# �� ���b�N
#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
sub lock {
	# 3���ȏ�Â����b�N�͉���
	if (-e $lockdir) {
		my $mtime = (stat($lockdir))[9];
		if ($mtime < time - 60*3) { &unlock; }
	}

	my $retry = 5;

	while (!mkdir($lockdir, 0755)) {
		if (--$retry <= 0) {
			&error('�r�W�[��Ԃł��B���΂炭�҂��Ă���ēx���M���Ă��������B');
		}
		sleep(1);
	}

	$lockflg = 1;
}

#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
# �� ���b�N����
#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
sub unlock {
	rmdir($lockdir);
	$lockflg = 0;
}

#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
# �� �G���[
#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
sub error {
	&unlock if ($lockflg);

	&header('error');

	print qq(
	</head>
	<body class="ftop">
	<p><table><tr><td><font color="#CC3333">�G���[</font><br>
	);

	print qq(<font color="#CC3333">&gt;&nbsp;</font>$_[0]<br>);

	print qq(</tr></td></table></p>);
	if ($bflag) {
		print qq(<a href="JavaScript:window.close();">����</a>);
	} else {
		print qq(<a href="JavaScript:history.back()">�߂�</a>);
	}

	print qq(</body></html>);

	exit;
}
1;