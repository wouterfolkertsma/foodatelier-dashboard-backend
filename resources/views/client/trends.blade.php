@extends('layout.base')

@section('title', 'Trends')

@section('content')
    <div class="uk-card-default uk-card-body">
        <!--SEARCH-FILTER-->
    @include('includes/search-bar')



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
                    </tr>
                    </thead>
                    <tbody id="resultsTable">
                    @foreach($filters as $filter)

                        <tr>
                            <td class="fixed-side">{{ $filter->data->id }}</td>
                            <td class="fixed-side last-fixed-side"><a onclick="updateChart({{$filter->data->id}})">{{ $filter->data->name }}</a></td>
                            <td>
                                @foreach ($filter->data->search_term as $key => $value)
                                    {{ $value }}
                                @endforeach
                            </td>
                            @if($filter->data->standard_interval)
                                <td>{{ $filter->data->standard_interval }}</td>
                                <td>NOW</td>
                            @else
                                <td>{{ $filter->data->custom_interval_from }}</td>
                                <td>{{ $filter->data->custom_interval_to }}</td>
                            @endif
                            @if($filter->data->location)
                                <td>{{ $filter->data->location}}</td>
                            @else
                                <td>DEFAULT (US)</td>
                            @endif
                            @if($filter->data->language)
                                <td>{{ $filter->data->language}}</td>
                            @else
                                <td>DEFAULT (US-ENG)</td>
                            @endif
                            @if($filter->data->search_type == "Web-Search")
                                <td><span uk-icon="icon: world"></span></td>
                            @elseif($filter->data->search_type == "Image-Search")
                                <td><span uk-icon="icon: image"></span></td>
                            @elseif($filter->data->search_type == "News-Search")
                                <td><span uk-icon="icon: commenting"></span></td>
                            @elseif($filter->data->search_type == "Youtube-Search")
                                <td><span uk-icon="icon: youtube"></span></td>
                            @elseif($filter->data->search_type == "Shopping-Search")
                                <td><span uk-icon="icon: cart"></span></td>
                            @endif
                        </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <div class="graph "style="width: 95%; height: 60%; z-index: 0">
        <div class="uk-card-default uk-card-body"style="height: 100%; width: 100%;">
            @include('includes.trends-chart-block')
        </div>
    </div>



    <script>


        jQuery(document).ready(function() {
            jQuery(".main-table").clone(true).appendTo('#table-scroll').addClass('clone');
        });
    </script>
@endsection

