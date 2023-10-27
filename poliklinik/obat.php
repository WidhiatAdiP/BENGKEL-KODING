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
    
    <title>Form Pengisian Data Obat</title>   <!--Judul Halaman-->
</head>
<body>
<div class="container">
<h3>
    Form Pengisian Data Obat
</h3>
<hr>    
<!--Form Input Data-->

<form class="form" method="POST" action="" name="myForm" onsubmit="return(validate());">
    <!-- Kode php untuk menghubungkan form dengan database -->
    <?php
    $nama_obat = '';
    $jenis_obat ='';
    $tanggal_kedaluarsa = '';
    $dosis_obat = '';
    if (isset($_GET['id'])) {
        $ambil = mysqli_query($koneksi, 
        "SELECT * FROM obat 
        WHERE id='" . $_GET['id'] . "'");
        while ($row = mysqli_fetch_array($ambil)) {
            $nama_obat = $row['nama_obat'];
            $jenis_obat = $row['jenis_obat'];
            $tanggal_kedaluarsa = $row['tanggal_kedaluarsa'];
            $dosis_obat = $row['dosis_obat'];
        }
    ?>
        <input type="hidden" name="id" value="<?php echo
        $_GET['id'] ?>">
    <?php
    }
    ?>
    <div class="col">
        <label for="inputNamaObat" class="form-label fw-bold">
            Nama Obat
        </label>
        <input type="text" class="form-control" name="nama_obat" id="inputNamaObat" placeholder="NamaObat" value="<?php echo $nama_obat ?>">
    </div>
        <div class="col">
            <label for="inputJenisObat" class="form-label fw-bold">
                Jenis Obat
            </label>
            <input type="text" class="form-control" name="jenis_obat" id="inputJenisObat" placeholder="InputJenisObat" value="<?php echo $jenis_obat ?>">
        </div>
        <div class="col">
            <label for="inputTanggalKedaluarsa" class="form-label fw-bold">
                Tanggal Kedaluarsa
            </label>
            <input type="date" class="form-control" name="tanggal_kedaluarsa" id="inputTanggalKedaluarsa" placeholder="InputTanggalKedaluarsa" value="<?php echo $tanggal_kedaluarsa ?>">
        </div>
        <div class="col">
            <label for="inputDosisObat" class="form-label fw-bold">
                Dosis Obat
            </label>
            <input type="text" class="form-control" name="dosis_obat" id="inputDosisObat" placeholder="InputDosisObat" value="<?php echo $dosis_obat ?>">
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
            <th scope="col">Nama Obat</th>
            <th scope="col">Jenis Obat</th>
            <th scope="col">Tanggal Kedaluarsa</th>
            <th scope="col">Dosis Obat</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <!--tbody berisi isi tabel sesuai dengan judul atau head-->
    <tbody>
        <!-- Kode PHP untuk menampilkan semua isi dari tabel urut
        berdasarkan status dan tanggal awal-->
        <?php
        $result = mysqli_query(
            $koneksi,"SELECT * FROM obat ORDER BY nama_obat"
            );
        $no = 1;
        foreach ($result as $data){
        ?>
            <tr>
                <th scope="row"><?php echo $no++ ?></th>
                <td><?php echo htmlspecialchars($data['nama_obat']) ?></td>
                <td><?php echo htmlspecialchars($data['jenis_obat']) ?></td>
                <td><?php echo htmlspecialchars($data['tanggal_kedaluarsa']) ?></td>
                <td><?php echo htmlspecialchars($data['dosis_obat']) ?></td>
                <td>
                    <a class="btn btn-info rounded-pill px-3" 
                    href="obat.php?id=<?php echo $data['id'] ?>">Ubah
                    </a>
                    <a class="btn btn-danger rounded-pill px-3" 
                    href="obat.php?id=<?php echo $data['id'] ?>&aksi=hapus">Hapus
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
        $ubah = mysqli_query($koneksi, "UPDATE obat SET 
                                        nama_obat = '" . $_POST['nama_obat'] . "',
                                        jenis_obat = '" . $_POST['jenis_obat'] . "',
                                        tanggal_kedaluarsa = '" . $_POST['tanggal_kedaluarsa'] . "',
                                        dosis_obat = '" . $_POST['dosis_obat'] . "'
                                        WHERE
                                        id = '" . $_POST['id'] . "'");
    } else {
        $tambah = mysqli_query($koneksi, "INSERT INTO obat (`nama_obat`,`jenis_obat`,`tanggal_kedaluarsa`,`dosis_obat`) 
                                        VALUES ( 
                                            '" . $_POST['nama_obat'] . "',
                                            '" . $_POST['jenis_obat'] . "',
                                            '" . $_POST['tanggal_kedaluarsa'] . "',
                                            '" . $_POST['dosis_obat'] . "'
                                            )");
    }

    echo "<script> 
            document.location='obat.php';
            </script>";
}

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        $hapus = mysqli_query($koneksi, "DELETE FROM obat WHERE id = '" . $_GET['id'] . "'");
    } else if ($_GET['aksi'] == 'ubah_status') {
        $ubah_status = mysqli_query($koneksi, "UPDATE obat SET 
                                        status = '" . $_GET['status'] . "' 
                                        WHERE
                                        id = '" . $_GET['id'] . "'");
    }

    echo "<script> 
            document.location='obat.php';
            </script>";
}
?>
</body>
</html>