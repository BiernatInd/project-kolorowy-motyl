<?php

namespace App\Http\Controllers\PobieranieZdjec;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log; // Dodaj import Log
use App\Models\User;

class PobieranieZdjecController extends Controller
{
    public function pobierzZdjeciaUzytkownika($userId)
    {
        // Znajdź użytkownika na podstawie $userId, na przykład w bazie danych
        $user = User::find($userId);
    
        if (!$user) {
            Log::error('Użytkownik o ID ' . $userId . ' nie istnieje.');
            return response()->json(['error' => 'Użytkownik nie istnieje'], 404);
        }
    
        // Lokalizacja zdjęć użytkownika
        $userName = $user->name; // Załóżmy, że nazwa użytkownika jest przechowywana w polu "name"
        $photoDirectory = public_path('photos' . DIRECTORY_SEPARATOR . $userName);
    
        // Dodaj log, aby sprawdzić lokalizację zdjęć
        Log::info('Ścieżka do zdjęć użytkownika ' . $userName . ': ' . $photoDirectory);
    
        // Sprawdź, czy katalog istnieje
        if (File::isDirectory($photoDirectory)) {
            // Pobierz listę zdjęć
            $photos = File::files($photoDirectory);
    
            // Utwórz tablicę z URL do zdjęć
            $photoUrls = [];
            foreach ($photos as $photo) {
                $photoUrls[] = asset('photos/' . $userName . '/' . $photo->getFilename());
            }
    
            // Dodaj log, aby sprawdzić ścieżki URL
            Log::info('Ścieżki URL zdjęć użytkownika ' . $userName . ': ' . implode(', ', $photoUrls));
    
            return response()->json($photoUrls);
        }
    
        // Dodaj log, aby sprawdzić, że katalog nie istnieje
        Log::error('Katalog zdjęć użytkownika ' . $userName . ' nie istnieje: ' . $photoDirectory);
    
        return response()->json(['error' => 'Brak zdjęć dla użytkownika ' . $userName], 404);
    }


    public function pobierzZipZdjeciaUzytkownika($userId)
{
    // Znajdź użytkownika na podstawie $userId, na przykład w bazie danych
    $user = User::find($userId);

    if (!$user) {
        Log::error('Użytkownik o ID ' . $userId . ' nie istnieje.');
        return response()->json(['error' => 'Użytkownik nie istnieje'], 404);
    }

    // Lokalizacja zdjęć użytkownika
    $userName = $user->name; // Załóżmy, że nazwa użytkownika jest przechowywana w polu "name"
    $photoDirectory = public_path('photos' . DIRECTORY_SEPARATOR . $userName);

    // Sprawdź, czy katalog istnieje
    if (File::isDirectory($photoDirectory)) {
        // Utwórz nowy obiekt ZIP
        $zip = new \ZipArchive();
        $zipFileName = $userName . '_photos.zip';
        $zipFilePath = public_path($zipFileName);

        if ($zip->open($zipFilePath, \ZipArchive::CREATE) === true) {
            // Pobierz listę zdjęć
            $photos = File::files($photoDirectory);

            foreach ($photos as $photo) {
                // Dodaj zdjęcie do archiwum ZIP
                $zip->addFile($photo->getRealPath(), $photo->getFilename());
            }

            $zip->close();

            return response()->download($zipFilePath, $zipFileName)->deleteFileAfterSend(true);
        } else {
            Log::error('Błąd podczas tworzenia archiwum ZIP.');
            return response()->json(['error' => 'Błąd podczas tworzenia archiwum ZIP'], 500);
        }
    }

    // Dodaj log, aby sprawdzić, że katalog nie istnieje
    Log::error('Katalog zdjęć użytkownika ' . $userName . ' nie istnieje: ' . $photoDirectory);

    return response()->json(['error' => 'Brak zdjęć dla użytkownika ' . $userName], 404);
}

    
}
