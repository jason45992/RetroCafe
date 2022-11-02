// ********************************************************** //
// The event handler function for the Contact Number text box

function validateNumber() {
    var contactnum = document.getElementById("contactnum");
    var numberRegExp = /^[0-9]{8}$/;
    if (!numberRegExp.test(contactnum.value)) {
        alert("The number you entered (" + contactnum.value +
        ") is not in the correct form. \n" +
        "The correct form contains 8 digit numbers.");
        contactnum.focus();
        contactnum.select();
        return false;
    }
}

