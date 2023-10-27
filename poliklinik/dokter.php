<?php
include_once("koneksi.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, 
    initial-scale=1.0">

    <!-- Bootstrap offline -->

    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel='stylesheet' href='styleku.css'> 

    <!-- Bootstrap Online -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
    crossorigin="anonymous">   
    
    <title>Form Pengisian Data Dokter</title>   <!--Judul Halaman-->
</head>
<body>
<div class="container">
<h3>
    Form Pengisian Data Dokter
</h3>
<hr>    
<!--Form Input Data-->

<form class="form" method="POST" action="" name="myForm" onsubmit="return(validate());">
    <!-- Kode php untuk menghubungkan form dengan database -->
    <?php
    $nama = '';
    $alamat ='';
    $no_hp = '';
    if (isset($_GET['id'])) {
        $ambil = mysqli_query($koneksi, 
        "SELECT * FROM dokter 
        WHERE id='" . $_GET['id'] . "'");
        while ($row = mysqli_fetch_array($ambil)) {
            $nama = $row['nama'];
            $alamat = $row['alamat'];
            $no_hp = $row['no_hp'];
        }
    ?>
        <input type="hidden" name="id" value="<?php echo
        $_GET['id'] ?>">
    <?php
    }
    ?>
    <div class="col">
        <label for="inputNama" class="form-label fw-bold">
            Nama
        </label>
        <input type="text" class="form-control" name="nama" id="inputNama" placeholder="Nama" value="<?php echo $nama ?>">
    </div>
        <div class="col">
            <label for="inputAlamat" class="form-label fw-bold">
                Alamat
            </label>
            <input type="text" class="form-control" name="alamat" id="inputAlamat" placeholder="Alamat" value="<?php echo $alamat ?>">
        </div>
        <div class="col">
            <label for="inputNoHp" class="form-label fw-bold">
                Nomor HP
            </label>
            <input type="text" class="form-control" name="no_hp" id="inputNoHp" placeholder="Nomor HP" value="<?php echo $no_hp ?>">
        </div>
        <br>
        <div class="col">
            <button type="submit" class="btn btn-primary rounded-pill px-3" name="simpan">Simpan</button>
        </div>
</br>
</form>
<!-- Table-->
<table class="table table-hover">
    <!--thead atau baris judul-->
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama</th>
            <th scope="col">Alamat</th>
            <th scope="col">No HP</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <!--tbody berisi isi tabel sesuai dengan judul atau head-->
    <tbody>
        <!-- Kode PHP untuk menampilkan semua isi dari tabel urut
        berdasarkan status dan tanggal awal-->
        <?php
        $result = mysqli_query(
            $koneksi,"SELECT * FROM dokter ORDER BY nama"
            );
        $no = 1;
        foreach ($result as $data){
        ?>
            <tr>
                <th scope="row"><?php echo $no++ ?></th>
                <td><?php echo htmlspecialchars($data['nama']) ?></td>
                <td><?php echo htmlspecialchars($data['alamat']) ?></td>
                <td><?php echo htmlspecialchars($data['no_hp']) ?></td>
                <td>
                    <a class="btn btn-info rounded-pill px-3" 
                    href="dokter.php?id=<?php echo $data['id'] ?>">Ubah
                    </a>
                    <a class="btn btn-danger rounded-pill px-3" 
                    href="dokter.php?id=<?php echo $data['id'] ?>&aksi=hapus">Hapus
                    </a>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>
<?php
if (isset($_POST['simpan'])) {
    if (isset($_POST['id'])) {
        $ubah = mysqli_query($koneksi, "UPDATE dokter SET 
                                        nama = '" . $_POST['nama'] . "',
                                        alamat = '" . $_POST['alamat'] . "',
                                        no_hp = '" . $_POST['no_hp'] . "'
                                        WHERE
                                        id = '" . $_POST['id'] . "'");
    } else {
        $tambah = mysqli_query($koneksi, "INSERT INTO dokter (`nama`,`alamat`,`no_hp`) 
                                        VALUES ( 
                                            '" . $_POST['nama'] . "',
                                            '" . $_POST['alamat'] . "',
                                            '" . $_POST['no_hp'] . "'
                                            )");
    }

    echo "<script> 
            document.location='dokter.php';
            </script>";
}

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        $hapus = mysqli_query($koneksi, "DELETE FROM dokter WHERE id = '" . $_GET['id'] . "'");
    } else if ($_GET['aksi'] == 'ubah_status') {
        $ubah_status = mysqli_query($koneksi, "UPDATE dokter SET 
                                        status = '" . $_GET['status'] . "' 
                                        WHERE
                                        id = '" . $_GET['id'] . "'");
    }

    echo "<script> 
            document.location='dokter.php';
            </script>";
}
?>
</body>
</html>