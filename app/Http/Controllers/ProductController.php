<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Config, Validator;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{

    protected $unitPage = 0;

    public function __construct() {
        // $this->unitPage = Config::get('app.items_show_per_page');
        $this->unitPage = 10;
        $this->middleware('auth');
    }


    public function index() {
        $data_products = Product::paginate($this->unitPage);
        return view('product.index', compact('data_products'));
    }


    public function onSearch(Request $body) {

        $word = $body->word_search;

        if ($word) {
            $data_products = Product::where('id', 'like', '%'.$word.'%')
                ->orWhere('name', 'like', '%'.$word.'%')
                ->orWhere('price', 'like', '%'.$word.'%')
                ->paginate($this->unitPage);
                // ->get();
            foreach ($data_products as $product) {
                $product->image_url = asset('./../'.$product->image_url);
            }
        } else {
            $data_products = Product::paginate($this->unitPage);
        }

        return view('product.index', compact('data_products'));

    }


    public function onAction($id = null) {

        $categories = Category::pluck('name', 'id')->prepend('เลือกรายการ', '');
        if ($id) {
        
            $product = Product::find($id);
            return view('product.edit')
                ->with('product', $product)
                ->with('categories', $categories);
        
        } else {

            return view('product.add')
                ->with('categories', $categories);
        
        }

    }


    public function onUpdate(Request $body) {
        
        $id = $body->id;
        // Validate area
        // $rules = array(
        //     'code' => 'required', 
        //     'name' => 'required',
        //     'category_id' => 'required|numeric', 
        //     'price' => 'numeric',
        //     'stock_qty' => 'numeric',
        // );
        
        // $messages = array(
        //     'required' => 'กรุณากรอกข้อมูล :attribute ให้ครบถ้วน', 
        //     'numeric' => 'กรุณากรอกข้อมูล :attribute ให้เป็นตัวเลข',
        // );
        
        // $temp = array(
        //     'code' => $body->code,
        //     'name' => $body->name,
        //     'category_id' => $body->category_id,
        //     'price' => $body->price,
        //     'stock_qty' => $body->stock_qty
        // );
        // //ตรงนี้เป็นการนําค่าจากฟอร์ม มาใส่ตัวแปร array temp เพราะ class Validator ต้องการ array
        // $validator = Validator::make($temp, $rules, $messages);
        // if ($validator->fails()) {
        //     return redirect('product/action/'.$id)
        //         ->withErrors($validator)
        //         ->withInput();
        // }
        // End Validate

        // if not fails() continue;

        // save section
        $product = Product::find($id);
        $product->code = $body->code;
        $product->name = $body->name;
        $product->category_id = $body->category_id;
        $product->price = $body->price;
        $product->stock_qty = $body->stock_qty;

        $product->save();

        if ($body->hasFile('image')) {
            $f = $body->file('image');
            $upload_to = 'upload\images'; // save to dir

            $relative_path = $upload_to . '/' . $f->getClientOriginalName(); // upload/images/file1.jpg
            $absolute_path = public_path() . '/' . $upload_to; //!important .../bikeshop/public/upload/image/file1.jpg
            
            // move and upload file
            $f->move($absolute_path, $f->getClientOriginalName());
            $product->image_url = $relative_path;
            $product->save();

        }

        return redirect('product')
            ->with('ok', true)
            ->with('msg', 'บันทึกข้อมูลเรียบร้อยแล้ว');
    }


    public function onInsert(Request $body) {

        $id = $body->id;
        // // Validate area
        // $rules = array(
        //     'code' => 'required', 
        //     'name' => 'required',
        //     'category_id' => 'required|numeric', 
        //     'price' => 'numeric',
        //     'stock_qty' => 'numeric',
        // );
        
        // $messages = array(
        //     'required' => 'กรุณากรอกข้อมูล :attribute ให้ครบถ้วน', 
        //     'numeric' => 'กรุณากรอกข้อมูล :attribute ให้เป็นตัวเลข',
        // );
        
        // $temp = array(
        //     'code' => $body->code,
        //     'name' => $body->name,
        //     'category_id' => $body->category_id,
        //     'price' => $body->price,
        //     'stock_qty' => $body->stock_qty
        // );
        // //ตรงนี้เป็นการนําค่าจากฟอร์ม มาใส่ตัวแปร array temp เพราะ class Validator ต้องการ array
        // $validator = Validator::make($temp, $rules, $messages);
        // if ($validator->fails()) {
        //     return redirect('product/action/')
        //         ->withErrors($validator)
        //         ->withInput();
        // }
        // End Validate


        $product = new Product();
        $product->code = $body->code;
        $product->name = $body->name;
        $product->category_id = $body->category_id;
        $product->price = $body->price;
        $product->stock_qty = $body->stock_qty;
        
        $product->save();
    
        if ($body->hasFile('image')) {
            $f = $body->file('image');
            $upload_to = 'upload\images'; // save to dir

            $relative_path = $upload_to . '/' . $f->getClientOriginalName(); // upload/images/file1.jpg
            $absolute_path = public_path() . '/' . $upload_to; //!important .../bikeshop/public/upload/image/file1.jpg
            
            // move and upload file
            $f->move($absolute_path, $f->getClientOriginalName());
            $product->image_url = $relative_path;
            $product->save();

        }

        return redirect('product')
            ->with('ok', true)
            ->with('msg', 'เพิ่มข้อมูลเรียบร้อยแล้ว');
    
    }


    public function onDelete($id) {
        Product::find($id)->delete();
        return redirect('product')
            ->with('ok', true)
            ->with('msg', 'ลบข้อมูลสำเร็จ');
    }


}
