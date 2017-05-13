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


    /* $( window ).on( "orientationchange", function( event ) {

     if(window.innerHeight > window.innerWidth)
     {
     console.log('height > width');
     location.reload();
     /*if(window.innerWidth < 1024)
     {
     $('.collant').css({'top':'0'}).stop();
     }*/
    /*  }
     else
     {
     console.log('width > height');
     scroll();

     }
     console.log('valeur apres rotation height: ',window.innerHeight);
     console.log('valeur apres rotation  width: ', window.innerWidth);
     });*/


    $('#mc-embedded-subscribe').click(function () {
        choix = 1;
    })
});

