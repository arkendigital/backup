@extends('layouts.master')

@section('breadcrumbs')

@endsection

@section('content')

<section class="gamefront__container">

    <div class="col-3">
        <div class="box box--with-margin">
            <span class="box__title">Games {{$profile->display_name}} contributes to</span>
            <div class="box__content">
                @foreach ($games as $game)
                    <p><a href="{{ route('showGame', $game) }}">{{$game->title}}</a></p>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-9">
        <div class="box box--with-margin">
            <span class="box__title">Files uploaded by {{$profile->display_name}}</span>
            <table width="100%" class="table table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Developer</th>
                        <th>Game</th>
                        <th>Filesize</th>
                        <th>Downloads</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @todo foreach loop through watched files --}}
                    @foreach ($files as $file)
                    <tr>
                        <td>
                            <a title="{{$file->title}}" href="{{route('showFile', [$file->game, $file])}}">
                                {{$file->title}}
                            </a>
                        </td> 
                        <td>
                            <a title="{{$file->profile->display_name}}" href="{{route('me', $file->profile)}}">
                                {{$file->profile->display_name}}
                            </a>
                        </td>
                        <td>
                            <a href="{{route('showGame', $file->game)}}" title="{{$file->game->title}}">
                                {{$file->game->title}}
                            </a>
                        </td>
                        <td>{{$file->upload->size}}</td> 
                        <td>{{$file->upload->downloads}}</td>
                    </tr>
                    @endforeach
                    {{-- @endtodo --}}
                </tbody>
            </table>
        </div>
    </div>

</section>
@endsection
