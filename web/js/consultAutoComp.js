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
            $('#results_birdName').completion({
                source: birdsList,
                select: function(event, ui){
                    $('#results_birdId').val(ui.item.id);
                }
            });
            $('#results_birdName').completion( "option", "minLength", 3 );
        }
    });
});

