                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Data Jenis Barang</h1>
                    <p class="mb-4">Data di bawah ini merupakan halaman melihat data jenis barang</p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <?php
                                if (isset($_GET['success']) && $_GET['success'] == 1) {
                                    echo "<div class='alert alert-info'><strong>Success!</strong> Data Berhasil dihapus</div>";
                                }
                                ?>

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Jenis</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <!-- <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Jenis</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot> -->
                                    <tbody>
                                        <?php
                                            $no=1;
                                            $query = "SELECT * FROM jenis";
                                            $result = mysqli_query($conn, $query);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                        
                                            echo "<tr>";    
                                            echo "<td>" . $no . "</td>";
                                            echo "<td>" . $row['nama_jenis'] . "</td>";
                                            echo "<td>
                                                    <a href='hapus_jenis.php?id=" . $row['id_jenis'] . "' class='btn btn-danger btn-circle'>
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