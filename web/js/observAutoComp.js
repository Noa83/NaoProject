$.widget("custom.completion", $.ui.autocomplete, {
    _renderMenu: function(ul, items){
        var that = this;
        $.each( items, function( index, item ) {
            that._renderItemData(ul, item)
        });
    }
});

$(function(){
    var jsonBirdsList = $.get({
        dataType: 'json',
        type: 'Get',
        url: 'bird/autocomp',
        success: function(data){
            var birdsList = eval(data);
            $('#observation_birdName').completion({
                source: birdsList,
                select: function(event, ui){
                    $('#observation_birdId').val(ui.item.id);
                }
            });
            $('#observation_birdName').completion( "option", "minLength", 3 );
        }
    });
});

