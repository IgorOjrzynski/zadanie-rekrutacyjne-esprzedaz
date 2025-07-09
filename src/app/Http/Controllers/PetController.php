<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Contracts\PetApiInterface;
use App\DTOs\PetDto;

class PetController extends Controller
{
    private PetApiInterface $petApi;

    public function __construct(PetApiInterface $petApi)
    {
        $this->petApi = $petApi;
    }

    public function index()
    {
        try {
            $pets = $this->petApi->findByStatus(['available']);
            return view('pets.index', ['pets' => $pets]);
        } catch (\Exception $e) {
            return back()->withError('Nie można pobrać zwierzaków: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'status'      => ['nullable', 'string'],
            'photo_urls'  => ['array'],
            'photo_urls.*'=> ['string'],
        ]);

        $dto = new PetDto(null, $validated['name'], $validated['status'] ?? null, $validated['photo_urls'] ?? []);

        $this->petApi->addPet($dto);

        return response()->json(['success' => true, 'id' => $dto->id]);
    }

    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'status'      => ['nullable', 'string'],
            'photo_urls'  => ['array'],
            'photo_urls.*'=> ['string'],
        ]);

        $dto = new PetDto($id, $validated['name'], $validated['status'] ?? null, $validated['photo_urls'] ?? []);

        $this->petApi->updatePet($dto);

        return response()->json(['success' => true]);
    }

    public function destroy(int $id)
    {
        $this->petApi->deletePet($id);

        return response()->json(['success' => true]);
    }
}
