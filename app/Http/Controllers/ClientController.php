<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use stdClass;

class ClientController extends Controller
{
    public function index() {

        $client_id = Auth::user()->id;
        $data = new stdClass();
        $data->campaignReady = Campaign::where('client_id', $client_id)
                                        ->where('status', 'ready')
                                        ->count();
        $data->campaignPrepare = Campaign::where('client_id', $client_id)
                                        ->where('status', 'prepare')
                                        ->count();

        return view('client.index', compact('data'));
    }
}
