@extends('layouts.app_master_admin')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Quản lý danh mục sản phẩm</h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <div class="box-header">
                    <h3 class="box-title"><a href="{{route('admin.category.create')}}"  class="class btn btn-success">Thêm Mới <i class="fa fa-plus"></i></a></h3>
                </div>
                <div class="col-md-12">
                    <table class="table">
                        <tr>
                            <th style="width: 10px">STT</th>
                            <th>Tên danh mục</th>
                            <th>Ảnh danh mục</th>
                            <th>Trạng thái</th>
                            <th>Hot</th>
                            <th>Thời gian</th>
                            <th>Chỉnh sửa</th>
                        </tr>
                        @if($categories)
                            <?php $count = 0; ?> <!--đánh số thứ tự tăng dần-->
                            @foreach($categories as $categoryItem)
                                    <?php $count++; ?> <!--đánh số thứ tự tăng dần-->
                                <tr>
                                    <td>{{ $count }}</td> <!--đánh số thứ tự tăng dần-->
                                    <td>{{$categoryItem->c_name }}</td>
                                    <td>
                                        <img src="{{ asset(pare_url_file($categoryItem->c_avatar)) }}" style="width: 80px; height: 80px;">
                                    </td>
                                    <td>
                                        @if($categoryItem->c_status == 1)
                                            <a href="{{route('admin.category.active', $categoryItem->id)}}" class="label label-info">Hiển thị</a>
                                        @else
                                            <a href="{{route('admin.category.active', $categoryItem->id)}}" class="label label-default">Ẩn</a>
                                        @endif
                                    </td>
                                    <td>
                                        @if($categoryItem->c_hot == 0)
                                            <a href="{{route('admin.category.hot', $categoryItem->id)}}" class="label label-default">Ẩn</a>
                                        @else
                                            <a href="{{route('admin.category.hot', $categoryItem->id)}}" class="label label-info">Hiển thị</a>
                                        @endif
                                    </td>
                                    <td>{{$categoryItem->created_at }}</td>
                                    <td>
                                    <!--sửa/xóa sản phầm cần truyền id vào trong route ($categoryItem->id)-->
                                        <a href="{{route('admin.category.update', $categoryItem->id)}}" class="btn btn-xs btn-primary"><i class="fa fa-pencil"> Chỉnh sửa</i></a>
                                        <a href="{{route('admin.category.delete', $categoryItem->id)}}" class="btn btn-xs btn-danger"><i class="fa fa-trash"> Xóa</i></a>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                    </table>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                {!! $categories->links() !!} <!--hiện phân trang-->
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
@stop
