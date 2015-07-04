
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sticky Footer Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


    <style>
        /* Sticky footer styles
-------------------------------------------------- */
        html {
            position: relative;
            min-height: 100%;
        }
        body {
            /* Margin bottom by footer height */
            margin-bottom: 60px;
        }
        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            /* Set the fixed height of the footer here */
            height: 60px;
            background-color: #f5f5f5;
        }


        /* Custom page CSS
        -------------------------------------------------- */
        /* Not required for template or sticky footer method. */

        .container {
            width: auto;
            max-width: 680px;
            padding: 0 15px;
        }
        .container .text-muted {
            margin: 20px 0;
        }
    </style>
</head>

<body>

<!-- Begin page content -->
<div class="container">
    <div class="page-header">
        <h1>Smart Parking</h1>
    </div>
    <p class="lead">Deze pagina toont een overzicht van alle sensoren die zijn aangesloten aan het Smart Parking systeem van groep 1 van ISEN.</p>
    <p>Onderstaand overzicht wordt realtime aangepast.</p>
    <div class="row">
        @foreach($sensors as $sensor)
        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <div class="caption" id="sensor-{{{ $sensor->id  }}}">
                    <h3>Sensor #{{{ $sensor->id }}}</h3>
                    <p>{{{ $sensor->address }}}</p>
                    <p><a href="#" class="btn btn-block btn-primary" role="button">Laden...</a></p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="text-muted">Dashboard voor ISEN demonstrator presentatie (data update: <span id="timer">{{{ \Carbon\Carbon::now()->addHours(2)->format("H:i:s") }}}</span>)</p>
    </div>
</footer>

<script>
    function setSensorAvailable(find_id) {
        $(find_id).find(".btn").removeClass("btn-danger").addClass("btn-success").text('Beschikbaar');
    }
    function setSensorNotAvailable(find_id) {
        $(find_id).find(".btn").removeClass("btn-success").addClass("btn-danger").text('Bezet');
    }

    function addZero(i) {
        if (i < 10) {
            i = "0" + i;
        }
        return i;
    }

    function refreshData() {
        $.getJSON("/api/all", function (result) {
            $.each(result, function (id, is_available) {
                var find_id = "#sensor-" + id;
                if (is_available) {
                    setSensorAvailable(find_id);
                } else {
                    setSensorNotAvailable(find_id);
                }
            });
        });

        var dt = new Date();
        var time = addZero(dt.getHours()) + ":" + addZero(dt.getMinutes()) + ":" + addZero(dt.getSeconds());
        $("#timer").text(time);


        setTimeout(refreshData, 1000);
    }



    refreshData();
</script>

</body>
</html>
