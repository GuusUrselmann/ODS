function generateRandomString(length) {
    var result = "";
    var characters =
        "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    var charactersLength = characters.length;
    for (var i = 0; i < length; i++) {
        result += characters.charAt(
            Math.floor(Math.random() * charactersLength)
        );
    }
    return result;
}

window.addEventListener(
    "load",
    function () {
        var input = document.getElementsByClassName("random-string");
        var buttons = document.getElementsByClassName("random-string-generator");
        
        buttons[0].addEventListener("click", function (event) {
            input[0].value = generateRandomString(8);
        });
    },
    false
);
