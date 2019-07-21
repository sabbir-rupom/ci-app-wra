$(function () {

    /**
     * Script for mobile device
     */
    if (isMobile()) {
        $('aside.sidebar').removeClass('expand');
        $('.main-content').removeClass('shrink');
    } else {
        $('aside.sidebar').addClass('expand');
        $('.main-content').addClass('shrink');
    }

    /**
     * Navbar Styling Animation
     */
    $('.sidebar-toggle').click(function () {
        if ($('aside.sidebar').hasClass('expand')) {
            $('aside.sidebar').removeClass('expand');
            $('.main-content').removeClass('shrink');
        } else {
            $('aside.sidebar').addClass('expand');
            $('.main-content').addClass('shrink');
        }
    });

    /**
     * Form input manipulation scripts 
     */
    $('input[type="file"]').change(function () {
        var name = '';
        var file;
        for (var i = 0; i < $(this).get(0).files.length; ++i) {
            file = $(this).get(0).files[i];
            name = file.name;
            $(this).siblings('label.custom-file-label').text(name);
            
            previewImage(file);
        }
    });

    // Form validation
    $("#contentForm").validate();


});

/**
 * Determine mobile / small screen devices
 * 
 * @returns {Boolean}
 */
function isMobile() {
    if ($(window).width() < 800 || /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        return true;
    }
    return false;
}

/**
 * Read selected image from input and show preview 
 * 
 * @param input
 * @returns boolean
 */
function previewImage(input) {

//    if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
        $('#imagePreview').html('<img class="img-fluid" src="' + e.target.result + '" />')
    }
    reader.readAsDataURL(input);

    return true;

}