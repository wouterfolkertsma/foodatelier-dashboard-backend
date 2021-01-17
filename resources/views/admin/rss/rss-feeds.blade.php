
@extends('layout.base')

@section('title', 'RSS Feed Management')

@section('content')
    <div class="uk-card-default uk-card-body">
        <!--SEARCH-FILTER-->
        @include('includes/search-bar')

        <!--ADD-BUTTON-->
        @if (auth()->user()->isEmployee())
            <a class="uk-button uk-button-primary uk-align-right" href="{{ route('rss.new') }}">New Feed</a>
        @endif

        <h3>Available RSS Feeds</h3>
        <table class="uk-table uk-table-striped" id="tableForm">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Url</th>
                <th>Date Created</th>
                <th>Date Updated</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody id="add-table">
            @foreach($data as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td data-type="name">{{ $item->name }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($item->url, 50, $end='...') }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->updated_at }}</td>
                    <td>
                        <a class="uk-button uk-button-secondary uk-button-small js-add-to-dashboard"
                           id="{{ $item->id }}"
                           data-type="{{ get_class($item) }}"
                           uk-toggle="target: #dashboards">Add to Dashboard</a>
                        <a class="uk-button uk-button-primary uk-button-small js-preview-rss" data-id="{{ $item->id }}" download>Preview</a>
                        @if (auth()->user()->isEmployee())
                            <a class="uk-button uk-button-secondary uk-button-small" href="{{ route('rss.edit', ['rssFeed' => $item->id]) }}">Edit</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div id="js-rss-preview-container"></div>

    <!-- This is the modal -->
    <div id="dashboards" uk-modal>
        <div class="uk-modal-dialog uk-modal-body uk-form-stacked">
            <legend class="uk-legend">Add data to Dashboard</legend>
            <div class="uk-margin">
                {{ Form::select('dashboard', $dashboards, null, ['id' => 'dashboard', 'class' => 'uk-select uk-form-width-medium']) }}
                <button id="js-add-to-dashboard" class="uk-button uk-button-secondary">Save</button>
            </div>
        </div>
    </div>
@endsection
