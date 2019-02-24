<?php

namespace App\Http\Controllers;
use App\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::all();
        return view('cities.list',compact('cities'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cities.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cities = new City();
        $cities->name = $request->input('name');
        $cities->save();
        Session::flash('success','Thêm mới tỉnh thành thành công');
        return redirect()->route('cities.index');
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
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cities = City::find($id);
        return view('cities.edit',compact('cities'));
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
        $cities = City::find($id);
        $cities->name =$request->input('name');
        $cities->save();
        Session::flash('success', 'Cập nhật thông tin tỉnh thành công');
        return redirect()->route('cities.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cities = City::find($id);
        $cities->customers()->delete();
        $cities->delete();
        Session::flash('success', 'Xóa tỉnh thành thành công');
        return redirect()->route('cities.index');
    }
}