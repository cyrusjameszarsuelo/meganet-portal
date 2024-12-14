$(document).ready(function() {
    $('.metricStore').click(function() {

        let action = $(this).attr('data-action');
        let url_name = $(this).attr('data-url');
        let action_val = $(this).attr('data-value');
        location.href = url_name

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/storeMetrics',
            data: {
                action: action,
                url_name: url_name,
                action_val: action_val,
            },
            method: 'POST',
            dataType: 'JSON',
            success: function (data) {
            },
            error: function (response) {
                console.log(response);
            }
        });
        
    })
})