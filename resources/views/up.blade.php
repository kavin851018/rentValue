<!DOCTYPE html>
<html>
<body>

@extends('master')


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
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/css/bootstrapValidator.min.css"/>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/js/bootstrapValidator.min.js"></script>
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