// ******************************************************************************************** Variable.
let baseUrl = window.location.origin + "/" + window.location.pathname.split('/')[1] + "/";
let commentUserIconPath = baseUrl + "assets/images/comment/";

let commentsArray1 = [  
    {  
       "id": 1,
       "parent": null,
       "created": "2015-01-01",
       "modified": "2015-01-01",
       "content": "Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Sed posuere interdum sem. Quisque ligula eros ullamcorper quis, lacinia quis facilisis sed sapien. Mauris varius diam vitae arcu.",
       "pings": [],
       "creator": 6,
       "fullname": "Simon Powell",
       "profile_picture_url": commentUserIconPath + "user-icon.png",
       "created_by_admin": false,
       "created_by_current_user": false,
       "upvote_count": 3,
       "user_has_upvoted": false
    },
    {  
       "id": 2,
       "parent": null,
       "created": "2015-01-02",
       "modified": "2015-01-02",
       "content": "Sed posuere interdum sem. Quisque ligula eros ullamcorper quis, lacinia quis facilisis sed sapien. Mauris varius diam vitae arcu.",
       "pings": [],
       "creator": 5,
       "fullname": "Administrator",
       "profile_picture_url": commentUserIconPath + "admin-user-icon.png",
       "created_by_admin": true,
       "created_by_current_user": false,
       "upvote_count": 2,
       "user_has_upvoted": false
    },
    {  
       "id": 3,
       "parent": null,
       "created": "2015-01-03",
       "modified": "2015-01-03",
       "content": "@Hank Smith sed posuere interdum sem.\nQuisque ligula eros ullamcorper https://www.google.com/ quis, lacinia quis facilisis sed sapien. Mauris varius diam vitae arcu. Sed arcu lectus auctor vitae, consectetuer et venenatis eget #velit.",
       "pings": [3],
       "creator": 1,
       "fullname": "You",
       "profile_picture_url": commentUserIconPath + "user-icon.png",
       "created_by_admin": false,
       "created_by_current_user": true,
       "upvote_count": 2,
       "user_has_upvoted": true
    },
    {  
       "id": 4,
       "parent": 3,
       "created": "2015-01-04",
       "modified": "2015-01-04",
       "file_url": "http://www.w3schools.com/html/mov_bbb.mp4",
       "file_mime_type": "video/mp4",
       "creator": 4,
       "fullname": "Todd Brown",
       "profile_picture_url": commentUserIconPath + "user-icon.png",
       "created_by_admin": false,
       "created_by_current_user": false,
       "upvote_count": 0,
       "user_has_upvoted": false
    },
    {  
       "id": 5,
       "parent": 4,
       "created": "2015-01-05",
       "modified": "2015-01-05",
       "content": "Quisque ligula eros ullamcorper quis, lacinia quis facilisis sed sapien. Mauris varius diam vitae arcu. Sed arcu lectus auctor vitae, consectetuer et venenatis eget velit.",
       "pings": [],
       "creator": 3,
       "fullname": "Hank Smith",
       "profile_picture_url": commentUserIconPath + "user-icon.png",
       "created_by_admin": false,
       "created_by_current_user": false,
       "upvote_count": 0,
       "user_has_upvoted": false
    },
    {  
       "id": 6,
       "parent": 1,
       "created": "2015-01-06",
       "modified": "2015-01-06",
       "content": "Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Sed posuere interdum sem. Quisque ligula eros ullamcorper quis, lacinia quis facilisis sed sapien. Mauris varius diam vitae arcu.",
       "pings": [],
       "creator": 2,
       "fullname": "Jack Hemsworth",
       "profile_picture_url": commentUserIconPath + "user-icon.png",
       "created_by_admin": false,
       "created_by_current_user": false,
       "upvote_count": 1,
       "user_has_upvoted": false
    },
    {  
       "id": 7,
       "parent": 1,
       "created": "2015-01-07",
       "modified": "2015-01-07",
       "content": "Sed posuere interdum sem. Quisque ligula eros ullamcorper quis, lacinia quis facilisis sed sapien. Mauris varius diam vitae arcu. Sed arcu lectus auctor vitae, consectetuer et venenatis eget velit.",
       "pings": [],
       "creator": 5,
       "fullname": "Administrator",
       "profile_picture_url": commentUserIconPath + "admin-user-icon.png",
       "created_by_admin": true,
       "created_by_current_user": false,
       "upvote_count": 0,
       "user_has_upvoted": false
    },
    {  
       "id": 8,
       "parent": 6,
       "created": "2015-01-08",
       "modified": "2015-01-08",
       "content": "Sed posuere interdum sem. Quisque ligula eros ullamcorper quis, lacinia quis facilisis sed sapien. Mauris varius diam vitae arcu.",
       "pings": [],
       "creator": 1,
       "fullname": "You",
       "profile_picture_url": commentUserIconPath + "user-icon.png",
       "created_by_admin": false,
       "created_by_current_user": true,
       "upvote_count": 0,
       "user_has_upvoted": false
    },
    {  
       "id": 9,
       "parent": 8,
       "created": "2015-01-09",
       "modified": "2015-01-10",
       "content": "Quisque ligula eros ullamcorper quis, lacinia quis facilisis sed sapien. Mauris varius diam vitae arcu. Sed arcu lectus auctor vitae, consectetuer et venenatis eget velit.",
       "pings": [],
       "creator": 7,
       "fullname": "Bryan Connery",
       "profile_picture_url": commentUserIconPath + "user-icon.png",
       "created_by_admin": false,
       "created_by_current_user": false,
       "upvote_count": 0,
       "user_has_upvoted": false
    },
    {  
       "id": 10,
       "parent": 9,
       "created": "2015-01-10",
       "modified": "2015-01-10",
       "content": "Quisque ligula eros ullamcorper quis, lacinia quis facilisis sed sapien. Mauris varius diam vitae arcu. Sed arcu lectus auctor vitae, consectetuer et venenatis eget velit.",
       "pings": [],
       "creator": 1,
       "fullname": "You",
       "profile_picture_url": commentUserIconPath + "user-icon.png",
       "created_by_admin": false,
       "created_by_current_user": true,
       "upvote_count": 0,
       "user_has_upvoted": false
    }
]


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
    postCommentOnEnter: true,

    getComments: function(success, error) { GetCommentsFromDb(success, error); },
    postComment: function(commentJSON, success, error) { InsertCommentsToDb(commentJSON, success, error); },
    putComment: function(commentJSON, success, error) { UpdateCommentsToDb(commentJSON, success, error); },
    deleteComment: function(commentJSON, success, error) { DeleteCommentsToDb(commentJSON, success, error); },

    upvoteComment: function(commentJSON, success, error) { UpvoteCommentsToDb(commentJSON, success, error); },
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












