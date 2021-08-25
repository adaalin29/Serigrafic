@extends('parts.template') @section('content')
<div class="banner portofoliu" style = "background-image: url({{Voyager::image(setting('site.header-banner'))}})"></div>
<div class="container">
  <div class="center-title">Servicii</div>
  <div class="news-content servicii-info"> {!! setting('site.servicii-text') !!}</div>

  <div class="servicii-container">
    @foreach($services_data as $service)
    <div class="servicii-box box1">
      
      <img src="{{Voyager::image($service['image'])}}" class="image">
      <div class="overlay">
        <div class="servicii-text">
          <div class="servicii-title">{{$service['title']}}</div>
          <div class="servicii-subtitle">{{$service['text']}}</div>
        </div>
      </div>
     
    </div>
     @endforeach
    
    
  </div>

  <div class="servicii-container-mobile">
    <div class="swiper-container servicii-mobile">
      <div class="swiper-wrapper">
        @foreach($services_data as $service)
        <div class="swiper-slide">
          <div class="servicii-page">
            <div class="servicii-image">
              <img src="{{Voyager::image($service['image'])}}" class="image">
            </div>
            <div class="servicii-mobile-header">
              <div class="servicii-mobile-title">{{$service['title']}}

              </div>
              <div class="servicii-mobile-text">{{$service['text']}}

              </div>
            </div>
          </div>
        </div>
        @endforeach
        

      </div>
      <!-- Add Pagination -->
      <div class="swiper-pagination"></div>

  <div class="parent-swiper-container servicii-swiper-container">
    <div class="swiper-container swiper-container-clienti">
      <div class="swiper-wrapper">
        @foreach($imgs_swiper as $imagine)
          <div class="swiper-slide"><a href="{{$imagine['url']}}"><img class="img-swiper"
												src="{{Voyager::image($imagine['image'])}}" alt="Smiley face"></a></div>
          @endforeach

      </div>
      <!-- Add Arrows -->
    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
  </div>
</div>



</div>

@endsection