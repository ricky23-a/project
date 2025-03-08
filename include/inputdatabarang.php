<!-- Begin Page Content -->
<div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Input Data Barang</h1>
        <div class="row">
            <div class="col-lg-12">
                <!-- Circle Buttons -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Data Barang</h6>
                    </div>
                    <div class="card-body">
                        <p>Masukkan data yang benar!</p>
                        <form role="form" class="margin-top-20" method="post" enctype="multipart/form-data" action="<?php $_SERVER['PHP_SELF'];?>">
                            <?php
                                if(isset($_POST['btnSimpan'])){
                                    $nama = $_POST['txtNamabarang'];
                                    $stok = $_POST['txtStokbarang'];
                                    $hb = $_POST['txtHargabelibarang'];
                                    $hj = $_POST['txtHargajualbarang'];
                                    $kategori = $_POST['txtKategoribarang'];

                                    if ($hb > $hj) {
                                        echo "<div class='alert alert-danger'><strong>Error!</strong> Harga beli lebih dari harga beli barang !</div><meta http-equiv='refresh' content='1; url= dashboard.php?page=inputdatabarang'/>";
                                    } else {
                                        $query = "INSERT INTO barang (nama_barang, stok, harga_beli, Harga_jual, kategori) VALUES ('$nama', '$stok', '$hb', '$hj', '$kategori')";
                                        $hasil = mysqli_query($conn, $query);

                                        if ($hasil) {
                                            echo "<div class='alert alert-info'><strong>Success!</strong> Data Berhasil di Input</div><meta http-equiv='refresh' content='1; url= dashboard.php?page=inputdatabarang'/>";
                                        } else {
                                            echo "<div class='alert alert-danger'><strong>Error!</strong> Data gagal ditambahkan !</div>";
                                        }
                                    }
                                }
                            ?>
                        <label> Nama Barang </label>
                        <input type="text" class="form-control" name="txtNamabarang" placeholder="Masukkan nama barang" required></input>
                        <br>
                        
                        <label> Stok Barang </label>
                        <input type="text" class="form-control" name="txtStokbarang" placeholder="Masukkan stok barang" required></input>
                        <br>

                        <label> Harga Beli (Rp.) </label>
                        <input type="text" class="form-control" name="txtHargabelibarang" placeholder="Masukkan harga beli barang" required></input>
                        <br>

                        <label> Harga Jual (Rp.) </label>
                        <input type="text" class="form-control" name="txtHargajualbarang" placeholder="Masukkan harga jual barang" required></input>
                        <br>
                        
                        <label>Kategori Barang</label>
                        <select class="form-control" name="txtKategoribarang" required>
                            <option value="">-- Pilih Kategori --</option>
                            <?php
                            $query = "SELECT * FROM jenis";
                            $result = mysqli_query($conn, $query);
                            
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='" . $row['nama_jenis'] . "'>" . $row['nama_jenis'] . "</option>";
                            }
                            ?>
                        </select>
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
