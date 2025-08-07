
$(document).ready(function () {

    new DataTable('.megatriviaAnswerList');


    var form = '#submitAnswerMegatrivia';

    $(form).on('submit', function (event) {
        event.preventDefault();
        var url = $(this).attr('data-action');
        
        // Create FormData object to handle file uploads
        var formData = new FormData();
        formData.append('answer', $('#answer').val());
        formData.append('megatrivia_id', $('#megatrivia_id').val());
        formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
        
        // Add image file if selected
        if ($('#image').prop('files')[0]) {
            formData.append('image', $('#image').prop('files')[0]);
        }
        
        $.ajax({
            url: url,
            data: formData,
            method: 'POST',
            dataType: 'JSON',
            processData: false,
            contentType: false,
            success: function (data) {

                if (data == 1) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Correct!',
                        showConfirmButton: true,
                    })
                } else if (data == 2) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Correct!',
                        showConfirmButton: true,
                    });
                } else if (data == 0) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Incorrect!',
                        showConfirmButton: true,
                    });
                }

                $('#answer').val('');
                $('#answer').attr('disabled', 'disabled');
                $('#submitButton').attr('disabled', 'disabled');
            },
            error: function (response) {
                console.log(response);
            }
        });
    });


});

$('.disableField').click(function () {
    disableField();
})

function disableField() {
    Swal.fire({
        position: 'top-end',
        icon: 'error',
        title: 'You can answer only once!',
        showConfirmButton: true,
    });
    $('#answer').attr('disabled', 'disabled');
}


