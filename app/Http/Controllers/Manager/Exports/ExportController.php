<?php

namespace App\Http\Controllers\Manager\Exports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;

use Illuminate\Validation\ValidationException;

use App\Http\Controllers\Manager\PPP\PPPRequestFetchController;
use App\Http\Controllers\Manager\PO\PORequestFetchController;

use App\Exports\Requests\PPPRequestExport;
use App\Exports\Requests\PORequestExport;

use Excel;
use DB;
use Carbon\Carbon;

class ExportController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('web.pages.manager.export');
    }

    public function ppp(Request $request)
    {
        $controller = new PPPRequestFetchController;

        $request = $request->merge(['nopagination' => 1]);

        $data = [];
        $data = $controller->fetch($request);

        $message = 'Exporting data, please wait...';

        if (!$data) {
            throw ValidationException::withMessages([
                'items' => 'No request found.',
            ]);
        }

        return Excel::download(new PPPRequestExport($data->original['items']), 'ppp_requests-' . $request->start_date.'_to-'.$request->end_date . '.xlsx');
    }

    public function po(Request $request)
    {
        $controller = new PORequestFetchController;

        $request = $request->merge(['nopagination' => 1]);

        $data = [];
        $data = $controller->fetch($request);

        $message = 'Exporting data, please wait...';

        if (!$data) {
            throw ValidationException::withMessages([
                'items' => 'No request found.',
            ]);
        }


        if (!$request->ajax()) {
            $ids = Arr::pluck($data->original['items'], 'id');
            return Excel::download(new PORequestExport($data->original['items']), 'po_requests-' . $request->start_date.'_to-'.$request->end_date . '.xlsx');
        }
    }
}
