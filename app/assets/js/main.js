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

        $div = $this.closest('div');
        $this.next().next().next().toggle();
    });
});


// Instantiate FastClick on the body
window.addEventListener('load', function() {
    FastClick.attach(document.body);
}, false);

