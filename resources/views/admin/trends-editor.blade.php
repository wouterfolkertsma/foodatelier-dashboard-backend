@extends('layout.base')

@section('title', 'Trends Editor')

@section('content')

<div class="uk-card-default uk-card-body"style="height: 350px; max-height: 350px;">
    {{ Form::model($filter, ['route' => ['filter.update', $filter->id], 'class' => 'uk-form-stacked']) }}
    <div class="headsection">
    <div class="uk-f-name">
        {{ Form::label('name', 'Filter Name:', ['class' => 'uk-form-label']) }}
        {{ Form::text('name', $filter->name, ['class' => 'uk-input uk-form-width-large']) }}
    </div>
    <div class="uk-f-description">
        {{ Form::label('description', 'Filter Description:', ['class' => 'uk-form-label']) }}
        {{ Form::text('description', $filter->description, ['class' => 'uk-input ']) }}
    </div>
    </div>
    {{ Form::hidden('search_term', '', array('id' => 'form_search_term')) }}
    {{ Form::hidden('country_id', $filter->country_id, array('id' => 'form_country_id')) }}

    {{ Form::hidden('standard_interval', 2, ['id' => 'form_standard_interval']) }}
    {{ Form::hidden('custom_interval_from', $filter->custom_interval_from, array('id' => 'form_custom_interval_from')) }}
    {{ Form::hidden('custom_interval_to', $filter->custom_interval_to, array('id' => 'form_custom_interval_to')) }}

    {{ Form::hidden('consider_web_search', $filter->consider_web_search, array('id' => 'form_consider_web_search')) }}
    {{ Form::hidden('consider_image_search', $filter->consider_image_search, array('id' => 'form_consider_image_search')) }}
    {{ Form::hidden('consider_news_search', $filter->consider_news_search, array('id' => 'form_consider_news_search')) }}
    {{ Form::hidden('consider_youtube_search', $filter->consider_youtube_search, array('id' => 'form_consider_youtube_search')) }}
    {{ Form::hidden('consider_shopping_search', $filter->consider_shopping_search, array('id' => 'form_consider_shopping_search')) }}

    {{ Form::hidden('with_top_metric', false, array('id' => 'form_with_top_metric')) }}
    {{ Form::hidden('with_rising_metric', false, array('id' => 'form_with_rising_metric')) }}
    {{ Form::hidden('language', 'en-US', array('id' => 'form_standard_interval')) }}


    {{ Form::label('filter', 'Filter Settings:', ['class' => 'uk-form-label']) }}
    <div onload="reset()" class="tag-search-container">
        <div class="tag-container">
            <input placeholder="Add New Term">
        </div>

            <div class="subsection">
                <div class="dropdown-search-container sub1">
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
                            {{$filter->country->country_name}}
                        </div>
                        <div class="search-box" >
                            <input type="text" placeholder="Search..."/>
                        </div>
                    </div>
                </div>
                <div class="sub2">

                        <button id="timeInterval" class="uk-button uk-button-default uk-width-1-1 uk-margin-small-bottom" type="button">Time</button>
                        <div uk-dropdown="pos: bottom-left; mode: click">
                            <ul class="uk-nav uk-dropdown-nav">
                                <li class="uk-active"><a href="#">Worldwide</a></li>
                                <li class="uk-nav-divider"></li>
                                <li><a onclick="setStandardInterval(1, 'last day')">last day </a></li>
                                <li><a onclick="setStandardInterval(2, 'last 7 days')">last 7 days</a></li>
                                <li><a onclick="setStandardInterval(3, 'last 30 days')">last 30 days</a></li>
                                <li><a onclick="setStandardInterval(4, 'last 90 days')">last 90 days</a></li>
                                <li><a onclick="setStandardInterval(5, 'last 5 Years')">last 5 Years</a></li>
                                <li><a onclick="setStandardInterval(6, '2004 - today')">2004 - today</a></li>
                                <li class="uk-nav-divider"></li>
                                <li><a onclick="timeSetTimeInterval()">custom</a></li>
                            </ul>
                        </div>

                </div>
                <div class="sub3">

                        <button id="searchType" class="uk-button uk-button-default uk-width-1-1 uk-margin-small-bottom" type="button">Search-Type</button>
                        <div uk-dropdown="pos: bottom-left; mode: click">
                            <ul class="uk-nav uk-dropdown-nav">
                                <li><a onclick="setSearchType(1, 'Web-Search')">Web-Search</a></li>
                                <li><a onclick="setSearchType(2, 'Image-Search')">Image-Search</a></li>
                                <li><a onclick="setSearchType(3, 'News-Search')">News-Search</a></li>
                                <li><a onclick="setSearchType(4, 'Youtube-Search')">Youtube-Search</a></li>
                                <li><a onclick="setSearchType(5, 'Shopping-Search')">Shopping-Search</a></li>
                            </ul>
                        </div>

                </div>
            </div>
    </div>

    <div class="button-section">
    <div class="save_button">
        {{ Form::submit('Save', ['class' => 'uk-button uk-button-secondary uk-width-1-1 ']) }}
    </div>
    {{ Form::close() }}
    <div class="uk-button uk-button-secondary uk-width-1-1" onclick="test()">
        PREVIEW
    </div>
    </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
