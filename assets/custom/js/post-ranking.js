(function($){
    $(function() {

        if ($('#prank-value').length) {

            $('#prank-value label').click(function() {
                const value = $(this).data('value')
                $('#prank-value label').map((i, e) => {
                    if ($(e).data('value') <= value) {
                        $(e).removeClass('empty').removeClass('current').addClass('fill');
                    } else {
                        $(e).removeClass('fill').removeClass('current').addClass('empty');
                    }
                    if ($(e).data('value') === value) {
                        $(e).addClass('current');
                    }
                })
            })

        }

    });
})(jQuery)
