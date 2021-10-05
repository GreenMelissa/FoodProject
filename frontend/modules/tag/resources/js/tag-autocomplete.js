/**
 * Переработанный автокомплит из примера
 * @source https://www.w3schools.com/howto/howto_js_autocomplete.asp
 * @type {{init: init}}
 */
FP.Autocomplete = function () {
    var $tagInputField = $('.js-tag-input');
    var $container = $('.js-autocomplete-container');
    var currentFocus;
    var timer;

    var init = function() {
        $tagInputField.on('input', function(event) {
            clearTimeout(timer);
            timer = setTimeout(function() {
                let value = $tagInputField.val();
                removeList();
                if (!value) {
                    return false;
                }
                FP.Autocomplete.currentFocus = -1;

                $('<div/>', {
                    id: 'tag-autocomplete-list',
                    class: 'autocomplete-items',
                }).appendTo($container);

                $.ajax({
                    url: '/tag/tag/search',
                    type: 'get',
                    data: {
                        search: value,
                    },
                    success: function(response) {
                        for (let i = 0; i < response.length; i++) {
                            if (response[i].substr(0, value.length).toUpperCase() === value.toUpperCase()) {
                                var content = '<strong>' + response[i].substr(0, value.length) + '</strong>';
                                content += response[i].substr(value.length);
                                content += "<input type='hidden' value='" + response[i] + "'>";

                                var item = $('<div>' + content + '</div>', {
                                    id: 'autocomplete-list-item',
                                    class: 'autocomplete-items',
                                }).appendTo($container);

                                item.on('click', function(e) {
                                    $tagInputField.val($(e.target).find('input')[0].value);
                                    removeList();
                                });
                                $('#tag-autocomplete-list').append(item);
                            }
                        }
                    },
                    error: function() {
                        return false;
                    }
                });
            }, 1000);
        });

        /**
         * Обработчик нажатий на клавиши внутри поля ввода
         */
        $tagInputField.on('keydown', function(event) {
            let listItems = $('#tag-autocomplete-list').find('div');
            if (event.keyCode === 40) {
                FP.Autocomplete.currentFocus++;
                addActive(listItems);
            } else if (event.keyCode === 38) {
                FP.Autocomplete.currentFocus--;
                addActive(listItems);
            } else if (event.keyCode === 13) {
                event.preventDefault();
                if (FP.Autocomplete.currentFocus > -1) {
                    if (listItems) {
                        listItems[FP.Autocomplete.currentFocus].click();
                    }
                }
            }
        });

        document.addEventListener('click', function (e) {
            removeList();
        });
    };

    /**
     * @param items
     * @returns {boolean}
     */
    let addActive = function(items) {
        if (!items) {
            return false;
        }
        removeActive(items);
        if (FP.Autocomplete.currentFocus >= items.length) {
            FP.Autocomplete.currentFocus = 0;
        }
        if (FP.Autocomplete.currentFocus < 0) {
            FP.Autocomplete.currentFocus = (items.length - 1);
        }
        items[FP.Autocomplete.currentFocus].classList.add('autocomplete-active');
    };

    /**
     * Удаление подсветки со всех элементов списка
     */
    let removeActive = function() {
        $('#tag-autocomplete-list').find('div').removeClass('autocomplete-active');
    };

    /**
     * Удаление списка
     */
    let removeList = function () {
        $('#tag-autocomplete-list').remove();
    };

    return {
        init: init,
    };
}();