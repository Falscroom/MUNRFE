@extends('layout')

@section('content')
    <h1 class="main-title">Model United Nations of the Russian Far East</h1>
    <div class="main-image d-none d-md-none d-lg-block">
        <img src="{{ asset('/images/main_image.jpg') }}" alt="main image">
    </div>

    <section class="section" id="section-news">

        <div class="row section-divider flex-center">
            <div class="col-auto second-title" >Latest News</div>
            <div class="col"><hr></div>
        </div>

        <div class="row">
            @foreach ($posts as $post)
                <div class="col-sm-12 col-md-12 col-lg-4">
                    <a href="{{ route('post', ['id' => $post->id]) }}">
                        <article class="card mr-2">
                            <img src="{{ Voyager::image($post->thumbnail('preview') ) }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <div class="card-date">
                                    {{ $post->created_at }}
                                </div>
                                <h2 class="card-title" style="margin-top: 10px">
                                    {{ $post->title }}
                                </h2>
                                <p class="card-text">
                                    {!! substr(strip_tags($post->content),0,600) !!}{{strlen(strip_tags($post->content)) > 600 ? "..." : "" }}
                                </p>
                            </div>
                        </article>
                    </a>
                </div>
            @endforeach
        </div>

        <div class="more-container">
            <span class="more-text">All news</span>
        </div>
    </section>

    <section class="section" id="section-contacts">

        <div class="row section-divider flex-center">
            <div class="col-auto second-title" >Contacts</div>
            <div class="col"><hr></div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6">
                <div class="row">
                    <div class="col-3">
                        <img src="{{ asset('/images/vk.svg') }}" class="contacts-logo-image"/>
                    </div>
                    <div class="col-9 flex-center">
                        <a href="#" class="contacts-link">www.vk.com/munrfeasdasdasdasdasdasdasd</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-3">
                        <img src="{{ asset('/images/insta.svg') }}" class="contacts-logo-image"/>
                    </div>
                    <div class="col-9 flex-center">
                        <a href="#" class="contacts-link">www.instagram.com/munrfe</a>
                    </div>
                </div>
            </div>
            <div class="col-6 d-none d-md-none d-lg-block" id="contacts-image-container" >
                <img src="{{ asset('/images/group.jpg') }}" class="contacts-group-image"/>
            </div>
        </div>
    </section>

    <section class="section" id="section-partners">

        <div class="row section-divider flex-center">
            <div class="col-auto second-title" >Partners</div>
            <div class="col"><hr></div>
        </div>

        <div class="row">
            <div class="col-12 col-sm-4 col-md-3">
                <img src="{{ asset('/images/far-eastern-federal-university-526-logo.png') }}" class="partner-image">
                <p class="partner-text">Far Eastern Federal University</p>
            </div>
        </div>

        <div class="more-container">
            <span class="more-text">All partners</span>
        </div>
    </section>
@endsection