<!DOCTYPE html>
<html>
<body>

@extends('master')


@section('content')
<form action="/user/upload" method="post" enctype="multipart/form-data">
    Select image to upload:

    <div class="custom-file">
        <input type="file" class="custom-file-input" name="fileToUpload[]" id="validatedCustomFile" multiple="true" required>
        <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
        <div class="invalid-feedback">Example invalid custom file feedback</div>
    </div>
    <input type="submit" class="btn btn-primary" value="Upload Image" name="submit">
    {!! csrf_field() !!}
</form>
    @endsection

</body>
</html>