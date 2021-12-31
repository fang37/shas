<!-- Modal -->
<div class="modal fade" id="attendance-modal" tabindex="-1" aria-labelledby="attendance-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="attendance-modalLabel">
                    <span id="name"></span> (<span id="number-id"></span>)
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row">
                <div class="col d-flex justify-content-start">
                    <img id="image" src="" alt="" width="280px">
                </div>
                <div class="col d-flex justify-content-start">
                    <div class="col">
                        <div class="mb-2 d-flex align-items-start">
                            <p class="d-inline mb-0">Suhu : &nbsp;</p> <span id="temp"></span>
                        </div>
                        <div class="row mb-2 d-flex align-items-">
                            <p class="mb-0">Waktu Masuk :</p>
                            <span class="align-text-top" id="time-start"></span>
                        </div>
                        <div class="row mb-2 d-flex align-items-start">
                            <p class="mb-0">Waktu Keluar :</p>
                            <span id="time-end"></span>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
            </div>
        </div>
    </div>
</div>