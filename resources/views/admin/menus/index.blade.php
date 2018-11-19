@extends('adminlte::page')


@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">All Menu Sections</h3>
    </div>
    
    <div class="box-body">
        @unless ($menus->isEmpty())
        
        @foreach ($menus as $menu)
        <div class="table-responsive">
            <table class="table table-hover" id="datatable-nopaging">
                <thead>
                    <tr>
                        <th>{{ $menu->name }} Menu - <a href="{{ route('menulink.create', $menu) }}">Add</a></th>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($menu->links as $link)
                            <tr>
                                <td>{{ $link->text }}</td>
                                <td>{{ $link->link }}</td>
                                <td>{{ $link->order }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-success btn-small" type="button" href="{{ route('menulink.edit', $link->id) }}">
                                        <i class="fa fa-pencil"></i>
                                        </a>
                    
                                        <a class="btn btn-danger btn-small" type="button" href="javascript:void(0);" onclick="document.getElementById('menu-link-{{ $link->id }}').submit();">
                                        <i class="fa fa-trash"></i>
                                        </a>
                    
                                        <form action="{{ route('menulink.destroy', $link->id) }}" method="POST" id="menu-link-{{ $link->id }}">
                                        {{ csrf_field() }}
                                        {{ method_field("DELETE") }}
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endforeach
            @else
            <div class="box__content">
                <h3 class="text-center">You haven't got any menus. :(</h3>
                <img src="{{ asset('storage/images/admin/no-articles-error.jpg') }}" class="center-block" alt="">
            </div>
            @endunless
        </div>
    </div>
    @endsection
    