
$(document).ready(function () {

    new DataTable('.megatriviaAnswerList');


    var form = '#submitAnswerMegatrivia';

    $(form).on('submit', function (event) {
        event.preventDefault();
        var url = $(this).attr('data-action');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url,
            data: {
                answer: $('#answer').val(),
                megatrivia_id: $('#megatrivia_id').val(),
            },
            method: 'POST',
            dataType: 'JSON',
            success: function (data) {
                
                if (data == 1) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Congratulations! You won a special prize!',
                        showConfirmButton: true,
                    })
                } else if (data == 2) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Correct! But somebody got it first!',
                        showConfirmButton: true,
                    });
                } else if (data == 0) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Incorrect! Try again next time!',
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

$('.disableField').click(function() {
    disableField();
})

function disableField() {
    Swal.fire({
        position: 'top-end',
        icon: 'error',
        title: 'Bawal ka na maganswer beshy hehe',
        showConfirmButton: true,
    });
    $('#answer').attr('disabled', 'disabled');
}


