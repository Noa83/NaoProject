$(function(){
    console.log('valeur height: ',window.innerHeight);
    console.log('valeur width: ', window.innerWidth);
    var parent =  $('.collant').parent();
    var defaultTop =  $('.collant').offset().top;
    var elementCourant =  $('.collant');
    var largeur = $(window).width();


    function scroll()
    {
        $('.collant').each(function () {
            var choix = 0;

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
    }

    scroll();
    $( window ).on( "orientationchange", function( event ) {
        location.reload();
    });

    $('#mc-embedded-subscribe').click(function () {
        choix = 1;
    })
});

