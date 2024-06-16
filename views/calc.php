<div class="calculator bg-secondary border rounded p-4 col-lg-4">
    <form action="aksi.php" method="POST">
        <div class="form-group">
            <input id="display" class="form-control text-right" type="text" name="display" readonly>
        </div>
        <?php
        $buttons = [
            ['7', '8', '9', '/'],
            ['4', '5', '6', '*'],
            ['1', '2', '3', '-'],
            ['0', '.', 'C', '+'],
            ['(', ')', '⌫', '%'],
            ['sin', 'cos', 'tan', 'log']
        ];

        foreach ($buttons as $row) {
            echo '<div class="row mt-2">';
            foreach ($row as $button) {
                $class = 'btn-dark';
                if ($button === '⌫') {
                    $class = 'btn-danger';
                } elseif (in_array($button, ['sin', 'cos', 'tan', 'log'])) {
                    $class = 'btn-info';
                } elseif ($button === 'C') {
                    $class = 'btn-warning';
                }
                echo '<div class="col-3">';
                echo '<button type="button" class="btn ' . $class . ' rounded-circle" onclick="appendToDisplay(\'' . $button . '\')">' . $button . '</button>';
                echo '</div>';
            }
            echo '</div>';
        }
        ?>
        <div class="row mt-2">
            <div class="col-12">
                <button type="submit" class="btn btn-success w-100" name="submit_calculate">=</button>
            </div>
        </div>
    </form>
</div>