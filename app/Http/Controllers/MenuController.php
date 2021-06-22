<?php

namespace App\Http\Controllers;

use DataTables;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Menus;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.menu');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data['url'] = '/menu/add';
        $data['method'] = 'post';
        $data['menu_parent'] = Menus::whereNull('parent_id')->get();
        $data['act'] = 'add';

        return view('admin.forms.menuForm', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $this->validate($request,[
            'name' => 'required|string|min:3|max:255',
            'order' => 'required',
            'status' => 'required',
         ]);
        
        $slug = strtolower($request->name);
        $slug = str_replace(" ","-",$slug);

        try{
            $menu = new Menus;
            $menu->name         = $request->name;
            $menu->slug         = $slug;
            $menu->parent_id    = $request->type;
            $menu->is_order     = $request->order;
            $menu->status       = $request->status;
            $menu->save();

            return redirect('menu')->with('status',"Insert successfully");
        }
        catch(Exception $e){
            return redirect('/menu/add')->with('failed',"operation failed");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function all()
    {
        //
        DB::statement(DB::raw('set @rownum=0'));

        $data = Menus::select('id', DB::raw("CASE WHEN status = 1 THEN 'Aktif' ELSE 'Tidak Aktif' END AS status"), 'name', 'slug', DB::raw('@rownum  := @rownum  + 1 AS rownum'))->get();

        return Datatables::of($data)
            ->addColumn('action', function ($data) {
                $update = '<a href="/menu/edit/'. $data->id .'" class="btn btn-primary">Edit</a>';
                $update .= ' <a href="/menu/delete/'. $data->id .'" class="btn btn-danger">Delete</a>';
                return $update;
            })
            ->rawColumns(['action'])
            ->make(true);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data['url'] = '/menu/update/'.$id;
        $data['method'] = 'post';
        $data['menu_parent'] = Menus::whereNull('parent_id')->get();
        $data['menu'] = Menus::where('id', $id)->first();
        $data['act'] = 'update';

        return view('admin.forms.menuForm', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request,[
            'name' => 'required|string|min:3|max:255',
            'order' => 'required',
            'status' => 'required',
         ]);
        
        $slug = strtolower($request->name);
        $slug = str_replace(" ","-",$slug);

        try{
            $menu = Menus::find($id);

            $menu->name     = $request->name;
            $menu->slug     = $slug;
            $menu->is_order = $request->order;
            $menu->status   = $request->status;
            $menu->save();

            return redirect('menu')->with('status',"Insert successfully");
        }
        catch(Exception $e){
            return redirect('/menu/add')->with('failed',"operation failed");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try{
            Menus::findOrFail($id)->delete();

            return redirect('menu')->with('status',"Insert successfully");
        }
        catch(Exception $e){
            return redirect('/menu/add')->with('failed',"operation failed");
        }
    }
}
