<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Label;
use App\Http\Requests\StoreLabelRequest;

class LabelController extends Controller
{
    public function index()
    {
        return auth()->user()->label;
    }
    public function store(StoreLabelRequest $request)
    {
        return auth()->user()->label()->create($request->validated());
    }

    public function destroy(Label $label)
    {
        $label->delete();
        return response('',204);
    }

    public function update(Label $label, StoreLabelRequest $request)
    {
        $label->update($request->validated());
        return response($label, 200);
    }
}
