@extends('/master')

@section('content')
    @include('/components.validationErrorMessage')
    <form action="/user/auth/sign-in" method="post">
        <div class="form-group">
            <label for="email">Email address:</label>
            <input type="email" class="form-control" name="email" id="email" value="{{old('email')}}">
        </div>
        <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" name="password" id="pwd" value="{{old('password')}}">
        </div>
        <div class="checkbox">
            <label><input type="checkbox"> Remember me</label>
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
        {!! csrf_field() !!}
    </form>
    @endsection