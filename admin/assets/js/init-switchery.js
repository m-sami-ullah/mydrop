(function($) {

    'use strict';

    $(document).ready(function() {

        // switchery

        var elem = document.querySelector('.js-switch1');
        var switchery = new Switchery(elem, { color: '#47863a' });

        var elem_2 = document.querySelector('.js-switch2');
        var switchery_2 = new Switchery(elem_2, { color: '#4aa9e9' });

        var elem_3 = document.querySelector('.js-switch3');
        var switchery_3 = new Switchery(elem_3, { color: '#eac459' });
        var elem_4 = document.querySelector('.js-switch4');
        var switchery_4 = new Switchery(elem_4, { color: '#23b9a9' });

    });

})(window.jQuery);
