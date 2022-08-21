<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Label;
use App\Http\Requests\StoreLabelRequest;

class LabelController extends Controller
{
    public function store(StoreLabelRequest $request)
    {
        return Label::create($request->validated());
    }

    public function destroy(Label $label)
    {
        $label->delete();
        return response('',204);
    }
}
