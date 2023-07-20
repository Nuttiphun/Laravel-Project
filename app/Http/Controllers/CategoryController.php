<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Config, Validator;

class CategoryController extends Controller
{

    protected $unitPage = 0;

    
    public function __construct() {
        // $this->unitPage = Config::get('app.items_show_per_page');
        $this->unitPage = 10;
        $this->middleware('auth');
    }

    
    public function index() {
        $data_category = Category::paginate($this->unitPage);
        return view('category.index', compact('data_category'));
    }
    
    
    public function onSearch(Request $body) {

        $word = $body->word_search;
        
        if ($word) {
            $data_category = Category::where('id', 'like', '%'.$word.'%')
                ->orWhere('name', 'like', '%'.$word.'%')
                ->paginate($this->unitPage);
        } else {
            $data_category = Category::paginate($this->unitPage);
        }

        return view('category.index', compact('data_category'));

    }


    // Section Add
    public function getFormAdd(Request $body) { 
        return view('category.add'); 
    }


    public function onAdd(Request $body) {
        
        // $validate_data = array(
        //     'name' => $body->name
        // );

        // $validate_rules = array(
        //     'name' => 'required'
        // );

        // $validate_message = array(
        //     'required' => 'โปรดกรอกช้อมูล :attribute'
        // );

        // $validator_result = Validator::make($validate_data, $validate_rules, $validate_message);
        // if ($validator_result->fails()) {
        //     return redirect('product/category/add')
        //         ->withErrors($validator_result)
        //         ->withInput();
        // }

        $category = new Category();
        $category->name = $body->name;
        $category->save();

        return redirect('product/category')
            ->with('status', true)
            ->with('message', 'บันทึกข้อมูลสำเร็จ');
    }
    // End



    // Section Edit
    public function getFormEdit(Request $body) { 
        $category = Category::find($body->id);
        return view('category.edit')
            ->with('category', $category);
    }


    public function onEdit(Request $body) {

        
        // $validate_data = array(
        //     'name' => $body->name
        // );
        
        // $validate_rules = array(
        //     'name' => 'required'
        // );
        
        // $validate_message = array(
        //     'required' => 'โปรดกรอกช้อมูล :attribute'
        // );
        
        // $validator_result = Validator::make($validate_data, $validate_rules, $validate_message);
        // if ($validator_result->fails()) {
        //     return redirect('product/category/edit/'.$body->id)
        //     ->withErrors($validator_result)
        //     ->withInput();
        // }
        
        $category = Category::find($body->id);
        $category->name = $body->name;
        $category->save();
        
        return redirect('product/category')
            ->with('status', true)
            ->with('message', 'แก้ไขข้อมูลสำเร็จ');
    }
    // End


    public function onDelete($id) {
        Category::find($id)->delete();

        return redirect('product/category')
            ->with('status', true)
            ->with('message', 'ลบข้อมูลสำเร็จ');
    }


}
