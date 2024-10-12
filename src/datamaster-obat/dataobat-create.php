<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apoteku</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="../assets/css/output.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <script defer>
        // Script untuk mengatur dropdown visibility
        function toggleDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId);
            dropdown.classList.toggle('hidden');
        }
    </script>

    
    <?php
if (isset($_POST['submit'])) {
    include('../database/dataobat.php');
    $ID_Obat = $_POST['ID_Obat'];
    $Nama_Obat = $_POST['Nama_Obat'];
    $Code = $_POST['Code'];
    $Formulasi = $_POST['Formulasi'];
    $Tanggal_Kadaluarsa = $_POST['Tanggal_Kadaluarsa'];
    $Stok = $_POST['Stok'];
    $ID_Supplier = $_POST['ID_Supplier'];
    $Status = $_POST['Status'];
    $Package = $_POST['Package'];
    $Harga_Obat = $_POST['Harga_Obat'];
    

    do {
        if (empty($ID_Obat) || empty($Nama_Obat) || empty($Code) || empty($Formulasi) || empty($Tanggal_Kadaluarsa) || empty($Stok) || empty($ID_Supplier) || empty($Status) || empty($Package) || empty($Harga_Obat)) {
        echo "<script>alert('Please fill all the fields')</script>";
        break;
        } else {
            $sql = "INSERT INTO obat(ID_Obat, Nama_Obat, Code, Formulasi, Tanggal_Kadaluarsa, Stok, ID_Supplier, Status, Package, Harga_Obat) VALUES ('$ID_Obat', '$Nama_Obat', '$Code', '$Formulasi', '$Tanggal_Kadaluarsa', '$Stok', '$ID_Supplier', '$Status', '$Package', '$Harga_Obat')";
            if (mysqli_query($conn, $sql)) {
                $successMessage = 'Obat has been created successfully';
            } else {
                echo 'Error: ' . $sql . '<br>' . mysqli_error($conn);
            }
            mysqli_close($conn);
        }
    } while (false);
}
?>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="../assets/css/output.css" rel="stylesheet">
</head>
<body>
        <form method="POST">
            <div class="grid grid-cols-1 gap-4">

            <div>
        <label for="ID_Obat">ID Obat</label>
        <input type="text" name="ID_Obat" class="input input-bordered input-primary w-full max-w-xs">
    </div>

    <div>
        <label for="Nama_Obat">Nama Obat</label>
        <input type="text" name="Nama_Obat" class="input input-bordered input-primary w-full max-w-xs">
    </div>

    <div>
        <label for="Code">Code</label>
        <input type="text" name="Code" class="input input-bordered input-primary w-full max-w-xs">
    </div>

    <div>
        <label for="Formulasi">Formulasi</label>
        <input type="text" name="Formulasi" class="input input-bordered input-primary w-full max-w-xs">
    </div>

    <div>
        <label for="Tanggal_Kadaluarsa">Tanggal Kadaluarsa</label>
        <input type="date" name="Tanggal_Kadaluarsa" class="input input-bordered input-primary w-full max-w-xs">
    </div>

    <div>
        <label for="Stok">Stok</label>
        <input type="number" name="Stok" class="input input-bordered input-primary w-full max-w-xs">
    </div>

    <div>
        <label for="ID_Supplier">ID Supplier</label>
        <input type="text" name="ID_Supplier" class="input input-bordered input-primary w-full max-w-xs">
    </div>

    <div>
        <label for="Status">Status</label>
        <input type="text" name="Status" class="input input-bordered input-primary w-full max-w-xs">
    </div>

    <div>
        <label for="Package">Package</label>
        <input type="text" name="Package" class="input input-bordered input-primary w-full max-w-xs">
    </div>

    <div>
        <label for="Harga_Obat">Harga Obat</label>
        <input type="number" name="Harga_Obat" class="input input-bordered input-primary w-full max-w-xs">
    </div>

            <div>
                <label for="ID_Supplier">ID Supplier</label>
                <select name="ID_Supplier" class="input input-bordered input-primary w-full max-w-xs">
                    <?php
                    include('../database/database.php');
                    $sql = "SELECT * FROM supplier";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<option value="' . $row['ID_Supplier'] . '">' . $row['Nama'] . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>

            <div>
                <button name="submit" type="submit" class="bg-green-500 opacity-95 text-white btn hover:bg-blues hover:opacity-100">
                    Create
                </button>
            </div>
        </div>
    </form>
</body>