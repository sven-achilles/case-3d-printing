(function($) {
    var $table;

    function onRowClick() {
        var $row = $(this);

        window.location = $row.attr('data-show-url');
    }

    $table = $('#print-orders');
    $table.on('click', 'tbody > tr', onRowClick);
})(jQuery);