</div>

<div class="graph "style="width: 93%; height: 60%; position: absolute; z-index: 0">
    <div class="uk-card-default uk-card-body"style="height: 100%; width: 100%;">
        @include('includes/trends-chart-block')
    </div>
</div>
<script>
    var ctx = document.getElementById("myChart2");
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                data: [],
                label: "unload",
                borderColor: "rgba(236,49,46)",
                backgroundColor : "rgba(219,66,50,0.3)",

            }, {
                data: [],
                label: "",
                borderColor: "",

            }, {
                data: [],
                label: "",
                borderColor: "#3cba9f",

            }, {
                data: [],
                label: "",
                borderColor: "#e8c3b9",

            }, {
                data: [],
                label: "",
                borderColor: "#c45850",

            }
            ]
        },
        options: {
            scales: {
                xAxes: [],
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });

    var updateChart = function() {
        console.log("TrendRequest is send")
        $.ajax({
            url: "{{ route('filter.get-trend', ['id' => 1] ) }}",
            type: 'GET',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                let IOT = data.InterestOverTime.results;
                let IOTLabels = IOT.map(a => a.interestAt)
                let IOTValues = IOT.map(a => a.firstValue)
                myChart.data.labels = IOTLabels;
                //myChart.data.datasets[0].data = IOTValues;


                let AllIOTResults = data.all;
                var i;
                for (i = 0; i < AllIOTResults.length; i++) {
                    let IOTValues = AllIOTResults[i].results.map(a => a.firstValue)

                    myChart.data.datasets[i].label = data.terms[i];
                    myChart.data.datasets[i].data = IOTValues;
                    console.log(IOTValues)
                }
                myChart.update();


            },
            error: function(data){
                console.log(data);
            }
        });
    }



    //------------------
    $(document).ready(function() { //Form -> EnterKeyPrevent
        $(window).keydown(function(event){
            if((event.keyCode == 13) && ($(event.target)[0]!=$("tag-container")[0])) {
                event.preventDefault();
                return false;
            }
        });
    });
    //-------------------

    const formSearchTerm = document.getElementById("form_search_term");

    const formCountryId = document.getElementById("form_country_id");

    const formStandardIntervalId = document.getElementById("form_standard_interval");
    const formCustomIntervalFrom = document.getElementById("form_custom_interval_from");
    const formCustomIntervalTo = document.getElementById("form_custom_interval_to");

    const formWebSearch = document.getElementById("form_consider_web_search");
    const formImageSearch = document.getElementById("form_consider_image_search");
    const formNewsSearch = document.getElementById("form_consider_news_search");
    const formYoutubeSearch = document.getElementById("form_consider_youtube_search");
    const formShoppingSearch = document.getElementById("form_consider_shopping_search");
    const searchTypes = [formWebSearch, formImageSearch, formNewsSearch, formYoutubeSearch, formShoppingSearch];

    const intervalButton =  document.getElementById("timeInterval");

    function setStandardInterval(id, name){
        intervalButton.innerHTML = name;
        formStandardIntervalId.value = id;
        //UIkit.dropdown(intervalButton).hide
    }
    let searchType = 0;
    const searchTypeButton =  document.getElementById("searchType");
    function setSearchType(id, name){

        searchType = id;
        searchTypeButton.innerHTML = name;
        searchTypes.forEach(function(item){
            item.value = 0;
        });
        searchTypes[id-1].value = 1;
        //console.log(searchTypes);
    }



    //--------------------------------Country-Selection

    const selected = document.querySelector(".selected");
    const optionsContainer = document.querySelector(".options-container");
    const searchBox = document.querySelector(".search-box input");

    const optionsList = document.querySelectorAll(".option");

    searchBox.value = '{{ $filter->location }}';
    console.log('{{ $filter->location }}');

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
            formCountryId.value = o.querySelector("label").htmlFor;
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
    //-------------------------------SearchTags
    const tagContainer = document.body.querySelector('.tag-container');
    const tagInput = document.body.querySelector('.tag-container input');

    let tags = [];
    //load terms
    @foreach ($filter->search_term as $key => $value)
        tags.push('{{ $value }}');
    @endforeach
    addTags();



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
        formSearchTerm.value = serialize(tags);
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
    //-----------------CustomInterval (Alert)
    let intervalFrom
    let intervalTo
    async function timeSetTimeInterval() {
        const {value: formValues} = await Swal.fire({
            title: 'TIME INTERVAL',
            html:
                '<input type="date" id="swal-input1" class="swal2-input">' +
                '<input type="date" id="swal-input2" class="swal2-input">',
            focusConfirm: false,
            preConfirm: () => {
                return [
                    intervalFrom = document.getElementById('swal-input1').value,
                    intervalTo = document.getElementById('swal-input2').value,
                    intervalButton.innerHTML = intervalFrom + " to " + intervalTo,
                    document.getElementById('swal-input1').value,
                    document.getElementById('swal-input2').value
                ]
            }
        })
    }

