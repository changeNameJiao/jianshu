@extends('layout.base')
@section('container')
<div class="container">
    <div class="blog-header"></div>
    <div class="row">
    <div class="col-sm-8">
        <blockquote>
            <p>
                <img src="/storage/9f0b0809fd136c389c20f949baae3957/iBkvipBCiX6cHitZSdTaXydpen5PBiul7yYCc88O.jpeg" alt="" class="img-rounded" style="border-radius:500px; height: 40px"> {{$user->name}}
            </p>
            <footer>关注：{{$user->stars_count}}｜粉丝：{{$user->fans_count}}｜文章：{{$user->posts_count}}</footer>
            <br>
        @include('user.badges.like',['target_user'=>$user])
        </blockquote>
    </div>
    <div class="col-sm-8 blog-main">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">文章</a></li>
                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">关注</a></li>
                <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">粉丝</a></li>
            </ul>
            <div class="tab-content">
                @foreach($user->posts as $post)
                <div class="tab-pane active" id="tab_1">
                    <div class="blog-post" style="margin-top: 30px">
                    <p class=""><a href="/user/{{$user->id}}}">{{$user->name}}</a> {{$post->created_at}}</p>
                    <p class=""><a href="/posts/{{$post->id}}" >{{$post->title}}</a></p>
                    {!! str_limit($post->content,200,'...') !!}
                    </div>      
                </div>
                @endforeach
                <!-- /.tab-pane -->
                 @if(count($susers) > 0)
                @foreach($susers as $star)
                <div class="tab-pane" id="tab_2">
                    <div class="blog-post" style="margin-top: 30px">
                        <p class="">{{$star->name}}</p>
                        <p class="">关注：{{$star->stars_count}} | 粉丝：{{$star->fans_count}}｜ 文章：{{$star->posts_count}}</p>
                        @include('user.badges.like',['target_user'=>$user])
                    </div>
                </div>
                @endforeach
                 @else
                     <div class="tab-pane" id="tab_3">
                         <div class="blog-post" style="margin-top: 100px;width:100%;text-align:center;">
                                                    暂无粉丝  
                         </div>   
                     </div>
                @endif
                <!-- /.tab-pane -->
                @if(count($fusers) > 0)
                @foreach($fusers as $fan)
                <div class="tab-pane" id="tab_3">
                     <div class="blog-post" style="margin-top: 30px">
                        <p class="">{{$fan->name}}</p>
                        <p class="">关注：{{$fan->stars_count}} | 粉丝：{{$fan->fans_count}}｜ 文章：{{$fan->posts_count}}</p>
                       @include('user.badges.like',['target_user'=>$user])
                    </div>
                </div>
                @endforeach
                @else
                     <div class="tab-pane" id="tab_3">
                         <div class="blog-post" style="margin-top: 100px;width:100%;text-align:center;">
                                                    暂无粉丝  
                         </div>   
                     </div>
                @endif
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div>
    </div>
@endsection