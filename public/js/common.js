$(document).ready(function () {
  
  
  
  
  var popupkey = $('.cookie-banner-container').attr('tm-popup-key');
console.log(popupkey);
  if (!Cookies.get(popupkey)) {
      $('.cookie-banner-container').addClass('is-active');
    }

  $('.cookie-banner-confirm').on('click', function () {
      $('.cookie-banner-container').removeClass('is-active');
      Cookies.set($('.cookie-banner-container').attr('tm-popup-key'), Date.now(), { expires: 365 });
  });
  $('.GDPR-popup-background').on('click', function () {
      $('.GDPR-popup-container').removeClass('is-active');
  });
  $('.GDPR-popup-confirm').on('click', function () {
      $('.GDPR-popup-container').removeClass('is-active');
      Cookies.set($('.GDPR-popup-container').attr('tm-popup-key'), Date.now(), { expires: 365 });
      // window.location.href = 'confidentialitate/';
  });

  $('.GDPR-popup-confirm-multumiri').on('click', function () {
      $('.GDPR-popup-container-multumiri').removeClass('is-active');
      Cookies.set($('.GDPR-popup-container-multumiri').attr('tm-popup-key'), Date.now(), { expires: 365 });
  });

	//AJAX submit a form
	$('.submitFormBtn').click(function () {
		$(this).addClass('ajax-loading');
		$(this).prop('disabled', true);
		$.ajax({
			context: this,
			type: $(this).attr('formmethod'),
			data: $(this).closest('form').serialize(),
			url: $('base').attr('href') + $(this).attr('formaction'),
		}).done(function (data) {
			$(this).closest('form').children('.error').html(data);
			$(this).removeClass('ajax-loading');
			$(this).prop('disabled', false);
			if (data.indexOf("class='green'") >= 0) $(this).closest('form')[0].reset();
		});

		return false;
	});

	//OFF CANVAS
	$('.toggle-off-canvas').click(function () {
		var pageBody = $('body');
		var offCanvas = $('#off-canvas');
		var pageWrapper = $('#wrapper');

		if (pageBody.hasClass('off-canvas-enabled')) {
			offCanvas.addClass('animation-leave');
			setTimeout(function () {
				offCanvas.removeClass('animation-enter animation-enter-active').addClass('animation-leave-active');
				pageWrapper.removeClass('animation-enter-active-wrapper').addClass('animation-leave-active-wrapper');

				setTimeout(function () {
					pageBody.removeClass('off-canvas-enabled');
					pageWrapper.removeClass('animation-leave-active-wrapper');
					offCanvas.removeClass('animation-leave animation-leave-active');
				}, 500);

			}, 250);
		}
		else {
			pageBody.addClass('off-canvas-enabled');
			offCanvas.addClass('animation-enter');
			setTimeout(function () {
				offCanvas.addClass('animation-enter-active');
				pageWrapper.addClass('animation-enter-active-wrapper');
			}, 250);
		}
	});
  
  if(screen.width>1024){
    $(".banner").css("background-size", "100%");
    
  }
  else{
    $(".banner").css("background-position", "center");
    $(".banner").css("background-size", "auto");
  }

	

	$('#scroll-item').on('click', function (e) {
		e.preventDefault();
		$('html, body').animate({ scrollTop: $($(this).attr('href')).offset().top }, 700, 'linear');
	});


	$(".cards>.box-card").each(function (index) {

		$(this).on({
			mouseenter: function () {
				//stuff to do on mouse enter
				$(".cards>.box-card").css("width", "8%");
				$(".cards>.box-card>.link-card>.text-link").hide();
				$(this).find(".link-card>.text-link").show();
				$(this).css("width", "20%");
			},
			mouseleave: function () {

				$(this).find(".link-card>.text-link").hide();
				$(this).css("width", "8%");
			}
		});
	});

	// $(".servicii-container>.servicii-box").each(function (index) {

	// 	$(this).on({
	// 		mouseenter: function () {
	// 			console.log("Da");
	// 			$(".servicii-box>.overlay.overlay1").css("display", "inline");
	// 			$(".servicii-box>.overlay.overlay2").css("height", "0");
	// 			$(".servicii-box>.overlay.overlay2").hide();
	// 		},
	// 		mouseleave: function () {

	// 			console.log("Nu");
	// 			$(".servicii-box>.overlay.overlay1").hide();
	// 			$(".servicii-box>.overlay.overlay2").css("display", "inline");
	// 			$(".servicii-box>.overlay.overlay2").css("height", "25%");
	// 		}
	// 	});
	// });


 var portofoliuSlides = 3;
  if(screen.width<=768)
    portofoliuSlides = 2;
  
//   if(screen.width<=480)
//     portofoliuSlides = 1;

	var swiper = new Swiper('.swiper2', {
		pagination: '.swiper-pagination',
		nextButton: '.swiper-button-next',
		prevButton: '.swiper-button-prev',
		slidesPerView: portofoliuSlides,
		paginationClickable: true,
		spaceBetween: 30,
		loop: true
	});
  var swiper3 = new Swiper('.swiper3', {
		pagination: '.swiper-pagination',
		nextButton: '.swiper1-pag-next',
		prevButton: '.swiper1-button-prev',
		slidesPerView: 1,
		paginationClickable: true,
// 		spaceBetween: 30,
		loop: true
	});
  var swiper4 = new Swiper('.servicii-mobile', {
		pagination: '.swiper-pagination',
		nextButton: '.swiper-clienti-button-next',
		prevButton: '.swiper-clienti-button-prev',
		slidesPerView: 1,
		paginationClickable: true,
// 		spaceBetween: 30,
		loop: true
	});
  
  
  var swiperSlides = 6;
  if(screen.width<=1366)
     swiperSlides = 3;
  if(screen.width<=1024)
     swiperSlides = 2;
  if(screen.width<=768)
    swiperSlides = 1;
  
/* swiper nichiduta */
	var swiper2 = new Swiper('.swiper-container-clienti', {
// 		pagination: '.swiper-pagination',
		nextButton: '.swiper-button-next.swiper-button-servicii',
		prevButton: '.swiper-button-prev.swiper-button-servicii',
		slidesPerView: swiperSlides,
		paginationClickable: true,
// 		spaceBetween: 30,
		loop: true
	});
  
  $(window).scroll(function() {
        if($(window).scrollTop() > 0) {
            $(".scroll-up").css("display","block");
        } else {
            $(".scroll-up").css("display","none");
        }
    }); 

    $(".scroll-up").click(function() {
      $("html, body").animate({ scrollTop: 0 }, "slow");
      return false;
    });




});

