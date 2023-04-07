<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MaterialMetal;
use App\Models\Metal;
use App\Models\Material;

class MaterialMetalController extends Controller
{
	/**
	 * Page load then call first method.
	 * @author Hitesh Khandar
	 */
	public function __construct()
	{
		$this->moduleRouteText	= "admin.materialmetal";
		$this->moduleViewName	= "admin.materialmetal";
		$this->list_url			= route($this->moduleRouteText . ".index");
		$module					= "Material Metal";
		$this->module			= $module;
		$this->modelObj			= new MaterialMetal();
        $this->path = "uploads/";
	}
	/**
	 * Display a listing of the resource.
	 * @author Hitesh Khandar
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
            $metals = Metal::Active()->get();
            $material_metals =  $metals->whereIn('slug',['yellow-gold','white-gold','rose-gold']);
            $metals_without_material =  $metals->whereIn('slug',['silver','platinum']);
            $materials = Material::select('id', 'name')->Active()->get();

            $selected_metalmaterial_arr = MaterialMetal::query()->get()->toArray();
            $selected_metalmaterial = array();
            if (!empty($selected_metalmaterial_arr)) {
                foreach ($selected_metalmaterial_arr as $value) {
                    $selected_id = ($value['material_id']) ? $value['metal_id'].'-'.$value['material_id'] : $value['metal_id'];
                    $selected_metalmaterial[$selected_id] = $value['price'];
                }
            }

            $data = array(
                "metals_with_material" => $material_metals,
                "metals_without_material" => $metals_without_material,
                "materials" 		=> $materials,
                "selected_metalmaterial" => $selected_metalmaterial,
                "module" 			=> $this->module,
                "page_title" 		=> "List",
                "action_url" 		=> $this->moduleRouteText . ".store",
                "action_params"     => 0,
                "method" 			=> "POST",
            );
            return view($this->moduleViewName . '.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 * @author Hitesh Khandar
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{

	}
	/**
	 * Store a newly created resource in storage.
	 * @author Hitesh Khandar
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
        //dd($request->all());
          /*Metal Material*/
          MaterialMetal::query()->delete();
          if (!empty($request->metalmaterial_price)) {
            foreach ($request->metalmaterial_price as $key => $value) {
                $metalmaterial = explode('-',$key);
                $metal_id = $metalmaterial[0];
                $material_id = isset($metalmaterial[1]) ? $metalmaterial[1] : null;
                $metalmaterial_data = array('material_id' => $material_id , 'metal_id' =>  $metal_id, 'price' =>  $value);
                MaterialMetal::create($metalmaterial_data);
            }
        }
        return redirect()->route($this->moduleViewName . '.index')->with('success', __('messages.update_message', ['title' => 'Material Metal Price']));
	}

	/**
	 * Display the specified resource.
	 * @author Hitesh Khandar
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * @author Hitesh Khandar
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
	}

	/**
	 * Update the specified resource in storage.
	 * @author Hitesh Khandar
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{

	}

	/**
	 * Remove the specified resource from storage.
	 * @author Hitesh Khandar
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
	}

}
