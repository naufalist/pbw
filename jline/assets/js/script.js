$(window).scroll(function(){

    // Navbar
    $('nav').toggleClass('scrolled', $(this).scrollTop() > 200);
    $('.navbar-brand').toggleClass('scrolled', $(this).scrollTop() > 200);

    // Go to Top
    buttonToTop();
});

function buttonToTop() {
    if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
        document.getElementById("btn-to-top").style.display = "block";
    } else {
        document.getElementById("btn-to-top").style.display = "none";
    }
}

function goTop() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}