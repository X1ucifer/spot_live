<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\File;



class AdsServicesLivewire extends Component
{
    use WithFileUploads;

    public $file, $title;

    public $name = "akhil";

    public $img = "https://client.spotd2d.com/storage/files/";

    //   public $out = $img.$file;


    public function render()
    {
        return view('livewire.adsservices');
    }


    public function index($link)
    {
        $path = storage_path().'/app/public/files/'.$link;
    //    dd(File::delete(storage_path('app/public/files/6wq1OXHIuCZEBIHginNaTGYBJO6PPmzb9gRSPgKL')));
        // dd('app/public/files/' . $link);
        // dd($d);

        if(File::exists($path)){
            unlink($path);
        }

        return redirect('ads');

    }


    public function submit()
    {
        $validatedData = $this->validate([

            'file' => 'required',
        ]);

        $validatedData['file'] = $this->file->store('files', 'public');

        // File::create($validatedData);

        session()->flash('message', 'File successfully Uploaded.');
    }


    public function updatedFiles()
    {
        // dd($this->files);

        // $this->files->store("images/ads/",'public');
        // dd($imageName);

        // $this->files->store('images');
        // You can do whatever you want to do with $this->files here
    }

    public function view()
    {
        $path = storage_path('app/public/files');
        $files = \File::allFiles($path);


        foreach ($files as $key => $path) {
            $files = pathinfo($path);
            $allMedia[] = $files['basename'];
        }


        return $allMedia ?? null;
    }

    public function delete($path)
    {
        // $path = storage_path('app/public/files');
        // $files = \File::allFiles($path);
        \File::delete(storage_path('app/public/files' . $path));



        // foreach($files as $key => $path){
        //     $files = pathinfo($path);
        //     $allMedia[] = $files['basename'];
        //   }


        //   return $allMedia ?? null;
    }
}
