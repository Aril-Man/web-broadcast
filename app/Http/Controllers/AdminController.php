<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;
use stdClass;

class AdminController extends Controller
{
    public function index() {

        $data = new stdClass();
        $data->campaignReady = Campaign::where('status', 'ready')->count();
        $data->campaignPrepare = Campaign::where('status', 'prepare')->count();

        return view('admin.index', compact('data'));
    }
}
