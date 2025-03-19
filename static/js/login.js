function validateForm() {
    // console.log("call validateForm()");
    // alert("call validateForm()");

    let role = document.querySelector('input[name="role"]:checked');
    // alert(role.value);
    
    if (role == null) {
        alert("Please select your role");
    } else {
        document.getElementById("loginform").submit();
    }
}
