@section('title', __('Services') )



<div>
    <form wire:submit.prevent="submit" enctype="multipart/form-data">

        <div>
            @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
            @endif
        </div>

        {{-- <div class="form-group">
            <label for="exampleInputName">Title:</label>
            <input type="text" class="form-control" id="exampleInputName" placeholder="Enter title" wire:model="title">
            @error('title') <span class="text-danger">{{ $message }}</span> @enderror
</div> --}}
<div class="" style="margin-left: 200px">
    <label for="exampleInputFile">File:</label>
    <input type="file" class="w-full h-20" id="exampleInputFile" wire:model="file">
    @error('name') <span class="text-danger">{{ $message }}</span> @enderror

    <button type="submit" class="bg-black text-white " style="padding: 10px;">
        Save</button>
</div>


</form>

@if(App\Http\Livewire\AdsServicesLivewire::view() == null)


    <h1>Services</h1>


@else
    @foreach(App\Http\Livewire\AdsServicesLivewire::view() as $link)
<!-- <h1>http://127.0.0.1:8000/storage/files/{{$link}}</h1> -->

<div style="margin:20px; display:flex;">

    <img src=https://client.spotd2d.com/storage/files/{{$link}} alt="Image" width="150" />
    <button style="margin-left:20px; color: red;" onclick="function_delete('{{ $link }}')"><a href="/progress/{{$link}}">DELETE</a></button>

</div>

@endforeach

@endif




<script>
    function function_delete(data) {
        console.log("-->", data);
        // document.location = "App\Http\Livewire\AdsServicesLivewire::delete(data)";
    }
</script>


<!-- <img src={{$img}}></img> -->
<!-- <img src="{{url('/images/myimage.jpg')}}" alt="Image"/> -->

</div>
