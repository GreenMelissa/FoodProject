$.fn.setTooltipIfOverflow = function() {
    $(this).on('mouseenter', function() {
        if (this.offsetWidth < this.scrollWidth || this.offsetHeight < this.scrollHeight) {
            $(this).attr('title', $(this).text());
        } else {
            $(this).removeAttr('title');
        }
    });
};