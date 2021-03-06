@extends('layouts.app')

@section('title')
    List of Books
@endsection

@section('content')
    <div class="container col-md-10 col-lg-offset-1">
        <div class="row">
            <h3>List of books</h3>

            {!! Form::model(compact($search), ['class' => 'form-search', 'method' => 'GET']) !!}
            <div class="input-group">
                <span class="input-group-btn">
                    {!! Form::submit('Search by:', ['class'=>'btn btn-warning']) !!}
                </span>
                {!! Form::text('search', null, ['placeholder'=> ($search) ? $search : 'id, title, author, price or categories','class'=>'form-control']) !!}
                <span class="input-group-btn">
                    <a href="{{ route( 'books.create' )  }}" class="btn btn-primary">New book</a>
            </span>
            </div>
            {!! Form::close() !!}

        </div>

        <div class="row table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Author</th>
                    <th>Categories</th>
                    <td style="width: 25%">Actions</td>
                </tr>
                </thead>
                <tbody>
                @foreach($books as $book)
                    <tr>
                        <td>{{ $book->id }}</td>
                        <td>
                            <?php $routeBookDownload = route( 'books.download', [ 'id' => $book->id ] ) ?>
                            {!!
                                (file_exists($book->zip_file)) ?
                                "<a href={$routeBookDownload} target='_blank' title='Download the book {$book->title}'>{$book->title}</a>"
                                :
                                $book->title !!}
                        </td>
                        <td>{{ $book->price }}</td>
                        <td>{!!  isset($book->author->name) ? $book->author->name : "<span class='label label-danger'>The author has been deleted.</span>" !!}</td>
                        <td>{{ $book->categories->implode('name',' | ') }}</td>
                        <td>
                            <a href="{{route('books.edit',['id'=>$book->id])}}"
                               class="btn btn-warning btn-outline btn-xs">
                                <strong>Edit</strong>
                            </a>
                            <a href="{{route('books.detail',['id'=>$book->id])}}"
                               class="btn btn-info btn-outline btn-xs">
                                <strong>Detail</strong>
                            </a>
                            <a href="{{route('chapters.index',['id'=>$book->id])}}"
                               class="btn btn-primary btn-outline btn-xs">
                                <strong>View chapters</strong>
                            </a>
                            <a href="{{route('books.cover.create',$book)}}"
                               class="btn btn-warning btn-outline btn-xs">
                                <strong>Cover</strong>
                            </a>

                            {{--<a href="{{route('books.export',$book)}}"--}}
                            {{--class="btn btn-primary btn-outline btn-xs"--}}
                            {{--onclick="event.preventDefault();document.getElementById('export-form-{{ $book->id }}').submit();">--}}
                            {{--<strong>Export</strong>--}}
                            {{--</a>--}}
                            {{--{!! Form::open(['route' => ['books.export', 'book' =>$book->id],'method'=>'POST', 'id' => "export-form-{$book->id}", 'style' => 'display:none']) !!}--}}
                            {{--{!! Form::close() !!}--}}

                            <?php $routeLinkExport = route( 'books.export', [ 'book' => $book->id ] ) ?>
                            <a href="{{route('books.export',$book)}}"
                               class="btn btn-primary btn-outline btn-xs"
                               onclick="event.preventDefault();exportBook('{!! $routeLinkExport !!}')">
                                <strong>Export</strong>
                            </a>

                            <a href="{{route('books.destroy',['id'=>$book->id])}}"
                               class="btn btn-danger btn-outline btn-xs">
                                <strong>Send to trash</strong>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="text-center">{{ $books->links() }}</div>
        </div>
    </div>

@endsection

@push('scripts')
<script type="text/javascript">
    function exportBook( route ) {
        window.$.ajax({
            url    : route,
            method : 'POST',
            data   : {
                _token: window.Laravel.csrfToken
            },
            success: function ( data ) {
                window.$.notify({ message: "The book export process has started." }, { type: 'info' })
            }
        });
    }
</script>
@endpush