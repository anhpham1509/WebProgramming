function validate(){
    var brand = document.getElementById("brand").value;
    var model = document.getElementById("model").value;
    var fuel = document.getElementById("fuel").value;
    var transmission = document.getElementById("transmission").value;
    var priceRange = document.getElementById("price-range").value;
    var email = document.getElementById("email").value;
    var emailAgain = document.getElementById("email-again").value;

    hideWarnings();

    validateField(brand,"warning-brand");
    validateField(model,"warning-model");
    validateField(fuel,"warning-fuel");
    validateField(transmission,"warning-transmission");
    validateField(priceRange,"warning-price-range");
    validateField(email,"warning-email");
    validateField(emailAgain,"warning-email-again");
    validateEmail(email, emailAgain);

    return !(isEmpty(brand) ||
    isEmpty(model) ||
    isEmpty(fuel) ||
    isEmpty(transmission) ||
    isEmpty(priceRange) ||
    isEmpty(email) ||
    isEmpty(emailAgain) || !isMatch(email, emailAgain));
}

function showWarnings(id){
    document.getElementById(id).innerHTML = "Please fill in this value";
}

function hideWarnings(){
    document.getElementById("warning-brand").innerHTML = "";
    document.getElementById("warning-model").innerHTML = "";
    document.getElementById("warning-fuel").innerHTML = "";
    document.getElementById("warning-transmission").innerHTML = "";
    document.getElementById("warning-price-range").innerHTML = "";
    document.getElementById("warning-email").innerHTML = "";
    document.getElementById("warning-email-again").innerHTML = "";
}

function isMatch(email1, email2){
    return email1 == email2;
}

function validateEmail(email1, email2){
    if (email1 != "" && email2 != "" && !isMatch(email1, email2)){
        document.getElementById("warning-email").innerHTML = "Email difference";
        document.getElementById("warning-email-again").innerHTML = "";
    }
}

function isEmpty(field){
    return field == "";
}

function validateField(field, id){
    if (isEmpty(field))
        showWarnings(id);
}
