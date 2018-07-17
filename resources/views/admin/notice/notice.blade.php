@extends('admin.layout.base')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

            <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-10 col-xs-6">
                <div class="box">

                    <div class="box-header with-border">
                        <h3 class="box-title">通知列表</h3>
                    </div>
                    <a type="button" class="btn " href="/admin/notices/create">增加通知</a>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tbody><tr>
                                <th style="width: 10px">#</th>
                                <th>通知名称</th>
                                <th>操作</th>
                            </tr>
                                                            <tr>
                                    <td>1</td>
                                    <td>这是一个通知</td>
                                    <td></td>
                                </tr>
                                                            <tr>
                                    <td>2</td>
                                    <td>这是第二个通知</td>
                                    <td></td>
                                </tr>
                                                            <tr>
                                    <td>3</td>
                                    <td>这是第三个通知</td>
                                    <td></td>
                                </tr>
                                                            <tr>
                                    <td>4</td>
                                    <td>简书活动通告</td>
                                    <td></td>
                                </tr>
                                                        </tbody></table>
                    </div>
                </div>
            </div>
        </div>
    </section>
        <!-- /.content -->
    </div>
 @endsection