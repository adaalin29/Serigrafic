@extends('parts.template') @section('content')
<div class="banner portofoliu">

</div>
<div class="container">
  <div class="our-story contact-story">
    <div class="contact-info">
      <div class="title contact-title">Contacteaza-ne!</div>
      <div class="news-content contact-news-content">Ai intrebari sau vrei o oferta pentru proiectul tau? <br> Lasa-ne un mesaj in formularul de mai jos.</div>
      <form id="form-contact" class = "formulare" action='{{ action("ContactController@send_message") }}' method="post">
        {{ csrf_field() }}
        <input type="text" id="fname" name="name" placeholder="Nume">
        <input type="text" id="ftel" name="phone" placeholder="Telefon">
        <input type="text" id="femail" name="email" placeholder="Email">
        <textarea name="message" placeholder = "Mesaj"></textarea>
        <div class="form-field termeni-si-conditii">
                    <p>
                        <input type="checkbox" id="accept-privacy" name="termeni" value="checkbox" style="vertical-align: middle; text-align: left; width: 20px;">
                        <label for="accept-privacy">Bifand aceasta casuta acceptati <a href="termeni/" style="color: #949494; font-weight: bold; padding-left: 0; margin-left: 5px;" target="_blank">Termenii si conditiile</a> .</label>
                    </p>
            </div>
        <div id="rezultat-formular"></div>
      <div class="button-send"><button class="button btn-send-message"  type="submit">Trimite</button></button>
      </div>
      </form>
      <div class="adress">
        <div class="adress-picture"><img src="images/contact-picture.png"></div>
        <div class="adress-text">
          <div class="adress-title">Adresa Birou</div>
          <div class="adress-subtitle">Strada Caraiman, nr.6 (incinta VINVICO) Constanta, Romania</div>
        </div>
      </div>
    </div>
<!--     <div class="map">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1212.232955617834!2d28.656965224074792!3d44.19169369876417!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40bafac83eece869%3A0xa941e7c026a90f3b!2sZoom+Beach!5e1!3m2!1sro!2sro!4v1555588214749!5m2!1sro!2sro"
        width="100%" height="600px" frameborder="0" style="border:0" allowfullscreen></iframe>
      
  </div> -->
  
  <div id="map-canvas"></div>
  </div>
</div>
@endsection
@push('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCmM1P-D5Zka0kPEbZSrsR90gpBlDxgm18"></script>
<script>
   document.addEventListener("DOMContentLoaded", function () {
            $.ajaxSetup({
							
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
            });
            
            var $formContact = $('#form-contact');
            var $rezultatFormular = $('#rezultat-formular');
            $formContact.on('submit', function(event) {
                event.preventDefault();
                $.ajax({
                    method: 'POST',
                    url: '{{ action("ContactController@send_message") }}',
										data: $formContact.serializeArray(),
                    context: this, async: true, cache: false, dataType: 'json'
                }).done(function(res) {
                    if (res.success == true) {
                      	$rezultatFormular.css('display', 'inline-block');  
												$rezultatFormular.html(
                            '<div style="color: green; background-color: white;">Mesajul a fost trimis cu succes!</div><br>'
												);
											setTimeout(function () { window.location.reload(); }, 4000);
                    } else { 
											$rezultatFormular.css('display','inline-block');
											$rezultatFormular.css('color','red');
											$rezultatFormular.html(
												
												'<strong>'+res.error.join('<br>')+"</strong>"
											);
											
                    }
                });
                return;
            });
          
        });
  function initialize() {

// 				var geocoder;
      
//         var address = "{{setting('site.adresa')}}";

				// # Get marker data

				var defaultMarkerLat = "{{setting('site.latitudine')}}";

				var defaultMarkerLng = "{{setting('site.longitudine')}}";

				var markerImg = 'images/marker.png';

				var markerTitle = "{{setting('site.title')}}";



				// # Show map

				var myLatlng = new google.maps.LatLng(defaultMarkerLat,defaultMarkerLng);

				var mapOptions = {

					zoom: 15,

					center: myLatlng,

					scrollwheel: false,

					mapTypeId: google.maps.MapTypeId.ROADMAP,
          
          disableDefaultUI: true

				}

				var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

				// # Show marker

				var marker = new google.maps.Marker({
          
          

					position: myLatlng,

					map: map,

// 					icon:{markerImg} ,
          icon:{url: "images/marker.png",
               scaledSize: new google.maps.Size(48,58)} ,

					title: markerTitle
				});

			}



			google.maps.event.addDomListener(window, 'load', initialize);
  
</script>
@endpush
