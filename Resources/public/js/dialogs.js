;(function($){
    "use strict";

    var doConfirm = function(event) {
        var $t = $(event.currentTarget) , msg = $t.attr('data-confirm'), href = $t.attr('href');
        event.preventDefault();
        bootbox.confirm(msg, function(result){
            if(result === true) {
                window.location = href;
            }
        });
    };

    $('[data-confirm]').on('click', doConfirm);

})(jQuery);