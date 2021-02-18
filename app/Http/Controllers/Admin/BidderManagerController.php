<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBidderManagerRequest;
use App\Http\Requests\StoreBidderManagerRequest;
use App\Http\Requests\UpdateBidderManagerRequest;
use App\Models\BidderManager;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BidderManagerController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('bidder_manager_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // dd(User::whereHas("roles", function($q){ $q->where("title", "Bidder"); })->get());
        if ($request->ajax()) {
            $query = User::whereHas("roles", function($q){ $q->where("title", "Bidder"); })/*->query()*/->select(sprintf('%s.*', (new User)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'bidder_manager_show';
                $editGate      = 'bidder_manager_edit';
                $deleteGate    = 'bidder_manager_delete';
                $crudRoutePart = 'bidder-managers';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('supplier_name', function ($row) {
                return $row->supplier_name ? $row->supplier_name : "";
            });
            $table->editColumn('company_reg_number', function ($row) {
                return $row->company_reg_number ? $row->company_reg_number : "";
            });
            $table->editColumn('company_contact_person', function ($row) {
                return $row->company_contact_person ? $row->company_contact_person : "";
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : "";
            });
            $table->editColumn('mobile', function ($row) {
                return $row->mobile ? $row->mobile : "";
            });
            $table->editColumn('address', function ($row) {
                return $row->address ? $row->address : "";
            });
            $table->editColumn('approved', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->approved ? 'checked' : null) . '>';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? User::STATUS_SELECT[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'approved']);

            return $table->make(true);
        }

        return view('admin.bidderManagers.index');
    }

    public function create()
    {
        abort_if(Gate::denies('bidder_manager_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bidderManagers.create');
    }

    public function store(StoreBidderManagerRequest $request)
    {
        $request->request->add(['roles' => [2]]);
        $request->request->add(['password' => bcrypt('password')]);
        $bidderManager = User::create($request->all());
        $bidderManager->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.bidder-managers.index');
    }

    public function edit(User $bidderManager)
    {
        abort_if(Gate::denies('bidder_manager_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bidderManagers.edit', compact('bidderManager'));
    }

    public function update(UpdateBidderManagerRequest $request, User $bidderManager)
    {
        $bidderManager->update($request->all());

        return redirect()->route('admin.bidder-managers.index');
    }

    public function show(User $bidderManager)
    {
        abort_if(Gate::denies('bidder_manager_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bidderManagers.show', compact('bidderManager'));
    }

    public function destroy(User $bidderManager)
    {
        abort_if(Gate::denies('bidder_manager_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bidderManager->delete();

        return back();
    }

    public function massDestroy(MassDestroyBidderManagerRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
