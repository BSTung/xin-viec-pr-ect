@extends('layouts.app_master_admin')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Cập nhật thuộc tính</h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <div class="box-body">
                    <form role="form" action="" method="POST">
                        @csrf

                        <div class="col-md-8">
                            <div class="form-group {{ $errors->first('atb_name') ? 'has-error' : ''}}">
                                <label for="name">Tên<span class="text-danger">(*)</span></label>
                                <input type="text" class="form-control" value="{{ $attribute->atb_name}}" name="atb_name" placeholder="Name ...">
                                @if ($errors->first('atb_name'))
                                    <span class="text-danger">{{ $errors->first('atb_name')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group {{ $errors->first('atb_type') ? 'has-error' : ''}}">
                                <label for="name">Nhóm thuộc tính<span class="text-danger">(*)</span></label>
                                <select class="form-control" name='atb_type'>
                                    <option value="1" {{ ($product->pro_country ?? '') == 1 ? "selected='selected'" : ""}}>Màu sắc</option>
                                    <option value="2" {{ ($product->pro_country ?? '') == 2 ? "selected='selected'" : ""}}>Bộ nhớ</option>
                                    <option value="3" {{ ($product->pro_country ?? '') == 3 ? "selected='selected'" : ""}}>Ram</option>
                                    <option value="4" {{ ($product->pro_country ?? '') == 4 ? "selected='selected'" : ""}}>Hệ điều hành</option>
                                </select>
                                @if ($errors->first('atb_type'))
                                    <span class="text-danger">{{ $errors->first('atb_type')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group {{ $errors->first('atb_category_id') ? 'has-error' : ''}}">
                                <label for="name">Danh mục<span class="text-danger">(*)</span></label>
                                <select class="form-control" name="atb_category_id">
                                    <option value="1" {{ $attribute->atb_category_id == 1 ?  "selected= 'selected'" : ''}}>Điện thoại</option>
                                    <option value="2" {{ $attribute->atb_category_id == 2 ?  "selected= 'selected'" : ''}}>Máy tính bảng</option>
                                    <option value="3" {{ $attribute->atb_category_id == 3 ?  "selected= 'selected'" : ''}}>Đồng hồ</option>
                                    <option value="4" {{ $attribute->atb_category_id == 4 ?  "selected= 'selected'" : ''}}>Laptop</option>
                                </select>
                                @if ($errors->first('atb_category_id'))
                                    <span class="text-danger">{{ $errors->first('atb_category_id')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="box-footer text-center" style="margin-top: 20px">
                                <a href="{{ route('admin.attribute.index')}}"  class="class btn btn-danger">Quay lại <i class="fa fa-undo"></i></a>
                                <button type="submit" class="btn btn-success">Cập nhật dữ liệu <i class="fa fa-save"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.box -->
    </section>
    <!-- /.content -->

@stop
