<?php
require_once("koneksi.php");

if(isset($_GET['add'])){
	$id = mysql_real_escape_string((int)$_GET['add']);
	$qt = mysql_query("SELECT br_id, br_stok FROM barang WHERE br_id='$id'");
	while($qt_row = mysql_fetch_assoc($qt)){
		if($qt_row['br_stok'] != $_SESSION['cart_'.$_GET['add']] && $qt_row['br_stok'] > 0){
			$_SESSION['cart_'.$_GET['add']]+='1';
			//header("Location: index.php");
            echo '<script language="javascript">alert("Produk berhasil dimasukan ke keranjang anda.."); document.location="index.php";</script>';
            
		} else {
			echo '<script language="javascript">alert("Stok produk tidak mencukupi!"); document.location="index.php";</script>';
		}
	}

}

function cart(){
	foreach($_SESSION as $name => $value){
		if($value > 0){
			if(substr($name, 0, 5) == 'cart_'){
				$id = substr($name, 5, (strlen($name)-5));
				$get = mysql_query("SELECT * FROM barang WHERE br_id='$id'");
				while($get_row = mysql_fetch_assoc($get)){
					$sub = $get_row['br_hrg'] * $value;
					echo '<div style="font-size:11px; margin-bottom:-10px">&raquo; '.$get_row['br_nm'].' @ Rp. '.$get_row['br_hrg'].' X '.$value.' = Rp. '.$sub.'</div><br>';
				}
			}
			$total += $sub;
		}
	}
	if($total == 0){
		echo 'Keranjang Belanja Kosong!';
	} else {
		echo '<div style="text-align:right; font-size:11px;"><a href="detail.php" class="btn btn-lg btn-danger">&raquo; Lihat Detail Keranjang &laquo;</a></div>';
	}
}

function produk(){
            $sql = mysql_query("SELECT * FROM barang ORDER BY br_id DESC");
	if(mysql_num_rows($sql) == 0){
		echo "Tidak ada produk!";
	}else{
		while($row = mysql_fetch_assoc($sql)){
			print '
			<div class="span4">
          			<div class="icons-box">
				<div class="title"><h3>'.$row['br_nm'].'</h3></div>
				<img src="'.$row['br_gbr'].'" />
				<div><h3>Rp. '.number_format($row['br_hrg'],2,",",".").'</h3></div>
                <div class="clear"><a href="detail.php?add='.$row['br_id'].'" class="btn btn-lg btn-danger">Detail &raquo</a> <a href="index.php?add='.$row['br_id'].'" class="btn btn-lg btn-success">Beli &raquo</a></b></div>
			</div>
            </div>
			';
		}
	}
}
?>