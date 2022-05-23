<?php

namespace App\Http\Controllers;

use App\Medicine;
use App\Category;
use Illuminate\Http\Request;
use DB;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // raw query
        // $result = DB::select(DB::raw('SELECT * FROM medicines'));

        // query builder
        // $result = DB::table('medicines')->get();

        // eloquent model
        $result = Medicine::all();
        $categories = Category::all();
        // dd($result);

        // return view('medicine.index', compact('result'));

        return view('medicine.index', compact('result', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('medicine.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Medicine();
        $data->generic_name = $request->get('generic_name');
        $data->form = $request->get('form');
        $data->restriction_formula = $request->get('restriction_formula');
        $data->price = $request->get('price');
        $data->description = $request->get('description');
        $data->faskes1 = $request->get('faskes1') == 'on' ? 1 : 0;
        $data->faskes2 = $request->get('faskes2') == 'on' ? 1 : 0;
        $data->faskes3 = $request->get('faskes3') == 'on' ? 1 : 0;
        $data->category_id = $request->get('category_id');
        $data->save();

        return redirect('medicines')
            ->with('status','data baru berhasil tersimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function show(Medicine $medicine)
    {
        // dd($medicine);
        $data = $medicine;
        return view('medicine.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function edit(Medicine $medicine)
    {
        $data = $medicine;
        $categories = Category::all();
        return view('medicine.edit', compact('data', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Medicine $medicine)
    {
        $medicine->generic_name = $request->get('generic_name');
        $medicine->form = $request->get('form');
        $medicine->restriction_formula = $request->get('restriction_formula');
        $medicine->price = $request->get('price');
        $medicine->description = $request->get('description');
        $medicine->faskes1 = $request->get('faskes1') == 'on' ? 1 : 0;
        $medicine->faskes2 = $request->get('faskes2') == 'on' ? 1 : 0;
        $medicine->faskes3 = $request->get('faskes3') == 'on' ? 1 : 0;
        $medicine->category_id = $request->get('category_id');
        $medicine->save();
        
        return redirect()->route('medicines.index')->with('status', 'Medicines data is changed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medicine $medicine)
    {
        try {
            $medicine->delete();

            return redirect()->route('medicines.index')->with('status', 'Data Medicine berhasil dihapus');
        } catch(\PDOException $e) {
            $msg = "Data Gagal dihapus. Pastikan data child sudah hilang atau tidak berhubungan";

            return redirect()->route('medicines.index')->with('error', $msg);
        }
    }

    public function getEditForm(Request $request)
    {
        $id = $request->get('id');
        $data = Medicine::find($id);
        $categories = Category::all();

        return response()->json(array(
            'status'=>'ok',
            'msg'=>view('medicine.getEditForm', compact('data', 'categories'))->render()
        ), 200);
    }

    public function getEditForm2(Request $request)
    {
        $id = $request->get('id');
        $data = Medicine::find($id);
        $categories = Category::all();
        
        return response()->json(array(
            'status'=>'ok',
            'msg'=>view('medicine.getEditForm2', compact('data', 'categories'))->render()
        ), 200);
    }

    public function deleteData(Request $request)
    {
        try {
            $id = $request->get('id');
            $Medicine = Medicine::find($id);
            $Medicine->delete();

            return response()->json(array(
                'status'=>'ok',
                'msg'=>'Berhasil menghapus data'
            ), 200);
        } catch (\PDOException $e)
        {
            return response()->json(array(
                'status'=>'ok',
                'msg'=>'Medicine is not deleted. It may be used in another table'
            ), 500);
        }
    }

    public function saveData(Request $request)
    {
        $id = $request->get('id');
        $Medicine = Medicine::find($id);
        $Medicine->generic_name = $request->get('generic_name');
        $Medicine->form = $request->get('form');
        $Medicine->restriction_formula = $request->get('restriction_formula');
        $Medicine->price = $request->get('price');
        $Medicine->description = $request->get('description');
        $Medicine->faskes1 = $request->get('faskes1');
        $Medicine->faskes2 = $request->get('faskes2');
        $Medicine->faskes3 = $request->get('faskes3');
        $Medicine->category_id = $request->get('category_id');
        $Medicine->save();

        return response()->json(array(
            'status'=>'ok',
            'msg'=>'Medicine data updated'
        ), 200);
    }

    public function coba1()
    {
        // squery builder filter
        $result = DB::table('medicines')
            ->where('price', '>', 20000)
            ->get();

        $result = DB::table('medicines')
            ->where('generic_name', 'like', '%fen')
            ->get();

        // group by
        $result = DB::table('medicines')
            ->select('generic_name')
            ->groupBy('generic_name')
            ->get();

        // agregate
        $result = DB::table('medicines')->count();

        $result = DB::table('medicines')->max('price');

        // filter + agregate
        $result = DB::table('medicines')
            ->where('generic_name', 'like', '%fen')    
            ->avg('price');

        // join + sort
        $result = DB::table('medicines')
            ->join('categories', 'medicines.category_id', '=', 'categories.id')
            ->orderBy('price', 'desc')
            ->get();

        // Eloquen
        $result = Medicine::where('price', '>', 20000)
            ->get();

        $result = Medicine::find(3);

        dd($result);
    }

    public function coba2()
    {
        // query 1 table
        // (2)
        $result = DB::table('medicines')
            ->select('generic_name', 'restriction_formula', 'price')
            ->get(); // Query builder
        $result = Medicine::select('generic_name', 'restriction_formula', 'price')->get(); // Eloquent

        // query inner join 2 tables
        // (1)
        $result = DB::table('medicines')
            ->join('categories', 'medicines.category_id', '=', 'categories.id')
            ->select(['generic_name', 'restriction_formula', 'categories.name'])
            ->get(); // Query builder
        $result = Medicine::select('generic_name', 'restriction_formula', 'category_id')
            ->with(['category' => function($query) {
                $query->select('id', 'name');
            }])->get(); // Eloquent

        // there is an aggregation of sum, count with 2 tables
        // (1)
        $result = DB::table('medicines')
            ->join('categories', 'medicines.category_id', '=', 'categories.id')
            ->select('categories.name')->distinct()->count('categories.name'); // Query builder
        $result = Medicine::select('category_id')->with(['category' => function($query){
                $query->select('id', 'name');
            }])->distinct()->count('category_id'); // Eloquent

        // (2)
        $result = DB::table('medicines')
            ->rightJoin('categories', 'medicines.category_id', '=', 'categories.id')
            ->select('categories.name')
            ->whereNull('medicines.generic_name')
            ->get(); // Query Builder
        $result = Medicine::rightJoin('categories', 'medicines.category_id', '=', 'categories.id')
            ->select('categories.name')
            ->whereNull('medicines.generic_name')
            ->get(); // Eloquent

        // (3)
        $result = DB::table('medicines')
            ->rightJoin('categories', 'medicines.category_id', '=', 'categories.id')
            ->selectRaw('categories.name, if(avg(medicines.price) is null, 0, avg(medicines.price)) as "average price"')
            ->groupBy('categories.name')
            ->get(); // Query Builder
        $result = Medicine::rightJoin('categories', 'medicines.category_id', '=', 'categories.id')
            ->select('categories.name', DB::Raw('if(avg(medicines.price) is null, 0, avg(medicines.price)) as "average price"'))
            ->groupBy('categories.name')
            ->get(); // Eloquent

        // (4)
        $result = DB::table('medicines')
            ->join('categories', 'medicines.category_id', '=', 'categories.id')
            ->select('categories.name')
            ->groupBy('categories.name')
            ->havingRaw('COUNT(categories.name) = 1')
            ->get(); // Query Builder
        $result = Medicine::select('category_id')
            ->with(['category' => function($query) {
                $query->select('id', 'name');
            }])->groupBy('category_id')
            ->havingRaw('COUNT(category_id) = 1')
            ->get(); // Eloquent

        // (5)
        $result = DB::table('medicines')
            ->select('generic_name')
            ->groupBy('generic_name')
            ->havingRaw('COUNT(generic_name) = 1')
            ->get(); // Query Builder
        $result = Medicine::select('generic_name')
            ->groupBy('generic_name')
            ->havingRaw('COUNT(generic_name) = 1')
            ->get(); // Eloquent

        // (6)
        $result = DB::table('medicines')
            ->join('categories', 'medicines.category_id', '=', 'categories.id')
            ->select('categories.name', 'generic_name')
            ->where('medicines.price', '=', function($query) {
                $query->selectRaw('MAX(med.price)')->from('medicines as med');
            })->get(); // Query Builder
        $result = Medicine::select('generic_name', 'category_id')
            ->with(['category' => function($query) {
                $query->select('id', 'name');
            }])
            ->where('price', '=', function($query) {
                $query->selectRaw('MAX(med.price)')->from('medicines as med');
            })->get(); // Eloquent

        dd($result);
    }

    public function highestprice()
    {
        $sub = DB::table('medicines as m')
            ->join('categories as c', 'm.category_id', 'c.id')
            ->select('c.id', DB::Raw('MIN(m.id) as med_id'))
            ->where('m.price', function($query) {
                $query->from('medicines as m1')
                    ->select('m1.price')
                    ->whereColumn('m1.category_id', 'c.id')
                    ->orderBy('m1.price', 'desc')
                    ->take(1);
            })
            ->groupBy('c.id');
        
        $result = DB::table('medicines as m')
            ->joinSub($sub, 'highest_price', function($join) {
                $join->on('m.id', '=', 'highest_price.med_id');
            })
            ->rightJoin('categories as c', 'highest_price.id', 'c.id')
            ->selectRaw('IFNULL(m.generic_name, "-") as generic_name, c.name as category_name, IFNULL(CAST(m.price as int), "-") as highest_price')
            ->get();

        return view('report.highest_price_per_category', compact('result'));
    }

    public function showInfo()
    {
        $result = Medicine::orderBy('price', 'desc')->first();

        return response()->json([
            'status'=>'oke',
            'msg'=>"<div class='alert alert-danger'>
                    Did you know? <br>
                    Harga obat termahal adalah ".$result->generic_name." ".$result->form." dengan harga ".$result->price.
                    "</div>"
        ], 200);        
    }
}
