$(document).ready(function () {
    $('#toggle_favorite').on('submit', function (event) {
        event.preventDefault();
        favorite = $('#favorite');
        unfavorite = $('#unfavorite');
        favorite_count = $('#favorite_count');

        if (favorite.hasClass('hidden')) {
            // When unfavored
            favorite.removeClass('hidden');
            unfavorite.addClass('hidden');
            favorite_count.text(parseInt(favorite_count.text()) - 1)
        } else {
            // When favored
            favorite.addClass('hidden');
            unfavorite.removeClass('hidden');
            favorite_count.text(parseInt(favorite_count.text()) + 1)
        }
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function () {
                console.log("Favorite togged");
            }
        })
    })
})

