#!/usr/bin/perl
# ���̃p�X�͐ݒu����T�[�o�[�̊��ɍ��킹�ĕύX���Ă��������B

# �ݒ�t�@�C��
$config = './config.ini';

#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
####�� �ȉ��X�N���v�g ��####
#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
$ENV{'TZ'} = 'JST-9';

if (!(-e $config)) { die "Error: $config�I�[�v���G���["; } else { require $config; }
if (!(-e $shopp)) { die "Error: $shopp�I�[�v���G���["; } else { require $shopp; }
if (!(-e $system)) { die "Error: $system�I�[�v���G���["; } else { require $system; }
if (!(-e $cgilib)) { die "Error: $cgilib�I�[�v���G���["; } else { require $cgilib; }
if (!(-e $jcode)) { die "Error: $jcode�I�[�v���G���["; } else { require $jcode; }

$bflag = 1; # �o�g���t���O
%FORM = &decode; # �f�R�[�h
$host = &get_host; # �z�X�g�擾
@btl = &file_read($bdata);

if ($FORM{'mode'} eq 'shopp') {
	&shopp;
} elsif ($FORM{'mode'} eq 'price') {
	&price;
} elsif ($FORM{'mode'} eq 'battle') {
	&in(@btl);
} elsif ($FORM{'mode'} eq 'action') {
	&action(@btl);
} elsif ($FORM{'mode'} eq 'reload') {
	&battle(@btl);
} elsif ($FORM{'mode'} eq 'close') {
	&close;
} else {
	&sframe;
}

