$(function(){


    $('.collant').each(function () {
        var choix = 0;
        var parent = $(this).parent();
        var defaultTop = $(this).offset().top;
        var elementCourant = $(this);
        var largeur = $(window).width();
        console.log(largeur);
        console.log(defaultTop);
        console.log(elementCourant);
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


    $( window ).on( "orientationchange", function( event ) {
        var largeur = $(window).width();
        var defaultTop = $('.collant').offset().top;
        console.log( defaultTop)

        if (largeur > 1024)
        {
        }
        else
        {
            location.reload();
        }
        $('.collant').each(function () {
            var choix = 0;
            var parent = $(this).parent();
            var defaultTop = $(this).offset().top;
            var elementCourant = $(this);
            var largeur = $(window).width();
            console.log(largeur);
            console.log(defaultTop);
            console.log(elementCourant);
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
                    else
                    {
                        //location.reload(true);
                        //alert(defaultTop);
                       // defaultTop = 2142;
                        //$(this).animate({top: defaultTop -2142}, 500);
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

    //$( window ).orientationchange();




});
