$(document).ready(function () {

    $.widget("custom.completion", $.ui.autocomplete, {
        _renderMenu: function (ul, items) {
            var that = this;
            $.each(items, function (index, item) {
                that._renderItemData(ul, item)
            });
        }
    });

    var accentMap = {
        "á": "a",
        "à": "a",
        "â": "a",
        "ä": "a",
        "ç": "c",
        "é": "e",
        "è": "e",
        "ê": "e",
        "ë": "e",
        "î": "i",
        "ï": "i",
        "ô": "o",
        "ö": "o",
        "ù": "u",
        "û": "u",
        "ü": "u"

    };

    var normalize = function (term) {
        var ret = "";
        for (var i = 0; i < term.length; i++) {
            ret += accentMap[term.charAt(i)] || term.charAt(i);
        }
        return ret;
    };
    $.ajax({
        dataType: 'json',
        type: 'POST',
        url: '/bird/autocomp',
        success: function (data) {
            var birdsList = eval(data);
            $('.birdName').completion({
                source: function (request, response) {
                    var matcher = new RegExp($.ui.autocomplete.escapeRegex(request.term), "i");
                    response($.grep(birdsList, function (value) {
                        value = value.label;
                        return matcher.test(value) || matcher.test(normalize(value));
                    }));
                },
                select: function (event, ui) {
                    $('.birdId').val(ui.item.id);
                }
            });
            $('.birdName').completion("option", "minLength", 3);

        }
    });
});

