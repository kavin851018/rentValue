@extends('master')

@section('content')
1.依照價格區間搜尋</br>
1-1實際價格</br>
1-2平均高值</br>
1-3平均低值</br>
</br>
2.輸入字串比對description</br>


    <form action="" method="GET">
        <input type="text" name="description" required/>
        <button type="submit">Submit</button>

    </form>
@foreach($result as $r)
    {{$r->description}}
    @endforeach
    @endsection