<?php


$conn = mysqli_connect("localhost","root","","stockbarang");



//menambah barang baru
if(isset($_POST['addnewbarang'])){
	$namabarang = $_POST['namabarang'];
	$deskripsi = $_POST['deskripsi'];
	$stock = $_POST['stock'];

	$addtotable = mysqli_query($conn,"insert into stock (namabarang, deskripsi, stock) values('$namabarang','$deskripsi','$stock')");
	if ($addtotable) {
		header('location:home.php');
	} else {
		echo "Gagal";
		header('location:home.php');
	}
};


//menambah barang masuk
if(isset($_POST['barangmasuk'])) {
	$barangnya = $_POST['barangnya'];
	$penerima = $_POST['penerima'];
	$qty = $_POST['qty'];

	$cekstocksekarang = mysqli_query($conn,"select * from stock where idbarang='$barangnya'");
	$ambildatanya = mysqli_fetch_array($cekstocksekarang);

	$stocksekarang = $ambildatanya['stock'];
	$tambahkanstocksekarangdenganquantity = $stocksekarang+$qty;

	$addtomasuk = mysqli_query($conn,"insert into masuk (idbarang, keterangan, qty) values('$barangnya', '$penerima','$qty')");
	$updatestockmasuk = mysqli_query($conn,"update stock set stock='$tambahkanstocksekarangdenganquantity' where idbarang='$barangnya'");
	if ($addtomasuk&&$updatestockmasuk) {
		header('location:masuk.php');
	}else {
		echo "Gagal";
		header('location:masuk.php');
	}
}

//menambah barang keluar
if(isset($_POST['addbarangkeluar'])) {
	$barangnya = $_POST['barangnya'];
	$penerima = $_POST['penerima'];
	$qty = $_POST['qty'];

	$cekstocksekarang = mysqli_query($conn,"select * from stock where idbarang='$barangnya'");
	$ambildatanya = mysqli_fetch_array($cekstocksekarang);

	$stocksekarang = $ambildatanya['stock'];


	if ($stocksekarang >= $qty) {
		//jika barang cukup
	
		$tambahkanstocksekarangdenganquantity = $stocksekarang-$qty;

		$addtokeluar = mysqli_query($conn,"insert into keluar (idbarang, penerima, qty) values('$barangnya', '$penerima','$qty')");
		$updatestockmasuk = mysqli_query($conn,"update stock set stock='$tambahkanstocksekarangdenganquantity' where idbarang='$barangnya'");
		if ($addtomasuk&&$updatestockmasuk) {
			header('location:keluar.php');
		}else {
			echo "Gagal";
			header('location:keluar.php');
		}
	}else {
		//jika barang tidak cukup
		echo '
		<script>
			alert("Stock saat ini tidak mencukupi");
			window.location.href="keluar.php";
		</script>

		';
	}	
}




//Update info barang
if (isset($_POST['updatebarang'])) {
	$idb = $_POST['idb'];
	$namabarang  = $_POST['namabarang'];
	$deskripsi = $_POST['deskripsi'];

	$update = mysqli_query($conn,"update stock set namabarang='$namabarang', deskripsi='$deskripsi' where idbarang ='$idb'");
	if ($update) {
		header('location:home.php');
	}else {
		echo "Gagal";
		header('location:home.php');
	}
}


//menghapus barang
if (isset($_POST['hapusbarang'])) {
	$idb = $_POST['idb'];

	$hapus = mysqli_query($conn, "delete from stock where idbarang='$idb'");
	if ($hapus) {
		header('location:home.php');
	}else {
		echo "Gagal";
		header('location:home.php');
	}
}



//mengubah data barang masuk
if (isset($_POST['updatebarangmasuk'])) {
	$idb = $_POST['idb'];
	$idm = $_POST['idm'];
	$deskripsi = $_POST['keterangan'];
	$qty = $_POST['qty'];

	$lihatstock = mysqli_query($conn,"select * from stock where idbarang='$idb'");
	$stocknya = mysqli_fetch_array($lihatstock);
	$stockskrg = $stocknya['stock'];

	$qtyskrg = mysqli_query($conn, "select * from masuk where idmasuk='$idm'");
	$qtynya = mysqli_fetch_array($qtyskrg);
	$qtyskrg = $qtynya['qty'];

	if($qty>$qtyskrg){
		$selisih = $qty-$qtyskrg;
		$kurangin = $stockskrg + $selisih;
		$kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
		$updatenya = mysqli_query($conn,"update masuk set qty='$qty', keterangan='$deskripsi' where idmasuk='$idm'");
			if ($kurangistocknya&&$updatenya) {
				header('location:masuk.php');
			}else {
				echo "Gagal";
				header('location:masuk.php');
			}
	}else {
		$selisih = $qtyskrg-$qty;
		$kurangin = $stockskrg - $selisih;
		$kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
		$updatenya = mysqli_query($conn,"update masuk set qty='$qty', keterangan='$deskripsi' where  idmasuk='$idm'");
			if ($kurangistocknya&&$updatenya) {
				header('location:masuk.php');
			}else {
				echo "Gagal";
				header('location:masuk.php');
			}
	}
}




