<html>
<head>
	<meta content="text/html; charset=UTF-8" http-equiv="content-type">
</head>
<table cellspacing="0" cellpadding="10" style="color:#666;font:13px Arial;line-height:1.4em;width:100%;">
	<tbody>
		<tr>
            <td style="color:#4D90FE;font-size:22px;border-bottom: 2px solid #4D90FE;">
				<?php echo CHtml::encode(Yii::app()->name); ?>
            </td>
		</tr>
		<tr>
            <td style="color:#777;font-size:16px;padding-top:5px;">
            	Nama: 
				<div><?php if(isset($data['nama'])) echo $data['nama'];  ?></div>
            </td>
		</tr>
		<tr>
            <td style="color:#777;font-size:16px;padding-top:5px;">
            	Judul
				<div>
					<?php if(isset($data['judul'])) echo $data['judul'];  ?>
				</div>
            </td>
		</tr>
		<tr>
            <td style="color:#777;font-size:16px;padding-top:5px;">
            	Isi berita
				<div>
					<?php if(isset($data['berita'])) echo $data['berita'];  ?>
				</div>
            </td>
		</tr>
	</tbody>
</table>
</body>
</html>