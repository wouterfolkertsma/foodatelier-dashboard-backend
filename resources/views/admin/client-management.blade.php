@extends('layout.base')

@section('title', 'Client Management')

@section('content')
    <div class="account-type-selection">
        <a class="uk-button uk-button-primary uk-align-right" href="{{ route('employee-manager') }}">Employee-Manager</a>
    </div>
    <div class="uk-card uk-card-body">

    <!--SEARCH-FILTER-->
        <div class="fa-search">
            <input id="query" onkeyup="tablefilter()" type="search" placeholder="" name="name" autocomplete="off" required />
            <label for="name" class="label-name">
                <span class="content-name">Search</span>
                <span class="search-icon" uk-search-icon></span>
                <button class="refresh-icon" uk-icon="refresh" onclick="tablefilterRefresh()" ></button>
            </label>
        </div>

    <!--ADD-BUTTON-->
        <a class="uk-button uk-button-primary uk-align-right" href="{{ route('company.new') }}">New company</a>
    </div>




    <div class="uk-card uk-card-body">
        <!--ZERO-RESULTS-ALERT-->
        <div class="uk-alert-warning" uk-alert  id="noresultsalert" style="visibility: hidden">
            <p>No Results.</p>
        </div>
        <!--TABLE-->
        <table class="uk-table uk-table-striped" id="tableForm">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Date Created</th>
                <th>Date Updated</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody id="resultsTable">
            @foreach($companies as $company)
                <tr>
                    <td>{{ $company->id }}</td>
                    <td>{{ $company->name }}</td>
                    <td>{{ $company->created_at }}</td>
                    <td>{{ $company->updated_at }}</td>
                    <td>
                        <a href="{{ route('company.edit', ['id' => $company->id]) }}">Edit</a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>


    <!--TABLE-FILTER-FUNCTIONS-->
    <script>
        function tablefilter() {
            var input, filter, table, tr, td, i, txtValue, count;
            count = 0;
            input = document.getElementById("query");
            filter = input.value.toUpperCase();
            table = document.getElementById("resultsTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                        count++;
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
            if(count < 1){
                document.getElementById("noresultsalert").style.visibility='visible';
                document.getElementById("tableForm").style.visibility='hidden';
            }else{
                document.getElementById("noresultsalert").style.visibility='hidden';
                document.getElementById("tableForm").style.visibility='visible';
            }
        }

        function tablefilterRefresh(){
            document.getElementById('query').value = '';
            tablefilter();
        }
    </script>

@endsection
