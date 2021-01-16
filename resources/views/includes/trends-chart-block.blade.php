<div class="uk-button uk-button-secondary uk-width-1-1" onclick="updateChart()">
    LOAD PREVIEW
</div>
<div class trendsValueChart >
    <canvas id="chart" width="100" height="50"></canvas>
</div>

<script>
    var ctx = document.getElementById("chart");
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
            url: "{{ route('filter.get-trend-graph') }}",
            type: 'GET',
            dataType: 'json',
            data: {
                searchTerm: formSearchTerm.value,
                countryId: formCountryId.value,
                searchType: formSearchType.value,
                standardIntervalId: formStandardIntervalId.value,
                customIntervalFrom: formCustomIntervalFrom.value,
                customIntervalTo: formCustomIntervalTo.value


            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                console.log('Data');
                console.log(data);
                let IOT = data.allResults;
                let IOTLabels = IOT[0].results.map(a => a.interestAt)

                myChart.data.labels = IOTLabels;
                console.log('Data');
                console.log(data);
                console.log('IOTLabels');
                console.log(IOTLabels);
                //myChart.data.datasets[0].data = IOTValues;


                let AllIOTResults = data.allResults;
                var i;
                for (i = 0; i < AllIOTResults.length; i++) {
                    let IOTValues = AllIOTResults[i].results.map(a => a.firstValue)

                    myChart.data.datasets[i].label = data.searchTerms[i];
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
</script>

