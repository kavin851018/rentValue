@extends('master')
@section('resource')
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/bootstrap/3.2.0/css/bootstrap.min.css"/>

    <!-- Include FontAwesome CSS if you want to use feedback icons provided by FontAwesome -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/fontawesome/4.1.0/css/font-awesome.min.css" />

    <!-- BootstrapValidator CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/jquery.bootstrapvalidator/0.5.0/css/bootstrapValidator.min.css"/>

    <!-- jQuery and Bootstrap JS -->
    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <!-- BootstrapValidator JS -->
    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery.bootstrapvalidator/0.5.0/js/bootstrapValidator.min.js"></script>
@endsection
@section('style')
<style>

</style>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('#test').bootstrapValidator({
                live: 'enabled',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    'fileToUpload[]': {
                        validators: {
                            notEmpty: {
                                // enabled is true, by default
                                message: '請選擇1或多個檔案'
                            },
                            file: {
                                extension: 'jpeg,png,jpg',
                                type: 'image/jpeg,image/png,image/jpg',
                                maxSize: 2048 * 1024,
                                message: '請選擇正確格式! 如 jpg,png '
                            }
                        }
                    }
                }
            });
        });

        $('#fileupload').change(function(e){
            var fileNumber = e.target.files.length;
            var fileName="";
            for(var i=0;i<fileNumber;i++){
                if(i==0){
                    fileName=e.target.files[i].name;
                    continue;
                }
                if(fileName.length>10&&i!=0){
                    fileName=fileName+"  and "+(fileNumber-i)+" more images.......";
                    break;
                }
                fileName+="  ,  "+e.target.files[i].name;

            }

            $('.custom-file-label').html(fileName);
        });
    </script>
@endsection
@section('description')
    透過資訊共享讓世界更美好!
@endsection
@section('content')
    <div class="row ">
        <div class="col-sm-12 col-md-9">
            <form action="/user/upload" method="post" enctype="multipart/form-data" id="test">


                <div class="form-group" >
                    <label for="fileToUpload[]">選擇要上傳的圖片:</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="fileToUpload[]" id="fileupload" multiple="true"  required>
                        <label class="custom-file-label" for="validatedCustomFile">選擇檔案...</label>

                    </div>
                </div>




                {!! csrf_field() !!}




                <div class="form-group">
                    <label for="price">實際租金</label>
                    <input type="number" class="form-control" id="price" name="price">
                </div>
                <div class="form-group">
                    <label for="description">居住情況</label>
                    <textarea class="form-control" rows="5" id="description" name="description"></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="送出" name="send">
                </div>

            </form>
        </div>
        <div class="col-sm-0 col-md-3">
            <h3>注意事項</h3>
            <p>1.不要盜圖</p>
            <p>2.不要作假</p>
        </div>
    </div>
@endsection