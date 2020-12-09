
@extends('layout.base')

@section('title', 'FileManagement')

@section('content')

    @include('includes.file-upload')

    <h3>Available data</h3>
    <table class="uk-table uk-table-striped" id="tableForm">
        <thead>
        <tr>
            <th>ID</th>
            <th>Type</th>
            <th>Name</th>
            <th>Date Updated</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody id="add-table">
        @foreach($data as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->data_type }}</td>
                <td data-type="name">{{ $item->data->name }}</td>
                <td>{{ $item->updated_at }}</td>
                <td>
                    <div uk-lightbox>
                        <a class="uk-button uk-button-default" href="/{{ $item->data->file_path }}">View</a>
                    </div>
                    <a class="uk-button uk-button-danger" onclick="window.jsAlertDeleteConfirm('{{ route('file.delete', ['id' => $item->data->id]) }}')">Delete Data
                    </a>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>




@endsection
