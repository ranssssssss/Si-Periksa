function format_currency(value) {
    text = 'Rp ' + value.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&\.');
    //remove last 3 character
    text = text.substring(0, text.length - 3);
    return text;
}

//set nav active
$(document).ready(function () {
    var url = window.location.href;
    last = url.substring(url.lastIndexOf('/') + 1);

    $("#nav-" + last).addClass("active");
    $("#nav-mobile-" + last).addClass("active");
});