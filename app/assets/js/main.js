// Remove NavBar from iOS
if( !window.location.hash && window.addEventListener ){
    window.addEventListener( "load",function() {
        setTimeout(function(){
            window.scrollTo(0, 0);
        }, 0);
    });
    window.addEventListener( "orientationchange",function() {
        setTimeout(function(){
            window.scrollTo(0, 0);
        }, 0);
    });
}

// Menu Script
var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
    showLeftPush = document.getElementById( 'showLeftPush' ),
    body = document.body;

showLeftPush.onclick = function() {
    classie.toggle( this, 'active' );
    classie.toggle( body, 'cbp-spmenu-push-toright' );
    classie.toggle( menuLeft, 'cbp-spmenu-open' );
};

function disableOther( button ) {
    if( button !== 'showLeftPush' ) {
        classie.toggle( showLeftPush, 'disabled' );
    }
}

$(document).ready(function() {
    var toggleOptions = $('.info-box--options');

    toggleOptions.on('click', function() {
        var $this = $(this),
            $optionsBox = $this.closest('div.options-box');

        $this.toggleClass('info-box--options__selected');
        $this.next().next().next().toggle();
    });

    // Check for if we click something on the body that isn't what we were expecting
    $(document).on('click', function(event) {
        var $infoBoxOptions = $('.info-box--options');

        if (!$(event.target).is($infoBoxOptions) && !$(event.target).is('.options-box')) {
            // Make all option toggles inactive
            $($infoBoxOptions).removeClass('info-box--options__selected');

            // Grab all the option boxes
            var $optionsBox = $infoBoxOptions.parent().children('.options-box');

            // Go through each and see if it's been toggled already, turn it off it has been
            // toggled
            $optionsBox.each(function (index) {
                var $this = $(this);
                (!$this.is(':visible')) || $this.toggle();
            });
        }
    });
});


// Instantiate FastClick on the body
window.addEventListener('load', function() {
    FastClick.attach(document.body);
}, false);

