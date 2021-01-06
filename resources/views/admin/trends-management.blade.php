@extends('layout.base')

@section('title', 'Trends Management')

@section('content')


    <div class="tag-search-container">
        <div class="tag-container">
            <input placeholder="Add New Term">
        </div>
        <div class="filters" style="float: left; padding-right: 8px;">
            <div class="dropdown-search-container">
                <div class="select-box" style="z-index:10;">
                    <div class="options-container" style="z-index:10;">
                        @foreach($countries as $country)
                            <div class="option" style="position:relative; z-index:10">
                                <input
                                    type="radio"
                                    class="radio"
                                    id="{{ $country->id }}"
                                    name="category"
                                />
                                <label for="{{ $country->id }}">{{ $country->country_name }}</label>
                            </div>
                        @endforeach
                    </div>
                    <div class="selected" uk-icon="icon: chevron-down">
                        SELECT COUNTRY
                    </div>
                    <div class="search-box" >
                        <input type="text" placeholder="Search..."/>
                    </div>
                </div>
            </div>

        </div>

        <div class="uk-inline">
            <button class="uk-button uk-button-default" type="button">Time</button>
            <div uk-dropdown="pos: bottom-left; mode: click">
                <ul class="uk-nav uk-dropdown-nav">
                    <li class="uk-active"><a href="#">Worldwide</a></li>
                    <li class="uk-nav-divider"></li>
                    <li><a href="#">last hour</a></li>
                    <li><a href="#">last 4 hours</a></li>
                    <li><a href="#">last day</a></li>
                    <li><a href="#">last 7 days</a></li>
                    <li><a href="#">last 30 days</a></li>
                    <li><a href="#">last 90 days</a></li>
                    <li><a href="#">last 5 Years</a></li>
                    <li><a href="#">2004 - today</a></li>
                    <li class="uk-nav-divider"></li>
                    <li><a onclick="timeSetTimeInterval()">custom</a></li>
                </ul>
            </div>

        </div>

        <button class="uk-button uk-button-default">SAVE</button>
    </div>
    <div class="graph"style="width: 60%; height: 50%; margin-top: 200px; position: absolute; z-index: 0">
        @include('includes/trends-chart-block')
    </div>


    <script>
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
        //-------------------------------
        const tagContainer = document.body.querySelector('.tag-container');
        const tagInput = document.body.querySelector('.tag-container input');

        let tags = [];
        function createTag(label) {
            const div = document.createElement('div');
            div.setAttribute('class','tag')
            const span = document.createElement('span');
            span.innerHTML = label;
            const closeBtn = document.createElement('i');
            closeBtn.setAttribute('uk-icon', 'close');
            closeBtn.setAttribute('data-item', label);

            div.appendChild(span);
            div.appendChild(closeBtn);
            return div;
        }
        function reset(){
            document.querySelectorAll('.tag').forEach(function (tag){
                tag.parentElement.removeChild(tag);
            })
        }
        function addTags(){
            reset();
            tags.slice().reverse().forEach(function (tag){
                const tagInput = createTag(tag);
                tagContainer.prepend(tagInput);
            })
        }

        tagInput.addEventListener('keyup', function (e){
            if(e.key === 'Enter'){
                tags.push(tagInput.value);
                addTags();
                tagInput.value = '';
            }
        })

        document.addEventListener('click', function (e){
            console.log(e.target.className);
            if(e.target.tagName === 'I'){
                const value = e.target.getAttribute('data-item');
                const index = tags.indexOf(value);
                tags = [...tags.slice(0,index), ...tags.slice(index+1)];
                addTags();
            }
        })

        async function timeSetTimeInterval() {
            const {value: formValues} = await Swal.fire({
                title: 'Multiple inputs',
                html:
                    '<input type="date" id="swal-input1" class="swal2-input">' +
                    '<input type="date" id="swal-input2" class="swal2-input">',
                focusConfirm: false,
                preConfirm: () => {
                    return [
                        document.getElementById('swal-input1').value,
                        document.getElementById('swal-input2').value
                    ]
                }
            })
        }
    </script>
@endsection
