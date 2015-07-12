 <?php
include "../koneksi.php";
        $br_id           = $_POST['br_id'];
        $br_nm           = $_POST['br_nm'];
        $br_item		 = $_POST['br_item'];
        $br_hrg 	     = $_POST['br_hrg'];
        $br_stok	     = $_POST['br_stok'];
        $br_satuan 	     = $_POST['br_satuan'];
        $br_gbr          = $_POST['br_gbr'];
        $ket             = $_POST['ket'];
        $br_sts          = $_POST['br_sts'];

$query = mysql_query("INSERT INTO barang (br_id, br_nm, br_item, br_hrg, br_stok, br_satuan, br_gbr, ket, br_sts) 
VALUES ('$br_id', '$br_nm', '$br_item', '$br_hrg', '$br_stok', '$br_satuan', '$br_gbr', '$ket', '$br_sts')");
if ($query){
	echo "<script>alert('Data barang Berhasil dimasukan!'); window.location = 'tambah.php'</script>";	
} else {
	echo "<script>alert('Data barang Gagal dimasukan!'); window.location = 'tambah.php'</script>";	
}
?>