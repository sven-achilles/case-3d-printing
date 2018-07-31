(function($) {
    var $upload_new_file_form;
    var $field_container;
    var $show_btn;
    var $hide_btn;

    function toggle() {
        if( $field_container.hasClass('hide') ) {
            show();
        } else {
            hide();
        }
    }

    function show() {
        $show_btn.addClass('hide');
        $hide_btn.removeClass('hide');
        $field_container.removeClass('hide');
    }

    function hide() {
        $show_btn.removeClass('hide');
        $hide_btn.addClass('hide');
        $field_container.addClass('hide');
    }

    $upload_new_file_form = $('#upload-new-file');
    $field_container      = $upload_new_file_form.find('.upload-form');
    $show_btn             = $upload_new_file_form.find('.btn.new');
    $hide_btn             = $upload_new_file_form.find('.btn.keep');

    $upload_new_file_form.on('click', '.btn', toggle);
})(jQuery);