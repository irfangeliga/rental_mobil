<?php 

if (!isset($_SESSION['user'])) {
    echo ("<script>location.href = '../login.php';</script>");
}

require_once '../utility.php';
?>
<div class="card shadow">
    <div class="h4 text-center card-header">Data Mobil Telah diupload</div>
    <hr>
    <div class="card-body">
        <div class="text-end">
            <a href="?url=input">
                <div class="btn btn-primary">Tambah Data</div>
            </a>
        </div>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Merk</th>
                <th scope="col">Model</th>
                <th scope="col">Tarif/hari</th>
                <th scope="col">Foto</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $link = "getInput";
                    $data = getApp($link);

                    if ($data && $data->status == '1')
                    foreach ($data->data as $baris) {
                        $no=1;
                        $merk = $baris-> merk;
                        $model = $baris-> model;
                        $tarif = $baris-> tarif;
                        $foto = $baris-> foto;
                        ?>
                <tr>
                <th scope="row"><?=$no++?></th>
                <td><?=$merk?></td>
                <td><?=$model?></td>
                <td><?=$tarif?></td>
                <td><a href="../assets/admin/images/<?=$foto?>">Lihat Foto</a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>