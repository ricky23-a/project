<?php
    include '../config.php';
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    
        $query = "DELETE FROM barang WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
    
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);
    
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                header("Location: dashboard.php?page=databarang&success=1");
                exit();
            } else {
                echo "<script>alert('Data gagal dihapus!'); window.location.href='dashboard.php?page=databarang';</script>";
            }
    
            mysqli_stmt_close($stmt);
        } else {
            echo "<script>alert('Query gagal!'); window.location.href='dashboard.php?page=databarang';</script>";
        }
    } else {
        echo "<script>alert('ID tidak ditemukan!'); window.location.href='dashboard.php?page=databarang';</script>";
    }
    
    mysqli_close($conn);
?>