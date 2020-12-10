@extends('layout.base')

@section('title', "Edit $dashboard->name")

@section('content')
    <div class="uk-card uk-card-body">
        {{ Form::model($dashboard, ['route' => ['dashboard.update', $dashboard->id], 'class' => 'uk-form-stacked']) }}
        <fieldset class="uk-fieldset">
            <div class="uk-margin">
                {{ Form::label('name', 'Name:', ['class' => 'uk-form-label']) }}
                {{ Form::text('name', $dashboard->name, ['class' => 'uk-input uk-form-width-large']) }}
            </div>
            <!--SAVE-BUTTON-->
            <div class="save_button">
                {{ Form::submit('Save', ['class' => 'uk-button uk-button-default']) }}
            </div>
        </fieldset>
        {{ Form::close() }}
    </div>

    <div class="uk-card uk-card-body">
        <div class="col-xs-12">
            <h3>Existing data</h3>
            <table class="uk-table uk-table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Name</th>
                    <th>Date Created</th>
                    <th>Date Updated</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody id="remove-table">
                @foreach($dashboard->data as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->data_type }}</td>
                        <td>{{ $item->data->name }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->updated_at }}</td>
                        <td>
                            <button class="uk-button uk-button-primary js-dashboard-data-remove"
                                    data-id="{{ $item->id }}">Remove
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-xs-12">
            <h3>Available data</h3>
            <table class="uk-table uk-table-striped" id="tableForm">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Name</th>
                    <th>Date Created</th>
                    <th>Date Updated</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody id="add-table">
                <div id="resultsTable">
                @foreach($data as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->data_type }}</td>
                        <td data-type="name">{{ $item->data->name }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->updated_at }}</td>
                        <td>
                            <button class="uk-button uk-button-secondary js-dashboard-data-add"
                                    data-id="{{ $item->id }}">Add
                            </button>
                        </td>
                    </tr>
                @endforeach
                </div>
                </tbody>
            </table>
        </div>
    </div>

@endsection
