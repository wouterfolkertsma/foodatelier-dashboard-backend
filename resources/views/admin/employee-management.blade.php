@extends('layout.base')

@section('title', 'Employee Management')

@section('content')

    <style>
        .em-field{
            background-color: #ff9090;
            max-width: 1280px;
            height: auto;
            margin: 0 auto;
        }

        .em-row{
            width: 100%;
            height: auto;
            display: inline-block;
            margin: 0 auto;
            padding: 0.25em;
        }

        /*new*/
        .em-id{
            display: inline-block;
            width: 8%;
            vertical-align: top;
        }
        .em-phone{
            display: inline-block;
            width: 15%;
            vertical-align: top;
        }
        .em-email{
            display: inline-block;
            width: 15%;
            vertical-align: top;
        }
        .em-desc{
            display: inline-block;
            width: 15%;
            vertical-align: top;
        }
        .em-created{
            display: inline-block;
            width: 15%;
            vertical-align: top;
        }
        .em-updated{
            display: inline-block;
            width: 15%;
            vertical-align: top;
        }
        .em-button{
            vertical-align: top;
            float: right;
        }

    </style>

        <div class="em-field">
{{--            Add headers to all colums without the white nodes--}}
            <div class="em-row" style="font-weight: bold; background: white; padding-top: 2em;">
                <div class="em-id">ID</div><div class="em-phone">Consulting phone</div><div class="em-email">Consulting email</div><div class="em-desc">Job description</div><div class="em-created">Created at</div><div class="em-updated">Updated at</div>
            </div>

            <?php

            // Read each row from the db seperately
            for ($x=0; $x < count($employees); $x++){
                // Decode json row from db
                $array = json_decode( $employees[$x], true );

                $y=0;
                // Alter between two colors for the rows
                if ($x%2==0){
                    echo '<div class="em-row" style="background: #efefef;">';
                } else {
                    echo '<div class="em-row" style="background: #dedede;">';
                }

                // Add each data to the correct colum on the correct row
                foreach($array as $item) {

                    if ($y < 6){
                        switch($y%6) {

                            case 0:
                                echo '<div class="em-id">'.$item.'</div>';
                                break;

                            case 1:
                                echo '<div class="em-phone">'.$item.'</div>';
                                break;

                            case 2:
                                echo '<div class="em-email">'.$item.'</div>';
                                break;

                            case 3:
                                echo '<div class="em-desc">'.$item.'</div>';
                                break;

                            case 4:
                                echo '<div class="em-created">'.convertTimeStr($item).'</div>';
                                break;

                            case 5:
                                echo '<div class="em-updated">'.convertTimeStr($item).'</div>';
                                break;
                        }
                        $y++;
                    }

                }

                // Close row of data add break and remove button
                echo '<div class="em-button"><button class="uk-button uk-button-default" id='.$x.' onclick=\'deleteEmployee(this.id, this.innerText)\'>Remove</button></div></div>';
                echo "<br>";

            }

            // Convert data received from db to front end format
            function convertTimeStr($item){
                return date("d-m-Y h:m:s", strtotime($item));
            }

//            $i = 0;
//            foreach($employees as $item) {
//
//                if ($i%6 == 0){
//                    echo "ID".$item;
//                } else if ($i%6 == 1){
//                    echo "Consulting phone".$item;
//                }else {
//                    echo $item;
//                }
//
//                $i++;
//            }

            ?>

            <script>
                // Check if user can be deleted from the database
                function deleteEmployee(buttonID, state) {
                    // console.log(state)
                    if (state == "REMOVE") {
                        if (confirm('Are you sure you want to delete this account?')) {
                            // Delete user from db
                            //alert("Deleted i think");
                            document.getElementById(buttonID).innerText = "Removing"
                        }
                    }
                }
            </script>

        </div>


@endsection
