<!DOCTYPE html>
<html>
<body>

@extends('master')
@section('description')
    資訊分享讓世界更美好
    @endsection

@section('content')
<form action="/user/upload" method="post" enctype="multipart/form-data">
    Select image to upload:

    <div class="form-group" id="test">
    <div class="custom-file">
        <input type="file" class="custom-file-input" name="fileToUpload[]" id="validatedCustomFile" multiple="true" required>
        <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
        <div class="invalid-feedback">Example invalid custom file feedback</div>
    </div>
    </div>

    <div class="form-group" >
        <label for="resume" class="col-sm-2 control-label">Upload stuff</label>
        <div class="col-sm-8">
            <input type="file" name="fileToUpload[]" id="fileupload" multiple="true" />
        </div>
        <div class="col-sm-2">	<a class="btn btn-danger pull-right" id="removeFile">Remove</a>

        </div>
    </div>


    <input type="submit" class="btn btn-primary" value="Upload Image" name="submit">
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
                                extension: 'doc,docx,pdf,zip,rtf',
                                type: 'application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/rtf,application/zip',
                                maxSize: 5 * 1024 * 1024, // 5 MB
                                message: 'The selected file is not valid, it should be (doc,docx,pdf,zip,rtf) and 5 MB at maximum.'
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
    </script>
    @endsection