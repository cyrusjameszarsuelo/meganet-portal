
$(document).ready(function () {

    var form = '#submitCommentMegagoodVibes';

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
                comment: $('#comment').val(),
                megagood_vibe_id: $('#megagood_vibe_id').val(),
            },
            method: 'POST',
            dataType: 'JSON',
            success: function (data) {
                $('#comment').val('');
                var commentMegagoodVibesList = `
                    <div class="row mt-3 commentSectionMegagoodVibesRow" data-id="`+ data.id + `">
                        <div class="col-md-1">
                            <span class="initialCommentator"> `+ data.user[0] + `
                            </span>
                        </div>
                        <div class="col-md-11">
                            <span class="nameCommentator">`+ data.user + ` <span
                                    class="timeComment">`+ timeAgo(data.created_at) + `</span></span>
                            <br>
                            <div class="commentColor" >
                                <span class="commentBanner" style="font-size: 15px; line-height: 26px; font-family: Helvetica">`+ data.comment + `</span>
                            </div>
                            <div class="btn-group float-right mt-2">
                                <button class="btn btn-info btn-sm updateMegagoodVibesCommentButton"
                                    data-toggle="modal" data-target="#updateMegagoodVibesComment"
                                    data-id="`+ data.id + `"
                                    data-comment="`+ data.comment + `">Update</button>
                                <button
                                    class="btn btn-primary btn-sm deleteCommentMegagoodVibesButton"
                                    data-id="`+ data.id + `">Delete</button>
                            </div>
                        </div>
                    </div>
                `;


                $('#commentMegagoodVibes').prepend(commentMegagoodVibesList);
            },
            error: function (response) {
                console.log(response);
            }
        });

    });

    function timeAgo(value) {
        const seconds = Math.floor((new Date().getTime() - new Date(value).getTime()) / 1000)
        let interval = seconds / 31536000
        const rtf = new Intl.RelativeTimeFormat("en", { numeric: 'auto' })
        if (interval > 1) { return rtf.format(-Math.floor(interval), 'year') }
        interval = seconds / 2592000
        if (interval > 1) { return rtf.format(-Math.floor(interval), 'month') }
        interval = seconds / 86400
        if (interval > 1) { return rtf.format(-Math.floor(interval), 'day') }
        interval = seconds / 3600
        if (interval > 1) { return rtf.format(-Math.floor(interval), 'hour') }
        interval = seconds / 60
        if (interval > 1) { return rtf.format(-Math.floor(interval), 'minute') }
        return rtf.format(-Math.floor(interval), 'second')
    }

    $('.heartReactSpan').click(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/likeMegagoodVibesContent',
            method: 'POST',
            data: {
                megagood_vibe_id: $('#megagood_vibe_id').val()
            },
            dateType: 'JSON',
            success: function(data) {
                console.log(data);
                if(data == 1) {
                    $('.heartReact').removeClass('fa-solid');
                    $('.heartReact').addClass("fa-regular");
                    $('.heartReact').css('color', '#000');
                } else {
                    $('.heartReact').removeClass("fa-regular");
                    $('.heartReact').addClass('fa-solid');
                    $('.heartReact').css('color', '#ee2f21');
                }
            },
            error: function(error) {
                console.log(error);
            }

        })
    });

    $('.updateMegagoodVibesCommentButton').click(function(){
        let megagoodVibes_comment_id = $(this).attr('data-id');
        let comment = $(this).attr('data-comment');

        $("#megagoodVibes_comment_id").val(megagoodVibes_comment_id)
        $("#commentMegagoodVibesTextbox").html(comment)
    });

    $('.deleteCommentMegagoodVibesButton').click(function () {
        let megagoodVibes_comment_id = $(this).attr('data-id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/deleteCommentMegagoodVibes',
                    method: 'POST',
                    dataType: 'JSON',
                    data: {
                        megagoodVibes_comment_id: megagoodVibes_comment_id,
                    },
                    success: function (data) {
                        $('.commentSectionMegagoodVibesRow').filter('[data-id="' + megagoodVibes_comment_id + '"]').remove();
                        if (data) {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                        }
                    },
                    error: function (error) {
                        console.log(error);
                    }
                })
            }
        })
    })
});