@extends('layouts.app')

@section('title')
    List of Chapters
@endsection

@section('content')
    <div class="container col-md-10 col-lg-offset-1">
        <div class="row">
            <h2> List of chapters in the book <span class="label label-primary">{{$book->title}}</span></h2>

            {!! Form::model(compact($search), ['class' => 'form-search', 'method' => 'GET']) !!}
            <div class="input-group">
                <span class="input-group-btn">
                    {!! Form::submit('Search by:', ['class'=>'btn btn-warning']) !!}
                </span>
                {!! Form::text('search', null, ['placeholder'=> ($search) ? $search : 'id, name or content',
                'class'=>'form-control']) !!}
                <span class="input-group-btn">
                    <a href="{{ route( 'chapters.create', ['book'=> $book->id] )  }}" class="btn btn-primary">New
                        charter</a>
            </span>
            </div>
            {!! Form::close() !!}

        </div>


        <div class="row table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Content</th>
                    <th>Order</th>
                    <td style="width: 15%;">Actions</td>
                </tr>
                </thead>
                <tbody>
                @foreach($chapters as $chapter)
                    <tr>
                        <td>{{ $chapter->id }}</td>
                        <td>{{ $chapter->name }}</td>
                        <td>{{ customEcho($chapter->content,200)  }}</td>
                        <td>{{ $chapter->order }}</td>
                        <td>
                            <a href="{{route('chapters.edit',['books' => $book->id,'chapter'=>$chapter->id])}}"
                               class="btn btn-warning btn-outline btn-xs">
                                <strong>Edit</strong>
                            </a>
                            <a href="{{route('chapters.detail',['book' => $book->id,'id'=>$chapter->id])}}"
                               class="btn btn-info btn-outline btn-xs">
                                <strong>Detail</strong>
                            </a>
                            <a href="{{route('chapters.destroy',['book' => $book->id,'id'=>$chapter->id])}}"
                               class="btn btn-danger btn-outline btn-xs">
                                <strong>Send to trash</strong>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="text-center">{{ $chapters->links() }}</div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">

    </script>
@endsection