@extends('parts.template') @section('content')
<div class = "container">
  <div class="center-title">Termeni si Conditii</div>
  <div class = "termeni-text">
    <div class = "news-content termeni-align">
      {!! setting('site.termeni') !!}
    </div>
  </div>
</div>
@endsection