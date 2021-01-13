

    <div id="related-trends-button" class="uk-button uk-button-default uk-width-1-1" onclick="load()">
        LOAD RELATED TRENDS
    </div>
    <div id="tables_container" style="float: left; display: flex;">

    </div>
<script>

    function load(){
        console.log("LOAD RELATED TRENDS")
        $.ajax({
            url: "{{ route('filter.get-related-terms', ['id' => 1] ) }}",
            type: 'GET',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {

                let AllIOTResults = data.allResults;
                let searchTerms = data.searchTerms;

                console.log(AllIOTResults);

                for (i = 0; i < AllIOTResults.length; i++) {
                    var table = $('<table>').addClass('uk-table uk-table-striped');
                    var head =$('<thead>');
                    var body =$('<tbody>');
                    var headrow = $('<tr>');
                    var tableEntryRowsCount = AllIOTResults[i].results.map(a => a.term).length;
                    console.log(tableEntryRowsCount)
                    if(tableEntryRowsCount>0){
                        let terms = AllIOTResults[i].results.map(a => a.term)
                        let ranking = AllIOTResults[i].results.map(a => a.ranking)
                        var titel1 = $('<td>').addClass('bar').text('TERM: "' + searchTerms[i] + '"');
                        headrow.append(titel1);
                        var titel2 = $('<td>').addClass('bar').text("RANKING");
                        headrow.append(titel2);
                        terms.forEach(function (element, index) {
                            var entryrow = $('<tr>');
                            var entry1 = $('<td>').addClass('bar').text(element);
                            entryrow.append(entry1);
                            var entry2 = $('<td>').addClass('bar').text(ranking[index]);
                            entryrow.append(entry2);
                            body.append(entryrow);
                        });
                        head.append(headrow);
                        table.append(head);
                        table.append(body);
                        var div =$('<div>').addClass("uk-flex-wrap-between");
                        div.append(table);
                        $('#tables_container').append(div);
                    }
                }



            },
            error: function(data){
                console.log("ERROR")
                console.log(data);
            }
        });

    }
</script>
