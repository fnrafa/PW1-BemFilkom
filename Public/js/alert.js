window.onload = function () {
    const modal = document.getElementById("alertModal");
    modal.style.display = "block";

    const closeButton = document.getElementsByClassName("close")[0];
    closeButton.onclick = function () {
        modal.style.display = "none";
        if (history.length > 1) {
            window.history.back();
        } else {
            window.location.href = "/";
        }
    };
};