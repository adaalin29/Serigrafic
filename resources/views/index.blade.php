@extends('parts.template') @section('content')

<div class="banner" style = "background-image: url({{Voyager::image(setting('site.header-banner'))}})" >
  <div class="container">
    <div class="center-text" data-aos="zoom-in" data-aos-duration="1000">
      <div class="center-text-big">
        {{setting('site.banner-titlu')}}
      </div>
      <div class="center-text-small">
        {{setting('site.banner-subtitlu')}}
      </div>
    </div>

  </div>
  <div class="arrow">
    <section id="section04" class="demo">
      <a href="#section05" id="scroll-item"><span></span>Scroll</a>
    </section>
  </div>
</div>
<div class="container">
  <div class="our-story" id="section05">
    <div class="news-box box1">
      <div class="news-text">
        <div class="title">{{setting('site.box1-titlu')}}</div>
        <div class="news-content">
       {!! setting('site.box1text') !!}
        </div>
      </div>
      <div class="news-picture">
        <img src="{{ Voyager::image(setting('site.box1-picture')) }}">
      </div>
    </div>
    <div class="news-box box2">
      <div class="news-text news-mobile">
        <div class="title">{{setting('site.box2-title')}}</div>
        <div class="news-content">
          {!! setting('site.Box2-text') !!}
        </div>
      </div>

      <div class="news-picture">
        <img src="{{ Voyager::image(setting('site.box2-picture')) }}">
      </div>
      <div class="news-text news-desktop">
        <div class="title">{{setting('site.box2-title')}}</div>
        <div class="news-content">
          {!! setting('site.Box2-text') !!}
        </div>
      </div>
    </div>


  </div>

</div>

<div class="cards">
  @foreach($services_data as $service)
  <div class="box-card">
    <div class="link-card">
      
      <div class="text-link">
        <a href = "/servicii" style = "text-decoration:none; color:white;">
        <div class="text-link-content">
          <div class="text-link-stanga padding-element-stanga">{{$service['title']}}</div>
          <div class="text-link-dreapta"><img src="images/arrow-cards.png"></div>
        </div></a>
      </div>
      <img src="{{Voyager::image($service['image'])}}">

    </div>
  </div>
  @endforeach

</div>
<div class="container">
  <div class="servicii-container-mobile">
    <div class="swiper-container servicii-mobile index-servicii-mobile">
      <div class="swiper-wrapper">
        @foreach($services_data as $service)
        <div class="swiper-slide">
          <div class = "link-swiper">
            <div class="text-link">
        <div class="text-link-content">
          <div class="text-link-stanga">Serigrafie</div>
          <div class="text-link-dreapta"><img src="images/arrow.png"></div>
        </div>
      </div>
            <img src="{{Voyager::image($service['image'])}}">
          </div>
        </div>
        @endforeach
      </div>
      <!-- Add Pagination -->
      <div class="swiper-pagination"></div>
      <!-- Add Arrows -->
            <div class="swiper-button-next swiper-clienti-button-next"></div>
      <div class="swiper-button-prev swiper-clienti-button-prev"></div>
    </div>
  </div>

  <div class="clienti">
    <div class="titlu-clienti">
      Clienti
    </div>
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
      <div class="swiper-button-next swiper-button-servicii"></div>
      <div class="swiper-button-prev swiper-button-servicii"></div>
    </div>

  </div>
</div>

@endsection