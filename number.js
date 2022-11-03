// ********************************************************** //
// For Checkout Page: The event handler function for the Contact Number text box

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

// ********************************************************** //
// For Admin Console Page: The event handler function for the Price text box

function validatePrice() {
    var price = document.getElementById("price");
    var numberRegExp = /^\d{0,8}[.]?\d{1,4}$/;
    if (!numberRegExp.test(price.value)) {
        alert("Please enter number.");
        price.focus();
        price.select();
        return false;
    }
}

