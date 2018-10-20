@extends('shopping-list.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('shopping-list.create') }}"> Create New Shoping</a>
            </div>
        </div>
    </div>

    @include('includes.flash-message')


    @yield('content')

    {{--@if ($message = Session::get('success'))--}}
        {{--<div class="alert alert-success">--}}
            {{--<p>{{ $message }}</p>--}}
        {{--</div>--}}
    {{--@endif--}}

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Title</th>
            <th>Details</th>
            <th>Create_by</th>
            <th>Email</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($shoppings as $shopping)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $shopping->title }}</td>
                <td>{{ $shopping->description }}</td>
                <td>{{ $shopping->getUserName() }}</td>
                <td>{{ $shopping->getUserEmail() }}</td>
                <td>
                    <form action="{{ route('shopping-list.destroy',$shopping->id) }}" method="POST">

                        <a class="btn btn-primary" href="{{ route('items.index',$shopping) }}">Add Item</a>

                        <a class="btn btn-info" href="{{ route('shopping-list.show',$shopping->id) }}">Show</a>

                        <a class="btn btn-primary" href="{{ route('shopping-list.edit',$shopping->id) }}">Edit</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Delete</button>

                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $shoppings->links() !!}

@endsection


@section('content')
    <script>

        $(".alert").alert('close')
        // $('.alert').alert()
    </script>
@endsection

