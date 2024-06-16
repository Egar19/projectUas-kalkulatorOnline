<div class="col-lg-6">
    <div class="row">
        <div class="container border rounded p-4 mt-4 col-10">
            <h2 class="text-center">Hasil</h2>
            <p class="text-center">
                <?php
                if (isset($_GET['hasil'])) {
                    echo $_GET['hasil'];
                }
                ?>
            </p>
        </div>

        <div class="container border rounded p-4 mt-4 col-10">
            <h2 class="text-center">Riwayat Penghitungan</h2>
            <ul class="list-group">
                <?php
                $stmt = $pdo->prepare("SELECT * FROM calculations WHERE user_id = ? ORDER BY created_at DESC");
                $stmt->execute([$user_id]);
                $calculations = $stmt->fetchAll();
                foreach ($calculations as $calculation) {
                    echo "<li class='list-group-item d-flex justify-content-between align-items-center'>
                                {$calculation['expression']} = {$calculation['result']}
                                <a href='aksi.php?hapus={$calculation['id']}' class='btn btn-danger btn-sm'>Hapus</a>
                            </li>";
                }
                ?>
            </ul>
            <div class="justify-content-around d-flex m-2">
                <form class="m-2" action="aksi.php" method="POST">
                    <button type="submit" name="hapus_semua" class="btn btn-danger mb-3">Hapus Semua Riwayat</button>
                </form>
                <div class="d-flex">
                    <form class="m-2" action="export_pdf.php" method="post">
                        <button type="submit" class="btn btn-primary mb-3">Ekspor Ke PDF</button>
                    </form>
                    <form class="m-2" action="export_csv.php" method="POST">
                        <button type="submit" name="export_csv" class="btn btn-primary mb-3">Ekspor Ke CSV</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>    