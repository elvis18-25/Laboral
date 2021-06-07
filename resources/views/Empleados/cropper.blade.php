  <!-- Modal -->
  <div class="modal fade" id="crpimg" id="staticBackdrop" data-backdrop="static" data-keyboard="false"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="margin-top: -109px">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b>AJUSTAR FOTOS</b></h5>
          <button type="button" class="close" id="btnclose" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="img-container">
            <div class="row">
                <div class="col-md-8 " id="silverfox">
                    <img src="" id="sample_image" />
                </div>
                <div class="col-md-4">
                    <div class="preview"></div>
                </div>
            </div>
        </div>
        </div>
        <div class="modal-footer">
          {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
          <button type="button" class="btn btn-info redondo" id="crop"><i class="fas fa-save"></i></button>
        </div>
      </div>
    </div>
  </div>