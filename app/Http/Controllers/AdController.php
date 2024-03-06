<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAdRequest;
use App\Models\Ad;
use App\Services\AdService;
use App\Services\GetJsonDataFromUrl;
use App\Services\MergeDataAction;
use Illuminate\Http\Request;

class AdController extends Controller
{
    protected AdService $adService;

    public function __construct(AdService $adService)
    {
        $this->adService = $adService;
        $this->middleware('throttle:60,1');
    }

    public function index(Request $request)
    {
        $refresh = $request->input('refresh');

        if ($refresh) {
            return view('welcome', [
                'ads' => Ad::orderBy('impressions', 'ASC')->get()
            ]);
        }

        return view('welcome', [
            'ads' => Ad::where(function ($query) use ($request) {
                if ($search = $request->input('ad_id')) {
                    $query->where('ad_id', $search);
                }
            })
                ->orderBy('impressions', 'ASC')
                ->get()
        ]);
    }

    public function create(CreateAdRequest $request, GetJsonDataFromUrl $getByEndpointAction, MergeDataAction $mergeDataAction)
    {
        ['endpoint1' => $endpoint1, 'endpoint2' => $endpoint2] = $request->validated();

        try {
            $endpoint1Data = $getByEndpointAction->handle($endpoint1);
            $endpoint2Data = $getByEndpointAction->handle($endpoint2);

            Ad::truncate();
            $mergedData = $mergeDataAction->handle($endpoint1Data, $endpoint2Data['data']['list']);

            $this->adService->bulkCreate($mergedData);

            return redirect()->route('home.index');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors([
                    'endpoint1' => 'Invalid endpoint URL',
                    'endpoint2' => 'Invalid endpoint URL',
                ]);
        }
    }
}
