const input_image = $('#image');
const preview = $('#preview');

const null_label = $('#null-label');
const preview_label = $('#preview-label');

input_image.on('change', function () {
    const reader = new FileReader();
    reader.readAsDataURL(input_image[0].files[0]);
    reader.onload = (e) => {
        preview.attr('src', e.target.result);
    }

    if (preview_label && null_label) {
        preview_label.removeClass('hidden');
        null_label.hide();
    }
});

