@extends('parts.template') @section('content')
<div class="banner portofoliu">

                </div>
<div class="container">
  <div class="center-title">Clienti</div>
  <div class="news-content clienti-text">{{setting('site.clienti-text')}}
  </div>
  <div class="clienti-pictures">
    @foreach($client as $clientDetail)
    <div class="client-picture">
      <a href="{{$clientDetail['url']}}"><img src = "{{Voyager::image($clientDetail['image'])}}"></a>
    </div>
    @endforeach
    


  </div>
</div>
@endsection