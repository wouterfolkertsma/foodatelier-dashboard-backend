
@extends('layout.base')

@section('title', 'Edit RSS Feed')

@section('content')
    <div class="uk-card-default uk-card-body">
        {{ Form::open(['route' => ['rss.update', $rssFeed->id], 'class' => 'uk-form-stacked']) }}
        <legend class="uk-legend">Edit $rssFeed->name</legend>
        <div class="uk-margin">
            {{ Form::label('name', 'Name:', ['class' => 'uk-form-label']) }}
            {{ Form::text('name', $rssFeed->name, ['class' => 'uk-input uk-form-width-large']) }}
        </div>
        <div class="uk-margin">
            {{ Form::label('url', 'Url:', ['class' => 'uk-form-label']) }}
            {{ Form::text('url', $rssFeed->url, ['class' => 'uk-input uk-form-width-large disabled']) }}
        </div>
        <div class="button_area">
            <div class="save_button">
                {{ Form::submit('Save', ['class' => 'uk-button uk-button-secondary']) }}
            </div>

            <a class="delete_button uk-button uk-button-primary" onclick="window.jsAlertDeleteConfirm('{{ route('rss.delete', ['rssFeed' => $rssFeed->id]) }}')">
                Delete RSS Feed
            </a>
        </div>
        {{ Form::close() }}
    </div>
    <div id="js-rss-preview-container"></div>
@endsection
