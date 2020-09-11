 <div class="card">
    <div class="card-header">Importar oferta/s</div>

    <div class="card-body">

        <form action="{{route('offers.import')}}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!--OFFER-->
            <div class="form-group">
                <label for="offerHeader">Seleccionar Oferta</label>

                <select class="custom-select" id="offerHeader" name="offerHeader" value="{{old('offerHeader')}}">
                    @if( count($offerHeaders)>0 )
                        <option value="" selected disabled hidden>Seleccione una Oferta</option>
                    @else
                        <option value="" selected disabled hidden>Debe de crear una Oferta primero</option>
                    @endif
                 
                   @foreach($offerHeaders as $offerHeader)
                        <option value="{{$offerHeader->id}}" data-badge="">
                            {{$offerHeader->description}}
                        </option>
                    @endforeach
                </select>

                @error('offerHeader')
                    <span class="invalid-feedback" role="alert" style="display:block">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

             <!--FILE UPLOAD-->
            <div class="form-group">
                <label for="excel">Importar Excel:</label>
                <input type="file" name="file" class="form-control-file" id="excel">

                @error('file')
                    <span class="invalid-feedback" role="alert" style="display:block">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-5">
                    <button type="submit" class="btn btn-custom">
                        Subir Oferta
                    </button>
                </div>

            </div>

        </form>
    </div>
    
</div>