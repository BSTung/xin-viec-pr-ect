<!-- Main content -->
<form role="form" action="" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="col-sm-8">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Thông tin cơ bản</h3>
            </div>
            <div class="box-body">
                <div class="form-group {{ $errors->first('pro_name') ? 'has-error' : '' }} ">
                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                    <input type="text" class="form-control" name="pro_name" placeholder="...." autocomplete="off" value="{{ $product->pro_name ?? old('pro_name')}}">
                    @if ($errors->first('pro_name'))
                        <span class="text-danger">{{ $errors->first('pro_name') }}</span>
                    @endif
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá sản phẩm</label> <!--nếu tồn tại product->pro_price thì show còn ko "??" thì hiện old('pro_price') bị bắt lỗi thì ko cần nhập lại các trường old-->
                            <input type="text" name="pro_price" value="{{ $product->pro_price ?? old('pro_price')}}" class="form-control" data-type="currency" placeholder=".vnđ">
                            @if ($errors->first('pro_price'))
                                <span class="text-danger">{{ $errors->first('pro_price') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giảm giá</label>
                            <input type="number" name="pro_sale" value="{{ $product->pro_sale ?? old('pro_sale',0)}}" class="form-control" data-type="currency" placeholder="%">
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <div class="form-group">
                            <label for="tag">Từ khóa</label>
                            <select name="keywords[]" class="form-control js-select2-keyword" multiple="">
                                <option value="">__Click__</option>

                                @foreach($keywords as $keyword)
                                    <option value="{{ $keyword->id}}" {{ in_array($keyword->id, $keywordOld) ? "selected='selected'" : ''}}
                                    >{{ $keyword->k_name}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group ">
                    <label for="exampleInputEmail1">Miêu tả sản phẩm</label>
                    <textarea name="pro_description" class="form-control" cols="5" rows="2" autocomplete="off">{{ $product->pro_description ?? old('pro_description')}}</textarea>
                    @if ($errors->first('pro_description'))
                        <span class="text-danger">{{ $errors->first('pro_description') }}</span>
                    @endif
                </div>
                <div class="form-group ">
                    <label class="control-label">Danh mục <b class="col-red">(*)</b></label>
                    <select name="pro_category_id" class="form-control">
                        <option value="">Chọn</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id}}" {{ ($product->pro_category_id ?? 0 == $category->id) ? "selected='selected'" : ""}}>
                                                            <!--(Nếu không tồn tại pro_category_id bằng ko, ngược lại = pro_category_id)
                                                            nếu tồn tại ? "selected='select'" : ""-->
                                {{ $category->c_name}}</option>
                        @endforeach
                    </select>
                    @if ($errors->first('pro_category_id'))
                        <span class="text-danger">{{ $errors->first('pro_category_id') }}</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Thuộc tính</h3>
            </div>
            <div class="box-body">

                @foreach($attributes as $key => $attribute)
                    <div class="form-group col-sm-3">
                        <div>
                            <h4 style="border-bottom: 1px solid #dedede; padding-bottom: 10px;">{{ $key}}</h4>
                        </div>
                        @foreach($attribute as $item)
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="attribute[]" {{ in_array($item['id'], $attributeOld) ? "checked" : ''}}
                                    value="{{ $item['id']}}">{{ $item['atb_name']}}
                                </label>
                            </div>
                        @endforeach
                    </div>
                @endforeach

            </div>
            <hr>
            <div class="box-header with-border">
                <h3 class="box-title">Album ảnh</h3>
            </div>
            <div class="box-body">
                @if (isset($images))
                    <div class="rows" style="margin-bottom: 15px;">
                        @foreach($images as $item)
                            <div class="col-sm-2">
                                <a href="{{ route('admin.product.delete_image', $item->id)}}" style="display: block;">
                                    <img src="{{ pare_url_file($item->pi_slug) }}" style="width: 100%; height: auto;">
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif
                <div class="form-group">
                    <div class="file-loading">
                        <input id="images" type="file" name="file[]" multiple class="file" data-overwrite-initial="false"
                               data-min-file-count="0">
                    </div>
                </div>
            </div>
            </hr>
            <hr>
            <div class="box-body">
                <div class="form-group col-sm-3">
                    <label for="exampleInputEmail1">Thương hiệu</label>
                    <select name="pro_country" class="form-control">
                        <option value="0">Chọn</option>
                        <option value="1" {{ ($product->pro_country ?? '') == 1 ? "selected='selected'" : ""}}>iPhone</option>
                        <option value="2" {{ ($product->pro_country ?? '') == 2 ? "selected='selected'" : ""}}>SAMSUNG</option>
                        <option value="3" {{ ($product->pro_country ?? '') == 3 ? "selected='selected'" : ""}}>oppo</option>
                        <option value="4" {{ ($product->pro_country ?? '') == 4 ? "selected='selected'" : ""}}>vivo</option>
                        <option value="5" {{ ($product->pro_country ?? '') == 5 ? "selected='selected'" : ""}}>xiaomi</option>
                        <option value="6" {{ ($product->pro_country ?? '') == 6 ? "selected='selected'" : ""}}>realme</option>
                        <option value="7" {{ ($product->pro_country ?? '') == 7 ? "selected='selected'" : ""}}>MacBook</option>
                        <option value="8" {{ ($product->pro_country ?? '') == 8 ? "selected='selected'" : ""}}>ASUS</option>
                        <option value="9" {{ ($product->pro_country ?? '') == 9 ? "selected='selected'" : ""}}>hp</option>
                        <option value="10" {{ ($product->pro_country ?? '') == 10 ? "selected='selected'" : ""}}>Lenovo</option>
                        <option value="11" {{ ($product->pro_country ?? '') == 11 ? "selected='selected'" : ""}}>Acer</option>
                        <option value="12" {{ ($product->pro_country ?? '') == 12 ? "selected='selected'" : ""}}>DELL</option>
                        <option value="13" {{ ($product->pro_country ?? '') == 13 ? "selected='selected'" : ""}}>MSI</option>
                        <option value="14" {{ ($product->pro_country ?? '') == 14 ? "selected='selected'" : ""}}>Apple Watch</option>
                        <option value="15" {{ ($product->pro_country ?? '') == 15 ? "selected='selected'" : ""}}>G-Shock</option>
                    </select>
                </div>

                <!--phần thêm pro_number, pro_energy-->

                <!--<div class="form-group col-sm-3">
                    <label>Số lượng</label>
                    <input type="number" class="form-control" name="" value="" placeholder="10">
                </div>-->

            </div>

            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Nội dung</h3>
                </div>
                <div class="box-body">
                    <div class="form-group ">
                        <label for="exampleInputEmail1">Tổng quan</label>
                        <textarea name="pro_content" id="content" class="form-control textarea" cols="5" rows="2">{{ $product->pro_content ?? ''}} </textarea>
                        @if ($errors->first('pro_content'))
                            <span class="text-danger">{{ $errors->first('pro_content') }}</span>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Ảnh đại diện</h3>
            </div>
            <div class="box-body block-images">
                <div style="margin-bottom: 10px"> <img src="/images/no-image.jpg" onerror="this.onerror=null;
                this.src='/images/no-image.jpg';" alt="" class="img-thumbnail" style="width: 100px;height: 150px;"> </div>
                <div style="position:relative;"> <a class="btn btn-primary" href="javascript:;"> Chọn ảnh <input type="file" style="position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:&quot;progid:DXImageTransform.Microsoft.Alpha(Opacity=0)&quot;;opacity:0;background-color:transparent;color:transparent;" name="pro_avatar" size="40" class="js-upload"> </a> &nbsp; <span class="label label-info" id="upload-file-info"></span> </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 clearfix">
        <div class="box-footer text-center">
            <a href="{{ route('admin.product.index') }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Hủy bỏ</a>
            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>{{ isset($product) ? " Cập nhật" : " Thêm mới"}}</button>
        </div>
    </div>
</form>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/themes/fa/theme.js" type="text/javascript"></script>

<!-- /.content -->
