$(document).ready(function() {
    $('#book').turn({
        width: 800,
        height: 500,
        autoCenter: true
    });

    $('#prev').click(function() {
        $('#book').turn('previous');
    });

    $('#next').click(function() {
        $('#book').turn('next');
    });
});
