document.getElementById('toggleSwitch').addEventListener('change', function() {
    const fruitText = document.getElementById('fruitText');
    const oneDiv = document.getElementById('ONE');
    const twoDiv = document.getElementById('TWO');

    if (this.checked) {
        fruitText.textContent = 'анонсы';
        oneDiv.style.display = 'none';
        twoDiv.style.display = 'block';
    } else {
        fruitText.textContent = 'карта';
        oneDiv.style.display = 'block';
        twoDiv.style.display = 'none';
    }
});
