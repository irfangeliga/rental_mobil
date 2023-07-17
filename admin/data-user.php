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
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Telepon</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Email</th>
                    <th scope="col">Password</th>
                    <th scope="col">No SIM</th>
                    <th scope="col">Status</th>
                    <th scope="col">action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $link = "getUser";
                        $data = getApp($link);

                        if ($data && $data->status == '1')
                        foreach ($data->data as $baris) {
                            $no=1;
                            $id = $baris-> id;
                            $email = $baris-> email;
                            $password = $baris-> password;
                            $nama = $baris-> nama;
                            $alamat = $baris-> alamat;
                            $telepon = $baris-> telepon;
                            $no_sim = $baris-> no_sim;
                            $status = $baris-> status;
                            ?>
                    <tr>
                        <th scope="row"><?=$no++?></th>
                        <td><?=$nama?></td>
                        <td><?=$telepon?></td>
                        <td><?=$alamat?></td>
                        <td><?=$email?></td>
                        <td><?=$password?></td>
                        <td><?=$no_sim?></td>
                        <td><?=$status?></td>
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