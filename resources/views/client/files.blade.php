@extends('layout.base')

@section('title', 'Files')

@section('content')

<div class="uk-margin-large" uk-filter="target: .js-filter ">

    <div class="uk-card-default-nav">
        <h5>Uploaded Files</h5>

        <ul class="uk-subnav uk-subnav-pill">
            <li class="uk-active" uk-filter-control><a href="#">All</a></li>
            <li uk-filter-control=".tag-image"><a href="#">Image</a></li>
            <li uk-filter-control=".tag-present"><a href="#">Presentations</a></li>
            <li uk-filter-control=".tag-text"><a href="#">Text Files</a></li>
            <li uk-filter-control=".tag-table"><a href="#">Tables</a></li>
        </ul>
    </div>

    <hr class="uk-divider-icon">
    
    <ul class="js-filter uk-child-width-1-2 uk-text-center" uk-grid>
    @foreach($files as $file)

    @if($file->data->imageable())
        <li class="tag-image">
            <div class="uk-card-default uk-card-body file-background" style="background-image: url('{{ $file->data->file_path }}')">
                    {{ $file->data->name }}<br><br>
                    <br><br>
                    {{ $file->data->created_at }}<br><br>

                    <a class="uk-button uk-button-secondary" href="{{ $file->data->file_path }}">View</a>
                    <a class="uk-button uk-button-primary" href="{{ $file->data->file_path }}" download>Download</a>
            </div>
        </li>
        @elseif($file->data->presentable())
        <li class="tag-present">
            <div class="uk-card-default uk-card-body">
                    {{ $file->data->name }}<br><br>
                    <br><br>
                    {{ $file->data->created_at }}<br><br>

                    <a class="uk-button uk-button-primary" href="{{ $file->data->file_path }}" download>Download</a>
            </div>
        </li>
        

        @elseif($file->data->textable())
        <li class="tag-text">
            <div class="uk-card-secondary uk-card-body">
                    {{ $file->data->name }}
                    <br><br>
                    {{ $file->data->created_at }}<br><br>

                    <a class="uk-button uk-button-primary" href="{{ $file->data->file_path }}" download>Download</a>
            </div>
        </li>

        @elseif($file->data->tableable())
        <li class="tag-table">
            <div class="uk-card-secondary uk-card-body">
                    {{ $file->data->name }}<br><br>
                    {{ $file->data->file_path }}<br><br>
                    {{ $file->data->created_at }}<br><br>

                    <a class="uk-button uk-button-primary" href="{{ $file->data->file_path }}" download>Download</a>
            </div>
        </li>
        @endif

        @endforeach
    </ul>

</div>

@endsection
