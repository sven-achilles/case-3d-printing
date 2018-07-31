(function($) {
    var thingiview;
    var color;
    var obj_path;

    function init() {
        thingiurlbase = '/vendor/thingiview/javascripts'; // needs to be global
        thingiview    = new Thingiview('model-viewer');
        color         = $('#print-design').attr('data-color');
        obj_path      = $('#print-design').attr('data-obj-path');
    }

    function loadModel() {
        console.log( color, obj_path );
        thingiview.setObjectColor( color );

        thingiview.initScene();
        thingiview.loadSTL( obj_path );
    }

    window.onload = function() {
        init();
        loadModel();
    };
})(jQuery);