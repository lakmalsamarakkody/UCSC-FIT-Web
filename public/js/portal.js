//COLORS 
const color_primary = "#3085d6";
const color_secondary = "#aaa";
const color_success = "#63c22c";
const color_warning = "#fdcf00";
const color_danger = "#d33";
const color_info = "#3fc3ee";
const color_error = "#87adbd";

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(function () {
    $('[data-tooltip="tooltip"]').tooltip()

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/portal/user/update/activity",
        type: 'post',
        // data: { 'userID': '{{ Auth::user()->id}}' },         
        success: function(data){
            console.log('login activity updated')
        },
        error: function(err){
            console.log('login activity update error')
        }
    });
    // /UPDATE LAST LOGIN ACTIVITY
})

