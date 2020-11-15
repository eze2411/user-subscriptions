<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{

    public function search()
    {
        return view('user.search');
    }

    public function searchList(Request $request)
    {
        $searchStr = $request->all()['userInput'] . '%';
        $users = DB::table('users')
            ->where('name', 'like', $searchStr)
            ->get();

        return view('user.list', ['users' => $users]);
    }

    public function searchLogin($userEmail)
    {
        $user = User::whereEmail($userEmail)->get()->first();
        if (isset($user->logins[0])) {
            $location = $this->getLoginLocation($user);
        }
        return view('user.login', ['user' => $user, 'location' => isset($location )? $location : '#N/A']);
    }

    private function getLoginLocation($user)
    {
        $response = Http::get('https://apis.datos.gob.ar/georef/api/ubicacion', [
            'lat' => $user->logins[0]->latitude,
            'lon' => $user->logins[0]->longitude,
        ])->body();
        $location = json_decode($response)->ubicacion->provincia->nombre;
        return $location ? $location : "#N/A";
    }

}
