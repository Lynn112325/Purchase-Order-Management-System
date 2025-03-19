// Purpose: To handle the selection of target restaurant
// display the type and address of the selected restaurant
document.getElementById('restaurant').addEventListener('change', function () {
    const selectedOption = this.options[this.selectedIndex];
    const type = selectedOption.getAttribute('data-type');
    const address = selectedOption.getAttribute('data-address');
    document.getElementById('type').value = type || '';
    document.getElementById('address').value = address || '';
});

