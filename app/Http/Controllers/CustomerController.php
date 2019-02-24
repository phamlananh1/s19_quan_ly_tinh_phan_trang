<?php

namespace App\Http\Controllers;
use App\City;
use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::paginate(5);
        $cities = City::all();
        return view('customers.list', compact('customers', 'cities'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::all();
        return view('customers.create', compact('cities'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customers = New Customer();
        $customers->name = $request->input('name');
        $customers->email = $request->input('email');
        $customers->dob = $request->input('dob');
        $customers->city_id = $request->input('city_id');
        $customers->save();
        Session::flash('success', 'Thêm mới khách hàng thành công');
        return redirect()->route('customers.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customers = Customer::find($id);
        $cities = City::all();
        return view('customers.edit', compact('customers', 'cities'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $customers = Customer::findOrFail($id);
        $customers->name = $request->input('name');
        $customers->email = $request->input('email');
        $customers->dob = $request->input('dob');
        $customers->city_id = $request->input('city_id');
        $customers->save();
        Session::flash('success', 'Cập nhật thông tin khách hàng thành công');
        return redirect()->route('customers.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customers = Customer::findOrFail($id);
        $customers->delete();
        Session::flash('success', 'Xóa khách hàng thành công');
        return redirect()->route('customers.index');
    }
    public function filterByCity(Request $request)
    {
        $idCity = $request->input('city_id');
        //kiem tra city co ton tai khong
        $cityFilter = City::findOrFail($idCity);
        //lay ra tat ca customer cua cityFiler
        $customers = Customer::where('city_id', $cityFilter->id)->get();
        $totalCustomerFilter = count($customers);
        $cities = City::all();
        return view('customers.list', compact('customers', 'cities', 'totalCustomerFilter', 'cityFilter'));
    }
    public function search(Request $request)

    {

        $keyword = $request->input('keyword');

        if (!$keyword) {

            return redirect()->route('customers.index');

        }

        $customers = Customer::where('name', 'LIKE', '%' . $keyword . '%')

            ->paginate(5);


        $cities = City::all();

        return view('customers.list', compact('customers', 'cities'));


    }
}