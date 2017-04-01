/**
 * Created by Bruno on 17/03/2017.
 */
$(function(){

    map = new GMaps({
        div: '#maps',
        lat: 45.83361900000001,
        lng: 1.2611050000000432
    });

    map.addMarker({
        lat: 45.83361900000001,
        lng: 1.2611050000000432,
        title: 'NAO',
        click: function(e) {
            alert('Nos amis les oiseaux');
        }
    });
});