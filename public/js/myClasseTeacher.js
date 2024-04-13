function openTab(evt, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].classList.add("hidden");
    }
    tablinks = document.getElementsByTagName("button");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].classList.remove("bg-orange-500");
    }
    document.getElementById(tabName).classList.remove("hidden");
    evt.currentTarget.classList.add("bg-orange-500");
}