    <div class="modal fade" id="importResults" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticEditSchedule" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticEditSchedule">Import Results</h5>
                    <button type="butoon" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="class-body p-5">
                    <form>
                      <div class="form-row">
                        <div class="form-group col">
                          <label for="year">Year</label>
                          <select id="year" name="year" class="form-control ">
                            <option selected>Year</option>
                            @foreach($years as $year)                          
                            <option value="{{ $year->year }}">{{ $year->year }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group col">
                          <label for="month">Month</label>
                          <select id="month" name="month" class="form-control ">
                            <option selected>Month</option>
                            <option value="january">January</option>
                            <option value="february">February</option>
                            <option value="march">March</option>
                            <option value="april">April</option>
                            <option value="may">May</option>
                            <option value="june">June</option>
                            <option value="july">July</option>
                            <option value="august">August</option>
                            <option value="september">September</option>
                            <option value="october">October</option>
                            <option value="november">November</option>
                            <option value="december">December</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col pt-5">
                          <label for="resultFile">Results File</label>
                          <div class="drop-zone">
                            <span class="drop-zone__prompt">Drop Results File here or click to upload</span>
                            <input type="file" name="resultFile" id="resultFile" class="drop-zone__input"/>
                          </div>
                        </div>
                      </div>
                      
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Discard</button>
                    <button onclick="import_result()" type="button" class="btn btn-outline-primary" onclick="">Import</button>
                </div>
            </div>
        </div>
    </div>