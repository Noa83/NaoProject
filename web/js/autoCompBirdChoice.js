$(document).ready(function() {

    $.widget("custom.completion", $.ui.autocomplete, {
        _renderMenu: function (ul, items) {
            var that = this;
            $.each(items, function (index, item) {
                that._renderItemData(ul, item)
            });
        }
    });

    $(function () {
        var jsonBirdsList = $.get({
            dataType: 'json',
            type: 'Post',
            url: '/bird/autocomp',
            success: function (data) {
                var birdsList = eval(data);
                $('.birdName').completion({
                    source: birdsList,
                    select: function (event, ui) {
                        $('.birdId').val(ui.item.id);
                    }
                });
                $('.birdName').completion("option", "minLength", 3);
            }
        });
    });

});

