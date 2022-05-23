@extends('layouts.app1')

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('admin.coins.store') }}" method="post">
            @csrf
            <div class="container mt-4">
                <h1>Add new Coin</h1>
                <div class="row g-3">

                    {{-- INSERISCI NOME --}}
                    <div class="col-sm-12">
                        <label for="name" class="form-label">Coin Name</label>
                        <input type="text" class="form-control" placeholder="Coin Name" id="name" name="name"
                            value="{{ old('name') }}"
                            style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAAXNSR0IArs4c6QAAAfBJREFUWAntVk1OwkAUZkoDKza4Utm61iP0AqyIDXahN2BjwiHYGU+gizap4QDuegWN7lyCbMSlCQjU7yO0TOlAi6GwgJc0fT/fzPfmzet0crmD7HsFBAvQbrcrw+Gw5fu+AfOYvgylJ4TwCoVCs1ardYTruqfj8fgV5OUMSVVT93VdP9dAzpVvm5wJHZFbg2LQ2pEYOlZ/oiDvwNcsFoseY4PBwMCrhaeCJyKWZU37KOJcYdi27QdhcuuBIb073BvTNL8ln4NeeR6NRi/wxZKQcGurQs5oNhqLshzVTMBewW/LMU3TTNlO0ieTiStjYhUIyi6DAp0xbEdgTt+LE0aCKQw24U4llsCs4ZRJrYopB6RwqnpA1YQ5NGFZ1YQ41Z5S8IQQdP5laEBRJcD4Vj5DEsW2gE6s6g3d/YP/g+BDnT7GNi2qCjTwGd6riBzHaaCEd3Js01vwCPIbmWBRx1nwAN/1ov+/drgFWIlfKpVukyYihtgkXNp4mABK+1GtVr+SBhJDbBIubVw+Cd/TDgKO2DPiN3YUo6y/nDCNEIsqTKH1en2tcwA9FKEItyDi3aIh8Gl1sRrVnSDzNFDJT1bAy5xpOYGn5fP5JuL95ZjMIn1ya7j5dPGfv0A5eAnpZUY3n5jXcoec5J67D9q+VuAPM47D3XaSeL4AAAAASUVORK5CYII=&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%;">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- GENERA TUTTO --}}
                    {{-- GENERA SLUG --}}
                    <div class="col-12">
                        <label for="address" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="slug" placeholder="Slug" name="slug"
                            value="{{ old('slug') }}">
                        <div class="invalid-feedback">
                            Please generate a slug.
                        </div>
                        <input type="button" value="Genera info coin" id="btn-slugger">
                    </div>

                    <div class="col-12">
                        <label for="address" class="form-label">Image</label>
                        <input type="text" class="form-control" id="image" placeholder="Image" name="image"
                            value="{{ old('image') }}">
                        <div class="invalid-feedback">
                            Please generate a image.
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="address" class="form-label">Description</label>
                        <input name="description" id="description" value="{{ old('description') }}"
                            class="form-control">
                        <div class="invalid-feedback">
                            Please generate a description.
                        </div>
                    </div>


                    <div class="w-100 d-flex justify-content-center">
                        <button class="w-50 btn btn-primary btn-lg mx-auto" type="submit">Add Coin</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
