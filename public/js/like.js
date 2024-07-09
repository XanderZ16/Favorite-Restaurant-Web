$(document).ready(function () {
    $('.product').each(function () {
        const product = $(this);
        const form = product.find('#toggle_like');
        form.on('submit', function (event) {
            event.preventDefault();
            const like = product.find('#like');
            const unlike = product.find('#unlike');
            const like_count = product.find('#like_count');

            if (like.hasClass('hidden')) {
                like.removeClass('hidden');
                unlike.addClass('hidden');
                like_count.text(parseInt(like_count.text()) - 1);
            } else {
                like.addClass('hidden');
                unlike.removeClass('hidden');
                like_count.text(parseInt(like_count.text()) + 1);
            }

            $.ajax({
                type: 'POST',
                url: form.attr('action'),
                data: form.serialize(),
                success: function () {
                    console.log("Liked");
                }
            });
        });
    });
})
