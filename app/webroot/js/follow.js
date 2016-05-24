$(function() {
    $('#doFollow').on('click', function(e) {
        e.preventDefault();
        var $this = $(this);
        if ($this.hasClass('follow')) {
            doAction = 'follow';
            addText = unFollowText;
        } else {
            doAction = 'unfollow';
            addText = followText;
        }
        $.ajax({
            url: '/users/' + doAction + '/' + folowerId,
            type: 'POST',
            dataType: 'JSON',
            data : { follower_id: folowerId },
            success: function(data) { 
                if (data.success) {
                    $this.toggleClass('follow unfollow')
                        .toggleClass('btn-primary btn-default')
                        .text(addText);
                } else {
                    $('.error').text(data.messages);
                }
            }
        });
    });
});