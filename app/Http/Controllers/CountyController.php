<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CountyController extends Controller
{
    public function index(Request $request)
    {
        $needle = $request->get('needle');
        $url = $needle ? "/counties?needle=" . urlencode($needle) : "/counties";

        $response = Http::api()->get($url);

        if ($response->failed()) {
            return redirect()
                ->route('counties.index')
                ->with('error', 'Hiba történt az adatok lekérdezése során.');
        }

        $counties = $this->getCounties($response);

        return view('counties.index', [
            'counties' => $counties,
        ]);
    }

    public function show($id)
    {
        $response = Http::api()->get("/counties/$id");

        if ($response->failed()) {
            return redirect()
                ->route('counties.index')
                ->with('error', 'A megye nem található.');
        }

        $county = $this->getCounty($response);

        return view('counties.show', [
            'county' => $county,
        ]);
    }

    public function create()
    {
        return view('counties.create');
    }

    public function store(Request $request)
    {
        $response = Http::api()->post('/counties', $request->all());

        if ($response->failed()) {
            return back()->with('error', 'Nem sikerült létrehozni a megyét.');
        }

        return redirect()
            ->route('counties.index')
            ->with('success', 'Megye sikeresen létrehozva!');
    }

    public function update(Request $request, $id)
    {
        $response = Http::api()
            ->put("/counties/$id", $request->all());

        if ($response->failed()) {
            return back()->with('error', 'Nem sikerült módosítani.');
        }

        return redirect()
            ->route('counties.index')
            ->with('success', 'Megye sikeresen frissítve!');
    }

    public function destroy($id)
    {
        $response = Http::api()
            ->delete("/counties/$id");

        if ($response->failed()) {
            return back()->with('error', 'Nem sikerült törölni.');
        }

        return redirect()
            ->route('counties.index')
            ->with('success', 'Megye sikeresen törölve!');
    }



    private function getCounties($response)
    {
        $body = json_decode($response->body(), false);
        return $body->counties ?? [];
    }

    private function getCounty($response)
    {
        $body = json_decode($response->body(), false);
        return $body->county ?? null;
    }

}
