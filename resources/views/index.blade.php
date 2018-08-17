@extends('master')

@section('resource')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.9.1.js"></script>
    <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <link rel="stylesheet" href="http://jqueryui.com/resources/demos/style.css">
    @endsection

@section('style')
    <style>
        /* Make the image fully responsive */
        .carousel-inner img {
            width: 100%;
            height: 100%;
        }
    </style>
    @endsection

@section('script')
    <script>
        $(function() {
            $( "#slider-range" ).slider({
                range: true,
                min: 2500,
                max: 8000,
                values: [ 3000, 7000 ],
                slide: function( event, ui ) {
                    $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
                }
            });
            $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
                " - $" + $( "#slider-range" ).slider( "values", 1 ) );
        });
    </script>
    @endsection

@section('description')
    貼上你租的房間讓大家估價，或者為他人的房間估值!
    @endsection

@section('content')
    <div class="row">
        {{$ObjectAll->links()}}
    </div>
    <div class="row">
        @foreach($ObjectAll as $Object)
        <div class="col-sm-6 col-md-4 col-lg-3">
            <h3>平均估價: $3700</h3>

            <img src="/image/1.jpg" class="img-thumbnail" alt="Cinque Terre">
            <!-- Button to Open the Modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal1-{{$Object->oid}}">
                查看圖片
            </button>
            <!-- Button to Open the Modal -->
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal2-{{$Object->oid}}">
                點我評價
            </button>
        </div>



    <!-- The Modal -->
    <div class="modal fade" id="myModal1-{{$Object->oid}}">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">平均估價: $3700</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div id="demo" class="carousel slide" data-ride="carousel">

                        <!-- Indicators -->
                        <ul class="carousel-indicators">
                            <li data-target="#demo" data-slide-to="0" class="active"></li>
                            <li data-target="#demo" data-slide-to="1"></li>
                            <li data-target="#demo" data-slide-to="2"></li>
                        </ul>

                        <!-- The slideshow -->
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="/image/1.jpg" alt="Los Angeles" width="1100" height="500">
                            </div>
                            <div class="carousel-item">
                                <img src="/image/2.jpg" alt="Chicago" width="1100" height="500">
                            </div>
                            <div class="carousel-item">
                                <img src="/image/3.jpg" alt="New York" width="1100" height="500">
                            </div>
                        </div>

                        <!-- Left and right controls -->
                        <a class="carousel-control-prev" href="#demo" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </a>
                        <a class="carousel-control-next" href="#demo" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </a>
                    </div>

                </div>
                <div class="modal-body">
                    房屋描述

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">關閉</button>
                </div>

            </div>
        </div>
    </div>

    <!-- The Modal2 -->
    <div class="modal" id="myModal2-{{$Object->oid}}">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">評估價值</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <p>
                        <label for="amount">價格範圍：</label>
                        <input type="text" id="amount" style="border:0; color:#f6931f; font-weight:bold;">
                    </p>

                    <div id="slider-range"></div>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">送出估值</button>
                </div>

            </div>
        </div>
    </div>

            @endforeach

    </div>

    @endsection

