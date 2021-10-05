FP.FoodForm = function () {
    var $tagInputField = $('.js-food-tag-input');
    var $submitButton = $('.js-submit-button');
    var $form = $('.js-food-form');
    var $tagContainer = $('.js-tag-container');
    var $tagListField = $('.js-tag-list-field');
    var $tagItem = $('.tag-item');

    /**
     * Массив с данными тэгов
     * @type {*[]}
     */
    var tagList = [];

    /**
     * Инициализация обработчиков
     */
    var init = function(tagListJson) {
        tagList = tagListJson;
        for (let i = 0; i < tagList.length; i++) {
            let uniqueKey = FP.FoodForm.getUniqueKey();
            tagList[i].key = uniqueKey;
            appendTagItem(uniqueKey, tagList[i].title);
        }
        $tagInputField.on('keydown', this.handleTagInput);
        $submitButton.on('click', this.submitForm);
        $(document).on('click', '.tag-item', this.handleTagItemClick);
    };

    /**
     * Обработчик нажатия на клавишу Enter в поле ввода тэга
     * @param event
     */
    let handleTagInput = function(event) {
        if (event.key === 'Enter') {
            let inList = false;
            let tagName = $(event.target).val().trim();
            // Если строка не пуста и, если такого тэга еще нет в списке, то добавляем его
            if (tagName) {
                for (let i = 0; i < tagList.length; i++) {
                    if (tagList[i].title === tagName) {
                        inList = true;
                    }
                }
                if (!inList) {
                    let uniqueKey = FP.FoodForm.getUniqueKey();
                    tagList.push({
                        key: uniqueKey,
                        title: tagName,
                    });
                    appendTagItem(uniqueKey, tagName);
                }
                $(event.target).val(null);
            }
        }
    };

    /**
     * Добавление div с тэгом
     * @param key
     * @param title
     */
    let appendTagItem = function(key, title) {
        $('<div>', {
            'class': 'tag-item ml-2',
            'text': title,
            'data-key': key,
        }).appendTo($tagContainer);
    };

    /**
     * Удаление div с тегом по key атрибуту
     * @param event
     */
    let handleTagItemClick = function(event) {
        let tagKey = $(event.target).data('key');
        if (tagKey) {
            for (let i = 0; i < tagList.length; i++) {
                if (tagList[i].key === tagKey) {
                    tagList.splice(i, 1);
                    $(event.target).remove();
                }
            }
        }
    };

    /**
     * Сабмит формы
     */
    let submitForm = function(event) {
        event.preventDefault();
        $tagListField.val(JSON.stringify(tagList));
        $form.submit();
    };

    /**
     * Генерирует случайный уникальный ключ
     * @source https://gist.github.com/gordonbrander/2230317
     * @returns {string}
     */
    let getUniqueKey = function() {
        return '_' + Math.random().toString(36).substr(2, 9);
    };

    return {
        init: init,
        handleTagInput: handleTagInput,
        submitForm: submitForm,
        handleTagItemClick: handleTagItemClick,
        getUniqueKey: getUniqueKey,
    };
}();