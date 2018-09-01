@extends('master')

@section('content')
    @include('/components.validationErrorMessage')
    <form action="/user/auth/sign-up" method="post">
        <div class="form-group">
            <label for="email">Email address:</label>
            <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}">
        </div>
        <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" id="pwd" name="password" value="{{old('password')}}">
        </div>
        <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" name="password_confirmation" id="pwd2" value="{{old('password_confirmation')}}">
        </div>
        <div class="form-group">
            <label for="sel1">Select list:</label>
            <select class="form-control" id="sel1" name="select" >
                <option value="G" {{ old('select') == 'G' ? "selected" : "" }}>一般會員</option>
                <option value="A" {{ old('select') == 'A' ? "selected" : "" }}>管理者</option>
            </select>
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
        {!! csrf_field() !!}
    </form>
    @endsection