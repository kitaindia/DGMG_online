#````````````````````````````
# ¥ ƒAƒCƒeƒ€ƒVƒ‡ƒbƒv
#````````````````````````````
sub shopp {
	&header;

	print <<"JAVA";
<script language="JavaScript">
<!--
function calc() {
	x = 0;
    for (i = 0; i < document.form1.wep.length; i++) {
		if (document.form1.wep[i].checked) {
			x += document.form1.wep[i].value - 0;
			document.form1.wepv.value = i;
		}
	}
    for (i = 0; i < document.form1.arm.length; i++) {
		if (document.form1.arm[i].checked) {
			x += document.form1.arm[i].value - 0;
			document.form1.armv.value = i;
		}
	}
	if (document.form1.acs1.checked) { x += document.form1.acs1.value - 0; }
	if (document.form1.acs2.checked) { x += document.form1.acs2.value - 0; }
	if (document.form1.mgc1.checked) { x += document.form1.mgc1.value - 0; }
	if (document.form1.mgc2.checked) { x += document.form1.mgc2.value - 0; }
	if (document.form1.mgc3.checked) { x += document.form1.mgc3.value - 0; }
	if (document.form1.mgc4.checked) { x += document.form1.mgc4.value - 0; }
	if (document.form1.mgc5.checked) { x += document.form1.mgc5.value - 0; }
	if (document.form1.mgc6.checked) { x += document.form1.mgc6.value - 0; }
	if (document.form1.mgc7.checked) { x += document.form1.mgc7.value - 0; }
	if (document.form1.mgc8.checked) { x += document.form1.mgc8.value - 0; }
	if (document.form1.itm1.checked) { x += document.form1.itm1.value - 0; }
	if (document.form1.itm2.checked) { x += document.form1.itm2.value - 0; }
	if (document.form1.itm3.checked) { x += document.form1.itm3.value - 0; }
	if (document.form1.itm4.checked) { x += document.form1.itm4.value - 0; }

	if (x > 5000) {
		document.form1.sub.disabled = true;
		parent.sbtm.document.getElementById('ov').style.display = 'inline';
	} else {
		document.form1.sub.disabled = false;
		parent.sbtm.document.getElementById('ov').style.display = 'none';
	}

	parent.sbtm.document.getElementById('id').innerHTML = x;
}
//-->
</script>
JAVA

	print qq(
	</head>
	<body class="fbottom" style="background-color:$bcolor2;">
	<table align="center" bgcolor="$bcolor2" cellpadding="5" cellspacing="20" width="510">
	<tr>
	<td bgcolor="$bcolor3">
	<form action="$battle" method="POST" name="form1" target="_top">
	<input type="hidden" name="name" value="$FORM{'name'}">
	<input type="hidden" name="mode" value="battle">
	<table align="center" cellpadding="4" width="100%">
	<tr>
	<td colspan="6">
	<input type="hidden" name="wepv" value="0">
	<div align="right">•Ší@<img src="$imgdir/wep.gif"></div>
	<hr size="1" width="100%">
	</td>
	</tr>
	<tr>
	<td><input type="radio" name="wep" value="0" checked style="border:0px;" onclick="calc();"></td>
	<td colspan="5"><small>”ƒ‚í‚È‚¢</small></td>
	</tr>
	<tr>
	<td colspan="2"><br></td>
	<td align="center"><small>U/–‚</small></td>
	<td align="center"><small>’l</small></td>
	<td align="center"><small>–¼</small></td>
	<td><small>à–¾</small></td>
	</tr>
	);

	foreach (@wep) {
		my ($no, $st, $mo, $prc, $nm, $ms) = split (/\//, $_);
		print qq(
		<tr>
		<td><input type="radio" name="wep" value="$prc" style="border:0px;" onclick="calc();"></td>
		<td><img src="$imgdir/a_ken$no.gif"></td>
		<td align="center" nowrap>$st/$mo</td>
		<td align="center" nowrap>$prc\G</td>
		<td nowrap><small>$nm</small></td>
		<td><small>$ms</small></td>
		</tr>
		);
	}

	print qq(
	</table>
	<table align="center" cellpadding="4" width="100%">
	<tr>
	<td colspan="6">
	<input type="hidden" name="armv" value="0">
	<div align="right">–h‹ï@<img src="$imgdir/arm.gif"></div>
	<hr size="1" width="100%">
	</td>
	</tr>
	<tr>
	<td><input type="radio" name="arm" value="0" checked style="border:0px;" onclick="calc();"></td>
	<td colspan="5"><small>”ƒ‚í‚È‚¢</small></td>
	</tr>
	<tr>
	<td colspan="2"><br></td>
	<td align="center"><small>–h/–‚–h</small></td>
	<td align="center"><small>’l</small></td>
	<td align="center"><small>–¼</small></td>
	<td><small>à–¾</small></td>
	</tr>
	);

	foreach (@arm) {
		my ($no, $st, $mo, $prc, $nm, $ms) = split (/\//, $_);
		print qq(
		<tr>
		<td><input type="radio" name="arm" value="$prc" style="border:0px;" onclick="calc();"></td>
		<td><img src="$imgdir/a_arm$no.gif"></td>
		<td align="center" nowrap>$st/$mo</td>
		<td align="center" nowrap>$prc\G</td>
		<td nowrap><small>$nm</small></td>
		<td><small>$ms</small></td>
		</tr>
		);
	}

	print qq(
	</table>
	<table align="center" cellpadding="4" width="100%">
	<tr>
	<td colspan="6">
	<input type="hidden" name="acsv" value="0">
	<div align="right">ƒAƒNƒZƒTƒŠ[@<img src="$imgdir/acs.gif"></div>
	<hr size="1" width="100%">
	</td>
	</tr>
	<tr>
	<td colspan="2"><br></td>
	<td align="center"><small>Œø‰Ê</small></td>
	<td align="center"><small>’l</small></td>
	<td align="center"><small>–¼</small></td>
	<td><small>à–¾</small></td>
	</tr>
	);

	foreach (@acs) {
		my ($no, $st, $prc, $nm, $ms) = split (/\//, $_);
		print qq(
		<tr>
		<td>
		<input type="checkbox" name="acs$no" value="$prc" style="border:0px;" onclick="calc();">
		</td>
		<td><img src="$imgdir/a_acs$no.gif"></td>
		<td align="center" nowrap>$st</td>
		<td align="center" nowrap>$prc\G</td>
		<td nowrap><small>$nm</small></td>
		<td><small>$ms</small></td>
		</tr>
		);
	}

	print qq(
	</table>
	<table align="center" cellpadding="4" width="100%">
	<tr>
	<td colspan="6">
	<input type="hidden" name="mgcv" value="0">
	<div align="right">–‚–@@<img src="$imgdir/magic.gif"></div>
	<hr size="1" width="100%">
	</td>
	</tr>
	<tr>
	<td colspan="2"><br></td>
	<td align="center"><small>Œø‰Ê/CP</small></td>
	<td align="center"><small>’l</small></td>
	<td align="center"><small>–¼</small></td>
	<td><small>à–¾</small></td>
	</tr>
	);

	foreach (@mgc) {
		my ($no, $st, $cp, $prc, $nm, $ms) = split (/\//, $_);
		print qq(
		<tr>
		<td><input type="checkbox" name="mgc$no" value="$prc" style="border:0px;" onclick="calc();"></td>
		<td><img src="$imgdir/a_mgc$no.gif"></td>
		<td align="center" nowrap>$st/-$cp</td>
		<td align="center" nowrap>$prc\G</td>
		<td nowrap><small>$nm</small></td>
		<td><small>$ms</small></td>
		</tr>
		);
	}

	print qq(
	<table align="center" cellpadding="4" width="100%">
	<tr>
	<td colspan="6">
	<input type="hidden" name="itmv" value="0">
	<div align="right">ƒAƒCƒeƒ€@<img src="$imgdir/item.gif"></div>
	<hr size="1" width="100%">
	</td>
	</tr>
	<tr>
	<td colspan="2"><br></td>
	<td align="center"><small>Œø‰Ê</small></td>
	<td align="center"><small>’l</small></td>
	<td align="center"><small>–¼</small></td>
	<td><small>à–¾</small></td>
	</tr>
	);

	foreach (@itm) {
		my ($no, $st, $prc, $nm, $ms) = split (/\//, $_);
		print qq(
		<tr>
		<td><input type="checkbox" name="itm$no" value="$prc" style="border:0px;" onclick="calc();"></td>
		<td><img src="$imgdir/a_itm$no.gif"></td>
		<td align="center" nowrap>$st</td>
		<td align="center" nowrap>$prc\G</td>
		<td nowrap><small>$nm</small></td>
		<td><small>$ms</small></td>
		</tr>
		);
	}

	print qq(
	</table>
	<p align="center"><input type="button" value=" ‚±‚Ì‘•”õ‚Åƒoƒg‚éI " name="sub" class="button" onClick="this.disabled='true'; this.form.submit();"></p>
	</form>
	</td></tr>
	</table>
	</body>
	</html>
	);
}

#````````````````````````````
# ¥ ƒAƒCƒeƒ€ƒVƒ‡ƒbƒvi‰ïŒvj
#````````````````````````````
sub price {
	&header;
	print <<"_HTML_";
</head>
<body class="ftop">
<table cellpadding="5" width="100%">
<tr>
<td style="line-height: 18px;">
<small>
Œ»İ‚Ìw“ü‹àŠzF<b><span id="id" style="color:#FFCC00;">0</span>G</b>
<span id="ov" style="color: #FF3300; display: none;">Over!</span><br>
Š‹àF<b><span style="color:#FFCC00;">5000</span>G</b>
</small>
</td>
<td align="right">
</td>
</tr>
</table>
</body>
</html>
_HTML_
}
1