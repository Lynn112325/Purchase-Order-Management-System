
function validateForm(e) {
    const role = document.querySelector('input[name="role"]:checked');
    
    if (!role) {
        // if no role is selected, prevent form submission
        if (e) {
            // prevent default form submission
            e.preventDefault();
            // prevent immediate propagation
            e.stopImmediatePropagation();
        }
        // alert('please select a role!');

        showToast('please select a role!', 'danger');
        
        // focus on the role selection
        document.querySelector('input[name="role"]').focus();
        
        return false;
    }
    
    // if a role is selected, allow form submission
    return true;
}