

    <div id="related-trends-button" class="uk-button uk-button-default uk-width-1-1" onclick="load()">
        LOAD RELATED TRENDS
    </div>
    <div id="loading_anim_container" style="display: table; margin: 0 auto;">

    </div>
    <div id="tables_container" style="float: left; display: flex; cursor: pointer;">

    </div>

<script>

    function addRelatedTermToTags(value){
        tags.push(value);
        addTags();
    }


    function load(){
        console.log("LOAD RELATED TRENDS")
        $( ".delete" ).remove();
        var loadingAnim = $('<div>').addClass('delete');
        $(loadingAnim).attr("uk-spinner","ratio: 4.5");
        var loaddiv =$('<div>').addClass("delete");
        loaddiv.append(loadingAnim);
        $('#loading_anim_container').append( loaddiv);

        console.log("InterValID: " +  formStandardIntervalId.value)
        $.ajax({
            url: "{{ route('filter.get-related-terms') }}",
            type: 'GET',
            data: {
                searchTerm: formSearchTerm.value,
                countryId: formCountryId.value,
                searchType: formSearchType.value,
                standardIntervalId: formStandardIntervalId.value,
                customIntervalFrom: formCustomIntervalFrom.value,
                customIntervalTo: formCustomIntervalTo.value


            },
            //dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                console.log(data.request)
                $( ".delete" ).remove();
                let AllIOTResults = data.allResults;
                let searchTerms = data.searchTerms;

                //console.log(AllIOTResults);

                for (i = 0; i < AllIOTResults.length; i++) {
                    var table = $('<table>').addClass('uk-table uk-table-striped');
                    var head =$('<thead>');
                    var body =$('<tbody>');
                    var headrow = $('<tr>');
                    var tableEntryRowsCount = AllIOTResults[i].results.map(a => a.term).length;

                    if(tableEntryRowsCount>0){
                        let terms = AllIOTResults[i].results.map(a => a.term)
                        let ranking = AllIOTResults[i].results.map(a => a.ranking)
                        var titel1 = $('<td>').addClass('bar').text('TERM: "' + searchTerms[i] + '"');
                        headrow.append(titel1);
                        var titel2 = $('<td>').addClass('bar').text("RANKING");
                        headrow.append(titel2);
                        terms.forEach(function (element, index) {
                            var entryrow = $('<tr>').addClass('entryrow');

                            var entry1 = $('<td>').addClass('bar').text(element);
                            entryrow.append(entry1);

                            var entry2 = $('<td>').addClass('bar').text(ranking[index]);
                            entryrow.append(entry2);
                            body.append(entryrow);
                        });
                        head.append(headrow);
                        table.append(head);
                        table.append(body);
                        var div =$('<div>').addClass("uk-flex-wrap-between delete");
                        div.append(table);
                        $('#tables_container').append(div);
                    }
                }
                $( ".bar" ).bind( "click", function() {
                    //alert( $( this ).text() );
                    tags.push($( this ).text());
                    addTags();
                    console.log("yooo");
                });




            },
            error: function(data){
                console.log("ERROR")
                console.log(data);
            }
        });

    }


</script>