var usersArray = [
    {
        id: 1,
        fullname: "Current User",
        email: "current.user@viima.com",
        profile_picture_url: "https://app.viima.com/static/media/user_profiles/user-icon.png"
    },
    {
        id: 2,
        fullname: "Jack Hemsworth",
        email: "jack.hemsworth@viima.com",
        profile_picture_url: "https://app.viima.com/static/media/user_profiles/user-icon.png"
    },
    {
        id: 3,
        fullname: "Hank Smith",
        email: "hank.smith@viima.com",
        profile_picture_url: "https://app.viima.com/static/media/user_profiles/user-icon.png"
    },
    {
        id: 4,
        fullname: "Todd Brown",
        email: "todd.brown@viima.com",
        profile_picture_url: "https://app.viima.com/static/media/user_profiles/user-icon.png"
    },
    {
        id: 5,
        fullname: "Administrator",
        email: "administrator@viima.com",
        profile_picture_url: "https://app.viima.com/static/media/user_profiles/user-icon.png"
    },
    {
        id: 6,
        fullname: "Simon Powell",
        email: "simon.powell@viima.com",
        profile_picture_url: "https://app.viima.com/static/media/user_profiles/user-icon.png"
    },
    {
        id: 7,
        fullname: "Bryan Connery",
        email: "bryan.connery@viima.com",
        profile_picture_url: "https://app.viima.com/static/media/user_profiles/user-icon.png"
    }
]