exit;
#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
# �� �o�g��
#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
sub battle {
	# �t�@�C���ǂݍ���
	my ($plyr1, $plyr2) = @_;

	my @list1 = split (/\t/, $plyr1);
	my @list2 = split (/\t/, $plyr2);

	my ($ply1, $ply2);
	if ($list1[2] ne $host) {
		if ($list2[2] ne $host) {
			&error("�^�C���A�E�g���܂����B");
		} elsif ($list1[6] == 0) {
			if ($list2[0] && time > ($timeout + $list2[0])) {
				$list1[6] = "2";
				$list2[6] = "1";

				$plyr1 = join ("\t", @list1);
				$plyr2 = join ("\t", @list2);

				# �t�@�C����������
				&lock if ($lock == 2);
				&file_write($bdata, $plyr1, $plyr2);
				&unlock if ($lock == 2);

				# ���
				&record($list2[1], $list1[1], $list2[8]);
			}
		}
		($ply1, $ply2) = ($plyr2, $plyr1);
	} else {
		if (!$plyr2) {
			$list1[0] = time;

			$plyr1 = join ("\t", @list1);

			# �t�@�C����������
			&lock if ($lock == 2);
			&file_write($bdata, $plyr1, $plyr2);
			&unlock if ($lock == 2);

		}
		($ply1, $ply2) = ($plyr1, $plyr2);
	}

	my ($tm, $nm, $ht, $sts, $dg, $prt, $flg, $mess1, $forl) = split (/\t/, $ply1);
	my ($hp, $cp, $hpc, $cpc, $st, $mg, $df, $md, $mc, $it) = split (/\//, $sts);
	my ($name2, $mess2) = (split (/\t/, $ply2))[1, 7];

	&header(0, $timeout-10);

	print qq(
	<script language="JavaScript">
	<!--
	function magic() {
		document.all['point'].innerHTML = "<img src=\\"$imgdir/back.gif\\" onclick=\\"defo1()\\"> );

	foreach (split (/\|/, $mc)) {
		my ($no, $st, $cp, $prc, $nm, $ms) = split (/\//, $mgc[$_]);
		print qq(<img src=\\"$imgdir/a_mgc$no\.gif\\" onclick=\\"actview('mgc','$nm','$no','$_')\\" onMouseOver=\\"document.all['come'].innerHTML=\\'$nm CP<b>$cp</b>����\\'\\" onMouseOut=\\"document.all['come'].innerHTML=\\'<br>\\'\\"> );
	}

	print qq(";
	}
	function item() {
		document.all['point'].innerHTML = "<img src=\\"$imgdir/back.gif\\" onclick=\\"defo1()\\"> );

	foreach (split (/\|/, $it)) {
		my ($no, $st, $prc, $nm, $ms) = split (/\//, $itm[$_]);
		print qq(<img src=\\"$imgdir/a_itm$no\.gif\\" onclick=\\"actview('itm','$nm','$no','$_')\\" onMouseOver=\\"document.all['come'].innerHTML=\\'$nm\\'\\" onMouseOut=\\"document.all['come'].innerHTML=\\'<br>\\'\\"> );
	}

	print qq(";
	}
	function defo1() {
		defo = "<img src=\\"$imgdir/atk.gif\\" onclick=\\"actview('atk','�ʏ�U��')\\" onMouseOver=\\"document.all['come'].innerText=\\'�ʏ�U��\\'\\" onMouseOut=\\"document.all['come'].innerHTML=\\'<br>\\'\\"> <img src=\\"$imgdir/mgc.gif\\" onclick=\\"magic()\\" onMouseOver=\\"document.all['come'].innerText=\\'���@\\'\\" onMouseOut=\\"document.all['come'].innerHTML=\\'<br>\\'\\"> <img src=\\"$imgdir/prt.gif\\" onclick=\\"actview('prt','�h��')\\" onMouseOver=\\"document.all['come'].innerText=\\'�h��\\'\\" onMouseOut=\\"document.all['come'].innerHTML=\\'<br>\\'\\"> <img src=\\"$imgdir/ac_item.gif\\" onclick=\\"item()\\" onMouseOver=\\"document.all['come'].innerText=\\'����\\'\\" onMouseOut=\\"document.all['come'].innerHTML=\\'<br>\\'\\">";
		document.all['point'].innerHTML = defo;
	}
	function actview(a,b,c,d) {
		if (a == 'mgc') {
			document.actimg.src = "$imgdir/a_mgc"+c+".gif";
			document.form.mgc.value = d;
		} else if (a == 'itm') {
			document.actimg.src = "$imgdir/a_itm"+c+".gif";
			document.form.itm.value = d;
		} else {
			document.actimg.src = "$imgdir/"+a+".gif";
		}
		document.all['actms'].innerHTML = b;
		document.form.action.value = a;
	}
	//-->
	</script>
	);

	print qq(
	<body class="fbottom" style="background-color: $bcolor1; margin: 0px;" oncontextmenu="return false;">
	<table align="center" bgcolor="$bcolor2" cellspacing="20" height="100%">
	<tr><td align="center" colspan="3">
	);

	if ($ply2) {
		&cwin($ply2);
	} else {
		print qq(
		<table bgcolor="#666666" cellspacing="1" cellpadding="15" width="240">
		<tr bgcolor="$bcolor3">
		<td align="center" width="190">
		<br><small>�ΐ푊���҂��Ă��܂�...</small><br><br>
		</td></tr></table>
		);
	}

	if ($ply2) {
		if ($mess1 eq 'fst') {
			$mess1 = "";
			$mess2 = "$name2�������𒧂�ł����I";
		} elsif ($mess1 eq 'snd') {
			$mess2 = "";
			$mess1 = "$name2�ɏ����𒧂񂾁I";
		}
	} else {
		$mess1 = "";
		$mess2 = "";
	}

	print qq(
	</td></tr>
	<tr><td align="center" colspan="3" style="color: $fcolor1;">$mess2<br></td></tr>
	<tr><td align="center" colspan="3" align="center" style="color: $fcolor1;">vs</td></tr>
	<tr><td align="center" colspan="3" style="color: $fcolor1;">$mess1<br></td></tr>
	<tr><td align="center" colspan="3">
	);

	my $flg2 = &cwin($ply1);

	my ($sdisa, $rdisa, $mess, $yturn);
	if (!$ply2) {
		$mess = "�ΐ푊���҂��Ă��܂�...";
		$sdisa = ' disabled';
	} elsif ($list1[2] eq $host) {
		$mess = "���Ȃ��̃^�[���ł��B";
	} else {
		$mess = "����̃^�[���ł��B";
		$sdisa = ' disabled';
	}

	if ($flg2 != 0) {
		$mess = qq(�Q�[���Z�b�g<br><input type="button" value=" CLOSE " onclick="window.close()">);
		$sdisa ||= ' disabled';
		$rdisa ||= ' disabled';
	}

	print qq(
	</td></tr>
	<tr><td align="center" colspan="3" style="color: $fcolor1;">
	$mess
	</td></tr>
	<tr>
	<td class="icon" valign="bottom">
	<table bgcolor="$bcolor3" width="160">
	<tr><td><small>�A�N�V�����R�}���h</small></td></tr>
	<tr>
	<td id="point">
	<img src="$imgdir/atk.gif" width="24" height="24" onclick="actview('atk','�ʏ�U��')" onMouseOver="document.all['come'].innerText='�ʏ�U��'" onMouseOut="document.all['come'].innerHTML='<br>'">
	<img src="$imgdir/mgc.gif" width="24" height="24" onclick="magic()" onMouseOver="document.all['come'].innerText='���@\'" onMouseOut="document.all['come'].innerHTML='<br>'">
	<img src="$imgdir/prt.gif" width="24" height="24" onclick="actview('prt','�h��')" onMouseOver="document.all['come'].innerText='�h��'" onMouseOut="document.all['come'].innerHTML='<br>'">
	<img src="$imgdir/ac_item.gif" width="24" height="24" onclick="item()" onMouseOver="document.all['come'].innerText='����'" onMouseOut="document.all['come'].innerHTML='<br>'">
	</td></tr>
	</table>
	</td>
	<td>
	</td>
	<td class="icon" valign="bottom">
	<table cellpadding="3" cellspacing="1">
	<tr>
	<td id="actms" colspan="3" style="color: $fcolor1;"><br></td>
	</tr>
	<tr bgcolor="$bcolor3">
	<td id="act"><img src="$imgdir/touka.gif" name="actimg"></td>
	<td align="right">
	<form action="$battle" method="POST" name="form">
	);

	if ($ply2) {
		print qq(
		<input type="hidden" name="mode" value="action">
		<input type="hidden" name="action" value="">
		<input type="hidden" name="mgc" value="">
		<input type="hidden" name="itm" value="">
		<input type="button" value="���s" onClick="this.disabled='true'; this.form.submit();"$sdisa>&nbsp;
		);
	} else {
		print qq(
		<input type="hidden" name="mode" value="close">
		<input type="button" value="����" onClick="this.disabled='true'; this.form.submit();">&nbsp;
		);
	}

	print qq(
	</form>
	</td>
	<td>
	&nbsp;<input type="button" value="�����[�h" onclick="location.href='$battle?mode=reload&name=$FORM{'name'}'"$rdisa>&nbsp;
	</td>
	</tr>
	</table>
	</td>
	</tr>
	<tr>
	<td id="come" colspan="3" style="color: $fcolor1;"><br></td>
	</tr>
	</table>
	</body>
	</html>
	);
}

sub cwin {
	my ($tm, $nm, $ht, $sts, $dg, $prt, $flg, $mess, $forl) = split (/\t/, $_[0]);
	my ($hp, $cp, $hpc, $cpc, $st, $mg, $df, $md, $mc, $it) = split (/\//, $sts);

	my $hpp = int(($hp * 100) / 100) || 1;
	my $cpp = int(($cp * 100) / 100) || 1;

	my ($hpcn, $cpcn);
	if ($hpc != 0) {
		$hpcn = ($hpc > 0) ? "<font color=\"#0033CC\">+$hpc</font>" : "<font color=\"#CC0000\">$hpc</font>";
	}
	if ($cpc != 0) {
		$cpcn = ($cpc > 0) ? "<font color=\"#0033CC\">+$cpc</font>" : "<font color=\"#CC0000\">$cpc</font>";
	}

	if ($flg == 1) {
		print qq(<font color="#0033CC" face="impact" size="6" style="position:relative; top:55px; left:0px;"><b>WIN!</b></font>);
	} elsif ($flg == 2) {
		print qq(<font color="#CC3333" face="impact" size="6" style="position:relative; top:55px; left:0px;"><b>LOSE!</b></font>);
	}

	print qq(
	<table bgcolor="#666666" cellspacing="1" cellpadding="10" width="240");
	print qq( class="inv") if ($flg);
	print qq(>
	<tr bgcolor="$bcolor3">
	<td width="190">
	<b>$nm</b>
	);

	if ($dg) {
		my ($st, $mg, $df, $md, $pz) = split (/\//, $dg);
		print qq(<img src="$imgdir/s_up.gif" width="24" height="24"> ) if ($st);
		print qq(<img src="$imgdir/m_up.gif" width="24" height="24"> ) if ($mg);
		print qq(<img src="$imgdir/d_up.gif" width="24" height="24"> ) if ($df);
		print qq(<img src="$imgdir/poizn.gif" width="24" height="24"> ) if ($pz);
	}

	print qq(
	<table>
	<tr>
	<td><span style="font-size:12px;">Hp</span></td>
	<td><div style="font-size:4px; line-height: 5px; border:1px solid #333; width:100px;"><div style="background-color:#669966; width:$hp\%;"><br></div></div></td>
	<td nowrap><span style="font-size:12px;">($hp/100)$hpcn</span></td>
	</tr>
	<tr>
	<td><span style="font-size:12px;">Cp</span></td>
	<td><div style="font-size:4px; line-height: 5px; border:1px solid #333; width:100px;"><div style="background-color:#CC6699; width:$cp\%;"><br></div></div></td>
	<td nowrap><span style="font-size:12px;">($cp/100)$cpcn</span></td>
	</tr>
	</table>
	</td></tr></table>
	);

	return $flg;
}

#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
# �� �A�N�V����
#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
sub action {
	# �t�@�C���ǂݍ���
	my ($ply1, $ply2) = @_;

	my ($tm1, $nm1, $ht1, $sts1, $dg1, $prt1, $flg1, $mess1, $forl1) = split (/\t/, $ply1);
	my ($hp1, $cp1, $hpc1, $cpc1, $st1, $mg1, $df1, $md1, $mc1, $it1) = split (/\//, $sts1);

	my ($tm2, $nm2, $ht2, $sts2, $dg2, $prt2, $flg2, $mess2, $forl2) = split (/\t/, $ply2);
	my ($hp2, $cp2, $hpc2, $cpc2, $st2, $mg2, $df2, $md2, $mc2, $it2) = split (/\//, $sts2);

	if ($ht1 eq $host) {
		# �h��t���O������
		$prt1 = 0;

		# hp/cp�����\��������
		$hpc1 = 0; $cpc1 = 0;
		$hpc2 = 0; $cpc2 = 0;

		$mess1 = ''; $mess2 = '';

		# �ʏ�U��
		if ($FORM{'action'} eq 'atk') {
			my $sths = (split (/\|/, (split (/\//, $dg1))[0]))[0] || 0;
			$sths = &stc(0, $sths) if ($sths);
			my $dfhs = (split (/\|/, (split (/\//, $dg2))[2]))[0] || 0;
			$dfhs = &stc(0, $dfhs) if ($dfhs);

			my $prt = 5 if ($prt2);
			my $dmg = ($st1 + $sths + int(rand(4)) + 20) - ($df2 + $dfhs + $prt);
			$dmg = 0 if ($dmg < 0);
			$hp2 -= $dmg;
			$hpc2 -= $dmg;
			$mess1 = "$nm1�̍U���I";
			$mess2 = "$nm2��$dmg�̃_���[�W�I";
		} elsif ($FORM{'action'} eq 'mgc') {
			my ($no, $st, $cp, $prc, $nm, $ms, $tp) = split (/\//, $mgc[$FORM{'mgc'}]);

			if ($cp > $cp1) {
				$mess1 = "$nm1��$nm�����݂��I<br>CP������Ȃ��I";
			} else {
				if ($tp eq 'a') {
					$val = &stc(0, $st);

					my $hs = (split (/\|/, (split (/\//, $dg1))[1]))[0] || 0;
					$mg1 = &stc($mg1, $hs) if ($hs);

					# �h�䖳��
					#my $prt = 5 if ($prt2);
					my $dmg = ($mg1 + $val + int(rand(4)) + 20) - ($md2);
					$dmg = 0 if ($dmg < 0);
					$hp2 -= $dmg;
					$hpc2 -= $dmg;

					$mess1 = "$nm1��$nm�����݂��I";
					$mess2 = "$nm2��$dmg�̃_���[�W�I";

					$cp1 -= $cp;
					$cpc1 -= $cp;
				} elsif ($tp eq 'h') {
					$val = &stc(0, $st);
					$hp1 += $val;
					$hpc1 = $val;

					$mess1 = "$nm1��$nm�����݂��I<br>$nm1��HP���񕜂����I";

					$cp1 -= $cp;
					$cpc1 -= $cp;
				} elsif ($tp eq 's') {
					my @dg = split (/\//, $dg1);
					$dg[0] = "$st|4";
					$dg1 = join ('/', @dg);

					$mess1 = "$nm1��$nm�����݂��I<br>$nm1�̍U���͂��オ�����I";

					$cp1 -= $cp;
					$cpc1 -= $cp;
				} elsif ($tp eq 'm') {
					my @dg = split (/\//, $dg1);
					$dg[1] = "$st|4";
					$dg1 = join ('/', @dg);

					$mess1 = "$nm1��$nm�����݂��I<br>$nm1�̖��@�U���͂��オ�����I";

					$cp1 -= $cp;
					$cpc1 -= $cp;
				} elsif ($tp eq 'd') {
					my @dg = split (/\//, $dg1);
					$dg[2] = "$st|4";
					$dg1 = join ('/', @dg);

					$mess1 = "$nm1��$nm�����݂��I<br>$nm1�̖h��͂��オ�����I";

					$cp1 -= $cp;
					$cpc1 -= $cp;
				} elsif ($tp eq 'p') {
					my @dg = split (/\//, $dg2);
					$dg[4] = "5|4";
					$dg2 = join ('/', @dg);

					$mess1 = "$nm1��$nm�����݂��I";
					$mess2 = "$nm2�͓łɔƂ��ꂽ�I";

					$cp1 -= $cp;
					$cpc1 -= $cp;
				}
			}
		} elsif ($FORM{'action'} eq 'prt') {
			# �h��t���O
			$prt1 = 1;
			$mess1 = "$nm1�͐g�\\�����I";

			# CP�l��
			my $ucp = 40;
			$ucp -= int($hp1 / 3);
			$cp1 += $ucp;
			$cpc1 = $ucp;
		} elsif ($FORM{'action'} eq 'itm') {
			my ($no, $st, $prc, $nm, $ms, $tp) = split (/\//, $itm[$FORM{'itm'}]);
			$val = &stc(0, $st);

			if ($tp eq 'h') {
				$hp1 += $val;
				$hpc1 = $val;
				$mess1 = "$nm1��$nm���g�����I<br>$nm1��HP���񕜂����I";
			} elsif ($tp eq 'c') {
				$cp1 += $val;
				$cpc1 = $val;
				$mess1 = "$nm1��$nm���g�����I<br>$nm1��CP���񕜂����I";
			}

			my @it = split (/\|/, $it1);
			my @nit = grep { $_ != $FORM{'itm'} } @it;
			$it1 = join ('|', @nit);
		}

		if ($hp2 < 1) {
			# �����|�����ꍇ
			$hp2 = 0;
			$flg1 = "1";
			$flg2 = "2";
			$mess2 .= "<br>$nm2�͗͐s�����I";

			# ���
			&record($nm1, $nm2, $forl1);
		} else {
			# �⏕���@/��Ԉُ�̏��ŃJ�E���g
			my @dg = split (/\//, $dg1);
			foreach (@dg) {
				if ($_) {
					my ($vl, $ct) = split (/\|/, $_);
					$ct--;
					$_ = (!$ct) ? 0 : "$vl|$ct";
				}
			}
			$dg1 = join ('/', @dg);

			# ��
			if ($dg[4]) {
				my ($vl, $ct) = split (/\|/, $dg[4]);
				my $pdmg = int(rand($vl)) + 6;
				$hp1 -= $pdmg;
				$hpc1 -= $pdmg;
				$hp1 = 1 if ($hp1 < 1);
				$mess1 .= "<br>$nm1�͓ł�$pdmg�̃_���[�W�I";
			}

			# CP�l��
			my $ccp = int(rand(6)) + 20;
			$cp1 += $ccp;
			$cpc1 += $ccp;
		}
	}

	$cp1 = 100 if ($cp1 > 100);
	$hp1 = 100 if ($hp1 > 100);
	$time = time;

	$nply1 = "$time\t$nm1\t$host\t$hp1/$cp1/$hpc1/$cpc1/$st1/$mg1/$df1/$md1/$mc1/$it1\t$dg1\t$prt1\t$flg1\t$mess1\t$forl1";
	$nply2 = "$time\t$nm2\t$ht2\t$hp2/$cp2/$hpc2/$cpc2/$st2/$mg2/$df2/$md2/$mc2/$it2\t$dg2\t$prt2\t$flg2\t$mess2\t$forl2";

	# �t�@�C����������
	&lock if ($lock == 2);
	&file_write($bdata, $nply2, $nply1);
	&unlock if ($lock == 2);

	&battle($nply2, $nply1);
}

#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
# �� ��т�t����
#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
sub record {
	my ($nm1, $nm2, $forl) = @_;

	# ���
	my @btllog = &file_read($btllog);
	my @btotal = &file_read($btotal);

	my $list;
	if ($forl eq "fst") {
		$list = "$nm1\t$nm2\t1\t";
	} else {
		$list = "$nm2\t$nm1\t0\t";
	}

	unshift (@btllog, $list.&get_days);

	my ($flg1, $flg2);
	foreach (@btotal) {
		my @tmp = split (/\t/, $_);
		if ($tmp[0] eq $nm1) {
			$tmp[1]++;
			$flg1 = 1;
		} elsif ($tmp[0] eq $nm2) {
			$tmp[2]++;
			$flg2 = 1;
		}
		$_ = join ("\t", @tmp);
	}

	push (@btotal, "$nm1\t1\t0") if (!$flg1);
	push (@btotal, "$nm2\t0\t1") if (!$flg2);

	$#btllog = $blogmax - 1 if ((@btllog) > $blogmax);

	# �t�@�C����������
	&lock if ($lock == 2);
	&file_write($btllog, @btllog);
	&file_write($btotal, @btotal);
	&unlock if ($lock == 2);
}

#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
# �� �o�g���Q��
#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
sub in {
	# �t�@�C���ǂݍ���
	my ($plyr1, $plyr2) = @_;

	if ($ENV{'REQUEST_METHOD'} ne 'POST') {
		&error("�s���ȃA�N�Z�X�ł��B");
	}

	if ((split (/\t/, $plyr1))[6] != 0 || (time > ($timeout+20 + (split (/\t/, $plyr1))[0]))) {
		($plyr1, $plyr2) = ();
	} elsif ((split (/\t/, $plyr1))[2] eq $host) {
		&error('�f�[�^���d�����Ă��܂��B���΂炭�o���Ă���Q�킵�Ă��������B');
	} elsif ($plyr2) {
		&error('�o�g�����ł��B���΂炭�o���Ă���Q�킵�Ă��������B');
	}

	my ($str, $mgc, $def, $mdf, $magic, $item) = (0, 0, 0, 0, '', '');

	foreach (@wep) {
		my ($no, $st, $mo, $prc, $nm, $ms) = split (/\//, $_);
		if ($FORM{'wepv'} == $no) {
			$str = &stc($str, $st);
			$mgc = &stc($mgc, $mo);
			last;
		}
	}
	foreach (@arm) {
		my ($no, $st, $mo, $prc, $nm, $ms) = split (/\//, $_);
		if ($FORM{'armv'} == $no) {
			$def = &stc($def, $st);
			$mdf = &stc($mdf, $mo);
			last;
		}
	}
	$i = 1;
	foreach (@acs) {
		if ($FORM{"acs$i"}) {
			my ($no, $st, $prc, $nm, $ms, $tp) = split (/\//, $_);
			if ($tp eq 's') {
				$str = &stc($str, $st);
			} elsif ($tp eq 'm') {
				$mgc = &stc($mgc, $st);
			}
		}
		$i++;
	}
	$i = 1;
	foreach (0..$#mgc) {
		if ($FORM{"mgc$i"}) {
			$magic .= '|' if ($magic ne '');
			$magic .= $_;
		}
		$i++;
	}
	$i = 1;
	foreach (0..$#itm) {
		if ($FORM{"itm$i"}) {
			$item .= '|' if ($item ne '');
			$item .= $_;
		}
		$i++;
	}

	$time = time;

	# ��ɂ����ق����搧
	if (!$plyr1) {
		$plyr1 = "$time\t$FORM{'name'}\t$host\t100/0/0/0/$str/$mgc/$def/$mdf/$magic/$item\t0/0/0/0/0\t0\t0\tfst\tfst";
	} else {
		# ��̏ꍇ���߂���cp+30
		$plyr2 = "$time\t$FORM{'name'}\t$host\t100/30/0/0/$str/$mgc/$def/$mdf/$magic/$item\t0/0/0/0/0\t0\t0\tsnd\tsnd";
	}

	# �t�@�C����������
	&lock if ($lock == 2);
	&file_write($bdata, $plyr1, $plyr2);
	&unlock if ($lock == 2);

	&battle($plyr1, $plyr2);
}

#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
# �� ����
#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
sub close {
	# �t�@�C����������
	&lock if ($lock == 2);
	&file_write($bdata);
	&unlock if ($lock == 2);

	print "Content-type: text/html\n\n";
	print <<"_HTML_";
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Shift_JIS">
<title>�~�j�Q�[��</title>
</head>
<body onload="window.close();"></body>
</html>
_HTML_
}

#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
# �� �t���[��
#�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`�`
sub sframe {
	print "Content-type: text/html\n\n";
	print <<"_HTML_";
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Shift_JIS">
<title>�~�j�Q�[��</title>
</head>
<frameset rows="88%, *">
<frame src="$battle?mode=shopp&name=$FORM{'name'}" name="stop" marginheight="0" marginwidth="0">
<frame src="$battle?mode=price" name="sbtm" marginheight="0" marginwidth="0">
<noframes>
<noframes>[�t���[���Ή��̃u���E�U�ł������������B]</noframes>
</html>
_HTML_
}