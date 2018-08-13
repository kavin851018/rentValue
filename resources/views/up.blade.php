<!DOCTYPE html>
<html>
<body>

<form action="/user/upload" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload[]" id="fileToUpload" multiple="true">
    <input type="submit" value="Upload Image" name="submit">
    {!! csrf_field() !!}
</form>

</body>
</html>