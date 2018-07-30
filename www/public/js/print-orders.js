(function($) {
    var $list;
    var $filter_btn;

    function showAllPrints() {
        $list.find('tbody tr.hide').removeClass('hide');
    }

    function hideOthersPrints() {
        showAllPrints();
        $list.find('tbody tr:not(.mine)').addClass('hide');
    }

    function onChange() {
        if( $(this).is(':checked') ) {
            hideOthersPrints();
        } else {
            showAllPrints();
        }
    }

    $list       = $('#print-orders');
    $filter_btn = $('#show-mine-check');

    $filter_btn.on('change', onChange );
})(jQuery);