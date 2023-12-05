<?php

namespace App\Http\Controllers\DodawanieZdjec;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\ListaZdjec;

class DodawanieZdjecController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('files')) {
            $userName = $request->input('userName');
            $files = $request->file('files');
            $uploadedFiles = [];

            Storage::disk('public')->makeDirectory($userName);

            foreach ($files as $file) {
                $originalFileName = $file->getClientOriginalName();
                $fileExtension = $file->getClientOriginalExtension();

                $existingFiles = Storage::disk('public')->files($userName);
                $fileNumber = count($existingFiles) + 1;

                $newFileName = $fileNumber . '.' . $fileExtension;

                $file->storeAs($userName, $newFileName, 'public');

                $uploadedFiles[] = [
                    'nazwa_uzytkownika' => $userName,
                    'nazwa_zdjecia' => $newFileName,
                    'sciezka_zdjecia' => "public/photos/$userName/$newFileName",
                ];
            }

            ListaZdjec::insert($uploadedFiles);

            return response()->json(['message' => 'Pliki zostały przesłane pomyślnie']);
        }

        return response()->json(['error' => 'Brak plików do przesłania'], 400);
    }

    public function checkUser(Request $request)
    {
        $userName = $request->query('userName');
        $userExists = User::where('name', $userName)->exists();
        return response()->json(['exists' => $userExists]);
    }
}
