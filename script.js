function appendToDisplay(value) {
    const display = document.getElementById('display');
    if (value === 'C') {
        clearDisplay();
    } else if (value === '⌫') {
        deleteLastChar();
    } else {
        display.value += value;
    }
}

function clearDisplay() {
    document.getElementById('display').value = '';
}

function deleteLastChar() {
    const display = document.getElementById('display');
    display.value = display.value.slice(0, -1);
}

// Automatically close the parenthesis after entering a number
document.getElementById('display').addEventListener('input', function(event) {
    const display = event.target;
    const value = display.value;
    if (value.match(/(sin|cos|tan|log)\(\d+$/)) {
        display.value += ')';
    }
});