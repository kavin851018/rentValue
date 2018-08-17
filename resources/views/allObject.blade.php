@extends('master')
@section('content')

    <table class="table table-condensed">
        <thead>
        <tr>
            <th>
                oid
            </th>
            <th>
                price
            </th>
            <th>
                description
            </th>
            <th>
                photo
            </th>
        </tr>
        </thead>
        <tbody>
            @foreach($ObjectAll as $Object)
                <tr>
                    <td>
                        {{$Object->oid}}
                    </td>
                    <td>
                        {{$Object->price}}
                    </td>
                    <td>
                        {{$Object->description}}
                    </td>
                    <td>
                        @foreach($Object->images as $image)
                            <img src="/{{$image->imagePath}}" class="img-thumbnail">

                            @endforeach
                    </td>
                </tr>
                @endforeach
        </tbody>

    </table>

    {{$ObjectAll->links()}}


    @endsection