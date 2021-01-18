@extends('layout.base')

@section('title', 'Trends Management')

@section('content')
    <!--ADD-BUTTON-->
    <div class="uk-card-default-small uk-card-body">
        {{ Form::open(['route' => ['category.save'], 'class' => 'uk-form-stacked']) }}
        <fieldset class="uk-fieldset">
            <legend class="uk-legend">New category</legend>
            <div class="uk-margin">
                {{ Form::label('name', 'Category-Name', ['class' => 'uk-form-label']) }}
                {{ Form::text('name', '', ['class' => 'uk-input uk-form-width-large']) }}
            </div>

            {{ Form::submit('Save New Category', ['class' => 'uk-button uk-button-secondary']) }}
        </fieldset>
        {{ Form::close() }}
    </div>


    <div class="uk-card-default uk-card-body">
        <!--SEARCH-FILTER-->
    @include('includes/search-bar')




        <!--ZERO-RESULTS-ALERT-->
        <div class="uk-alert-warning" uk-alert id="no-results-alert" style="display: none">
            <p>No Results.</p>
        </div>
        <!--TABLE-->
        <table class="uk-table uk-table-striped" id="tableForm">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Trend-Filters</th>
                <th>RSS-Feeds</th>
                <th>Files</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody id="resultsTable">
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td data-type="name">{{ $category->name }}</td>
                    <td>{{ $category->trendFilterMembersCount() }} members</td>
                    <td>{{ $category->rssMembersCount() }} members</td>
                    <td>{{ $category->fileMembersCount() }} members</td>
                    <td>
                        <a href="{{ route('category.edit', ['id' => $category->id]) }}">Edit</a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
@endsection
