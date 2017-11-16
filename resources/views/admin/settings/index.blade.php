@extends('adminlte::page')

@section('content_header')
    <h1>{{ env('APP_NAME') }} Settings</h1>
@endsection

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">{{ env('APP_NAME') }} Settings</h3>
    </div>
    <form action="{{ route('adminSettingsUpdate') }}" method="POST" role="form" autocomplete="off">
        <div class="box-body">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            @foreach($settings as $setting)
                <div class="form-group">
                    <label for="{{ $setting->key }}">{{ trans('settings.' . $setting->key) }}</label>
                    <input
                        type="text"
                        class="form-control"
                        name="{{ $setting->key }}"
                        id="{{ $setting->key }}"
                        placeholder="{{ trans('settings.' . $setting->key) }}"
                        value="{{ $setting->value }}"
                    >
                </div>
            @endforeach
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Save Settings</button>
        </div>
    </form>
</div>
@endsection
