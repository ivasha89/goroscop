$(function () {
    $('#shadowjQ').mouseover(function () {
        $('#shadowjQ').addClass('shadow');
    });
    $('#shadowjQ1').mouseover(function () {
        $('#shadowjQ1').addClass('shadow');
    });
});
$(function () {
    $('#shadowjQ').mouseout(function () {
        $('#shadowjQ').removeClass('shadow');
        $('#shadowjQ').addClass('shadow-sm');
    });
    $('#shadowjQ1').mouseout(function () {
        $('#shadowjQ1').removeClass('shadow');
        $('#shadowjQ1').addClass('shadow-sm');
    });
});