<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Receiver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use stdClass;
use App\Imports\PhoneNumber;
use Maatwebsite\Excel\Facades\Excel;

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

    public function campaignIndex() {
        $campaigns = Campaign::get();
        return view('client.campaign.index', compact("campaigns"));
    }

     public function campaignStore(Request $req) {

        $validator = Validator::make($req->all(), [
            'name' => 'required',
            'content' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('client.campaign.index')->with('error', 'Invalid required fields');
        }
        
        $campaign = new Campaign();
        $campaign->client_id = Auth::user()->id;
        $campaign->name = $req->name;
        $campaign->content = $req->content;
        $campaign->status = "prepare";
        $campaign->save();

        $import = new PhoneNumber();
        Excel::import($import, request()->file('file'));
        $data = Excel::toArray(new stdClass(), request()->file('file'));
        for ($x = 1; $x <= $import->getCounting(); $x++) {
            $receiver = new Receiver();
            $receiver->campaign_id = $campaign->id;
            $receiver->phone = $data[0][$x][0]; 
            $receiver->save();
        }
        
        return redirect()->route('client.campaign.index')->with('success', 'Success add campaign');
    }
}
