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
            /*width: 100%;*/
            /*height: 100%;*/
            width: auto;

            height: 400px;

            max-height: 400px;
        }
        .img-thumbnail{
            width:300px;
            height:180px;
        }
    </style>
    @endsection



@section('description')
    貼上你租的房間讓大家估價，或者為他人的房間估值!
    @endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            {{$ObjectAll->links()}}
        </div>
        <div class="col-md-6">
            <form>
                <div class="form-group">
                    <input type="text" class="form-control" name="description" placeholder="輸入關鍵字搜索" value="{{$keyword}}"/>
                </div>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-default">搜尋</button>
            </form>
        </div>
    </div>
    <div class="row">
        @foreach($ObjectAll as $Object)

        <div class="col-sm-6 col-md-4 col-lg-3">
            @if($Object->lowerAvg!=0)
            <h5 id="price-{{$Object->oid}}">平均低價: ${{$Object->lowerAvg}}<br>平均高價: ${{$Object->higherAvg}}   </h5>
            @else
                <h5 id="price-{{$Object->oid}}">平均低價: 尚無<br>平均高價: 尚無</br></h5>
                @endif
            <img src="/{{$Object->firstImage['imagePath']}}" class="img-thumbnail" id="thumbnail-{{$Object->oid}}" alt="Cinque Terre" data-toggle="modal" data-target="#myModal1-{{$Object->oid}}">
            <!-- Button to Open the Modal -->
        </div>



    <!-- The Modal -->
    <div class="modal " id="myModal1-{{$Object->oid}}">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <form action="/sendValue" method="POST" id="form-{{$Object->oid}}">
                <!-- Modal Header -->
                <div class="modal-header">
                    @if($Object->lowerAvg!=0)
                    <h4 class="modal-title" id="modal-price-{{$Object->oid}}">平均低價: ${{$Object->lowerAvg}} &nbsp;&nbsp; 平均高價: ${{$Object->higherAvg}}</h4>
                    @else
                        <h4 class="modal-title" id="modal-price-{{$Object->oid}}">平均低價: 尚無 &nbsp;&nbsp; 平均高價: 尚無</h4>
                        @endif
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div id="demo-{{$Object->oid}}" class="carousel slide" data-ride="carousel">

                        <!-- Indicators -->
                        <ul class="carousel-indicators">


                            @foreach($Object->images as $i => $image)
                                @if($i==0)
                                    <li data-target="#demo-{{$Object->oid}}" data-slide-to="0" class="active"></li>
                                @else
                                    <li data-target="#demo-{{$Object->oid}}" data-slide-to="{{$i}}"></li>
                                @endif

                                @endforeach

                        </ul>

                        <!-- The slideshow -->
                        <div class="carousel-inner">





                            @foreach($Object->images as $i => $image)
                                @if($i==0)
                                    <div class="carousel-item active">
                                        <img src="/{{$image->imagePath}}" alt="Los Angeles" class="img-responsive center-block">
                                    </div>
                                @else
                                    <div class="carousel-item">
                                        <img src="/{{$image->imagePath}}" alt="Chicago" class="img-responsive center-block">
                                    </div>
                                @endif
                                @endforeach
                        </div>

                        <!-- Left and right controls -->
                        <a class="carousel-control-prev" href="#demo-{{$Object->oid}}" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </a>
                        <a class="carousel-control-next" href="#demo-{{$Object->oid}}" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </a>
                    </div>

                </div>
                <div class="modal-body " style="white-space:pre-line;">{{$Object->description}}</div>
                <div class="modal-body">
                    <p>
                        <input type="hidden" name="_token"  value="{{csrf_token()}}">
                        <input type="hidden" name="oid" id="oid-{{$Object->oid}}"  value="{{$Object->oid}}">
                        <label for="amount-{{$Object->oid}}">價格範圍：</label>
                        <input type="text" name="amount" id="amount-{{$Object->oid}}" style="border:0; color:#4286f4; font-weight:bold;">
                    </p>
                    <div id="slider-range-{{$Object->oid}}"></div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer" id="modal-footer-{{$Object->oid}}">
                    <button type="submit" id="submit-Value-Button-{{$Object->oid}}" class="btn btn-primary" >送出估值</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">關閉</button>
                </div>
            </form>
            </div>
        </div>
    </div>



                <script>
                    $(function() {
                        $("#thumbnail-{{$Object->oid}}").click(function(){
                            $('#modal-footer-{{$Object->oid}}').children(".help-block").remove();
                        });





                        $( "#slider-range-{{$Object->oid}}" ).slider({
                            range: true,
                            min: 2000,
                            max: 11000,
                            values: [ 3000, 7000 ],
                            step:100,
                            slide: function( event, ui ) {
                                $( "#amount-{{$Object->oid}}" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
                            }
                        });
                        $( "#amount-{{$Object->oid}}" ).val( "$" + $( "#slider-range-{{$Object->oid}}" ).slider( "values", 0 ) +
                            " - $" + $( "#slider-range-{{$Object->oid}}" ).slider( "values", 1 ) );
                        // process the form
                        $('#form-{{$Object->oid}}').submit(function(event) {
                            // get the form data
                            // there are many ways to get this data using jQuery (you can use the class or id also)
                            var formData = {
                                'amount'              : $('input[id=amount-{{$Object->oid}}]').val(),
                                '_token'              : $('input[name=_token').val(),
                                'oid'                 : $('input[id=oid-{{$Object->oid}}').val()
                            };

                            // process the form
                            $.ajax({
                                type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
                                url         : '/sendValue', // the url where we want to POST
                                data        : formData, // our data object
                                dataType    : 'json', // what type of data do we expect back from the server
                                encode          : true
                            })
                            // using the done promise callback
                                .done(function(data) {

                                    // log data to the console so we can see
                                    console.log(data);
                                    $('#modal-footer-{{$Object->oid}}').removeClass('has-error has-success');
                                    $('#modal-footer-{{$Object->oid}}').children(".help-block").remove();
                                    if(!data.success){

                                            $('#modal-footer-{{$Object->oid}}').addClass('has-error');
                                            $('#modal-footer-{{$Object->oid}}').prepend("<div class='help-block mr-auto'>"+"送出估值發生錯誤，即將重整頁面"+"</div>");
                                            setTimeout(function(){ location.reload(); }, 1000);


                                    }
                                    else{
                                        $('#modal-footer-{{$Object->oid}}').addClass('has-success');
                                        $('#modal-footer-{{$Object->oid}}').prepend("<div class='help-block mr-auto'>"+"送出估值成功!"+"</div>");
                                        $('#price-{{$Object->oid}}').html("平均低價: $"+data.lowerAvg+"<br>平均高價: $"+data.higherAvg);
                                        $('#modal-price-{{$Object->oid}}').html("平均低價: $"+data.lowerAvg+"&nbsp;&nbsp;&nbsp;&nbsp;平均高價: $"+data.higherAvg+"&nbsp;&nbsp;&nbsp;&nbsp;實際租金: $"+data.realValue);
                                        $('#submit-Value-Button-{{$Object->oid}}').remove();






                                    }

                                    // here we will handle errors and validation messages
                                });

                            // stop the form from submitting the normal way and refreshing the page
                            event.preventDefault();
                        });

                    });
                </script>

            @endforeach

    </div>

    @endsection

