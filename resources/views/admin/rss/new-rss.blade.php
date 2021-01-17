
@extends('layout.base')

@section('title', 'New RSS Feed')

@section('content')
    <div class="uk-card-default uk-card-body">
        {{ Form::open(['route' => 'rss.save', 'class' => 'uk-form-stacked']) }}
        <legend class="uk-legend">New RSS</legend>
        <div class="uk-margin">
            {{ Form::label('name', 'Name:', ['class' => 'uk-form-label']) }}
            {{ Form::text('name', '', ['class' => 'uk-input uk-form-width-large']) }}
        </div>
        <div class="uk-margin">
            {{ Form::label('url', 'Url:', ['class' => 'uk-form-label']) }}
            {{ Form::text('url', '', ['class' => 'uk-input uk-form-width-large']) }}
        </div>
        <button id="js-preview-rss" class="uk-button-primary uk-button" type="button">Preview</button>
        <button class="uk-button-secondary uk-button">Save</button>
        {{ Form::close() }}
    </div>
    <div id="js-rss-preview-container"></div>
@endsection
