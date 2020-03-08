@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <input class="form-control" type="text" placeholder="Search" aria-label="Search">
                    <i class="fas fa-search" aria-hidden="true"></i>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @foreach($articles as $article)
                            <div style="margin-bottom: 10px;border-bottom: 1px dotted black;">
                                <p style="color: #000000">
                                    <b>{{ $article->source->name }}</b> - {{\Carbon\Carbon::parse($article->publishedAt)->diffForHumans() }}
                                </p>
                                @if($article->urlToImage != null)
                                    <img width="100%" height="75%" src="{{ $article->urlToImage }}" />
                                @else
                                    <img width="100%" height="350px;" src="/img/no_image_available.jpg" />
                                @endif
                                <a href="{{ $article->url }}"><h3>{{ $article->title }}</h3></a>
                                <p style="color: #000000">{{ $article->description }}</p>
                            </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
