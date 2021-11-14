<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<style type="text/css">

    .card {
        /* Add shadows to create the "card" effect */
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        transition: 0.3s;
        margin: 0 auto;
        float: none;
        margin-bottom: 10px;
    }

    /* On mouse-over, add a deeper shadow */
    .card:hover {
        box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
    }

    body {
        background-color: #003366;
    }

</style>
</head>
<body>
<div>
    <div class="container">
        <div class="content">
            <div class="row" style="margin-top : 10px; float: right;">
                <div class="col-md-12">
                    {{ $pockets->links()}}
                </div>
            </div>
            @if(!empty($pockets))
                <div class="row">
                    @foreach( $pockets->items() as $pocket)
                        <div class="container-fluid" style="padding-top: 50px;">
                            <div class="card">
                                <div class="card-body">
                                    <div class="container-fluid" style="padding-top: 50px;">
                                        <div class="row">
                                            <div class="col">
                                                <div class="card  h-100">
                                                    <div class="card-header text-center " style="font-family: Sans-Serif; text-transform:uppercase; font-size:1.5rem">
                                                        {{ $pocket->title }}
                                                    </div>
                                                    <div class="card-body">

                                                        @if(!empty($pocket->contents))
                                                            <div class="row">

                                                            @foreach($pocket->contents as $content)

                                                            <div class="col">
                                                                <div class="card" style="max-width: 18rem;">
                                                                    <img class="card-img-top" src="{{$content->image}}" alt="Card image cap">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title text-center">{{$content->title}}</h5>
                                                                        @if(!empty($content->tags))
                                                                            @foreach($content->tags as $tag)
                                                                                <a class="btn btn-info" target="_blank" href="{{$content->url}}">{{ $tag->name }}</a>
                                                                            @endforeach
                                                                        @else
                                                                            No Tags
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                        @else
                                                            <div class="row">Contents not available here!</div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row" style="margin-top : 10px; float: right;">
                    <div class="col-md-12">
                        {{ $pockets->links()}}
                    </div>
                </div>
            @else
            <div class="row">Pockets not available here!</div>
            @endif
        </div>
    </div>

</div>
</body>
</html>