
Chạy chương trình và quan sát kết quả.

Bước 9: Cập nhật action CustomerController/update()
/**
* Update the specified resource in storage.
*
* @param  int  $id
* @return Response
*/
public function update(Request $request, $id){
$customer = Customer::findOrFail($id);
$customer->name     = $request->input('name');
$customer->email    = $request->input('email');
$customer->dob      = $request->input('dob');
$customer->city_id  = $request->input('city_id');
$customer->save();

//dung session de dua ra thong bao
Session::flash('success', 'Cập nhật khách hàng thành công');

//cap nhat xong quay ve trang danh sach khach hang
return redirect()->route('customers.index');
}
Cập nhật trang danh sách khách hàng

Trang danh sách khách hàng hiển thị tỉnh thành của khách hàng

Chỉnh sửa view customers/list.blade.php

@extends('home')
@section('title', 'Danh sách khách hàng')
@section('content')
    <div class="col-12">
        <div class="row">
            <div class="col-12">
                <h1>Danh Sách Khách Hàng</h1>
            </div>
            <div class="col-12">
                @if (Session::has('success'))
                    <p class="text-success">
                        <i class="fa fa-check" aria-hidden="true"></i>
                        {{ Session::get('success') }}
                    </p>
                @endif
            </div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên khách hàng</th>
                    <th scope="col">Ngày Sinh</th>
                    <th scope="col">Email</th>
                    <th scope="col">Tỉnh thành</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if(count($customers) == 0)
                    <tr>
                        <td colspan="4">Không có dữ liệu</td>
                    </tr>
                @else
                    @foreach($customers as $key => $customer)
                        <tr>
                            <th scope="row">{{ ++$key }}</th>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->dob }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->city->name }}</td>
                            <td><a href="{{ route('customers.edit', $customer->id) }}">sửa</a></td>
                            <td><a href="{{ route('customers.destroy', $customer->id) }}" class="text-danger" onclick="return confirm('Bạn chắc chắn muốn xóa?')">xóa</a></td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
            <a class="btn btn-primary" href="{{ route('customers.create') }}">Thêm mới</a>
        </div>
    </div>
@endsection