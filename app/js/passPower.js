var timeout;

function checkPassPower(textInput) {
    clearTimeout(timeout);
    const pass = textInput.value;
    var power = 1;
    if (pass.length >= 8) {
        power++;
    }
    if (pass.length >= 10) {
        power++;
    }
    if (pass.length >= 40) {
        power++;
    }
    if (pass.match(/\W/)) {
        power++;
    }
    if (/\d/.test(pass)) {
        power++;
    }
    if (pass.toUpperCase() !== pass && pass.toLowerCase() !== pass) {
        power++;
    } else {
        power = 0;
    }
    if (power === 0) {
        document.getElementById("passPowerInf").innerText = "Hasło jest Bardzo Słabe";
        document.getElementById("passPowerBox").style.backgroundColor = "#ff3c3c";
    } else if (power <= 2) {
        document.getElementById("passPowerInf").innerText = "Hasło jest Słabe";
        document.getElementById("passPowerBox").style.backgroundColor = "#f16262";
    } else if (power >= 3 && power <= 4) {
        document.getElementById("passPowerInf").innerText = "Hasło jest Średnie";
        document.getElementById("passPowerBox").style.backgroundColor = "#62c6f1";
    } else if (power >= 5 && power <= 6) {
        document.getElementById("passPowerInf").innerText = "Hasło jest Mocne";
        document.getElementById("passPowerBox").style.backgroundColor = "#62f1b1";
    } else {
        document.getElementById("passPowerInf").innerText = "Hasło jest Super Mocne";
        document.getElementById("passPowerBox").style.backgroundColor = "#67f162";
    }
    document.getElementById("passPowerBox").style.display = "block";
    timeout = setTimeout(function () {
        document.getElementById("passPowerBox").style.display = "none";
    }, 5000)
}