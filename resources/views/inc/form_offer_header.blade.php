 <div class="card">
    <div class="card-header">Crear una oferta</div>

    <div class="card-body">

        <form action="{{route('offers.create.header')}}"  method="POST" >
            @csrf

             <!--DESCRIPTION -->
            <div class="form-group">
                <label for="description">Descripción</label>
                <input type="text" name="description" class="form-control" id="description" placeholder="Escriba una description"  value="{{ old('description') }}">

                @error('description')
                    <span class="invalid-feedback" role="alert" style="display:block">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!--FECHA-->
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="dateFrom">Fecha Desde</label>

                    <input type="date" class="form-control" id="dateFrom" placeholder="Escriba la fecha" name="dateFrom" min="{{ Date('Y-m-d') }}" value="{{ old('dateFrom') }}">

                    @error('dateFrom')
                        <span class="invalid-feedback" role="alert" style="display:block">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="dateTo">Fecha Hasta</label>

                    <input type="date" class="form-control" id="dateTo" placeholder="Escriba la fecha" name="dateTo" min="{{ Date('Y-m-d') }}" value="{{ old('dateTo') }}">

                    @error('dateTo')
                        <span class="invalid-feedback" role="alert" style="display:block">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <!--SITES-->
            <div class="form-group">
                <label for="sites">Tienda/s</label>
                <select class="js-placeholder-multiple js-states form-control" multiple="multiple" id="sites" name="sites[]">
                    <optgroup label="Seleccionar todo">
                        @foreach($sites as $site)
                            <option value="{{$site->id}}" data-badge="">
                                {{$site->description}}
                            </option>
                        @endforeach
                    </optgroup>
                </select>

                @error('sites')
                    <span class="invalid-feedback" role="alert" style="display:block">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group row mb-0">
                <div class="center-btn">
                    <button type="submit" class="btn btn-custom">
                        Crear Oferta
                    </button>
                </div>

            </div>

        </form>
    </div>
    
</div>