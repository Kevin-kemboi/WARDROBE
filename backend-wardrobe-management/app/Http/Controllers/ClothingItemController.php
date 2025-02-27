<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClothingItem;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;


class ClothingItemController extends Controller
{
    /**
     * Display a listing of clothing items.
     */
    public function index()
    {
        $items = ClothingItem::all();
        return response()->json($items, 200);
    }

    /**
     * Store a newly created clothing item.
     */
    
    
    public function store(Request $request)
    {
        // Validate request data
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:top,bottom,shoes',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max size
        ]);
    
        // Define storage directory
        $storagePath = storage_path('app/public/clothing_images');
    
        // Ensure the directory exists
        if (!File::exists($storagePath)) {
            File::makeDirectory($storagePath, 0755, true, true);
        }
    
        // Handle image upload if provided
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('clothing_images', 'public');
        }
    
        // Get current timestamp
        $now = Carbon::now();
    
        // Create new clothing item with timestamps
        $clothingItem = ClothingItem::create([
            'name' => $request->name,
            'category' => $request->category,
            'image' => $imagePath,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    
        return response()->json([
            'message' => 'Clothing item added successfully!',
            'data' => $clothingItem
        ], 201);
    }
    
    /**
     * Update a clothing item.
     */
    public function update(Request $request, $id)
    {
        $item = ClothingItem::find($id);
        if (!$item) {
            return response()->json(['error' => 'Item not found'], 404);
        }

        // Validate input data
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'category' => 'sometimes|string|max:255',
            'color' => 'nullable|string|max:255',
            'size' => 'nullable|string|max:50',
            'brand' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        // Update item
        $item->update($request->all());

        return response()->json($item, 200);
    }

    /**
     * Remove a clothing item.
     */
    public function destroy($id)
    {
        $item = ClothingItem::find($id);
        if (!$item) {
            return response()->json(['error' => 'Item not found'], 404);
        }

        $item->delete();
        return response()->json(['message' => 'Item deleted successfully'], 200);
    }
}
