                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Data Barang</h1>
                    <p class="mb-4">Data di bawah ini merupakan halaman melihat data barang</p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <?php
                                if (isset($_GET['success']) && $_GET['success'] == 1) {
                                    echo "<div class='alert alert-info'><strong>Success!</strong> Data Berhasil Dihapus</div><meta http-equiv='refresh' content='1; url= dashboard.php?page=databarang'/>";
                                }
                                ?>

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>Stok Barang</th>
                                            <th>Harga Beli</th>
                                            <th>Harga Jual</th>
                                            <th>Kategori Barang</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $no=1;
                                            $query = "SELECT * FROM barang";
                                            $result = mysqli_query($conn, $query);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                        
                                            echo "<tr>";    
                                            echo "<td>" . $no . "</td>";
                                            echo "<td>" . $row['nama_barang'] . "</td>";
                                            echo "<td>" . $row['stok'] . "</td>";
                                            echo "<td>Rp. " . number_format($row['harga_beli'], 0, ',', '.') . "</td>";
                                            echo "<td>Rp. " . number_format($row['Harga_jual'], 0, ',', '.') . "</td>";
                                            echo "<td>" . $row['kategori'] . "</td>";
                                            echo "<td>
                                                    <a href='hapus_barang.php?id=" . $row['id'] . "' class='btn btn-danger btn-circle'>
                                                    <i class='fa fa-times-circle'></i>
                                                    </a>
                                                </td>";
                                            echo "</tr>";
                                            $no++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->