$(document).ready(function () {

    // var heartReact = $('.heartReact').attr('data-id');

    // $(".heartReact").each(function(){
    //     $.ajax({
    //         url: '/getLikesOnComment',
    //         method: 'GET',
    //         dataType: 'JSON',
    //         data: {
    //             banner_question_comment_id: $(this).attr('data-id')
    //         },
    //         success: function(data) {
    //             if (data) {
    //                 $('#heartReact' + data.banner_question_comment_id).removeClass("fa-regular");
    //                 $('#heartReact' + data.banner_question_comment_id).addClass("fa-solid");
    //                 $('#heartReact' + data.banner_question_comment_id).css('color', '#ee2f21');
    //             } else {
    //             }
    //         },
    //         error: function(error) {
    //             console.log(error);
    //         }
    //     })
    // })


    var form = '#submitCommentBanner';

    $(form).on('submit', function (event) {
        event.preventDefault();
        var formData = new FormData(this);
        $('.groupComments').attr('hidden', 'hidden');
        $('.loader').removeAttr('hidden');
        var url = $(this).attr('data-action');
        var comment = $('#comment').val();
        var banner_question_id = $('#banner_question_id').val();


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'X-Socket-Id': pusher.connection.socket_id
            }
        });
        $.ajax({
            url: url,
            method: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'JSON',
            success: function (data) {
                // console.log(data['bannerQuestionComment']);
                var imageDiv = `<img src="`+ data['filename'] +`" alt="" class="bannerQuestionImageStyle">
                <br>
                <br>`;
                
                $('.groupComments').removeAttr('hidden');
                $('.loader').attr('hidden', 'hidden');
                var rowComment = `
                <div class="row no-gutters commentSectionRow" data-id="` + data['bannerQuestionComment'].id + `">
                    <div class="col-2 text-center pr-2">
                        <span class="initialCommentator"> ` + data['bannerQuestionComment'].user[0] + `
                        </span>
                    </div>
                    <div class="col-10">
                        <span class="nameCommentator">` + data['bannerQuestionComment'].user + ` <span
                                class="timeComment">` + timeAgo(data['bannerQuestionComment'].created_at) + `</span></span>
                        <br>
                        <div class="commentColor">
                            <span class="commentBanner">
                            `+ (data['filename'] != '' ? imageDiv : '') + `
                            ` + data['bannerQuestionComment'].comment + `
                                <div
                                    class="row actionButtonHidden">
                                    <div class="col-6 text-center">
                                        <span class="text-center ">
                                            <a type="button" data-id="` + data['bannerQuestionComment'].id + `" data-comment="` + data['bannerQuestionComment'].comment + `"
                                                class="editBannerCommentButton">Edit</a>
                                        </span>
                                    </div>
                                    <div class="col-6 text-center">
                                        <span class="text-center">
                                            <a type="button" class="deleteCommentBanner" data-id="` + data['bannerQuestionComment'].id + `">Delete</a>
                                        </span>
                                    </div>
                                </div>
                            </span>
                        </div>
                        <div class="row mt-1">
                            <div class="col-12">
                                <i class="fa-regular fa-heart heartReact` + data['bannerQuestionComment'].id + `
                                    data-id="` + data['bannerQuestionComment'].id + `"></i>
                                <a type="button" class="likeList" data-record="` + data['bannerQuestionComment'] + `">
                                    <i style="font-size: 12px"
                                        id="countReact` + data['bannerQuestionComment'].id + `">0
                                    </i>
                                    <i
                                        style="font-size: 12px">Like</i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                `;

                $(".groupComments").prepend(rowComment);
                $('.emoji-wysiwyg-editor').html('');
                $('#fileUpload').val('');
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

    $('.heartReact').click(function () {
        var banner_question_id = $('#banner_question_id').val();
        var banner_question_comment_id = $(this).attr('data-id');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/likeBannerComment',
            method: 'POST',
            dataType: 'JSON',
            data: {
                banner_question_id: banner_question_id,
                banner_question_comment_id: banner_question_comment_id
            },
            success: function (data) {
                if (data == 1) {
                    $('.heartReact' + banner_question_comment_id).removeClass("fa-solid");
                    $('.heartReact' + banner_question_comment_id).addClass("fa-regular");
                    $('.heartReact' + banner_question_comment_id).css('color', '#000');
                    if (parseInt($('#countReact' + banner_question_comment_id).html()) == 1) {
                        console.log('test');
                        $('#countReact' + banner_question_comment_id).html(' 0 ');
                    } else {
                        $('#countReact' + banner_question_comment_id).html(parseInt($('#countReact' + banner_question_comment_id).html()) - 1);
                    }
                } else {
                    $('.heartReact' + data.banner_question_comment_id).addClass("fa-solid");
                    $('.heartReact' + data.banner_question_comment_id).removeClass("fa-regular");
                    $('.heartReact' + data.banner_question_comment_id).css('color', '#ee2f21');
                    $('#countReact' + data.banner_question_comment_id).html(parseInt($('#countReact' + data.banner_question_comment_id).html()) + 1);
                }
            },
            error: function (error) {
                console.log(error);
            },
        });
    });

    // $('.heartReactRemove').click(function() {
    //     console.log('test');
    //     // var banner_question_id = $('#banner_question_id').val();
    //     // var banner_question_comment_id = $(this).attr('data-id');

    //     // $.ajaxSetup({
    //     //     headers: {
    //     //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     //     }
    //     // });
    //     // $.ajax({
    //     //     url: '/removeLikeBannerComment',
    //     //     method: 'POST',
    //     //     dataType: 'JSON',
    //     //     data: {
    //     //         banner_question_id: banner_question_id,
    //     //         banner_question_comment_id: banner_question_comment_id
    //     //     },
    //     //     success: function (data) {
    //     //         $('#heartReact' + data.banner_question_comment_id).removeClass("fa-solid");
    //     //     },
    //     //     error: function (error) {
    //     //         console.log(error);
    //     //     },
    //     // });
    // });

    // $('.editBannerComment').click(function() {
    //     let id = $(this).attr('data-id');
    //     let comment = $(this).attr('data-comment');
    //     $('#viewAllComments').modal('hide');
    //     // $('#viewAllComments').on('hidden.bs.modal', function () {
    //         // $('#editModal').modal('show')
    //     // })

    //     $('#commentBanner').html(comment);
    //     $('#banner_question_id ').val(id);
    // })

    $("#viewAllCommentsButton").click(function () {
        $("#viewAllComments").modal('show');
    });

    $(".editBannerCommentButton").click(function () {
        $("#viewAllComments").modal('hide');
        $("#editModal").modal('show');

        let id = $(this).attr('data-id');
        let comment = $(this).attr('data-comment');
        $('#commentBanner').html(comment);
        $('#banner_question_id ').val(id);
    });

    $('.deleteCommentBanner').click(function () {
        let banner_question_id = $(this).attr('data-id');
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
                    url: '/deleteCommentBanner',
                    method: 'POST',
                    dataType: 'JSON',
                    data: {
                        banner_question_id: banner_question_id,
                    },
                    success: function (data) {
                        $('.commentSectionRow').filter('[data-id="' + banner_question_id + '"]').remove();
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
    });

    $(".likeList").click(function () {
        $('#likeListContent').html('');
        $("#viewAllComments").modal('hide');
        $("#likeListModal").modal('show');
        let likes = $(this).attr('data-record');


        $.each(JSON.parse(likes), function (i, data) {

            let contentUserLikes = `
                <span>`+ data.user + `</span>
                <hr style="opacity: 1">`;

            $('#likeListContent').prepend(contentUserLikes);
        })

    });

    $('#closeLikeListModal').click(function () {
        $("#likeListModal").modal('hide');
    })

});