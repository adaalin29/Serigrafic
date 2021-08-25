@extends('parts.template') @section('content')
<div class="banner portofoliu">

</div>
<div class="container">
  <div class="center-title">Portofoliu</div>
  
  <div class = "categorii">
    <div class="categorie-element-swiper swiper-produse font-corrected" id_categorie = "0">
            Toate
          </div>
    
    @foreach($categorii as $categorie)
          <div class="categorie-element-swiper swiper-produse font-corrected" id_categorie = "{{$categorie['id']}}">
            {{$categorie['nume_categorie']}}
          </div>
        @endforeach
    
  </div>
  <div class="parent-swiper-container" style = "display:none;">
    <div class="swiper-container swiper2">
      <div class="swiper-wrapper">
        <div class="swiper-slide swiper-produse">
          <div class="categorie-element-swiper" id_categorie = "0">
            Toate
          </div>
        </div>
        @foreach($categorii as $categorie)
        <div class="swiper-slide swiper-produse">
          <div class="categorie-element-swiper" id_categorie = "{{$categorie['id']}}">
            {{$categorie['nume_categorie']}}
          </div>
        </div>
        @endforeach
      </div>
      <!-- Add Pagination -->

      <!-- Add Arrows -->
    </div>
  </div>
@if($portofolii->count() > 0)
  <div class="album">
    @foreach($portofolii as $portofoliu)
      @foreach($portofoliu['images'] as $imagine)
        <div class = "imagine-album categorie-{{$portofoliu['id_category']}}">
          <a href="{{Voyager::image($imagine)}}" class="fancybox-thumb album-box" rel="fancybox-thumb">
            <img src="{{Voyager::image($imagine)}}">
          </a>
        </div>
      @endforeach
    @endforeach
  </div>
@else
  <div class ="news-content portofoliu-hidden">
    Nu exista elemente!
  </div>
@endif

</div>


@endsection

@push('scripts')
<script type="text/javascript">
  $(document).ready(function(){
    $('.categorie-element-swiper').click(function(){
      var categorie_curenta = $(this).attr('id_categorie');
      if(categorie_curenta == 0){
         $('.imagine-album').fadeIn();
      }
      else{
        var elemente_afisate = '.categorie-' + categorie_curenta;
        $('.imagine-album').fadeOut();
        console.log(elemente_afisate);
        $(elemente_afisate).fadeIn();
        
      }
    });
    
  });
  $(".fancybox-thumb").fancybox({
      prevEffect	: 'none',
      nextEffect	: 'none',
      helpers	: {
        title	: {
          type: 'outside'
        },
        thumbs	: {
          width	: 100,
          height	: 100
        },
        overlay: {
          locked: false
        }
      }
    });
</script>
@endpush