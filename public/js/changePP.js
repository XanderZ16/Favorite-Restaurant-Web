const image = $('#image');

image.on('change', function () {
    console.log("masuk");
    let formData = new FormData();
    formData.append('image', image[0].files[0]);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: '/change-pp',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (e) {
            console.log(e);
        },
        error: function (e) {
            console.log(e);
        }
    });
})
