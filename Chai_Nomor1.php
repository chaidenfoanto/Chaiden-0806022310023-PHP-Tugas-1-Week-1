<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chaiden Nomor 1</title>
    <style>
        h1{font-family: Calibri, Helvetica, Arial, sans-serif;}
        .error { color: red; }
    </style>
</head>
<body>
    <h1>Polindrome Pyramid by Loverboy Chaiden</h1>
    <form method="POST" action="">
        <label for="angka">Mau berapa baris ganteng? 😘 [1-50]: </label>
        <input type="number" id="angka" name="angka" required>
        <input type="submit" value="Submit">
    </form>
    <br>
    
    <?php
    //pengecekan submit
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $angka = (int)$_POST['angka']; //ambil angka inputan user

        // buat pengecekan inputan user
        if ($angka < 1) {
            echo "<p class='error'>Inputan hanya boleh angka bulat dimulai dari angka 1, ya dek ya!</p>"; // Tampilkan pesan error
        } elseif($angka > 50) {
            echo "<p class='error'>Tidak perlu banyak-banyak kak, pusing atur layoutnya😭😭</p>";
        } else {
            //looping tiap baris, banyak baris sesuai dgn inputan user
            for ($i = 1; $i <= $angka; $i++) {

                //tambah spasi kosong di sebelah kiri supaya rapih, konsepnya semakin banyak angkanya, makin sedikit spasinya
                for ($j = $i; $j < $angka; $j++) {
                    echo "&nbsp;&nbsp;&nbsp;";
                }

                // tampilkan angka dari 1 sampai $i
                for ($j = 1; $j <= $i; $j++) {
                    echo str_pad($j, 2, " ", STR_PAD_LEFT) . " "; // str_pad(..) untuk menambahkan padding kiri supaya angka sejajar
                }

                // menampilkan angka dari $i-1 sampai 1 (bagian mundurnya seperti 3 2 1)
                for ($j = $i - 1; $j >= 1; $j--) {
                    echo str_pad($j, 2, " ", STR_PAD_LEFT) . " "; // str_pad(..) untuk menambahkan padding kiri supaya angka sejajar
                }

                echo "<br>"; // enter (pindah ke baris baru)
            }
        }
    }
    ?>
</body>
</html>