var width = 400;

if (screen.width <= 1366)
	width = 350;
function changeMenu(x) {
	// x.classList.toggle("change");
	document.getElementById("mySidenav").style.width = width+ "px";
}
function closeNav() {
	document.getElementById("mySidenav").style.width = "0";
}
if(screen.width<=1024){
	width = 100;
	function changeMenu(x) {
		// x.classList.toggle("change");
		document.getElementById("mySidenav").style.width = width+ "%";
	}	
}















//  var popupkey = $this.attr('tm-popup-key');
// console.log(popupkey);
//   if (!Cookies.get(popupkey)) {
//       $('.cookie-banner-container').addClass('is-active');
//     }

//   $('.cookie-banner-confirm').on('click', function () {
//       $('.cookie-banner-container').removeClass('is-active');
//       Cookies.set($('.cookie-banner-container').attr('tm-popup-key'), Date.now(), { expires: 365 });
//   });
//   $('.GDPR-popup-background').on('click', function () {
//       $('.GDPR-popup-container').removeClass('is-active');
//   });
//   $('.GDPR-popup-confirm').on('click', function () {
//       $('.GDPR-popup-container').removeClass('is-active');
//       Cookies.set($('.GDPR-popup-container').attr('tm-popup-key'), Date.now(), { expires: 365 });
//       // window.location.href = 'confidentialitate/';
//   });

//   $('.GDPR-popup-confirm-multumiri').on('click', function () {
//       $('.GDPR-popup-container-multumiri').removeClass('is-active');
//       Cookies.set($('.GDPR-popup-container-multumiri').attr('tm-popup-key'), Date.now(), { expires: 365 });
//   });




