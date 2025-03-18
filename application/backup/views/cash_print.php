<?php 
defined('BASEPATH') or exit ('No direct script access allowed');
?>
<script type="text/javascript">
window.print();
</script>
<div id="my-data-table">

<table width="100%">
	<tr>
		<td><img src="<?php echo base_url() ?>/assets/images/logo_report.png" alt="" /></td>
		<td align="right"><b>Nomor KAS BON : <?php echo $no_cash; ?></b></td>
	</tr>
</table>

<center>
<h2><u>BUKTI KAS BON SEMENTARA</u></h2>
Tanggal: <?php echo $start_date.' s/d '.$end_date; ?>
</center>

<table>
	<tr>
		<td>Di Bayarkan Kepada</td><td width="10px">:</td>
			<td><?php echo $receiver_name; ?></td>
	</tr>
	<tr>
		<td>Jumlah</td><td>:</td>
			<td><?php echo $amount; ?></td>		
	</tr>
	<tr>
		<td>Terbilang</td><td>:</td>
			<td><?php echo $words; ?></td>	
	</tr>
</table>

<br><br>

<table width="100%">
	<tr>
		<td width="30%" align="center">Diterima oleh</td>
		<td width=""></td>
		<td width="30%" align="center">Disetujui oleh</td>
	</tr>
	<tr>
		<td><br><br></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td align="center">(....................................)</td>
		<td></td>
		<td align="center">(....................................)</td>
	</tr>
</table>
FR-PR-FAT-01-02
</div><!-- my-data-table-->

