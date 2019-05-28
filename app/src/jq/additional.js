$('.carousel').carousel({
    interval: 4000
  });

function hideHeader() {
    document.getElementById("dance-header").setAttribute("class", "hide");
}

function showHeader() {
    document.getElementById("dance-header").setAttribute("class", "show");
}