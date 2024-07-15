$.ajaxSetup({
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
})

$.ajax({
    url: checkAuth,
    type: 'POST',
    success: function(data) {
        profileButton = $(".profile_title")
        if(!data['ifAuth']) {
            profileButton.text('Войти')
        }else {
            profileButton.text('Профиль')
        }

        profileButton.animate({
            opacity: '+=25',
        }, 4000)
    },
    error: function(data) {
        console.log('Main Layout error - data was not fetched')
    },
})