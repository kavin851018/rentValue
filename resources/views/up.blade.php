<!DOCTYPE html>
<html>
<body>

@extends('master')
@section('description')
    資訊分享讓世界更美好
    @endsection

@section('content')
<form action="/user/upload" method="post" enctype="multipart/form-data" id="test">


    <div class="form-group" >
        選擇要上傳的圖片:
    <div class="custom-file">
        <input type="file" class="custom-file-input" name="fileToUpload[]" id="fileupload" multiple="true" required>
        <label class="custom-file-label" for="validatedCustomFile">選擇檔案...</label>

    </div>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="送出" name="send">
    </div>



    {!! csrf_field() !!}
</form>
    @endsection

</body>
</html>

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
                            file: {
                                extension: 'jpeg,png,jpg',
                                type: 'image/jpeg,image/png,image/jpg',
                                maxSize: 2048 * 1024,
                                message: 'The selected file is not valid'
                            }
                        }
                    }
                }
            });

            $('#removeFile').on('click', function () {
                document.getElementById('fileupload').value = "";
                $('#test').bootstrapValidator('revalidateField', 'fileupload');
            });
        });

        $('#fileupload').change(function(e){
            var fileNumber = e.target.files.length;
            var fileName="";
            for(var i=0;i<fileNumber;i++){
                fileName+=e.target.files[i].name+",";
            }
            $('.custom-file-label').html(fileName);
        });
    </script>
    @endsection