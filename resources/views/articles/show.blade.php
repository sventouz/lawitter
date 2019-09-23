@extends('layout')
@section('content')

    @if($item !== '')
        <div class="headcopy">Title</div><hr>
        <h1 class="text">{{ $item->title }}</h1>
        <br/>
        <article>
            <div>{{ $item->body }}</div>
        </article>
        <br/>
        @unless ($item->tags->isEmpty())
            <h5>Tags:</h5>
            <ul>
                @foreach($item->tags as $tag)
                    <li>{{ $tag->name }}</li>
                @endforeach
            </ul>
        @endunless
        <br/>
        @if($authUser->id === $item->user_id)
            <a href="{{ action('ArticlesController@edit', [$item->id]) }}" class="btn btn-primary">
                編集
            </a>
            {!! delete_form(['articles', $item->id]) !!}
        @endif
    @endif
    <br/>
    @if (Auth::check())
        @if ($like)
            <!-- いいね取り消しフォーム -->
            {{ Form::model($item, array('action' => array('LikesController@destroy', $item->id, $like->id))) }}
            <button type="submit">
                ♡ いいね {{ $item->likes_count }}
            </button>
            {!! Form::close() !!}
        @else
        <!-- いいねフォーム -->
        {{ Form::model($item, array('action' => array('LikesController@store', $item->id))) }}
            <button type="submit">
            + いいね {{ $item->likes_count }}
            </button>
        {!! Form::close() !!}
        @endif
    @endif














    <div>
        <a href="{{ action('ArticlesController@index') }}" class="btn btn-secondary float-right">
            一覧へ戻る
        </a>
    </div>


    
@endsection
