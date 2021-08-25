@extends('parts.template') @section('content')
<div class="banner portofoliu">
                    <div class="container">
                        <div class="banner-text">
                            <div class="banner-title">{{$portofoliu['title']}}</div>
                            <div class="banner-subtitle">{{$portofoliu['subtitle']}}</div>
                        </div>
                    </div>

                </div>
                <div class="container">
                    <div class="title detaliu-title">{{$portofoliu['title_info']}}</div>
                    <div class="news-content detaliu-text">
                        {{$portofoliu['title_text']}}
                    </div>
                    <div class="our-story" id="section05">
                        <div class="news-box box1">
                          <div class="news-picture news-mobile">
                                <img src="images/car1.png">
                            </div>
                            <div class="news-text">
                                <div class="title detaliu-title">{{$portofoliu['box1_title']}}</div>
                                <div class="news-content">
                                    {{$portofoliu['box1_text']}}
                                </div>
                            </div>
                            <div class="news-picture news-desktop">
                                <img src="{{Voyager::image($portofoliu['box1_image'])}}">
                            </div>
                        </div>
                        <div class="news-box box2">

                            <div class="news-picture">
                                <img src="{{Voyager::image($portofoliu['box2_image'])}}">
                            </div>
                            <div class="news-text">
                                <div class="title detaliu-title">{{$portofoliu['box1_title']}}</div>
                                <div class="news-content">
                                    {{$portofoliu['box2_text']}}
                                </div>
                            </div>
                        </div>
                        

                    </div>
                </div>

@endsection