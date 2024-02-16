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

    public function getClientById($id) {

        $data = new stdClass();
        $data->client = User::leftJoin('quotas', 'quotas.client_id', '=', 'users.id')
                                ->select('users.*', 'quotas.quota')
                                ->where('users.id', $id)->first();

        if ($data->client == null) {
            return response()->json(['status' => false, 'message' => 'Data not found']);
        }

        return response()->json(['status' => true, 'message' => 'Get data success', 'data' => $data]);
    }

    public function updateClient(Request $req) {
        try {

            $validator = Validator::make($req->all(), [
                'name' => 'required',
                'email' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors()->first(), 400);
            }

            $client_id = $req->client_id;
            $email = $req->email;
            $name = $req->name;
            $isEmail = $req->isEmail;

            if ($isEmail == "true") {
                $validate = User::where('email', $email)->first();
                if ($validate != null) {
                    return response()->json("This email is already registered", 400);
                }
            }

            $updated = User::where('id', $client_id)
                ->update([
                    'name' => $name,
                    'email' => $email,
                ]);
                quota::where('client_id', $client_id)
                    ->update([
                        'quota' => $req->qty
                    ]);

            return response()->json($updated);
        } catch (\Throwable $th) {
            return response()->json($th);
        }
    }

    public function campaignIndex() {

        $data = new stdClass();
        $data->campaigns = Campaign::leftJoin('users', 'users.id', '=', 'campaigns.client_id')
                                    ->select('campaigns.*', 'users.name as client_name')
                                    ->where('users.role', 'client')
                                    ->get();

        return view('admin.campaign.index', compact('data'));

    }
}
