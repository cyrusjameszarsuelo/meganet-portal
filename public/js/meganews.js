
$(document).ready(function () {

    var form = '#submitCommentMeganews';

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
                meganews_id: $('#meganews_id').val(),
            },
            method: 'POST',
            dataType: 'JSON',
            success: function (data) {
                $('#comment').val('');
                var commentMeganewsList = `
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
                                <button class="btn btn-info btn-sm updateMeganewsCommentButton"
                                    data-toggle="modal" data-target="#updateMeganewsComment"
                                    data-id="`+ data.id + `"
                                    data-comment="`+ data.comment + `">Update</button>
                                <button class="btn btn-primary btn-sm deleteCommentMeganewsButton"
                                    data-id="`+ data.id + `">Delete</button>
                            </div>
                        </div>
                    </div>
                `;


                $('#commentMeganews').prepend(commentMeganewsList);
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
            url: '/likeMeganewsContent',
            method: 'POST',
            data: {
                meganews_id: $('#meganews_id').val()
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

    $(document).on("click", ".updateMeganewsCommentButton", function() {
        let meganews_comment_id = $(this).attr('data-id');
        let comment = $(this).attr('data-comment');

        $("#meganews_comment_id").val(meganews_comment_id)
        $("#commentMeganewsTextbox").html(comment)
    });

    // $('.updateMeganewsCommentButton').click(function(){
    //     let meganews_comment_id = $(this).attr('data-id');
    //     let comment = $(this).attr('data-comment');

    //     $("#meganews_comment_id").val(meganews_comment_id)
    //     $("#commentMeganewsTextbox").html(comment)
    // });

    $(document).on("click", ".deleteCommentMeganewsButton", function() {
        let meganews_comment_id = $(this).attr('data-id');
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
                    url: '/deleteCommentMeganews',
                    method: 'POST',
                    dataType: 'JSON',
                    data: {
                        meganews_comment_id: meganews_comment_id,
                    },
                    success: function (data) {
                        $('.commentSectionMeganewsRow').filter('[data-id="' + meganews_comment_id + '"]').remove();
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