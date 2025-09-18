/**
 * @param {boolean} condition The condition under which the navigation becomes sticky
 */
function nav_size(condition) {

	if (condition){ 

		$('.main-nav').addClass("small");
		$('.navigation li.open').removeClass("open");

	}

	else{

		$('.main-nav').removeClass("small");

	}

}



$(document).ready(function() {

    let lastScrollTop = $(this).scrollTop();

    $('body').on('scroll', function() {

        let currentScrollTop = $(this).scrollTop();
        nav_size(currentScrollTop > lastScrollTop && currentScrollTop > 128);
        lastScrollTop = currentScrollTop;

    });

    $('.nav-brown, .nav-white').on('mouseenter', function() {

		$('.main-nav.small').removeClass("small");
		$('.small .navigation li.open').removeClass("open");

    });

});



$(document).ready(function() {

	$('.main-nav .navigation .menu-item-has-children').on('click', function() {
		$(this).toggleClass("open");
		$('.navigation li.open').not(this).removeClass("open");
	});

    $('.main-nav .hamburger-icon').on('click', function() {
		$(this).toggleClass("open");
		$('.navigation').toggleClass("open");
		$('.main-nav li.open').not(this).removeClass("open");
	});

    $('.navigation .menu-item-has-children').on('mouseenter', function() {
		$('.navigation li.open').not(this).removeClass("open");
	});

});