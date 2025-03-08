<!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Input Jenis Barang</h1>
        <div class="row">
            <div class="col-lg-12">
                <!-- Circle Buttons -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Jenis Barang</h6>
                    </div>
                    <div class="card-body">
                        <p>Masukkan data yang benar!</p>
                        <form role="form" class="margin-top-20" method="post" enctype="multipart/form-data" action="<?php $_SERVER['PHP_SELF'];?>">
                            <?php
                                if(isset($_POST['btnSimpan'])){
                                    $nama = $_POST['txtNama'];
                                    // $cek = "INSERT INTO jenis {nama_jenis} VALUES {:nama}";
                                    // $simpan=$pdo->prepare($cek); 
                                    // $hasil=$simpan->execute(array(
                                    //     ':nama' => $_POST['txtNama']
                                    // ));
                                    $query = "INSERT INTO jenis (nama_jenis) VALUES ('$nama')";
                                    $hasil = mysqli_query($conn, $query);
                                if($hasil){
                                    echo "<div class='alert alert-info'><strong>Success!</strong> Data Berhasil di Input</div><meta http-equiv='refresh' content='1; url= dashboard.php?page=inputjenisbarang'/>";
                                }else{
                                    echo "<div class='alert alert-danger'><strong>Error!</strong> Data gagal ditambahkan !</div>";
                                }
                            }
                            ?>
                        <label> Nama Jenis </label>
                        <input type="text" class="form-control" name="txtNama" placeholder="Masukkan nama jenis barang"></input>
                        <br>
                                    
                        <button type="submit" name="btnSimpan" class="btn btn-success btn-circle">
                            <i class="fas fa-save"></i>
                        </button>
                                    
                        <button type="reset" class="btn btn-danger btn-circle">
                            <i class="fa fa-times-circle"></i>
                        </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
