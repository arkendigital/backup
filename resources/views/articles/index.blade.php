@extends('layouts.master')

@section('breadcrumbs')
    {{ Breadcrumbs::render() }}
@endsection

@section('content')
<main class="site">
    <section class="site__container">

        <aside class="col-3">
            @unless ($categories->isEmpty())
            <!-- #partials.sidebar.item -->
            <div class="sidebar__item">
                <div class="box">
                    <span class="box__title"><i class="fa fa-list"></i> Categories</span>
                    <p></p>
                    @foreach ($categories as $category)
                        <p><a href="{{$category->slug}}">{{$category->name}}</a></p>
                        <hr>
                    @endforeach
                    {{$categories->links()}}
                </div>
            </div>
            <!-- / #partials.sidebar.item -->
            @endunless
        </aside>

        <section class="col-9">
            @foreach ($articles as $article)
                <a  href="{{route('showArticle', [$article->game, $article])}}">
                    <div class="box profile__header" style='background-image: url("{{asset($article->image)}}");'>
                        <div class="profile__name" style="margin-top: 150px;">
                           <h4 style="color: #FFF;">{{$article->title}}</h4>
                            <p class="profile__subheader">
                                  Posted in {{$article->game->title}}</p>
                        </div>
                    </div>
                </a>

                <div class="box box--with-margin box--no-border">
                    <span class="box__title">
                        <i class="fa fa-newspaper-o"></i> Published {{$article->created_at->diffForHumans()}}
                    </span>
                    <div class="box__content">
                        <p>{{str_limit(strip_tags($article->body), 360)}}</p>
                        <div class="u-pull-right">
                            <a class="button icon" href="{{route('showArticle', [$article->game, $article])}}">
                                <i class="fa fa-book"></i> Read More
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
            {{$articles->links()}}
        </section>

    </section>
</main>
@endsection
