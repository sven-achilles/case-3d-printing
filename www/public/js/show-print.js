(function($) {
    window.onload = function() {
        thingiurlbase = '/vendor/thingiview/javascripts';
        thingiview    = new Thingiview('model-viewer');

        thingiview.setObjectColor('#C0D8F0');
        thingiview.initScene();
        thingiview.loadSTL('/uploads/designs/c53bc390483c0928ccbbc5c4208eaaf0.stl');
    };
})(jQuery);