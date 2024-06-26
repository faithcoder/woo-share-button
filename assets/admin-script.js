jQuery(document).ready(function($) {
    $('.wsb-toggle').on('change', function() {
        var styleControllers = $(this).closest('tr').next().find('.wsb-style-controllers');
        if ($(this).is(':checked')) {
            styleControllers.show();
        } else {
            styleControllers.hide();
        }
    });
});
