<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\quota;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use stdClass;

class AdminController extends Controller
{
    public function index() {

        $data = new stdClass();
        $data->campaignReady = Campaign::where('status', 'ready')->count();
        $data->campaignPrepare = Campaign::where('status', 'prepare')->count();

        return view('admin.index', compact('data'));
    }

    public function clientIndex() {
        $data = new stdClass();
        $data->clients = User::leftJoin('quotas', 'quotas.client_id', '=', 'users.id')
                            ->select('users.*', 'quotas.quota')
                            ->where('role', 'client')->get();

        return view('admin.client.index', compact('data'));
    }

    public function clientStore(Request $req) {

        $validator = Validator::make($req->all(), [
            'email' => 'required',
            'name' => 'required',
            'qty' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.client.index')->with('error', 'Invalid required fields');
        }

        $client = new User();
        $client->name = $req->name;
        $client->email = $req->email;
        $client->password = Hash::make('user123');
        $client->role = 'client';
        $client->save();

        $quota = new quota();
        $quota->client_id = $client->id;
        $quota->quota = $req->qty;
        $quota->save();

        return redirect()->route('admin.client.index')->with('success', 'Success add client');
    }
}
