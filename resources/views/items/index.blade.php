@extends('items.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <a class="btn btn-success" href="{{ route('shopping-list.index') }}"> Back to Shoping list</a>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('items.create',$shopping->id) }}"> Create New Item</a>
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
            <th>Shopping</th>
            <th>Title</th>
            <th>Description</th>
            <th>Create_by</th>
            <th>Update_by</th>
            <th>Completed</th>
            <th>Completed_date</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($items as $item)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $shopping->title }}</td>
                <td>{{ $item->title }}</td>
                <td>{{ $item->description }}</td>
                <td>{{ $item->getUserCreateName() }}</td>
                <td>{{ $item->getUserUpdateName() }}</td>
                <td>
                    <form action="{{ route('items.completed',[$shopping->id,$item->id]) }}" method="POST">

                        <button type="submit" class="btn @if($item->completed) btn-danger @else btn-primary @endif">
                            @if($item->completed)
                                Already buy Complete
                            @else
                                Not buy Complete
                            @endif

                        </button>
                        @csrf
                    </form>
                </td>
                <td>{{ $item->completed_at }}</td>

                <td>
                    <form action="{{ route('items.destroy',[$shopping->id,$item->id]) }}" method="POST">
                        <div>
                            <a class="btn btn-info" href="{{ route('items.show',[$shopping->id,$item->id]) }}">Show</a>
                        </div>
                        <div>
                            <a class="btn btn-primary" href="{{ route('items.edit',[$shopping->id,$item->id]) }}">Edit</a>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                        @csrf
                        @method('DELETE')

                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $items->links() !!}

@endsection


@section('content')
    <script>
        $(".alert").alert('close')
    </script>
@endsection

