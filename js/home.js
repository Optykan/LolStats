function error(msg) {
    if (runError == false) {
        runError = true;
        $("#header").addClass("animated fadeOutLeft");

        setTimeout(function () {
            $("#error").text(msg).removeClass("hidden").addClass("animated fadeInRight");
        }, 100);

        setTimeout(function () {
            $("#error").removeClass("animated fadeInRight");
            $("#header").addClass("hidden").removeClass("default animated fadeOutLeft");
        }, 850);


        setTimeout(function () {
            $("#error").addClass("animated fadeOutLeft");
            $("#header").removeClass("animated fadeOutLeft hidden").addClass("default animated fadeInRight");

        }, 2300);

        setTimeout(function () {
            $("#error").addClass("hidden").removeClass("animated fadeOutLeft");
            $("#header").removeClass("animated fadeInRight");
            runError = false;
        }, 3050);
    }
}

function interCheck(msg) {
    setTimeout(function () {
        loadToError(msg)
    }, 1000);
}

function loadToError(msg) {
    $("#loading").addClass("animated fadeOutLeft");
    $("#error").text(msg).removeClass("hidden").addClass("animated fadeInRight");

    setTimeout(function () {
        $("#error").removeClass("animated fadeInRight");
        $("#loading").addClass("hidden").removeClass("default animated fadeOutLeft");
    }, 850);

    setTimeout(function () {
        $("#error").addClass("animated fadeOutLeft");
        $("#header").removeClass("animated fadeOutLeft hidden").addClass("default animated fadeInRight");

    }, 2300);

    setTimeout(function () {
        $("#error").addClass("hidden").removeClass("animated fadeOutLeft");
        $("#header").removeClass("animated fadeInRight");
        load = false;
    }, 3050);
}

function loading(msg) {
    if (runError == false && load == false) {
        load = true;
        inter = true;
        $("#header").addClass("animated fadeOutLeft");

        setTimeout(function () {
            $("#loading").text(msg).removeClass("hidden").addClass("animated fadeInRight");
        }, 100);

        setTimeout(function () {
            $("#loading").removeClass("animated fadeInRight");
            $("#header").addClass("hidden").removeClass("default animated fadeOutLeft");
        }, 850);
        setTimeout(function () {
            inter = false;
        }, 1000);
    }
}

function callback(vfd) {
    if (vfd.indexOf("ID") > -1) {
        var idarr = vfd.split("=");
        window.location.replace("results.php?id=" + idarr[1] + "&name=" + idarr[2]);
    } else {
        setTimeout(function () {
            loadToError(vfd);
        }, 1000);
    }
}

function test(msg) {
    loading(msg);
    callback("test");
}

function urlError(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}