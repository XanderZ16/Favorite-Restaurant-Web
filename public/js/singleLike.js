$(document).ready(function () {
    const form = $('#toggle_like');
    form.on('submit', function (event) {
        event.preventDefault();
        const like = $('#like');
        const unlike = $('#unlike');
        const like_count = $('#like_count');

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
