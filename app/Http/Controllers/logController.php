<?php

namespace App\Http\Controllers;

class logController extends Controller
{
    public function index()
    {
        $data = [];
        // Ambil isi log dari file
        $logContents = file(storage_path('logs/item_activity.log'));
        foreach($logContents as $index=>$lines){
            if (!empty($lines)) {
                $logEntry = json_decode($lines,true); // true untuk mengembalikan array asosiatif
                $data[$index] = $logEntry;
            }
        }
    
        return view('livewire.items.items-log', ['logs' =>($data)]);
    }
}
