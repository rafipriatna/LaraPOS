<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Coupon;

use App\Http\Requests\CouponRequest;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Coupon List";

        $items = Coupon::all();

        return view('pages.coupon.index', [
            'title' => $title,
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Create New Coupon";

        return view('pages.coupon.create', [
            'title' => $title
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CouponRequest $request)
    {
        $data = $request->all();
        $data['coupon_code'] = strtoupper(str_replace(' ', '', $data['coupon_code']));

        Coupon::create($data);

        return redirect()->route('coupon.index')->with('success','Kupon berhasil dibuat!');
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
        $title = "Edit Coupon";

        $item = Coupon::findOrFail($id);

        return view('pages.coupon.edit', [
            'title' => $title,
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CouponRequest $request, $id)
    {
        $data = $request->all();

        Coupon::findOrFail($id)->update($data);

        return redirect()->route('coupon.index')->with('success','Kupon berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Coupon::findOrFail($id)->delete();

        return redirect()->route('coupon.index')->with('success','Kupon berhasil dihapus!');
    }
}
