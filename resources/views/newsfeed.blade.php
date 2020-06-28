
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-2">
            <div class="card">
                <div class="card-body" style="color:black;">
                    <h5 class="card-title">Categories</h5>
                    <div style="padding-bottom: 5px;">
                        <a href="{{url()->current()}}" style="background-color: #2ca02c" class="btn btn-primary">
                            <b>clear</b>
                        </a>
                    </div>
                    <hr/>
                    @foreach($categories as $category)
                        <div style="padding-bottom: 5px;">
                            <a href="?category={{$category->CategoryShort}}" class="btn btn-primary">
                                {{$category->CategoryShort}}
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
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

                            @for($page_number = 1; $page_number <= $total_pages; $page_number++)
                                @if($page == $page_number)
                                        <span style="color: black;font-weight: bold;">{{ $page_number }}</span>
                                @else
                                    <a href="{{ route('newsfeed') }}?page={{ $page_number.'&category='.app('request')->input('category') }}">{{ $page_number }}</a>
                                @endif
                            @endfor
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
