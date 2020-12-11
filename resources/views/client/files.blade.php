@extends('layout.base')

@section('title', 'Files')

@section('content')
    <div class="uk-card-default uk-card-body">
        <h3>Uploaded files</h3>
        <!--TABLE-->
        <table class="uk-table uk-table-striped" id="tableForm">
            <thead>
            <tr>
                <th>ID</th>
                <th>Filename</th>
                <th>Filepath</th>
                <th>Date Created</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody id="resultsTable">
            @foreach($files as $file)
                <tr>
                    <td>{{ $file->data->id }}</td>
                    <td data-type="name">{{ $file->data->name }}</td>
                    <td>{{ $file->data->file_path }}</td>
                    <td>{{ $file->data->created_at }}</td>
                    <td>
                        @if($file->data->imageable())
                            <div uk-lightbox>
                                <a class="uk-button uk-button-secondary" href="{{ $file->data->file_path }}">View</a>
                            </div>
                        @endif
                        <br>
                        <a class="uk-button uk-button-primary" href="{{ $file->data->file_path }}" download>Download</a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
@endsection
