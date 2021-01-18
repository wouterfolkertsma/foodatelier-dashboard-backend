
@extends('layout.base')

@section('title', 'Edit RSS Feed')

@section('content')
    <div class="uk-card-default uk-card-body">
        {{ Form::open(['route' => ['rss.update', $rssFeed->id], 'class' => 'uk-form-stacked']) }}
        <legend class="uk-legend">Edit $rssFeed->name</legend>
        <div class="uk-margin">
            {{ Form::label('name', 'Name:', ['class' => 'uk-form-label']) }}
            {{ Form::text('name', $rssFeed->name, ['class' => 'uk-input uk-form-width-large']) }}
        </div>
        <div class="uk-margin">
            {{ Form::label('url', 'Url:', ['class' => 'uk-form-label']) }}
            {{ Form::text('url', $rssFeed->url, ['class' => 'uk-input uk-form-width-large disabled']) }}
        </div>
        <label class="uk-form-label">Category:</label>
        <div class="dropdown-search-container sub1" style="max-width: 500px;">
            <div class="select-box" style="z-index:10;">
                <div class="options-container" style="z-index:10;">
                    @foreach($categories as $category)
                        <div class="option" style="position:relative; z-index:10">
                            <input
                                type="radio"
                                class="radio"
                                id="{{ $category->id }}"
                                name="category"
                            />
                            <label for="{{ $category->id }}">{{ $category->name }}</label>
                        </div>
                    @endforeach
                </div>
                <div class="selected" uk-icon="icon: chevron-down">
                    Select Category
                </div>
                <div class="search-box" >
                    <input type="text" placeholder="Search..."/>
                </div>
            </div>
        </div>

        <div class="button_area">
            <div class="save_button">
                {{ Form::submit('Save', ['class' => 'uk-button uk-button-secondary']) }}
            </div>

            <a class="delete_button uk-button uk-button-primary" onclick="window.jsAlertDeleteConfirm('{{ route('rss.delete', ['rssFeed' => $rssFeed->id]) }}')">
                Delete RSS Feed
            </a>
        </div>
        {{ Form::close() }}
    </div>
    <div id="js-rss-preview-container"></div>

    <script>
        //--------------------------------Category-Selection
        const formCategoryId = document.getElementById("form_country_id");

        const selected = document.querySelector(".selected");
        const optionsContainer = document.querySelector(".options-container");
        const searchBox = document.querySelector(".search-box input");

        const optionsList = document.querySelectorAll(".option");


        selected.addEventListener("click", () => {
            optionsContainer.classList.toggle("active");

            searchBox.value = "";
            filterList("");

            if (optionsContainer.classList.contains("active")) {
                searchBox.focus();
            }
        });

        optionsList.forEach(o => {
            o.addEventListener("click", () => {
                selected.innerHTML = o.querySelector("label").innerHTML;
                formCategoryId.value = o.querySelector("label").htmlFor;
                optionsContainer.classList.remove("active");
            });
        });

        searchBox.addEventListener("keyup", function(e) {
            filterList(e.target.value);
        });

        const filterList = searchTerm => {
            searchTerm = searchTerm.toLowerCase();
            optionsList.forEach(option => {
                let label = option.firstElementChild.nextElementSibling.innerText.toLowerCase();
                if (label.indexOf(searchTerm) != -1) {
                    option.style.display = "block";
                } else {
                    option.style.display = "none";
                }
            });
        };
    </script>
@endsection
