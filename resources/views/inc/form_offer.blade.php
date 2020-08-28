 <div class="card">
    <div class="card-header">Importar las ofertas</div>

    <div class="card-body">

        <form action="{{route('offers.import')}}" method="POST" enctype="multipart/form-data">
            @csrf

             <!--DESCRIPTION-->
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
                        Importar Excel
                    </button>
                </div>

            </div>

        </form>
    </div>
    
</div>