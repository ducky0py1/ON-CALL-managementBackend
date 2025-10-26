<?php

namespace App\Http\Controllers\Api;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    use AuthorizesRequests; 

    public function index()
    {
        return response()->json(User::paginate(15));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'role_type' => 'required|in:admin,secretaire',
            'service_id' => 'nullable|exists:services,id',
            'telephone' => 'nullable|string|max:20',
            'is_active' => 'sometimes|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $validatedData = $validator->validated();
         if (!empty($validatedData['password'])) {
        $validatedData['password'] = Hash::make($validatedData['password']);
    } else {
        unset($validatedData['password']);
    }
        $user = User::create($validatedData);

        return response()->json($user, 201);
    }

    public function show(User $user)
    {
        return response()->json($user);
    }

    public function update(Request $request, User $user)
    {
          $validator = Validator::make($request->all(), [
        'nom' => 'sometimes|required|string|max:100',
        'prenom' => 'sometimes|required|string|max:100',
        'email' => ['sometimes', 'required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        'password' => 'nullable|string|min:8',
        'role_type' => 'sometimes|required|in:admin,secretaire',
        'telephone' => 'nullable|string|max:20',
        'service_id' => 'nullable|exists:services,id', 
        'is_active' => 'sometimes|boolean',
    ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        
        $validatedData = $validator->validated();
        
       if (!empty($validatedData['password'])) {
        $validatedData['password'] = Hash::make($validatedData['password']);
    } else {
        unset($validatedData['password']);
    }
    //  Automatically set service_id to null if the user is admin
    if (isset($validatedData['role_type']) && $validatedData['role_type'] === 'admin') {
        $validatedData['service_id'] = null;
    }
        $user->update($validatedData);

        $user->load('service');
       return response()->json([
        'message' => 'Utilisateur mis à jour avec succès.',
        'data' => $user
    ]);
    }

    public function destroy(User $user)
    {
        // This is a special authorization check that does not require a policy
        if ($user->id === auth()->id()) {
            return response()->json(['message' => 'Vous ne pouvez pas supprimer votre propre compte.'], 403);
        }
        
        $user->delete();
        return response()->noContent();
    }

    public function listSecretaries()
    {
        $secretaries = User::where('role_type', 'secretaire')->get();
        return response()->json($secretaries);
    }
   

} 
try {
    $user = User::create($validatedData);
    return response()->json($user, 201);
} catch (\Exception $e) {
    return response()->json(['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()], 500);
}