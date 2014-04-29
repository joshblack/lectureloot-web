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

// jQuery Scripts
$(document).ready(function() {
    var toggleOptions = $('.info-box--options');

    toggleOptions.on('click', function() {
        var $this = $(this),
            $optionsBox = $this.closest('div.options-box');

        $this.toggleClass('info-box--options__selected');
        $this.next().next().toggle();
    });

    // Check for if we click something on the body that isn't what we were expecting
    $(document).on('click', function(event) {
        var $infoBoxOptions = $('.info-box--options'),
            $searchBox = $('.input--search');

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

    $('.search-page .info-box').on('click', function () {
        $(this).toggleClass('shadow');
    });

    // Checkin Script

    var $checkin = $('#checkin');
    // Toggle showLocation request
    $checkin.on('click', function() {
        $checkin.html('Checking you in...');
        showLocation();
    });

    function showLocation() {
        navigator.geolocation.getCurrentPosition(callback, errorHandler);
    }

    function callback(position) {
        var latitude = position.coords.latitude,
            longitude = position.coords.longitude;

        $.post(
            '/checkins',
            {
                latitude: latitude,
                longitude: longitude
            },
            function(data) {
                var info = $.parseJSON(data);
                if (info.error)
                {
                    $checkin.html('Whoops! Try again.')
                        .append('<p>' + info.error + '</p>');
                }
                else
                {
                    $checkin.attr('disabled', true)
                        .html('Success! You\'re good to go!')
                        .css('background', '#5CBD68');
                }
                console.log(info.error);
            }

            );
    }

    function errorHandler(error) {
        switch(error.code) {
            case error.PERMISSION_DENIED:
                document.getElementById('latitude').innerHTML = 'Location service privledges denied. Please enable it to checkin.';
                break;
            case error.POSITION_UNAVAILABLE:
                document.getElementById('latitude').innerHTML = 'Position unavailable, please try checking in in a few minutes.';
                break;
            case error.TIMEOUT:
                document.getElementById('latitude').innerHTML = 'Request timed out, please check your network settings and try again.';
                break;
            case error.UNKNOWN_ERROR:
                document.getElementById('latitude').innerHTML = 'Unknown error, please try again.';
                break;
        }
    }
});

// Instantiate FastClick on the body
window.addEventListener('load', function() {
    FastClick.attach(document.body);
}, false);

