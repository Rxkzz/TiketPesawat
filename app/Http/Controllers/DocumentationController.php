<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Parsedown;

class DocumentationController extends Controller
{
    public function index()
    {
        $path = base_path('README.md');
        if (!File::exists($path)) {
            abort(404);
        }

        $contents = File::get($path);
        $parsedown = new Parsedown();
        $html = $parsedown->text($contents);

        return view('documentation.index', compact('html'));
    }
} 