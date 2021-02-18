<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTenderCategoryRequest;
use App\Http\Requests\StoreTenderCategoryRequest;
use App\Http\Requests\UpdateTenderCategoryRequest;
use App\Models\TenderCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TenderCategoryController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('tender_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tenderCategories = TenderCategory::all();

        return view('admin.tenderCategories.index', compact('tenderCategories'));
    }

    public function create()
    {
        abort_if(Gate::denies('tender_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $parentCategory = TenderCategory::where('parent_id',null)->get();
        // dd($parentCategory);

        return view('admin.tenderCategories.create',compact('parentCategory'));
    }

    public function store(StoreTenderCategoryRequest $request)
    {
        $tenderCategory = TenderCategory::create($request->all());

        return redirect()->route('admin.tender-categories.index');
    }

    public function edit(TenderCategory $tenderCategory)
    {
        abort_if(Gate::denies('tender_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
          $parentCategory = TenderCategory::where('parent_id',null)->get();
        return view('admin.tenderCategories.edit', compact('tenderCategory','parentCategory'));
    }

    public function update(UpdateTenderCategoryRequest $request, TenderCategory $tenderCategory)
    {
        $tenderCategory->update($request->all());

        return redirect()->route('admin.tender-categories.index');
    }

    public function show(TenderCategory $tenderCategory)
    {
        abort_if(Gate::denies('tender_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tenderCategories.show', compact('tenderCategory'));
    }

    public function destroy(TenderCategory $tenderCategory)
    {
        abort_if(Gate::denies('tender_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tenderCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyTenderCategoryRequest $request)
    {
        TenderCategory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
