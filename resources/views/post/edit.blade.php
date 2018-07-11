@extends('layout.base')
@section('container')
<div class="container">
    <div class="blog-header"></div>
        <div class="row">
            <div class="col-sm-8 blog-main">
                <form action="/posts/{{$post->id}}" method="post">
                    {{method_field("PUT")}}
                    {{ csrf_field() }}
                    {{-- <input type="hidden" name="_method" value="PUT"> --}}
                    <div class="form-group">
                        <label>标题</label>
                        <input name="title" type="text" class="form-control" placeholder="这里是标题" value="{{$post->title}}">
                    </div>
                    <div class="form-group">
                        <label>内容</label>
                        <textarea id="content" name="content" class="form-control" style="height:400px;max-height:500px;"  placeholder="这里是内容">{{$post->content}}</textarea>
                    </div>
                  @include('layout.error')
                    <button type="submit" class="btn btn-default">提交</button>
                </form>
                <br>
            </div>
@endsection