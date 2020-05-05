
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <input class="form-control" type="text" name="txt_search" placeholder="Search" aria-label="Search" value="{{ $search_query }}">
                    <i class="fas fa-search" aria-hidden="true"></i>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if($articles->count() > 0)
                            @foreach($articles as $article)
                                <div>
                                    <p style="color: #000000">
                                        <b>{{ $article->source->name }}</b> - {{\Carbon\Carbon::parse($article->publishedAt)->diffForHumans() }}
                                    </p>
                                    @if($article->urlToImage != null)
                                        <img width="100%" height="75%" src="{{ $article->urlToImage }}" />
                                    @else
                                        <img width="100%" height="350px;" src="/img/no_image_available.jpg" />
                                    @endif
                                    <a href="{{ $article->url }}" target="_blank"  ><h3>{{ $article->title }}</h3></a>
                                    <p style="color: #000000">{{ $article->description }}</p>
                                </div>
                                <div style="margin-bottom: 10px;border-bottom: 1px dotted black;">
                                    <span style="color: black;">category: </span><span style="color: black;font-weight: bold;">{{ $article->category }}</span>
                                </div>
                            @endforeach
                    @else
                            <div style="margin-bottom: 10px;border-bottom: 1px dotted black;">
                                <p style="color: #000000">
                                    Nothing found!
                                </p>
                            </div>
                    @endif


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
