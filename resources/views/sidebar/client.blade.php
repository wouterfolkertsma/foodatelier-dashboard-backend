@extends('sidebar.base')

@section('links')

    <a class="menu-submenu" >
        <a class="menu-link" href="{{ route('client-trends') }}">
            <li tabindex="0" class="icon-dashboard"><span><img src="/../images/icons/icon-dashboard.svg">Trends</span>
        </a>
        <ul id="trend-categories">

        </ul>
        </li>
    </a>

    <a class="menu-submenu" >
        <a class="menu-link" href="{{ route('rss.index') }}">
            <li tabindex="0" class="icon-dashboard"><span><img src="/../images/icons/icon-dashboard.svg">RSS Feeds</span>
        </a>
        <ul id="rss-categories">

        </ul>
        </li>

    </a>

    <a class="menu-submenu" >
        <a class="menu-link" href="{{ route('client-files') }}">
            <li tabindex="0" class="icon-dashboard"><span><img src="/../images/icons/icon-dashboard.svg">Local Files</span>
        </a>
        <ul id="file-categories">

        </ul>
        </li>
    </a>

    </div>

    <script>
        const trendCategories = document.getElementById("trend-categories");
        const rssCategories = document.getElementById("rss-categories");
        const fileCategories = document.getElementById("file-categories");

        $.ajax({
            url: "{{ route('client.get-menu-categories') }}",
            type: 'GET',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                //console.log(data)

                let rssCategories = data.rss;
                //console.log(rssCategories)
                let fileCategories = data.files;
                //console.log(fileCategories)
                let trendCategories = data.filters;
                //console.log(filterCategories)


                //TREND-CATEGORIES-----------------------------------------------------------------
                for (i = 0; i < trendCategories.length; i++) {
                    //console.log("name= " + trendCategories[i].name)
                    var a = $('<a>').addClass('menu-link');
                    var li = $('<li>').addClass('sublink trend-category').attr({
                        data: trendCategories[i].id
                    });
                    var titel = $('<span>').addClass('sublink-titel').text(trendCategories[i].name);
                    li.append(titel);
                    a.append(li);
                    $('#trend-categories').append(a);
                }
                //RSS-CATEGORIES-----------------------------------------------------------------
                for (i = 0; i < rssCategories.length; i++) {
                    //console.log("name= " + rssCategories[i].name)
                    var a = $('<a>').addClass('menu-link');
                    var li = $('<li>').addClass('sublink rss-category').attr({
                        data: rssCategories[i].id
                    });
                    var titel = $('<span>').addClass('sublink-titel').text(rssCategories[i].name);
                    li.append(titel);
                    a.append(li);
                    $('#rss-categories').append(a);
                }
                //FILE-CATEGORIES-----------------------------------------------------------------
                for (i = 0; i < fileCategories.length; i++) {
                    //console.log("name= " + fileCategories[i].name)
                    var a = $('<a>').addClass('menu-link');
                    var li = $('<li>').addClass('sublink file-category').attr({
                        data: fileCategories[i].id
                    });
                    var titel = $('<span>').addClass('sublink-titel').text(fileCategories[i].name);
                    li.append(titel);
                    a.append(li);
                    $('#file-categories').append(a);
                }
                //LinkBinding-------------------------------------------
                $( ".rss-category" ).bind( "click", function() {
                    let id = $( this ).attr('data');
                    location.href = "/manage/" + id + "/rss";
                });
                $( ".trend-category" ).bind( "click", function() {
                    let id = $( this ).attr('data');
                    location.href = "/manage/" + id + "/trends";
                });
                $( ".file-category" ).bind( "click", function() {
                    let id = $( this ).attr('data');
                    location.href = "/manage/" + id + "/files";
                });
            },
            error: function(data){
                console.log("ERROR")
                console.log(data);
            }
        });
    </script>
@endsection