//-------------------------------------------------
    function test(){
        console.log("SearchTypes:")
        searchTypes.forEach(function(type){
            console.log(type.id + "=" + type.value)
        });
        console.log("------")
        console.log("country-ID =" + formCountryId.value)
        console.log("Tags/Terms:" + tags.toString())
        console.log("php serialized = " + serialize(tags))

        updateChart();
    }


//---------------------------------------------------serialize
     function serialize (mixedValue) { //like PHP

  let val, key, okey
  let ktype = ''
  let vals = ''
  let count = 0
  const _utf8Size = function (str) {
    return ~-encodeURI(str).split(/%..|./).length
  }
  const _getType = function (inp) {
    let match
    let key
    let cons
    let types
    let type = typeof inp
    if (type === 'object' && !inp) {
      return 'null'
    }
    if (type === 'object') {
      if (!inp.constructor) {
        return 'object'
      }
      cons = inp.constructor.toString()
      match = cons.match(/(\w+)\(/)
      if (match) {
        cons = match[1].toLowerCase()
      }
      types = ['boolean', 'number', 'string', 'array']
      for (key in types) {
        if (cons === types[key]) {
          type = types[key]
          break
        }
      }
    }
    return type
  }
  const type = _getType(mixedValue)
  switch (type) {
    case 'function':
      val = ''
      break
    case 'boolean':
      val = 'b:' + (mixedValue ? '1' : '0')
      break
    case 'number':
      val = (Math.round(mixedValue) === mixedValue ? 'i' : 'd') + ':' + mixedValue
      break
    case 'string':
      val = 's:' + _utf8Size(mixedValue) + ':"' + mixedValue + '"'
      break
    case 'array':
    case 'object':
      val = 'a'
      /*
      if (type === 'object') {
        var objname = mixedValue.constructor.toString().match(/(\w+)\(\)/);
        if (objname === undefined) {
          return;
        }
        objname[1] = serialize(objname[1]);
        val = 'O' + objname[1].substring(1, objname[1].length - 1);
      }
      */
      for (key in mixedValue) {
        if (mixedValue.hasOwnProperty(key)) {
          ktype = _getType(mixedValue[key])
          if (ktype === 'function') {
            continue
          }
          okey = (key.match(/^[0-9]+$/) ? parseInt(key, 10) : key)
          vals += serialize(okey) + serialize(mixedValue[key])
          count++
        }
      }
      val += ':' + count + ':{' + vals + '}'
      break
    case 'undefined':
    default:
      // Fall-through
      // if the JS object has a property which contains a null value,
      // the string cannot be unserialized by PHP
      val = 'N'
      break
  }
  if (type !== 'object' && type !== 'array') {
    val += ';'
  }
  return val
}


</script>
@endsection
