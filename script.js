// Fungsi untuk menambahkan nilai ke dalam tampilan kalkulator
function appendToDisplay(value) {
    const display = document.getElementById('display');
    if (value === 'C') {
        clearDisplay(); // Mengosongkan tampilan jika 'C' ditekan
    } else if (value === '⌫') {
        deleteLastChar(); // Menghapus karakter terakhir jika '⌫' (backspace) ditekan
    } else {
        display.value += value; // Menambahkan nilai ke dalam tampilan
    }
}

// Fungsi untuk mengosongkan tampilan kalkulator
function clearDisplay() {
    document.getElementById('display').value = ''; // Mengatur nilai tampilan menjadi string kosong
}

// Fungsi untuk menghapus karakter terakhir dari tampilan kalkulator
function deleteLastChar() {
    const display = document.getElementById('display');
    display.value = display.value.slice(0, -1); // Menghapus karakter terakhir dari nilai tampilan
}

// Event listener untuk menutup otomatis tanda kurung setelah memasukkan angka
document.getElementById('display').addEventListener('input', function(event) {
    const display = event.target; // Mendapatkan elemen tampilan kalkulator
    const value = display.value; // Mendapatkan nilai saat ini dari tampilan

    // Memeriksa apakah nilai tampilan diakhiri dengan salah satu nama fungsi trigonometri atau logaritma diikuti oleh angka
    if (value.match(/(sin|cos|tan|log)\(\d+$/)) {
        display.value += ')'; // Menambahkan ')' untuk menutup panggilan fungsi
    }
});
