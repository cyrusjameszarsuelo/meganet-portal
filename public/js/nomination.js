$(document).ready(function () {
    //change selectboxes to selectize mode to be searchable
    $("select").select2();

    $('#valuesMultiple').on('change', function () {
        var data = $("#valuesMultiple").val();
        $('#behavior').attr('disabled', true);
        $.ajax({
            url: "/getBehavior",
            type: "GET",
            data: {
                data: data,
            },
            success: function (data) {
                $('#behavior').empty();
                $('#behavior').attr('disabled', false);

                data.forEach(element => {
                    $('#behavior').append(
                        `<option value="${element.id}">${element.behavior}<option>`
                    );
                });

            },
            error: function (error) {
                $('#behavior').empty();
            }
        });
    });

    $('#nominationForm').on('submit', function (event) {
        event.preventDefault();

        let nominee = $('#nominee').val();
        let department = $('#department').val();
        let critical_incidents = $('#critical_incidents').val();
        let result_impact = $('#result_impact').val();
        let valuesMultiple = $('#valuesMultiple').val();
        let behavior = $('#behavior').val();
        let user = $('div.userInfo span b').html().toUpperCase();
        let valueMessage = 'The following values is already exists in the system: ';
        let behaviorMessage = 'The following behaviors is already exists in the system: ';

        if (department.length == '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please select a department!',
            });
            return false;
        }

        Swal.fire({
            title: "Submit entry?",
            text: "Can't be undone once submitted",
            icon: "info",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Proceed",
            cancelButtonText: "Go Back",
            showDenyButton: true,
            denyButtonColor: "#717171",
            denyButtonText: `Discard`,
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/nominate',
                    data: {
                        nominee: nominee,
                        user_nominate: user,
                        department: department,
                        critical_incidents: critical_incidents,
                        result_impact: result_impact,
                        valuesMultiple: valuesMultiple,
                        behavior: behavior,
                        nominee_type: "individual",
                    },
                    type: 'POST',
                    success: function (returnedValue) {
                        let checkArray = Array.isArray(returnedValue);
                        if (checkArray == true) {
                            returnedValue[0].forEach(valueElement => {
                                valueMessage += valueElement + '<br>';
                            })
                            returnedValue[1].forEach(behaviorElement => {
                                behaviorMessage += behaviorElement +
                                    '<br>';
                            });

                            Swal.fire({
                                title: "The following values already exist:",
                                html: `The following behaviors already exist: ${valueMessage} ${behaviorMessage}`,
                                text: ``,
                                icon: "error",
                                showCancelButton: true,
                                confirmButtonColor: "#3085d6",
                                cancelButtonColor: "#d33",
                                confirmButtonText: "Yes"
                            }).then((confirmed) => {
                                if (confirmed.isConfirmed) {
                                    location.href = '/nomination'
                                }
                            });

                        } else {
                            if (returnedValue == 0) {
                                Swal.fire({
                                    title: "Entry already exists",
                                    text: "Would you like to make another nomination?",
                                    icon: "error",
                                    showCancelButton: true,
                                    confirmButtonColor: "#3085d6",
                                    cancelButtonColor: "#d33",
                                    confirmButtonText: "Yes"
                                }).then((confirmed) => {
                                    if (confirmed.isConfirmed) {
                                        location.href = '/nomination'
                                    }
                                });
                            } else {
                                Swal.fire({
                                    title: "Entry successfully submitted!",
                                    text: "Would you like to make another nomination?",
                                    icon: "success",
                                    showCancelButton: true,
                                    confirmButtonColor: "#3085d6",
                                    cancelButtonColor: "#d33",
                                    confirmButtonText: "Yes"
                                }).then((confirmed) => {
                                    if (confirmed.isConfirmed) {
                                        location.href = '/nomination'
                                    }
                                });
                            }
                        }


                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            } else if (result.isDenied) {
                location.href = '/home';
            }
        });
    });

    Swal.fire({
        title: "Nomination",
        text: "Please select to nominate whether Team or Individual",
        icon: "info",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        confirmButtonText: "Team Nomination",
        cancelButtonText: "Individual Nomination",
        cancelButtonColor: "#d33",
    }).then((result) => {
        if (result.isConfirmed) {
            location.href = "/nomination-group";
        }
    });

});