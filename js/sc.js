function toggleSidebar() {
    const sidebar = document.querySelector('.sidebar');
    const mainContent = document.querySelector('.main-content');
    
    sidebar.classList.toggle('closed');
    if (sidebar.classList.contains('closed')) {
        mainContent.style.marginLeft = '0px';
    } else {
        mainContent.style.marginLeft = '250px';
    }
}

document.getElementById("search-barang").addEventListener("keyup", function() {
    let input = this.value.toLowerCase();
    let items = document.querySelectorAll(".daftar-list-barang-beli");

    items.forEach(item => {
        let namaBarang = item.getAttribute("data-nama");
        if (namaBarang.includes(input)) {
            item.style.display = "flex";
        } else {
            item.style.display = "none";
        }
    });
});



function hapus(id) {
    Swal.fire({
        title: "Apakah kamu yakin?",
        text: "Barang yang dihapus tidak dapat dikembalikan!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Hapus",
        cancelButtonText: "Batal"
    }).then((result) => {
        if (result.isConfirmed) {
            fetch('hapus.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'id=' + id
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        title: "Dihapus!",
                        text: "Barang kamu telah dihapus.",
                        icon: "success"
                    }).then(() => {
                        refreshTabel();
                    });
                } else {
                    Swal.fire({
                        title: "Gagal!",
                        text: "Barang gagal dihapus.",
                        icon: "error"
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    title: "Error!",
                    text: "Terjadi kesalahan saat menghapus barang.",
                    icon: "error"
                });
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire({
                title: "Dibatalkan",
                text: "Barang kamu gak jadi dihapus!",
                icon: "error"
            });
        }
    });
}

function edit(id) {
    fetch('ambil_barang.php?id=' + id)
        .then(response => response.json())
        .then(data => {
            Swal.fire({
                title: "Edit Barang",
                html: `
                    <input type="text" id="nama" class="swal2-input" placeholder="Nama Barang" value="${data.nama_barang}">
                    <input type="text" id="harga" class="swal2-input" placeholder="Harga Barang" value="${data.harga}">
                    <input type="text" id="varian" class="swal2-input" placeholder="Varian Barang" value="${data.varian}">
                    <input type="text" id="stok" class="swal2-input" placeholder="Stok Barang" value="${data.stok}">
                `,
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                icon: "info",
                confirmButtonText: "Simpan",
                cancelButtonText: "Batal",
                focusConfirm: false,
                preConfirm: () => {
                    return {
                        id: id,
                        nama: document.getElementById("nama").value,
                        harga: document.getElementById("harga").value,
                        varian: document.getElementById("varian").value,
                        stok: document.getElementById("stok").value
                    };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    let formData = new FormData();
                    formData.append("id", id);
                    formData.append("nama", result.value.nama);
                    formData.append("harga", result.value.harga);
                    formData.append("varian", result.value.varian);
                    formData.append("stok", result.value.stok);

                    fetch('edit_barang.php', {
                        method: "POST",
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                title: "Sukses!",
                                text: "Barang kamu telah diedit.",
                                icon: "success"
                            }).then(() => {
                                refreshTabel();
                            });
                        } else {
                            Swal.fire({
                                title: "Gagal!",
                                text: "Barang gagal diedit.",
                                icon: "error"
                            });
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            title: "Error!",
                            text: "Terjadi kesalahan saat mengedit barang.",
                            icon: "error"
                        });
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire({
                        title: "Dibatalkan",
                        text: "Barang kamu gak jadi diedit!",
                        icon: "error"
                    });
                }
            });
        })
    .catch(error => console.error('Error:', error));
}

function tambah() {
    let nama = document.querySelector('input[name="namabarang"]').value;
    let harga = document.querySelector('input[name="hargabarang"]').value;
    let varian = document.querySelector('input[name="varianbarang"]').value;
    let stok = document.querySelector('input[name="stokbarang"]').value;

    if (!nama || !harga || !varian || !stok) {
        Swal.fire({
            title: "Error!",
            text: "Semua kolom harus diisi!",
            icon: "error"
        });
        return;
    }

    Swal.fire({
        title: "Apakah kamu yakin?",
        text: "Jika ada kesalahan dalam menambahkan, kamu bisa mengeditnya nanti.",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Tambah",
        cancelButtonText: "Batal"
    }).then((result) => {
        if (result.isConfirmed) {
            let formData = new FormData();
            formData.append('namabarang', nama);
            formData.append('hargabarang', harga);
            formData.append('varianbarang', varian);
            formData.append('stokbarang', stok);

            fetch('tambah_barang.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                            title: "Ditambahkan!",
                            text: "Barang kamu telah ditambahkan.",
                            icon: "success"
                        }).then(() => {
                            refreshTabel();
                            document.querySelector('input[name="namabarang"]').value = "";
                            document.querySelector('input[name="hargabarang"]').value = "";
                            document.querySelector('input[name="varianbarang"]').value = "";
                            document.querySelector('input[name="stokbarang"]').value = "";
                        });
                } else {
                    Swal.fire({
                        title: "Gagal!",
                        text: "Barang gagal ditambahkan.",
                        icon: "error"
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    title: "Error!",
                    text: "Terjadi kesalahan saat menambahkan barang.",
                    icon: "error"
                });
            });

        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire({
                title: "Dibatalkan",
                text: "Barang kamu gak jadi ditambahkan!",
                icon: "error"
            });
        }
    });
};

function refreshTabel() {
    fetch('get_barang.php')
    .then(response => response.text())
    .then(data => {
        document.getElementById('barang-table-body').innerHTML = data;
    })
    .catch(error => console.error('Error:', error));
}