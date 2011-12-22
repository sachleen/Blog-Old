function gallery(images) {
    $.each($(images), function(index, value) {
        $(value).click(function() {
            $(this).parent().find('img').not(this).removeClass('fullImage').attr('style','');
            if($(this).hasClass('fullImage')) {
                $(this).removeClass('fullImage').attr('style', '');
            } else {
                $(this).addClass('fullImage').center();
            }
        });
    });
}

jQuery.fn.center = function () {
    this.css("position","fixed");
    this.css("top", (($(window).height() - this.outerHeight()) / 2) + "px");
    this.css("left", (($(window).width() - this.outerWidth()) / 2) + "px");
    return this;
}