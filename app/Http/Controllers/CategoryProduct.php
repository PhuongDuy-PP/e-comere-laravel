<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class CategoryProduct extends Controller
{
    public function add_category_product(){
        return view('admin.add_category_product');
    }

    public function all_category_product(){
        $all_category_product = DB::table('tbl-category_product')->get();
        $maneger_category_product = view('admin.all_category_product')->with('all_category_product', $all_category_product);
        return view('admin_layout')->with('admin.all_category_product', $maneger_category_product);
    }

    public function save_category_product(Request $request){
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        $data['category_status'] = $request->category_product_status;
        
        DB::table('tbl-category_product')->insert($data);
        Session::put('message', 'Thêm danh mục sản phẩm thành công');
        return Redirect::to('add-category-product');
    }

    public function unactive_category_product($category_product_id){
        DB::table('tbl-category_product')->where('category_id', $category_product_id)->update(['category_status'=>1]);
        Session::put('message', 'Unactive thành công');
        return Redirect::to('all-category-product');
    }

    public function active_category_product($category_product_id){
        DB::table('tbl-category_product')->where('category_id', $category_product_id)->update(['category_status'=>0]);
        Session::put('message', 'Active thành công');
        return Redirect::to('all-category-product');
    }
}
