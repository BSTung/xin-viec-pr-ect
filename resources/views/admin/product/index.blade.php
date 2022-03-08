@extends('layouts.app_master_admin')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Quản lý sản phẩm</h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <div class="box-title">
                    <form class="form-inline">
<!--                        <input type="text" class="form-control" value="{{ Request::get('id')}}" name="id" placeholder="ID">-->
                        <input type="text" class="form-control" value="{{ Request::get('name')}}" name="name" placeholder="Tên...">
                        <select name="category" class="form-control">
                            <option value="0">Danh mục</option>
                            @foreach($categories as $item)
                                <option value="{{ $item->id}}" {{ Request::get('category') == $item->id ? "selected='selected'" : ""}}>{{ $item->c_name}}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-success"><i class="fa fa-search"> Tìm kiếm</i></button>
<!--                        <button type="submit" name="export" value="true" class="btn btn-info">
                            <i class="fa fa-save"> Xuất Excel</i>
                        </button>-->
                        <a href="{{ route('admin.product.create')}}"  class="class btn btn-success">Thêm Mới <i class="fa fa-plus"></i></a>
                    </form>
                </div>
                <div class="col-md-12">
                    <table class="table">
                        <tbody>
                        <tr>
                            <th style="width: 10px">STT</th>
                            <th>Tên sản phẩm</th>
                            <th>Danh mục</th>
                            <th>Hình ảnh</th>
                            <th>Giá bán</th>
                            <th>Hot</th>
                            <th>Trạng thái</th>
                            <th>Số lượng</th>
                            <th>Chỉnh sửa</th>
                        </tr>
                        </tbody>
                        @if (isset($products))
                            <?php $count = 0; ?>
                            @foreach ($products as $product)
                                <?php $count++; ?>
                                <tr>
                                    <td>{{ $count}}</td>
                                    <td>{{ $product->pro_name}}</td>
                                    <td>
                                        <span class="label label-success">{{ $product->category->c_name ?? "[N\A]"}}</span>
                                    </td>
                                    <td>
                                        <img src="{{ asset(pare_url_file($product->pro_avatar)) }}" style="width: 90px; height: 100px">
                                    </td>
                                    <td>
                                        @if ($product->pro_sale)
                                            <span style="text-decoration: line-through;">{{ number_format($product->pro_price,0,',','.')}} vnđ</span><br>
                                            @php
                                                $price = (100 - $product->pro_sale) * $product->pro_price /100;
                                            @endphp
                                            <span>{{ number_format($price,0,',','.')}} vnđ</span>
                                        @else
                                            {{ number_format($product->pro_price,0,',','.')}} vnđ
                                        @endif
                                    </td>
                                    <td>
                                        @if ($product->pro_hot == 1)
                                            <a href="{{ route('admin.product.hot', $product->id)}}"class="label label-default">Non</a>
                                        @else
                                            <a href="{{ route('admin.product.hot', $product->id)}}"class="label label-info">Hot</a>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($product->pro_active == 1)
                                            <a href="{{ route('admin.product.active', $product->id)}}"class="label label-info">Active</a>
                                        @else
                                            <a href="{{ route('admin.product.active', $product->id)}}"class="label label-default">Hide</a>
                                        @endif
                                    </td>
                                    <td>{{ $product->pro_number}}</td>
                                    <td>
                                        <a href="{{ route('admin.product.update', $product->id)}}" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i> Cập nhật</a>
                                        <a href="{{ route('admin.product.delete', $product->id)}}" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Xóa</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </table>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                {!! $products->appends($query)->links() !!}
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
@stop
