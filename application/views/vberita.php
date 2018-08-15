<html>
<head>
<title>Menampilkan Berita Terbaru dan Berita Sebelumnnya</title>
</head>

<body>
<h3> Berita Terbaru :</h3>
<?php
foreach ($b_terbaru->result() as $row );
$isi = $row->isi_berita;
$isi = substr($isi , 0 , 200);
?>
<table border ="0" width="600" cellpadding="0"cellspacing="0";>
<tr>
<td>
<b><?php echo $row->judul; ?></b>
</b> />
<i><?php echo $row->hari."," $row->tanggal.",".$row->jam; ?></i>
<br/>
<?php echo $isi; ?>
</td>
</tr>
</table>
<?php
endforeach;
?>
</body>
</html>