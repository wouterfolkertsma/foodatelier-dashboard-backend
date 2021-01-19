@extends('layout.base')

@section('title', 'RSS Feeds')

@section('content')
    <div class="uk-card-default uk-card-body">
    <!--SEARCH-FILTER-->
    @include('includes/search-bar')

    <!--ADD-BUTTON-->
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
                    <td data-type="name">{{ $item->data->name }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($item->data->url, 50, $end='...') }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->updated_at }}</td>
                    <td>
                        <a class="uk-button uk-button-primary uk-button-small js-preview-rss" data-id="{{ $item->id }}">View</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div id="js-rss-preview-container"></div>
@endsection
