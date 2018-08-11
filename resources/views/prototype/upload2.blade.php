<!DOCTYPE html>
<html lang="en">
<head>
    <title>評屋網</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <script src="http://igniteui.com/js/modernizr.min.js"></script>
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.min.js"></script>
    <script src="http://cdn-na.infragistics.com/igniteui/latest/js/infragistics.core.js"></script>
    <script src="http://cdn-na.infragistics.com/igniteui/latest/js/infragistics.lob.js"></script>
    <link href="http://cdn-na.infragistics.com/igniteui/latest/css/themes/infragistics/infragistics.theme.css" rel="stylesheet"></link>
    <link href="http://cdn-na.infragistics.com/igniteui/latest/css/structure/infragistics.css" rel="stylesheet"></link>

    <style>
        .s-clearfix {
            content: "";
            display: table;
            clear: both;
        }

        .mb10 {
            margin-bottom: 10px;
        }

        .ml5 {
            margin-left: 5px;
        }

        .mt4 {
            margin-top: 4px;
        }

        .border-box {
            box-sizing: border-box;
        }

        .igui-filter-f-left {
            float: left;
        }

        .igui-filter-f-right {
            float: right;
        }

        .igui-filter-checkbox label {
            cursor: pointer;
        }

        .jumbotron{
            padding:2rem  2rem;
        }
    </style>

    <script>
        $(function () {
            var buttonLabel = $.ig.Upload.locale.labelUploadButton;
            if (Modernizr.input.multiple) {
                buttonLabel = "Drag and Drop Files Here <br/> or Click to Select From a Dialog";
            }
            $("#igUpload1").igUpload({
                mode: 'multiple',
                multipleFiles: true,
                maxUploadedFiles: 5,
                maxSimultaneousFilesUploads: 2,
                progressUrl: "http://igniteui.com/IGUploadStatusHandler.ashx",
                controlId: "serverID1",
                labelUploadButton: buttonLabel,
                onError: function (e, args) {
                    showAlert(args);
                }
            });
            if (Modernizr.input.multiple) {
                $(".ui-igstartupbrowsebutton").attr("style", "width: 320px; height: 80px;");
            }
            $("#useSingleRequestCheck").igCheckboxEditor({
                checked: false,
                valueChanged: function (evt, ui) {
                    $("#igUpload1").igUpload("option", "useSingleRequest", ui.newState);
                }
            });
        });

        function showAlert(args) {
            $("#error-message").html(args.errorMessage).stop(true, true).fadeIn(500).delay(3000).fadeOut(500);
        }
    </script>

</head>
<body>

<div class="jumbotron text-center">
    <h1>評屋網 - 上傳物件 </h1>
    <p>透過資訊共享讓世界更美好!</p>

    <ul class="nav justify-content-end">
        <li class="nav-item">
            <a class="nav-link" href="/">首頁</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/upload">上傳物件</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">關於評屋網</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="#">贊助</a>
        </li>
    </ul>
</div>

<div class="container">
    <div class="row">
        <div class="col-sm-8">



            <div class="border-box igui-filter-checkbox">
                <div class="mb10 s-clearfix">
                    <input class="mr5 igui-filter-f-left" id="useSingleRequestCheck" type="checkbox"></input>
                    <label class="ml5 igui-filter-f-right mt4" for="useSingleRequestCheck">Use a Single Request for Uploading Multiple Files</label>
                </div>
            </div>

            <div id="igUpload1"></div>
            <div id="error-message" style="color: #FF0000; font-weight: bold;"></div>

            <div class="form-group">
                <label for="usr">實際租金</label>
                <input type="text" class="form-control" id="usr">
            </div>
            <div class="form-group">
                <label for="comment">居住情況</label>
                <textarea class="form-control" rows="5" id="comment"></textarea>
            </div>

            <button type="submit" class="btn btn-primary float-right">送出</button>

        </div>
        <div class="col-sm-4">
            <h3>注意事項</h3>
            <p>1.不要盜圖</p>
            <p>2.不要作假</p>
        </div>
    </div>

</div>

</body>
</html>
