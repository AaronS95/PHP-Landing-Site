$(document).ready(function () {
    $("#generateDogButton").click(function (e) {
        e.preventDefault();
        $.get("../utils/getDogImage.php", function (data) {
            if (data === "") {
                alert("There was an error!");
            } else {
                $("#dogImage").attr("src", data);
            }
        });
    });
});

$(document).ready(function () {
    $("#generatePwButton").click(function (e) {
        e.preventDefault();
        const length = $("#length").val();
        const numbers = $("#numbers").prop("checked");
        const uppercase = $("#uppercase").prop("checked");
        const specialChars = $("#specialChars").prop("checked");
        const apple = $("#apple").prop("checked");
        $.get("../utils/getPassword.php", {
            length: length,
            numbers: numbers,
            uppercase: uppercase,
            specialChars: specialChars,
            apple: apple
        }, function (data) {
            if (data === "") {
                alert("There was an error!");
            } else {
                $("#password").text(data);
            }
        });
    });
});