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
        </tr>
        </thead>
        <tbody>
            @foreach($ObjectPaginate as $Object)
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
                </tr>
                @endforeach
        </tbody>

    </table>

    {{$ObjectPaginate->links()}}

    @endsection