<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use App\Models\Catalogs;
use App\Models\Items;
use App\Models\Chat;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{




    // /**
    //  * Display a listing of the resource.
    //  * @return Renderable
    //  */
    public function api_chat__add_msg(Request $request)
    {

        $ret = [ 'in' => $request->all() ];

try {
        $itemAdd = $request->validate([
            //         // 'title' => 'required|unique:posts|max:255',
            //         // 'body' => 'required',
            //         'name' => 'required|string',
            'msg' => 'required|string',
            // 'price' => 'required|numeric',
            //         // 'old_price' => 'nullable',
            'room_id' => 'integer',
            'writer_id' => 'integer',
            'to_user_id' => 'integer',
    //         // 'status_order' => 'string|required_with:buy,sell,free,arenda,arenda_search', // enum('buy','sell','arenda') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'какой тип обьявления',
    //         'status_order' => 'string|required', // enum('buy','sell','arenda') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'какой тип обьявления',
    //         // 'status', //` enum('on','off') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'on' COMMENT 'работает или не очень',

        ]);


        $ret['res'] = Chat::create($itemAdd);

        } catch (\Throwable $th) {
            //throw $th;
            $ret['error'] = $th->getMessage();
        }

        return response()->json($ret);
    }


    public function api_chat__get_chat(Request $request , $room_id , $writer_id )
    {

        $ret = [
            'in' => $request->all() ,
            '$room_id' => $room_id,
            '$writer_id' => $writer_id
        ];

        // $ret['res'] =
        $re = Chat::GetChat($room_id, $writer_id )->get();
        $ret['res'] = $re->toArray();

        return response()->json($ret);
    }


    public function api_chat__get_chat_list_users(Request $request , $room_id )
    {

        $ret = [
            'in' => $request->all() ,
            '$room_id' => $room_id
        ];

        // $ret['res'] =
        $re = Chat::ListChatUsers($room_id )->get();
        $ret['res'] = $re->toArray();

        return response()->json($ret);
    }


    // /**
    //  * Display a listing of the resource.
    //  * @return Renderable
    //  */
    // public function index()
    // {
    //     return view('vitrin::index');
    // }



    // public function api(Request $request, $method, $var1 = '')
    // {

    //     $return = [
    //         'req' => $request,
    //         'method' => $method
    //     ];

    //     // получение каталогов
    //     if ($method == 'catalogs') {

    //         $return['datain'] = Catalogs::all();
    //     }
    //     // получение обьявлений
    //     else if ($method == 'items') {

    //         // if (!empty($var1)) {
    //         //     $return['datain'] = Items::where('cat_id', '=', $var1)->get();
    //         // } else {
    //         $return['datain'] = Items::Cats($var1)->get();
    //         // }

    //     }
    //     // получение 1 обьявлений
    //     else if ($method == 'item') {

    //         // if (!empty($var1)) {
    //         //     $return['datain'] = Items::where('cat_id', '=', $var1)->get();
    //         // } else {
    //         $r = Items::Item($var1)->get();
    //         $return['datain'] = $r[0];
    //         // }

    //     }

    //     return response()->json($return);
    // }

    // public function apiPost(Request $request, $method, $var1 = '')
    // {

    //     $return = [
    //         'req' => $request->all(),
    //         'method' => $method,
    //         // 'input' => Input::file('files')
    //         'files' => $request->file('files')
    //     ];

    //     // $return['files_e'] = [];
    //     // $return['files_e2'] = [];
    //     // foreach ($return['files'] as $file) {
    //     //     // $return['files_e'][] = $file;
    //     //     $res = $file->move('uploads/');
    //     //     $return['files_e2'][] = $res;
    //     //     $return['files_e'][] = $file->path();
    //     // }


    //     // try {
    //     //code...

    //     $itemAdd = $request->validate([
    //         // 'title' => 'required|unique:posts|max:255',
    //         // 'body' => 'required',
    //         'name' => 'required|string',
    //         'opis' => 'required|string',
    //         'price' => 'required|numeric',
    //         // 'old_price' => 'nullable',
    //         'cat_id' => 'required|integer',
    //         'autor_id' => 'required|integer',
    //         // 'status_order' => 'string|required_with:buy,sell,free,arenda,arenda_search', // enum('buy','sell','arenda') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'какой тип обьявления',
    //         'status_order' => 'string|required', // enum('buy','sell','arenda') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'какой тип обьявления',
    //         // 'status', //` enum('on','off') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'on' COMMENT 'работает или не очень',

    //     ]);

    //     $return['$itemAdd'] = $itemAdd;
    //     // for ($t = 0; $t <= 20; $t++) {
    //         $return['item_add_result'] = Items::insertGetId($itemAdd);
    //     // }
    //     // $return['item_add_result_id'] = $return['item_add_result']->id;

    //     if (!empty($return['item_add_result'])) {
    //         $in = [];

    //         for ($i = 0; $i <= 20; $i++) {

    //             // if ($request->fileHas('files' . $i)) {

    //             try {
    //                 //code...

    //                 $return['files_' . $i] = $request->file('files' . $i);
    //                 $path = $request->file('files' . $i)->store('public/items');
    //                 $return['files_' . $i . '_path'] = $path;
    //                 $return['files_' . $i . '_real'] = Storage::url($path);

    //                 $e = [
    //                     'items_id' => $return['item_add_result'],
    //                     'img' => Storage::url($path)
    //                 ];
    //                 $in[] = $e;
    //             } catch (\Throwable $th) {
    //                 // $return['files_' . $i] = 'skip';
    //             }
    //         }

    //         if (!empty($in)) {
    //             $return['insert-imgs_ar'] = $in;
    //             $return['insert-imgs'] = DB::table('items-img')->insert($in);
    //         }
    //     }

    //     // } catch (\Throwable $th) {
    //     //     //throw $th;
    //     //     $return['error'] = $th;
    //     // }


    //     // $errors = $validator->errors();
    //     // $return['error2'] = $errors->all();









    //     // $files = Input::file('files');
    //     // foreach ($files as $file) {
    //     //     // public/uploads
    //     //     $file->move('uploads/');
    //     // }

    //     // получение каталогов
    //     if ($method == 'catalogs') {

    //         $return['datain'] = Catalogs::all();
    //     }
    //     // получение обьявлений
    //     else if ($method == 'items') {
    //         // if (!empty($var1)) {
    //         //     $return['datain'] = Items::where('cat_id', '=', $var1)->get();
    //         // } else {
    //         $return['datain'] = Items::Cats($var1)->get();
    //         // }
    //     }

    //     return response()->json($return);
    // }

    // /**
    //  * Show the form for creating a new resource.
    //  * @return Renderable
    //  */
    // public function create()
    // {
    //     return view('vitrin::create');
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  * @param Request $request
    //  * @return Renderable
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

    // /**
    //  * Show the specified resource.
    //  * @param int $id
    //  * @return Renderable
    //  */
    // public function show($id)
    // {
    //     return view('vitrin::show');
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  * @param int $id
    //  * @return Renderable
    //  */
    // public function edit($id)
    // {
    //     return view('vitrin::edit');
    // }

    // /**
    //  * Update the specified resource in storage.
    //  * @param Request $request
    //  * @param int $id
    //  * @return Renderable
    //  */
    // public function update(Request $request, $id)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  * @param int $id
    //  * @return Renderable
    //  */
    // public function destroy($id)
    // {
    //     //
    // }
}
