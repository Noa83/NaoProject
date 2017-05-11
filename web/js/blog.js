$(function(){

    var choix = 0;

    $('.collant').each(function () {
        var parent = $(this).parent();
        var defaultTop = $(this).offset().top;
        var elementCourant = $(this);
        var largeur = $(window).width();
        console.log(largeur);

        $(window).scroll(function () {
            if(choix == 0)
            {
                if (largeur > 1024) {
                    if ($(window).scrollTop() > defaultTop) {
                        elementCourant.stop().animate({top: $(window).scrollTop()}, 500)
                    }
                    else {
                        elementCourant.stop().animate({top: defaultTop - 110}, 500)
                    }
                }
            }
            else
            {
                if (largeur > 1024) {
                    if ($(window).scrollTop() > defaultTop) {
                        elementCourant.stop().animate({top: $(window).scrollTop() - 50}, 500)
                    }
                    else {
                        elementCourant.stop().animate({top: defaultTop - 110}, 500)
                    }
                }
            }

        })
    });

    $('#mc-embedded-subscribe').click(function () {
        choix = 1;
    })
});
