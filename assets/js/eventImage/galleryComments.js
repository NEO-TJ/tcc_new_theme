// ******************************************************************************************** Variable.
let baseUrl = window.location.origin + "/" + window.location.pathname.split('/')[1] + "/";
let commentUserIconPath = baseUrl + "assets/images/comment/";

// ******************************************************************************************** Variable.
$('#comments-container').comments({
    profilePictureURL: commentUserIconPath + "user-icon.png",
    enableReplying: true,
    enableEditing: true,
    enableUpvoting: false,
    enableDeleting: true,
    enableAttachments: false,
    enablePinging: false,
    enableHashtags: true,
    postCommentOnEnter: false,

    getComments: function(success, error) { GetCommentsFromDb(success, error); },
    postComment: function(commentJSON, success, error) { InsertCommentsToDb(commentJSON, success, error); },
    putComment: function(commentJSON, success, error) { UpdateCommentsToDb(commentJSON, success, error); },
    deleteComment: function(commentJSON, success, error) { DeleteCommentsToDb(commentJSON, success, error); },

    //upvoteComment: function(commentJSON, success, error) { UpvoteCommentsToDb(commentJSON, success, error); },
    //hashtagClicked: function(hashtag) {alert("hashtag");},
});


// ******************************************************************************************** Method.
// ############################################################################################ CRUD comment.
// -------------------------------------------------------------------------------------------- Get comment.
function GetCommentsFromDb(success, error) {
    let data = { 'iccCardId' : $('input#iccCardId').val() };

    // Get dashboard report by ajax.
    $.ajax({
        url: baseUrl + 'ajaxService/ajaxGetComments',
        type: 'post',
        data: data,
        dataType: 'json',
        beforeSend: function(){},
        error: error,
        complete: function(){},
        success: function(dsComments) {
            let commentsArray = commentsJsonToArray(dsComments);

            success(commentsArray);
        }
    });
}

// -------------------------------------------------------------------------------------------- Insert comment
function InsertCommentsToDb(commentJSON, success, error) {
    let dsComments = {
        'topic_id'              : $('input#iccCardId').val(),
        'creator'               : 0,
        'content'               : commentJSON['content'],
        'profile_picture_url'   : commentJSON['profile_picture_url'],
        'parent'                : commentJSON['parent'],
        'upvote_count'          : commentJSON['upvote_count'],
        'created_by_admin'      : commentJSON['created_by_admin'],
    };
    let data = {"dsComments" : dsComments };

    // Get dashboard report by ajax.
    $.ajax({
        url: baseUrl + 'ajaxService/ajaxInsertComments',
        type: 'post',
        data: data,
        beforeSend: function(){},
        error: error,
        complete: function(){},
        success: function(commentsId) {
            if(commentsId > 0) {
                commentJSON['id'] = commentsId;
                success(commentJSON);
            } else if(commentsId == -1) {
                swal({
                    title : 'แจ้งเตือน',
                    type : 'info',
                    html : "กรุณา login เข้าสู่ระบบ ก่อนคอมเมนต์ข้อความ",
                });
            } else {
                swal({
                    title : 'ผิดพลาด',
                    type : 'error',
                    html : "เกิดความผิดพลาดในการบันทึกข้อมูล กรุณาลองใหม่อีกครั้ง",
                })
            }
        }
    });
}

// -------------------------------------------------------------------------------------------- Insert comment
function UpdateCommentsToDb(commentJSON, success, error) {
    let dsComments = { 'content' : commentJSON['content'] };
    let data = {
        "commentsId" : commentJSON['id'],
        "dsComments" : dsComments
    };

    // Get dashboard report by ajax.
    $.ajax({
        url: baseUrl + 'ajaxService/ajaxUpdateComments',
        type: 'post',
        data: data,
        beforeSend: function(){},
        error: error,
        complete: function(){},
        success: function(result) {
            if(result > 0) {
                success(commentJSON);
            } else if(result == -1) {
                swal({
                    title : 'แจ้งเตือน',
                    type : 'info',
                    html : "กรุณา login เข้าสู่ระบบ ก่อนแก้ไขข้อความ",
                });
            } else {
                swal({
                    title : 'ผิดพลาด',
                    type : 'error',
                    html : "เกิดความผิดพลาดในการบันทึกข้อมูล กรุณาลองใหม่อีกครั้ง",
                })
            }
        }
    });
}

// -------------------------------------------------------------------------------------------- Delete comment
function DeleteCommentsToDb(commentJSON, success, error) {
    let data = { "commentsId" : commentJSON['id'] };

    // Get dashboard report by ajax.
    $.ajax({
        url: baseUrl + 'ajaxService/ajaxDeleteComments',
        type: 'post',
        data: data,
        beforeSend: function(){},
        error: error,
        complete: function(){},
        success: function(result) {
            if(result > 0) {
                success(commentJSON);
            } else if(result = -1) {
                swal({
                    title : 'แจ้งเตือน',
                    type : 'info',
                    html : "กรุณา login เข้าสู่ระบบ ก่อนลบข้อความ",
                });
            } else {
                swal({
                    title : 'ผิดพลาด',
                    type : 'error',
                    html : "เกิดความผิดพลาดในการลบข้อมูล กรุณาลองใหม่อีกครั้ง",
                })
            }
        }
    });
}


// -------------------------------------------------------------------------------------------- Insert comment
function UpvoteCommentsToDb(commentJSON, success, error) {
    let dsComments = {
        'upvote_count'      : commentJSON['upvote_count'],
        'user_has_upvoted'  : commentJSON['user_has_upvoted'],
    };
    let data = {
        "commentsId"    : commentJSON['id'],
        "creatorId"     : commentJSON['creator'],
        "dsComments"    : dsComments
    };

    // Get dashboard report by ajax.
    $.ajax({
        url: baseUrl + 'ajaxService/ajaxUpvoteComments',
        type: 'post',
        data: data,
        beforeSend: function(){},
        error: error,
        complete: function(){},
        success: function(result) {
            if(result > 0) {
                success(commentJSON);
            } else if(result == -1) {
                swal({
                    title : 'แจ้งเตือน',
                    type : 'info',
                    html : "กรุณา login เข้าสู่ระบบ ก่อนกดถูกใจข้อความ",
                });
            } else {
                swal({
                    title : 'ผิดพลาด',
                    type : 'error',
                    html : "เกิดความผิดพลาดในการบันทึกข้อมูล กรุณาลองใหม่อีกครั้ง",
                })
            }
        }
    });
}



// -------------------------------------------------------------------------------------------- json helper.
function commentsJsonToArray(dsComments) {
    for(let i = 0; i < dsComments.length; i++) {
        dsComments[i]["id"] = parseInt(dsComments[i]["id"]);
        dsComments[i]["parent"] = ((parseInt(dsComments[i]["parent"]) > 0) ? parseInt(dsComments[i]["parent"]) : null);
        dsComments[i]["creator"] = parseInt(dsComments[i]["creator"]);
        dsComments[i]["created_by_admin"] = ((dsComments[i]["created_by_admin"] == "1") ? true : false);
        dsComments[i]["created_by_current_user"] = ((dsComments[i]["created_by_current_user"] == "1") ? true : false);
        dsComments[i]["upvote_count"] = parseInt(dsComments[i]["upvote_count"]);
        dsComments[i]["user_has_upvoted"] = ((dsComments[i]["user_has_upvoted"] == "1") ? true : false);
    }

    return dsComments;
}