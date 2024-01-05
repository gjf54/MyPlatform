$.ajaxSetup({
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
})

$.ajax({
    url: checkAuth,
    type: 'POST',
    success: function(data) {
        profileButton = $(".profile_title")
        if(!data['ifAuth']) {
            profileButton.text('Sign In')
        }else {
            profileButton.text('Profile')
        }

        profileButton.animate({
            opacity: '+=25',
        }, 4000)
    },
    error: function(data) {
        console.log('Main Layout error - data not fetched')
    },
})