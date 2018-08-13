@extends('master')
@section('resource')

@endsection
@section('style')

@endsection
@section('script')

@endsection
@section('description')
    透過資訊共享讓世界更美好!
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-8">
            <form action="/user/upload" method="post" enctype="multipart/form-data">
                <div class="input-group mb-3">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile02" multiple="true"/>
                        <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                    </div>
                    <div class="input-group-append">
                        <button class="btn btn-primary">Upload</button>
                    </div>
                </div>

                <script type="application/javascript">
                    $('#inputGroupFile02').change(function(e){
                        var fileNumber = e.target.files.length;
                        var fileName="";
                        for(var i=0;i<fileNumber;i++){
                            fileName+=e.target.files[i].name+",";
                        }
                        $('.custom-file-label').html(fileName);
                    });
                </script>


                <div class="form-group">
                    <label for="usr">實際租金</label>
                    <input type="text" class="form-control" id="usr">
                </div>
                <div class="form-group">
                    <label for="comment">居住情況</label>
                    <textarea class="form-control" rows="5" id="comment"></textarea>
                </div>

                <input type="submit" class="btn btn-primary" value="送出" name="submit">
                {!! csrf_field() !!}

            </form>
        </div>
        <div class="col-sm-4">
            <h3>注意事項</h3>
            <p>1.不要盜圖</p>
            <p>2.不要作假</p>
        </div>
    </div>
@endsection