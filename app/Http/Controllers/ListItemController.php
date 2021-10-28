<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListItem;
use Yajra\Datatables\Datatables;
use PDF;

class ListItemController extends Controller
{
    public function index()
    {
        return view('listitem.index');
    }

    public function json()
    {
        $list = ListItem::select(['id', 'name', 'price']);

        return Datatables::of($list)
            ->editColumn('price', function ($list) {
                return $list->price ? "Rp " . $list->price . ".00" : '';
            })
            ->make(true);
    }

    public function crup(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required|integer',
        ]);

        ListItem::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'name' => $request->name,
                'price' => $request->price
            ],
        );

        return response()->json(['success' => true]);
    }

    public function edit($id)
    {
        $list = ListItem::find($id);
        return response()->json([
            'isi' => $list
        ]);
    }

    public function destroy($id)
    {
        $list = ListItem::find($id);
        $list->delete();
        return response()->json(['success' => true]);
    }

    public function excel()
    {
        $list = ListItem::all();

        return view('listitem.excel', ['list' => $list]);
    }

    public function pdf()
    {
        $list = ListItem::all();

        $pdf = PDF::loadview('listitem.pdf', ['list' => $list]);
        return $pdf->download('List Item.pdf');
    }
}
