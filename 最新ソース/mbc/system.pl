#Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`
# Å• ÉfÉRÅ[Éh
#Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`
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

			# É^ÉOêßå‰
			if (!$notag) {
				my $tag = join ('|', @oktag);
				$in{$_} =~ s/&lt;(\/?($tag).*?)&gt;/<$1>/ig;
			}

			# ÉnÉCÉpÅ[ÉäÉìÉN
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

#Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`
# Å• ÉXÉeÅ[É^ÉX
#Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`
sub stc {
	my ($val, $st) = @_;
	if ($st =~ s/(.+?)(\d+)//) {
		if ($1 eq '+') { $val += $2; }
		elsif ($1 eq '-') { $val -= $2; }
	}
	return $val;
}

#Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`
# Å• ÉzÉXÉgñºÇälìæ
#Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`
sub get_host {
	my ($addr, $host) = ($ENV{'REMOTE_ADDR'}, $ENV{'REMOTE_HOST'});

	if ($host eq $addr || !$host) {
		$host = gethostbyaddr(pack("C4", split(/\./,$addr)), 2) || $addr;
	}

	#return $ENV{'HTTP_USER_AGENT'};
	return $host;
}

#==============================================
# Å• ÉAÉNÉZÉXÉ`ÉFÉbÉN
#==============================================
sub access_check {
	#if ($refurl && (!$ENV{'HTTP_REFERER'} or $ENV{'HTTP_REFERER'} !~ /^$refurl/) || $ENV{'REQUEST_METHOD'} ne 'POST') {
	#if ($refurl && (!$ENV{'HTTP_REFERER'} or $ENV{'HTTP_REFERER'} !~ /^(http:\/\/$ENV{'SERVER_NAME'}$ENV{'SCRIPT_NAME'})/)) {
	if ($refurl && (!$ENV{'HTTP_REFERER'} or $ENV{'HTTP_REFERER'} !~ /^$refurl/)) {
		&error("ïsê≥Ç»ÉAÉNÉZÉXÇ≈Ç∑ÅB");
	}
}

#Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`
# Å• ÉAÉNÉZÉXêßå¿
#Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`
sub deny {

	my $denyflg;
	for (my $i = 0; $i < ((@deny)+(@deny2)); $i++) {
		# IPÉzÉXÉgêßå¿
		if ($deny[$i]) {
			$deny[$i] =~ s/\./\\./g; $deny[$i] =~ s/\*/\.\*/g;
			if ($host =~ /$deny[$i]/i) { $denyflg = 1; last; }
		}

		# Cookieêßå¿
		if ($deny2[$i]) {
			if ($COOKIE{'name'} eq $deny2[$i]) { $denyflg = 1; last; }
		}
	}

	if ($denyflg) {
		&error($denyms);
	}
}

#==============================================
# Å• ÉNÉbÉLÅ[èëÇ´èoÇµ
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
# Å• ÉNÉbÉLÅ[ì«Ç›èoÇµ
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

#Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`
# Å• âÊëúÉAÉbÉvÉçÅ[Éh
#Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`
sub img_write {
	my ($name, $img) = @_;

	if (length ($img) > ($imgmxsz * 1024)) {
		&error("âÊëúÇÃÉtÉ@ÉCÉãÉTÉCÉYÇ™ëÂÇ´âﬂÇ¨Ç‹Ç∑ÅB");
	}

    open(OUT,">$name");
    binmode OUT;
    print OUT $img;
    close(OUT);
}

#Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`
# Å• ÉtÉ@ÉCÉãì«Ç›çûÇ›
#Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`
sub file_read {
	my ($file) = @_;

	open(FILE, "$file") || &error("ÉtÉ@ÉCÉã\"$file\"Ç™äJÇØÇ‹ÇπÇÒÇ≈ÇµÇΩÅB");
		my @line = <FILE>;
	close(FILE);

	chomp (@line);

	return @line;
}

#Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`
# Å• ÉtÉ@ÉCÉãèëÇ´çûÇ›
#Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`
sub file_write {
	my ($file, @data) = @_;

	open(FILE, ">$file") || &error("ÉtÉ@ÉCÉã\"$file\"Ç™äJÇØÇ‹ÇπÇÒÇ≈ÇµÇΩÅB");
		flock (FILE, 2) if ($lock == 1); # ÉçÉbÉN
		foreach (@data) {
			print FILE "$_\n";
		}
		seek (FILE, 0, 0) if ($lock == 1); # ÉçÉbÉNâèú
	close(FILE);
}

#Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`
# Å• ÉpÉXÉèÅ[ÉhÇà√çÜâª
#Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`
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

#Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`
# Å• îFèÿämîF
#Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`
sub pass_check {
	my ($pass, $pwd) = @_;

	my $salt = substr($pwd,0,2);

	if (!$pwd) {
		&error("ÉpÉXÉèÅ[ÉhÇÕìoò^Ç≥ÇÍÇƒÇ¢Ç‹ÇπÇÒÅB");
	} elsif ($pwd ne crypt($pass, $salt)) {
		&error("ÉpÉXÉèÅ[ÉhÇ™ä‘à·Ç¡ÇƒÇ¢Ç‹Ç∑ÅB");
	}
}

#Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`
# Å• ì˙ïtÇälìæ
#Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`
sub get_days {
	my ($sec, $min, $hour, $dy, $mon, $year, $wday, $yday, $isdst) = gmtime(time+60*60*9);
	my @week = ('ì˙','åé','âŒ','êÖ','ñÿ','ã‡','ìy');

	$days = sprintf("%04d/%01d/%01d\(%s\) %02d:%02d", $year+1900, $mon+1, $dy, $week[$wday], $hour, $min);

	return $days;
}

#Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`
# Å• äOïîåƒÇ—èoÇµ
#Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`
sub mem {
	# ÉtÉ@ÉCÉãì«Ç›çûÇ›
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

	# èoóÕ
	print "Content-type: text/javascript\n\n";
	print "document.write('<small>É`ÉÉÉbÉgéQâ¡é“ <b>$i</b>êl$tmp</small>');";
}

#Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`
# Å• ÉwÉbÉ_Å[
#Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`
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

#Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`
# Å• íòçÏå†
#Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`
sub copy {
	print <<"_HTML_";
<div align="right">
<font size="1">
<a href="http://goo.gl/kxtdN" target="_blank">Ç‹ÇÎÇ‚Ç©É`ÉÉÉbÉg Ver$version</a>
</font>
</div>
_HTML_
}

#Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`
# Å• ÉçÉbÉN
#Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`
sub lock {
	# 3ï™à»è„å√Ç¢ÉçÉbÉNÇÕâèú
	if (-e $lockdir) {
		my $mtime = (stat($lockdir))[9];
		if ($mtime < time - 60*3) { &unlock; }
	}

	my $retry = 5;

	while (!mkdir($lockdir, 0755)) {
		if (--$retry <= 0) {
			&error('ÉrÉWÅ[èÛë‘Ç≈Ç∑ÅBÇµÇŒÇÁÇ≠ë“Ç¡ÇƒÇ©ÇÁçƒìxëóêMÇµÇƒÇ≠ÇæÇ≥Ç¢ÅB');
		}
		sleep(1);
	}

	$lockflg = 1;
}

#Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`
# Å• ÉçÉbÉNâèú
#Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`
sub unlock {
	rmdir($lockdir);
	$lockflg = 0;
}

#Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`
# Å• ÉGÉâÅ[
#Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`Å`
sub error {
	&unlock if ($lockflg);

	&header('error');

	print qq(
	</head>
	<body class="ftop">
	<p><table><tr><td><font color="#CC3333">ÉGÉâÅ[</font><br>
	);

	print qq(<font color="#CC3333">&gt;&nbsp;</font>$_[0]<br>);

	print qq(</tr></td></table></p>);
	if ($bflag) {
		print qq(<a href="JavaScript:window.close();">ï¬Ç∂ÇÈ</a>);
	} else {
		print qq(<a href="JavaScript:history.back()">ñﬂÇÈ</a>);
	}

	print qq(</body></html>);

	exit;
}
1;