//menghapus barang masuk
 if(isset($_POST['hapusbarangmasuk'])){
 	$idb = $_POST['idb'];
 	$qty = $_POST['kty'];
 	$idm = $_POST['idm'];

	$getdatastock = mysqli_query($conn,"select * from stock where idbarang='$idb'");
	$data = mysqli_fetch_array($getdatastock);
	$stok = $data['stock'];

	$selisih = $stok-$qty;

 	$update = mysqli_query($conn, "update stock set stock='$selisih' where idbarang='$idb'");
 	$hapusdata = mysqli_query($conn, "delete from masuk where idmasuk='$idm'");

 	if($update&&$hapusdata){
 		header('location:masuk.php');
 	}else{
 		echo "Gagal";
 		header('location:masuk.php');
 	}
 
 }


//mengubah barang keluar
if (isset($_POST['updatebarangkeluar'])) {
	$idb = $_POST['idb'];
	$idk = $_POST['idk'];
	$penerima = $_POST['penerima'];
	$qty = $_POST['qty'];

	$lihatstock = mysqli_query($conn,"select * from stock where idbarang='$idb'");
	$stocknya = mysqli_fetch_array($lihatstock);
	$stockskrg = $stocknya['stock'];

	$qtyskrg = mysqli_query($conn, "select * from keluar where idkeluar='$idk'");
	$qtynya = mysqli_fetch_array($qtyskrg);
	$qtyskrg = $qtynya['qty'];

	if($qty>$qtyskrg){
		$selisih = $qty-$qtyskrg;
		$kurangin = $stockskrg - $selisih;
		$kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
		$updatenya = mysqli_query($conn,"update keluar set qty='$qty', penerima='$penerima' where idkeluar='$idk'");
			if ($kurangistocknya&&$updatenya) {
				header('location:keluar.php');
			}else {
				echo "Gagal";
				header('location:keluar.php');
			}
	}else {
		$selisih = $qtyskrg-$qty;
		$kurangin = $stockskrg + $selisih;
		$kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
		$updatenya = mysqli_query($conn,"update keluar set qty='$qty', penerima='$penerima' where  idkeluar='$idk'");
			if ($kurangistocknya&&$updatenya) {
				header('location:keluar.php');
			}else {
				echo "Gagal";
				header('location:keluar.php');
			}
	}
}




//menghapus barang keluar
 if(isset($_POST['hapusbarangkeluar'])){
 	$idb = $_POST['idb'];
 	$qty = $_POST['kty'];
 	$idk = $_POST['idk'];

	$getdatastock = mysqli_query($conn,"select * from stock where idbarang='$idb'");
	$data = mysqli_fetch_array($getdatastock);
	$stok = $data['stock'];

	$selisih = $stok+$qty;

 	$update = mysqli_query($conn, "update stock set stock='$selisih' where idbarang='$idb'");
 	$hapusdata = mysqli_query($conn, "delete from keluar where idkeluar='$idk'");

 	if($update&&$hapusdata){
 		header('location:keluar.php');
 	}else{
 		echo "Gagal";
 		header('location:keluar.php');
 	}
 
 }




//menambah admin baru
 if (isset($_POST['addadmin'])) {
 	$username = $_POST['username'];
 	$password = $_POST['password'];

 	$queryinsert = mysqli_query($conn, "insert into users (username, password) values('username','password')");

 	if ($queryinsert) {
 		header('location:admin.php');
 	} else {
 		header('location:admin.php');
 	}
 }


//edit data admin
 if (isset($_POST['updateadmin'])) {
 	$usernamebaru = $_POST['usernameadmin'];
 	$passwordbaru = $_POST['passwordbaru'];
 	$idnya = $_POST['id'];

 	$queryupdate = mysqli_query($conn,"update users set username='$usernamebaru', password='$passwordbaru' where user_id='$idnya'");

 	if ($queryupdate) {
 		header('location:admin.php');
 	} else{
 		header('location:admin.php');
 	}
 }


 //hapus admin
 if (isset($_POST['hapusadmin'])) {
 	$id = $_POST['id'];

 	$querydelete = mysqli_query($conn,"delete from users where user_id='$id'");

 	if ($querydelete) {
 		header('location:admin.php');
 	} else{
 		header('location:admin.php');
 	}
 }



//menambah request barang baru
if(isset($_POST['addnewbarangrequest'])){
	$namabarang = $_POST['namabarang'];
	$deskripsi = $_POST['deskripsi'];
	$stock = $_POST['stock'];

	$addtotable = mysqli_query($conn,"insert into request (namabarang, deskripsi, stock) values('$namabarang','$deskripsi','$stock')");
	if ($addtotable) {
		header('location:request.php');
	} else {
		echo "Gagal";
		header('location:request.php');
	}
};

//Update info barang request
if (isset($_POST['updatebarang'])) {
	$idb = $_POST['idb'];
	$namabarang  = $_POST['namabarang'];
	$deskripsi = $_POST['deskripsi'];
	$stock = $_POST['stock'];

	$update = mysqli_query($conn,"update request set namabarang='$namabarang', deskripsi='$deskripsi', stock='$stock' where idbarang ='$idb'");
	if ($update) {
		header('location:request.php');
	}else {
		echo "Gagal";
		header('location:request.php');
	}
}


//menghapus barang request
if (isset($_POST['hapusbarang'])) {
	$idb = $_POST['idb'];

	$hapus = mysqli_query($conn, "delete from request where idbarang='$idb'");
	if ($hapus) {
		header('location:request.php');
	}else {
		echo "Gagal";
		header('location:request.php');
	}
}


?>