
  
  <!-- Modal -->
  <div class="modal fade" id="upload" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" style="background-color: #525f7f ">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel" style="color: white">SUBIR ARCHIVOS</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <a class="nav-link active" id="home-tab" tabindex="0" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" tabindex="1" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
                </li>
              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="card-body" style="height: 223px;">
                        <div class="form-group">
                            <label style="color: white">{{ __('DESCRIPCION ') }}</label>
                          <input type="text" class="form-control  mb-3" name="descrs[]" aria-describedby="emailHelp" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="Descripcion">
                          <input type="text" name="" id="idempel" hidden>
                        <div class="custom-file col-sm-8">
                          <input type="file" id="actual-btn" max-file-size="1000000" name="archive" hidden/>
                          <label for="actual-btn" id="labid" style="color: white"><i class="fas fa-folder-open"></i></label>
                          <span id="file-chosen" style="color: white">SIN ARCHIVO...</span>
                        </div>
                      </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                  <div class="card-body" style="height: 223px;">
                <div class="form-row">
                    <div id="qrcode" style="margin-left: 50px"></div>
                    <div class="custom-file col-sm-8">
                      <input type="file" id="actual-btn" max-file-size="1000000" name="archive" hidden/>
                      <label for="actual-btn" id="labid" style="color: white"><i class="fas fa-folder-open"></i></label>
                      <span id="file-chosen" style="color: white">SIN ARCHIVO...</span>
                    </div>
                  </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
              </div>
              
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info" id="phone"><i class="fas fa-mobile-alt"></i></button>
          <button type="button" class="btn btn-success" id="back" hidden><i class="fas fa-arrow-left"></i></button>
        </div>
      </div>
    </div>
  </div>

  <style>
      #file-chosen{
          cursor: pointer;
      }
  </style>
