@extends('layout.base')

@section('title', 'Trends Management')

@section('content')
    <div class="uk-card-default uk-card-body">
        <!--SEARCH-FILTER-->
    @include('includes/search-bar')

    <!--ADD-BUTTON-->
    <<a class="uk-button uk-button-primary uk-align-right" href="{{ route('filter.new') }}">New Filter</a>

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
                <th>Search Terms</th>
                <th>From</th>
                <th>To</th>
                <th>Location</th>
                <th>Language</th>
                <th>Web</th>
                <th>Image</th>
                <th>News</th>
                <th>Youtube</th>
                <th>Shopping</th>

                <th>Date Created</th>
                <th>Date Updated</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody id="resultsTable">
            @foreach($filters as $filter)
                <tr>
                    <td>{{ $filter->id }}</td>
                    <td>{{ $filter->name }}</td>
                    <td>
                        @foreach ($filter->search_term as $key => $value)

                            <span uk-icon="icon: tag"></span>{{ $value }}
                        @endforeach
                    </td>
                    @if($filter->standard_interval)
                        <td>{{ $filter->standard_interval }}</td>
                        <td>NOW</td>
                    @else
                        <td>{{ $filter->custom_interval_from }}</td>
                        <td>{{ $filter->custom_interval_to }}</td>
                    @endif
                    @if($filter->location)
                        <td>{{ $filter->location}}</td>
                    @else
                        <td>DEFAULT (US)</td>
                    @endif
                    @if($filter->language)
                        <td>{{ $filter->language}}</td>
                    @else
                        <td>DEFAULT (US-ENG)</td>
                    @endif
                    @if($filter->consider_web_search)
                        <td><span uk-icon="icon: check"></span></td>
                    @else
                        <td><span uk-icon="icon: close"></span></td>
                    @endif
                    @if($filter->consider_image_search)
                        <td><span uk-icon="icon: check"></span></td>
                    @else
                        <td><span uk-icon="icon: close"></span></td>
                    @endif
                    @if($filter->consider_news_search)
                        <td><span uk-icon="icon: check"></span></td>
                    @else
                        <td><span uk-icon="icon: close"></span></td>
                    @endif
                    @if($filter->consider_youtube_search)
                        <td><span uk-icon="icon: check"></span></td>
                    @else
                        <td><span uk-icon="icon: close"></span></td>
                    @endif
                    @if($filter->consider_shopping_search)
                        <td><span uk-icon="icon: check"></span></td>
                    @else
                        <td><span uk-icon="icon: close"></span></td>
                    @endif

                    <td>{{ $filter->created_at }}</td>
                    <td>{{ $filter->updated_at }}</td>
                    <td>
                        <a href="{{ route('filter.edit', ['id' => $filter->id]) }}">Edit</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <script>
        let arr2 = {!! json_encode($filter->search_term) !!};

        console.log(arr2)
    </script>
@endsection
