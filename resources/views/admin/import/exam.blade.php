@extends('adminlte::page')

@section('content_header')
    <h1>Upload Exam Survey Data</h1>
@endsection

@section('content')

<div class="box box-primary">
    <form action="{{ route('import.exam-survey') }}" method="POST" role="form" enctype="multipart/form-data">
        <div class="box-body">
            {{ csrf_field() }}
            {{ method_field("POST") }}

            <div class="form-group">
              <label for="file">File</label>
              @if($errors->has("file"))
                <p class="text-danger">{{ $errors->first("file") }}</p>
              @endif
              <input type="file" class="form-control" name="file" id="file">
            </div>

			<button class="btn btn-success">Import</button>

		</div>
	</form>
</div>

@endsection
