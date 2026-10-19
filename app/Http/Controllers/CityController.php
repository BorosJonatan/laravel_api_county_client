<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CityController extends Controller
{
    public function index()
    {
        $response = Http::api()->get('/cities');

        if ($response->failed()) {
            return redirect()->route('cities.index')
                ->with('error', 'Hiba történt.');
        }

        $cities = $this->getCities($response);

        return view('cities.index', [
            'cities' => $cities,
            'isLogged' => !empty(session('api_token'))
        ]);
    }

    public function show($id){
        $response = Http::api()->get("/cities/{$id}");

        if ($response->failed()) {
            return redirect()
                ->route('cities.index')
                ->with('error', 'A város nem található.');
        }

        $city = $this->getCity($response);
        
        return view('cities.show', [
            'city' => $city,
        ]);
    }

    public function edit($id)
    {
        $response = Http::api()
            ->withToken(session('api_token'))
            ->get("/cities/{$id}");

        if ($response->failed()) {
            return redirect()
                ->route('cities.index')
                ->with('error', 'A város nem található.');
        }

        $city = $this->getCity($response);

        $countiesResponse = Http::api()->get('/counties');

        if ($countiesResponse->failed()) {
            return redirect()
                ->route('cities.index')
                ->with('error', 'Nem sikerült lekérni a megyéket.');
        }

        $counties = $this->getCounties($countiesResponse);

        return view('cities.edit', [
            'city' => $city,
            'counties' => $counties,
        ]);
    }

    public function create()
    {
        $response = Http::api()
            ->withToken(session('api_token'))
            ->get('/counties');
        if ($response->failed()) {
            return redirect()
                ->route('cities.index')
                ->with('error', 'Nem sikerült a szervert elérni!');
        }
        $counties = $this->getCounties($response);

        return view('cities.create', compact('counties'));
    }

    public function store(Request $request)
    {
        $response = Http::api()
            ->withToken(session('api_token'))
            ->post('/cities', $request->all());

        if ($response->failed()) {
            return back()->with('error', 'Nem sikerült létrehozni a várost.');
        }

        return redirect()
            ->route('cities.index')
            ->with('success', 'Város sikeresen létrehozva!');
    }

    public function update(Request $request, $id)
    {
        $response = Http::api()
            ->withToken(session('api_token'))   
            ->put("/cities/$id", $request->all());

        if ($response->failed()) {
            return back()->with('error', 'Nem sikerült módosítani.');
        }

        return redirect()
            ->route('cities.index')
            ->with('success', 'Város sikeresen frissítve!');
    }

    public function destroy($id)
    {
        $response = Http::api()
            ->withToken(session('api_token'))
            ->delete("/cities/$id");

        if ($response->failed()) {
            return back()->with('error', 'Nem sikerült törölni.');
        }

        return redirect()
            ->route('cities.index')
            ->with('success', 'Város sikeresen törölve!');
    }

    private function getCity($response)
    {
        $body = json_decode($response->body(), false);
        return $body->city ?? null;
    }

    private function getCities($response)
    {
        $body = json_decode($response->body(), false);
        return $body->cities ?? [];
    }

    private function getCounties($response)
    {
        $body = json_decode($response->body(), false);
        return $body->counties ?? [];
    }
}
