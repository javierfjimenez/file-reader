<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    // Muestra el formulario de subida
    public function showForm()
    {
        return view('upload');
    }

    // Procesa los archivos en la carpeta especificada
    public function processFiles(Request $request)
    {
        // Validar el término de búsqueda
        $request->validate([
            'search' => 'required|string|max:255',
        ]);

        // Obtener el término de búsqueda
        $searchTerm = $request->input('search');

        // Ruta de la carpeta que contiene los archivos
        $directoryPath = '/Users/javierferreira/Documents/Sites/freelance/personal/storage/app/public/files';

        // Obtener todos los archivos en el directorio
        $files = glob($directoryPath . '/*.{pdf,jpg,png}', GLOB_BRACE);
        
        $matchingFiles = []; // Array para almacenar los archivos que coinciden

        foreach ($files as $file) {
            // Procesar el archivo para extraer el texto
            $pythonScriptPath = base_path('script.py');
            $output = shell_exec("python3 " . escapeshellarg($pythonScriptPath) . " " . escapeshellarg($file));

            // Verificar si hay algún error en la ejecución
            if ($output === null) {
                continue; // Salta este archivo si hay un error
            }

            // Verificar si el término de búsqueda está presente en la salida
            if (stripos($output, needle: $searchTerm) !== false) {
                // Agregar el nombre del archivo al array solo si se encontró el término
                $matchingFiles[] = basename($file);
            }
        }

        // Retornar los resultados a la vista
        return view('result', ['matchingFiles' => $matchingFiles, 'searchTerm' => $searchTerm]);
    }
}