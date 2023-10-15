$(window).on('beforeunload', function (e) {
     $('html').attr('data-preloader', 'enable');
});
