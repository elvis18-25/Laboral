<form action="{{url('sender')}}" method="post">
    @method("POST")
    @csrf
    <div class="col-sm-6">
        <input type="text" name="text" id="" class="form-control" placeholder="Enviar....">
    </div>
    <button type="submit" class="btn btn-info"><i class="fas fa-save">Enviar</i></button>
</form>