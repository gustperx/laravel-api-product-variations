<?php

namespace App\Http\Controllers\Api;

use App\Models\Variation;
use App\Http\Controllers\Controller;
use App\Http\Resources\VariationResource;
use App\Http\Requests\Variations\StoreVariationRequest;
use App\Http\Requests\Variations\UpdateVariationRequest;

class VariationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return VariationResource::collection(Variation::paginate());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Variations\StoreVariationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVariationRequest $request)
    {
        $variation = Variation::create($request->only('product_id', 'reference', 'description', 'price'));
        return new VariationResource($variation);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Variation  $variation
     * @return \Illuminate\Http\Response
     */
    public function show(Variation $variation)
    {
        return new VariationResource($variation);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Variations\UpdateVariationRequest  $request
     * @param  \App\Models\Variation  $variation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVariationRequest $request, Variation $variation)
    {
        $variation->update($request->only('product_id', 'reference', 'description', 'price'));
        return new VariationResource($variation);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Variation  $variation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Variation $variation)
    {
        $variation->delete();
        return new VariationResource($variation);
    }
}
