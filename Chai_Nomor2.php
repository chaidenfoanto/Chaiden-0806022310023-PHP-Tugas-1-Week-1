<?php
session_start(); // mulai session

// inisialisasi array kosong jika tidak ada array dalam session
if (!isset($_SESSION['nums1'])) {
    $_SESSION['nums1'] = [];
}
if (!isset($_SESSION['nums2'])) {
    $_SESSION['nums2'] = [];
}

// deklarasi erorr message di variabel m dan n
$error_m = '';
$error_n = '';

// masukkan angka ke dalam array nums1 jika method nya post
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nums1'])) {
    $angka1 = intval($_POST['nums1']); // Mengubah input ke integer
    array_push($_SESSION['nums1'], $angka1); // Menyimpan ke array nums1 di session
}

// masukkan angka ke dalam array nums2 jika method nya post
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nums2'])) {
    $angka2 = intval($_POST['nums2']); // Mengubah input ke integer
    array_push($_SESSION['nums2'], $angka2); // Menyimpan ke array nums2 di session
}

// reset data session
if (isset($_POST['reset'])) {
    $_SESSION['nums1'] = [];
    $_SESSION['nums2'] = [];
    $_SESSION['sorted'] = [];
}

// proses merge dan sorting by variabel m dan n
if (isset($_POST['m']) && isset($_POST['n'])) {
    $m = intval($_POST['m']);
    $n = intval($_POST['n']);
    
    // Mengecek apakah nilai m valid (tidak lebih dari jumlah elemen di nums1)
    if ($m > count($_SESSION['nums1'])) {
        $error_m = "Nilai m tidak boleh lebih dari " . count($_SESSION['nums1']);
    }

    // Mengecek apakah nilai n valid (tidak lebih dari jumlah elemen di nums2)
    if ($n > count($_SESSION['nums2'])) {
        $error_n = "Nilai n tidak boleh lebih dari " . count($_SESSION['nums2']);
    }

    // Jika tidak ada error, lakukan merge dan sort
    if (empty($error_m) && empty($error_n)) {
        // Ambil elemen sesuai m dan n
        $valid_nums1 = array_slice($_SESSION['nums1'], 0, $m);
        $valid_nums2 = array_slice($_SESSION['nums2'], 0, $n);

        // merge array
        $merged_array = array_merge($valid_nums1, $valid_nums2);

        // sort array
        sort($merged_array);

        // save hasil ke session
        $_SESSION['sorted'] = $merged_array;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chaiden Nomor 2</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        h1 {
            text-align: center;
            color: #4CAF50;
        }
        h5{
            text-align: center;
        }
        form {
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        }
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .results, .array-data {
            margin-top: 20px;
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        pre {
            background-color: #f1f1f1;
            padding: 10px;
            border-radius: 5px;
            overflow-x: auto;
        }
        .reset-button {
            background-color: #f44336;
            margin-top: 20px;
        }
        .reset-button:hover {
            background-color: #e53935;
        }
        .error-message {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Nomor 2 - ELearn</h1>
        <h5>by Loverboy Chaiden🤘🏻</h5>

        <!-- form input untuk nums1 -->
        <form method="POST" action="">
            <label for="nums1">Masukkan nilai untuk <i>nums1</i> :</label>
            <input type="number" id="nums1" name="nums1" required>
            <input type="submit" value="Tambah ke nums1">
        </form>

        <!-- form input untuk nums2 -->
        <form method="POST" action="">
            <label for="nums2">Masukkan nilai untuk <i>nums2</i> :</label>
            <input type="number" id="nums2" name="nums2" required>
            <input type="submit" value="Tambah ke nums2">
        </form>

        <!-- menampilkan data nums1 dan nums2 -->
        <div class="array-data">
            <h3>Array <i>nums1</i> :</h3>
            <pre><?php print_r($_SESSION['nums1']); ?></pre>

            <h3>Array <i>nums2</i> :</h3>
            <pre><?php print_r($_SESSION['nums2']); ?></pre>
        </div>

        <!-- form input untuk m dan n -->
        <h3>Gabungkan dan Urutkan Array:</h3>
        <form method="POST" action="">
            <label for="m">Masukkan nilau (m) untuk elemen <i>nums1</i> :</label>
            <input type="number" id="m" name="m" required>
            <!-- error message untuk m -->
            <?php if (!empty($error_m)): ?>
                <p class="error-message"><?php echo $error_m; ?></p>
            <?php endif; ?>

            <label for="n">Masukkan nilau (n) untuk elemen <i>nums2</i> :</label>
            <input type="number" id="n" name="n" required>
            <!-- error message untuk n -->
            <?php if (!empty($error_n)): ?>
                <p class="error-message"><?php echo $error_n; ?></p>
            <?php endif; ?>

            <input type="submit" value="Merge and Sort">
        </form>

        <!-- menampilkan hasil merge dan sort -->
        <?php if (isset($_SESSION['sorted']) && !empty($_SESSION['sorted'])): ?>
        <div class="results">
            <h3>Hasil Merge & Sorting:</h3>
            <pre><?php echo "[" . implode(",", $_SESSION['sorted']) . ",]"; ?></pre>
        </div>
        <?php endif; ?>

        <!-- tombol untuk reset data session -->
        <form method="POST" action="">
            <input type="hidden" name="reset" value="1">
            <input type="submit" value="Reset Data" class="reset-button">
        </form>
    </div>
</body>
</html>
