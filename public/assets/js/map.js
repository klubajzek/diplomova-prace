jQuery(document).ready(function ($) {
    $('.city-position').on('click', function (e) {
        e.preventDefault();

        $url = $('.container').data('url');
        $position = $(this).data('position');

        if ($url != null && $position != null) {
            jQuery.ajax({
                url: $url,
                method: 'POST',
                data: {
                    position: $position
                },
                success: function (response) {
                    if (response.success) {
                        window.location = response.url;
                    }
                }
            });
        }
    })
});