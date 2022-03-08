<?php
Route::group(['prefix' => 'admin123', 'namespace' => 'Admin'], function (){
    Route::get('/', function (){
        return view('admin.index');
    });
    /*Route danh mục category*/
    Route::group(['prefix' => 'category'], function (){
        Route::get('/', 'AdminCategoryController@index')->name('admin.category.index');
        Route::get('create', 'AdminCategoryController@create')->name('admin.category.create');
        Route::post('create', 'AdminCategoryController@store');
        /*khi xóa, sửa, active, HOT cần truyền tham số {id} để xử lý đúng đối tượng*/
        Route::get('active/{id}', 'AdminCategoryController@active')->name('admin.category.active');
        Route::get('hot/{id}', 'AdminCategoryController@hot')->name('admin.category.hot');
        Route::get('delete/{id}', 'AdminCategoryController@delete')->name('admin.category.delete');
        Route::get('update/{id}', 'AdminCategoryController@edit')->name('admin.category.update');
        Route::post('update/{id}', 'AdminCategoryController@update');
    });

    /*Route từ khóa keyword*/
    Route::group(['prefix' => 'keyword'], function (){
        Route::get('/', 'AdminKeywordController@index')->name('admin.keyword.index');
        Route::get('create', 'AdminKeywordController@create')->name('admin.keyword.create');
        Route::post('create', 'AdminKeywordController@store');
        Route::get('hot/{id}', 'AdminKeywordController@hot')->name('admin.keyword.hot');
        Route::get('delete/{id}', 'AdminKeywordController@delete')->name('admin.keyword.delete');
        Route::get('update/{id}', 'AdminKeywordController@edit')->name('admin.keyword.update');
        Route::post('update/{id}', 'AdminKeywordController@update');
    });

    /*Route product sản phẩm*/
    Route::group(['prefix' => 'product'], function (){
        Route::get('/', 'AdminProductController@index')->name('admin.product.index');
        Route::get('create', 'AdminProductController@create')->name('admin.product.create');
        Route::post('create', 'AdminProductController@store');
        Route::get('delete/{id}', 'AdminProductController@delete')->name('admin.product.delete');
        Route::get('update/{id}', 'AdminProductController@edit')->name('admin.product.update');
        Route::post('update/{id}', 'AdminProductController@update');
        Route::get('hot/{id}', 'AdminProductController@hot')->name('admin.product.hot');
        Route::get('active/{id}', 'AdminProductController@active')->name('admin.product.active');
    });

    /*Route attribute thuộc tính sản phẩm*/
    Route::group(['prefix' => 'attribute'], function (){
       Route::get('/','AdminAttributeController@index')->name('admin.attribute.index');
        Route::get('create', 'AdminAttributeController@create')->name('admin.attribute.create');
        Route::post('create', 'AdminAttributeController@store');
        Route::get('delete/{id}', 'AdminAttributeController@delete')->name('admin.attribute.delete');
        Route::get('update/{id}', 'AdminAttributeController@edit')->name('admin.attribute.update');
        Route::post('update/{id}', 'AdminAttributeController@update');
        Route::get('hot/{id}', 'AdminAttributeController@hot')->name('admin.attribute.hot');
    });
});
