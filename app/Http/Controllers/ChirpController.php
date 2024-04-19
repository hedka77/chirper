<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChirpsRequest;
use App\Models\Chirp;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\DB;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        //return Inertia::render('Chirps/Index', [ 'chirps' => Chirp::with('user:id,name')->latest()->get(), ]);
        $chirps = Chirp::with('user:id,name')->latest()->paginate(15)->through(function($item) {
            return [ 'id'         => $item->id,
                     'user_id'    => $item->user_id,
                     'name'       => $item->user->name,
                     'message'    => $item->message,
                     'created_at' => $item->created_at,
                     'updated_at' => $item->updated_at,

            ];
        });

        return Inertia::render('Chirps/Index', ['chirps' => $chirps,]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreChirpsRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $request->user()->chirps()->create($validated);

        return redirect(route('chirps.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Chirp $chirp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chirp $chirp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    //public function update(Request $request, Chirp $chirp)
    public function update(StoreChirpsRequest $request, Chirp $chirp): RedirectResponse
    {
        Gate::authorize('update', $chirp);

        $validated = $request->validated();

        $chirp->update($validated);

        return redirect(route('chirps.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp): RedirectResponse
    {
        Gate::authorize('delete', $chirp);

        $chirp->delete();

        return redirect(route('chirps.index'));
    }
}
