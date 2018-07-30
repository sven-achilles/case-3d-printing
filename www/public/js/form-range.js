(function($, undefined) {
    var $form_sliders;

    function initLabels() {
        $form_sliders.after( '<div class="label">0</div>' );
    }

    function onChange() {
        var $form_slider = $(this);

        $form_slider.each(function() {
            var $form_slider = $(this);
            var value        = $form_slider.val();
            var postfix      = $form_slider.attr('data-postfix');

            if( typeof postfix !== typeof undefined && postfix !== false ) {
                value += ' ' + postfix;
            }

            $form_slider.next('.label').text( value );
        });
    }

    function init() {
        $form_sliders = $('input[type=range]');

        initLabels();

        $form_sliders.on('change', onChange).trigger('change');
    }

    init();
})(jQuery);