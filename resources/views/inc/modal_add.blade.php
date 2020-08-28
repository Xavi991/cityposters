 <!-- Modal -->
<div class="modal fade" id="add-design" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLabel">Agregar un Cartel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('images.import')}}" method="POST" enctype="multipart/form-data" id="image-form">
            @csrf
            <div class="form-group">
                <label for="image">Importar Cartel:</label>
                <input type="file" name="image" class="form-control-file" id="image">

                @error('image')
                    <span class="invalid-feedback" role="alert" style="display:block">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-custom" id="add-image-btn">Agregar</button>
      </div>
    </div>
  </div>
</div>