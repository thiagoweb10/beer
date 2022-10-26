<?php

namespace App\Http\Controllers;

use App\Services\PunkapiService;
use App\Http\Requests\BeerRequest;
use App\Jobs\ExportJob;
use App\Jobs\SendExportEmailJob;
use App\Jobs\StoreExportDataJob;


class BeerController extends Controller
{
    public function index(BeerRequest $request, PunkapiService $service)
    {
        return $service->getBeers(...$request->validated());
    }

    public function export(BeerRequest $request, PunkapiService $service)
    {
        $filename = "cervejas-encontradas".now()->format('Y-m-d -H_i').".xlsx";

        ExportJob::withChain([
            (new SendExportEmailJob($filename))->delay(5),
            (new StoreExportDataJob(auth()->user(), $filename))->delay(10)
        ])->dispatch($request->validated(), $filename);

        return 'relatório criado.';
    }
}