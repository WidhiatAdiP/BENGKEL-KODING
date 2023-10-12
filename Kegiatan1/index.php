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

    <!-- Bootstrap Online -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
    crossorigin="anonymous">   
    
    <title>To Do List</title>   <!--Judul Halaman-->
</head>
<body>
<div class="container">
<h3>
    To Do List
    <small class="text-muted">
        Catat semua hal yang akan kamu kerjakan disini.
    </small>
</h3>
<hr>    
<!--Form Input Data-->

<form class="form row" method="POST" action="" name="myForm" onsubmit="return(validate());">
    <!-- Kode php untuk menghubungkan form dengan database -->
    <?php
    $isi = '';
    $nama ='';
    $tgl_awal = '';
    $tgl_akhir = '';
    if (isset($_GET['id'])) {
        $ambil = mysqli_query($mysqli, 
        "SELECT * FROM kegiatan 
        WHERE id='" . $_GET['id'] . "'");
        while ($row = mysqli_fetch_array($ambil)) {
            $isi = $row['isi'];
            $nama = $row['nama'];
            $tgl_awal = $row['tgl_awal'];
            $tgl_akhir = $row['tgl_akhir'];
        }
    ?>
        <input type="hidden" name="id" value="<?php echo
        $_GET['id'] ?>">
    <?php
    }
    ?>
    <div class="col">
        <label for="inputIsi" class="form-label fw-bold">
            Kegiatan
        </label>
        <input type="text" class="form-control" name="isi" id="inputIsi" placeholder="Kegiatan" value="<?php echo $isi ?>">
    </div>
    <div class="col">
        <label for="inputNama" class="form-label fw-bold">
            Nama
        </label>
        <input type="text" class="form-control" name="nama" id="inputNama" placeholder="Nama" value="<?php echo $nama ?>">
    </div>
    <div class="col">
        <label for="inputTanggalAwal" class="form-label fw-bold">
            Tanggal Awal
        </label>
        <input type="date" class="form-control" name="tgl_awal" id="inputTanggalAwal" placeholder="Tanggal Awal" value="<?php echo $tgl_awal ?>">
    </div>
    <div class="col mb-2">
        <label for="inputTanggalAkhir" class="form-label fw-bold">
        Tanggal Akhir
        </label>
        <input type="date" class="form-control" name="tgl_akhir" id="inputTanggalAkhir" placeholder="Tanggal Akhir" value="<?php echo $tgl_akhir ?>">
    </div>
    <div class="col">
        <button type="submit" class="btn btn-primary rounded-pill px-3" name="simpan">Simpan</button>
    </div>
</form>
<!-- Table-->
<table class="table table-hover">
    <!--thead atau baris judul-->
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Kegiatan</th>
            <th scope="col">Nama</th>
            <th scope="col">Awal</th>
            <th scope="col">Akhir</th>
            <th scope="col">Status</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <!--tbody berisi isi tabel sesuai dengan judul atau head-->
    <tbody>
        <!-- Kode PHP untuk menampilkan semua isi dari tabel urut
        berdasarkan status dan tanggal awal-->
        <?php
        $result = mysqli_query(
            $mysqli,"SELECT * FROM kegiatan ORDER BY status,tgl_awal"
            );
        $no = 1;
        foreach ($result as $data){
        ?>
            <tr>
                <th scope="row"><?php echo $no++ ?></th>
                <td><?php echo htmlspecialchars($data['isi']) ?></td>
                <td><?php echo htmlspecialchars($data['nama']) ?></td>
                <td><?php echo htmlspecialchars($data['tgl_awal']) ?></td>
                <td><?php echo htmlspecialchars($data['tgl_akhir']) ?></td>
                <td>
                    <?php
                    if ($data['status'] == '1') {
                    ?>
                        <a class="btn btn-success rounded-pill px-3" type="button" 
                        href="index.php?id=<?php echo $data['id'] ?>&aksi=ubah_status&status=0">
                        Sudah
                        </a>
                    <?php
                    } else {
                    ?>
                        <a class="btn btn-warning rounded-pill px-3" type="button" 
                        href="index.php?id=<?php echo $data['id'] ?>&aksi=ubah_status&status=1">
                        Belum</a>
                    <?php
                    }
                    ?>
                </td>
                <td>
                    <a class="btn btn-info rounded-pill px-3" 
                    href="index.php?id=<?php echo $data['id'] ?>">Ubah
                    </a>
                    <a class="btn btn-danger rounded-pill px-3" 
                    href="index.php?id=<?php echo $data['id'] ?>&aksi=hapus">Hapus
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
        $ubah = mysqli_query($mysqli, "UPDATE kegiatan SET 
                                        isi = '" . $_POST['isi'] . "',
                                        nama = '" . $_POST['nama'] . "',
                                        tgl_awal = '" . $_POST['tgl_awal'] . "',
                                        tgl_akhir = '" . $_POST['tgl_akhir'] . "'
                                        WHERE
                                        id = '" . $_POST['id'] . "'");
    } else {
        $tambah = mysqli_query($mysqli, "INSERT INTO kegiatan(isi,nama,tgl_awal,tgl_akhir,status) 
                                        VALUES ( 
                                            '" . $_POST['isi'] . "',
                                            '" . $_POST['nama'] . "',
                                            '" . $_POST['tgl_awal'] . "',
                                            '" . $_POST['tgl_akhir'] . "',
                                            '0'
                                            )");
    }

    echo "<script> 
            document.location='index.php';
            </script>";
}

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        $hapus = mysqli_query($mysqli, "DELETE FROM kegiatan WHERE id = '" . $_GET['id'] . "'");
    } else if ($_GET['aksi'] == 'ubah_status') {
        $ubah_status = mysqli_query($mysqli, "UPDATE kegiatan SET 
                                        status = '" . $_GET['status'] . "' 
                                        WHERE
                                        id = '" . $_GET['id'] . "'");
    }

    echo "<script> 
            document.location='index.php';
            </script>";
}
?>
</body>
</html>