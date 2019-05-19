@extends('layout')

@section('content')
    <style>
        figure {
            width: 100%;
        }
        img {
            width: 100%;
        }
        .gallery {
            margin-top: 50px;
            width: 100%;
            display: flex;
            justify-content: center;
        }
        .gallery > div {
            display: inline-block;
        }
    </style>
    <h1 class="main-title">{{ $post->title }}</h1>
    <div class="main-image" style="max-height: 350px; overflow: hidden;">
        <img src="{{ Voyager::image($post->image ) }}" alt="main image">
    </div>


    <section style="margin-top: 30px">
        <div class="card-text">
            {!! $post->content !!}
        </div>
    </section>

    <div class="row gallery no-gutters" itemscope itemtype="http://schema.org/ImageGallery">
            @foreach (json_decode($post->gallery) as $key => $image)
                <div class="col-lg-3">
                    <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                        <a href="{{ Voyager::image($image) }}" itemprop="contentUrl" data-size="{{ $post->getWidth($key) }}x{{ $post->getHeight($key) }}">
                            <img src="{{ Voyager::image($post->getThumbnail($image,'preview') ) }}" class="responsive-img" itemprop="thumbnail" alt="Image description" />
                        </a>
                    </figure>
                </div>
            @endforeach
    </div>

    <div class="spacer"></div>

    @include('photoswipe-layout')
@endsection

@section('javascript')
    <script src="{{ asset('js/photoswipe-init.js') }}"></script>
@endsection

















