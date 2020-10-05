 <!-- Card -->
<div class="card main-cards">
    <div class="card-header">
        Seleccionar Diseño
        <i class="fa fa-plus-circle add-custom" data-toggle="modal" data-target="#add-design">
            
            <span data-toggle="tooltip" data-placement="top" title="Volver atras"></span>
        </i>
    </div>

    @error('inlineRadioOptions')
        <div class="alert alert-danger text-center mb-2 mt-1"> {{ $message }} </div>
    @enderror

    @if(Session::has('default'))
         <div class="alert alert-success text-center mb-2 mt-1 notification">
             {{Session::get('default')}}
         </div>
    @endif

    <div class="card-body">
        <form action="{{ route('selected.design') }}"  method="POST">
            @csrf

            @if(count($images) == 0)
                <div class="empty-poster-container">
                    <img src="{{asset('img/add-image.png')}}">
                </div>
                <p class="empty-poster-message mb-2">Aún no hay Diseños</p>
            @else
                @foreach($images as $image)
                    <div class="form-check form-check-inline mb-3">
                      @if($image->active)
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="{{'inlineRadio'.$image->id}}" value="{{$image->id}}" checked>

                        <label class="form-check-label img-box active-img" for="{{'inlineRadio'.$image->id}}">
                          <img src="{{ route('get.image', ['filename' => $image->image_path_name]) }}">
                        </label>
                      @else
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="{{'inlineRadio'.$image->id}}" value="{{$image->id}}">

                        <label class="form-check-label img-box" for="{{'inlineRadio'.$image->id}}">
                          <img src="{{ route('get.image', ['filename' => $image->image_path_name]) }}">
                        </label>
                      @endif

                      <a href="{{route('delete.image', ['id' => $image->id])}}">
                            <i class=" fa fa-times icon-delete"></i>
                      </a>
                    </div>
                @endforeach
                <div class="form-group row mb-0">
                    <div class="center-btn">
                        <button type="submit" class="btn btn-custom">
                            Usar
                        </button>
                    </div>

                </div>
            @endif
        </form>
    </div>
    
</div>