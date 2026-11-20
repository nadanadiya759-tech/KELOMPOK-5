<?php
namespace App\Http\Controllers;
use App\Models\Area;
use Illuminate\Http\Request;
class AreaController extends Controller {
    public function index() { return view('area.index',['areas'=>Area::orderByDesc('id_area')->get()]); }
    public function create() { return view('area.form',['area'=>new Area]); }
    public function store(Request $request) {
        Area::create($this->validated($request));
        return redirect()->route('area.index')->with('success','Area berhasil ditambahkan.');
    }
    public function edit(Area $area) { return view('area.form',compact('area')); }
    public function update(Request $request, Area $area) {
        $area->update($this->validated($request));
        return redirect()->route('area.index')->with('success','Area berhasil diperbarui.');
    }
    public function destroy(Area $area) {
        $area->delete();
        return redirect()->route('area.index')->with('success','Area berhasil dihapus.');
    }
    private function validated(Request $request): array {
        $data=$request->validate([
            'nama_area'=>'required|string|max:100',
            'nomor_lantai'=>'required|integer|min:0|max:999',
            'ada_stopkontak'=>'sometimes|boolean','ada_wifi'=>'sometimes|boolean',
            'ketersediaan_area'=>'required|in:tersedia,tidak tersedia',
        ]);
        $data['ada_stopkontak']=$request->boolean('ada_stopkontak');
        $data['ada_wifi']=$request->boolean('ada_wifi');
        return $data;
    }
}
