<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <title>rating test</title>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

    <style type="text/css">
        /*    --------------------------------------------------
        :: Login Section
        -------------------------------------------------- */
        #login {
            padding-top: 50px
        }
        #login .form-wrap {
            width: 30%;
            margin: 0 auto;
        }
        #login h1 {
            color: #1fa67b;
            font-size: 18px;
            text-align: center;
            font-weight: bold;
            padding-bottom: 20px;
        }
        #login .form-group {
            margin-bottom: 25px;
        }
        #login .checkbox {
            margin-bottom: 20px;
            position: relative;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            -o-user-select: none;
            user-select: none;
        }
        #login .checkbox.show:before {
            content: '\e013';
            color: #1fa67b;
            font-size: 17px;
            margin: 1px 0 0 3px;
            position: absolute;
            pointer-events: none;
            font-family: 'Glyphicons Halflings';
        }
        #login .checkbox .character-checkbox {
            width: 25px;
            height: 25px;
            cursor: pointer;
            border-radius: 3px;
            border: 1px solid #ccc;
            vertical-align: middle;
            display: inline-block;
        }
        #login .checkbox .label {
            color: #6d6d6d;
            font-size: 13px;
            font-weight: normal;
        }
        #login .btn.btn-custom {
            font-size: 14px;
            margin-bottom: 20px;
        }
        #login .forget {
            font-size: 13px;
            text-align: center;
            display: block;
        }

        /*    --------------------------------------------------
            :: Inputs & Buttons
            -------------------------------------------------- */
        .form-control {
            color: #212121;
        }
        .btn-custom {
            color: #fff;
            background-color: #1fa67b;
        }
        .btn-custom:hover,
        .btn-custom:focus {
            color: #fff;
        }

        /*    --------------------------------------------------
            :: Footer
            -------------------------------------------------- */
        #footer {
            color: #6d6d6d;
            font-size: 12px;
            text-align: center;
        }
        #footer p {
            margin-bottom: 0;
        }
        #footer a {
            color: inherit;
        }
    </style>
</head>

<body>
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="form-wrap">
                    <h1>Image Upload</h1>
                    {{ Form::open(array('url' => '/upload','files' => true)) }}

                    <ul class="errors">
                        @foreach($errors->all() as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>

                    <div class="form-group">
                        {{ Form::label('avatar', 'Avatar',array('class' => 'sr-only')) }}
                        {{ Form::file('avatar') }}
                    </div>


                    {{ Form::submit('Upload', array('class' => 'btn btn-custom btn-lg btn-block')) }}

                    {{ Form::close() }}

                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>
</body>
</html>
