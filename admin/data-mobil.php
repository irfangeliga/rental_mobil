<?php 

if (!isset($_SESSION['user'])) {
    echo ("<script>location.href = '../login.php';</script>");
}

require_once '../utility.php';

$info   = "";
$merk   = "";
$model  = "";
$tarif  = "";
$id     = "";
$foto   = "";
$type   = "insert";
if(isset($_GET['type'])){
    $type = $_GET['type'];
}

if ($type == 'del') {
    $id = $_GET['id'];
    $link = "setInput&id=" . urlencode($_GET['id']) . "&type=delete";
    $data = getApp($link);
    if ($data && $data->status == '1') {
        $info = "Delete data success";
        echo ("<script>alert('$info')</script>");
        echo ("<script>location.href = '?url=data-mobil';</script>");
    } else {
        $info .= "Delete data failed";
        echo ("<script>alert('$info')</script>");
    }
}

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $link = "getInputId&id=" . urlencode($id);
    $data = getApp($link);
    if ($data && $data->status == '1') {
        $merk = $data->data[0]-> merk;
        $model = $data->data[0]-> model;
        $tarif = $data->data[0]-> tarif;
        $foto = $data->data[0]-> foto;
    } else {
        $info .= " Data Not Found";
        echo ("<script>alert('$info')</script>");
    }
}
if(isset($_POST['submit'])){
    if(!isset($_GET['id'])){
        $id="";
    }else{
        $id = $_GET['id'];
    }
    $merk   = $_POST['merk'];
    $model  = $_POST['model'];
    $plat   = $_POST['plat'];
    $tarif  = str_replace(".", "", $_POST['tarif']);

    $direktori = "../assets/admin/images/";
    $file_name = $_FILES['foto']['name'];
    move_uploaded_file($_FILES['foto']['tmp_name'], $direktori.$file_name);

    if ($merk && $model && $plat && $tarif) {
        if ($type == 'insert' || $type == 'update') {
            $link = "setInput&id=" . urlencode($id) . "&merk=" . urlencode($merk). "&model=" . urlencode($model) . "&plat=" . urlencode($plat) . "&tarif=" . urlencode($tarif) . "&type=" . urlencode($type) . "&foto=" . urlencode($file_name) ;
            $data = getAdmin($link);
                if ($data && $data->status == 1) {
                    $info = $type . " data success";
                    echo ("<script>alert('$info')</script>");
                    echo ("<script>location.href = '?url=read-mobil';</script>");
                } else
                    $info = "Terjadi Kesalahan, Coba beberapa saat lagi";
                    echo ("<script>alert('$info')</script>");
        } else
        echo ("<script>alert('Data invalid')</script>");
    } else
        echo ("<script>alert('Data Tidak Boleh Kosong')</script>");

}

?>

    <div class="card rounded shadow">
        <h4 class="text-center card-title mt-3">Input Data Mobil</h4>
        <hr>
        <div class="card-body">
            <form class="p-3" action="" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="merk" class="form-label">Merk</label>
                    <input type="text" name="merk" id="merk" value="<?=$merk?>" class="form-control form-control-sm" >
                    
                </div>
                <div class="mb-3">
                    <label for="model" class="form-label">Model</label>
                    <input type="text" name="model" id="model" value="<?=$merk?>" class="form-control form-control-sm" >
                    
                </div>
                <div class="mb-3">
                    <label for="plat" class="form-label">Nomor Plat</label>
                    <input type="text" name="plat" id="plat" value="<?=$merk?>" class="form-control form-control-sm" >
                    
                </div>
                <div class="mb-3">
                    <label for="tarif" class="form-label">Tarif Per Hari</label>
                    <input type="text" name="tarif" id="harga" value="<?=$tarif?>" class="form-control form-control-sm" >
                    
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label">Foto Mobil</label>
                    <input type="file" name="foto" id="foto" class="form-control form-control-sm" >
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    
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
                    <th scope="col">action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $link = "getInput";
                        $data = getApp($link);

                        if ($data && $data->status == '1')
                        foreach ($data->data as $baris) {
                            $no=1;
                            $id = $baris-> id;
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
                        <td>
                            <a href="?url=data-mobil&type=del&id=<?=$id?>"><div class="btn btn-danger">Delete</div></a>
                            <a href="?url=data-mobil&type=up&id=<?=$id?>"><div class="btn btn-info">Edit</div></a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
         var rupiah = document.getElementById('harga');
        rupiah.addEventListener('keyup', function (e) {
            rupiah.value = formatRupiah(this.value);
        });

        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
        }
    </script>