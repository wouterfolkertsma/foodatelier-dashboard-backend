
@extends('layout.base')

@section('title', 'File Management')

@section('content')
    @include('includes.file-upload')
    <style>.filter{
            position: absolute;
            border: solid black 1px;
            border-radius: 2px;
            background-color : white;
            padding: 8px;
            display:none;
        }
    </style>

    <hr class="uk-divider-icon">
    <div class="uk-card-default uk-card-body">
        <h3>Available data</h3>
        <table class="filterTable uk-table uk-table-striped" id="tableForm">
            <thead>
            <tr>
                <th>ID</th>
                <th class="filterButton" index=1>Name</th>
                <th class="filterButton" index=2>Date Updated</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody id="add-table">
            @foreach($data as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td data-type="name">{{ $item->name }}</td>
                    <td>{{ $item->updated_at }}</td>
                    <td>
                        <a class="uk-button uk-button-secondary uk-button-small" href="{{ $item->file_path }}" download>Download</a>
                        <a class="uk-button uk-button-secondary uk-button-small js-add-to-dashboard"
                           id="{{ $item->id }}"
                           data-type="{{ get_class($item) }}"
                           uk-toggle="target: #dashboards">Add to Dashboard</a>
                        <a class="uk-button uk-button-primary uk-button-small"
                           onclick="window.jsAlertDeleteConfirm('{{ route('file.delete', ['id' => $item->id]) }}')">
                            Delete Data
                        </a>
                        @if($item->imageable())
                            <div uk-lightbox class="d-inline">
                                <a class="uk-button uk-button-secondary uk-button-small" href="/{{ $item->file_path }}">View</a>
                            </div>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

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
