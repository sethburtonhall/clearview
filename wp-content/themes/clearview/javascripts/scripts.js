/**
 * Here goes all the JS Code you need in your child theme buddy!
 */
(function($) {

 $('#slider').orbit({
     fluid: '960x353',
     timer: true,
     directionalNav: true,
     bullets: false,
     captions: true,
     captionAnimation: 'fade',
     captionAnimationSpeed: 800,
     animation: 'horizontal-push',
     advanceSpeed: 6000,
     pauseOnHover: true,
     startClockOnMouseOut: false,
     startClockOnMouseOutAfter: 1000
 });
 $('#slider-home .timer').hide();

}(jQuery));
