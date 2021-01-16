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
        <div id="table-scroll" class="table-scroll">
            <div class="table-wrap">

        <table class="uk-table uk-table-striped main-table" id="tableForm">
            <thead>
            <tr>
                <th class="fixed-side" scope="col">ID</th>
                <th class="fixed-side last-fixed-side" scope="col">Name</th>
                <th scope="col">Search Terms</th>
                <th scope="col">From</th>
                <th scope="col">To</th>
                <th scope="col">Location</th>
                <th scope="col">Language</th>
                <th scope="col">Search-Type</th>


                <th>Date Created</th>
                <th>Date Updated</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody id="resultsTable">
            @foreach($filters as $filter)

                <tr>
                    <td class="fixed-side">{{ $filter->id }}</td>
                    <td class="fixed-side last-fixed-side"><a href="{{ route('filter.edit', ['id' => $filter->id]) }}">{{ $filter->name }}</a></td>
                    <td>
                        @foreach ($filter->search_term as $key => $value)
                            {{ $value }}
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
                    @if($filter->search_type == "Web-Search")
                        <td><span uk-icon="icon: world"></span></td>
                    @elseif($filter->search_type == "Image-Search")
                        <td><span uk-icon="icon: image"></span></td>
                    @elseif($filter->search_type == "News-Search")
                        <td><span uk-icon="icon: commenting"></span></td>
                    @elseif($filter->search_type == "Youtube-Search")
                        <td><span uk-icon="icon: youtube"></span></td>
                    @elseif($filter->search_type == "Shopping-Search")
                        <td><span uk-icon="icon: cart"></span></td>
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

        jQuery(document).ready(function() {
            jQuery(".main-table").clone(true).appendTo('#table-scroll').addClass('clone');
        });
    </script>
@endsection
