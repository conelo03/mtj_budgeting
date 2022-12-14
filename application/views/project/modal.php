<!-- MODAL BUDGET -->
<div class="modal fade" id="modalBudgetAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Budget</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="saveBudgetData">
        <div class="modal-body">
          <span class="text-danger msgError" style="display: none"></span>
          <!-- <div class="form-group">
            <label class="form-label">Select Project Quotation</label>
            <select name="projectQuotationId" class="form-control" id="selectProjectQuotation" data-live-search="true" required>

            </select>
          </div> -->
          <div class="form-group">
            <label class="form-label">Budget Name</label>
            <input name="budgetName" id="budgetName" class="form-control" type="text" placeholder="Budget Name">
          </div>

          <div class="form-group">
            <label class="form-label">Budget value</label>
            <input name="budget" id="budget" class="form-control" type="text" onkeyup="rupiah(this)">
          </div>

          <div class="form-group">
            <label class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" type="text" placeholder="Description"></textarea>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalBudgetEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Budget</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="updateBudgetData">
        <div class="modal-body">
          <span class="text-danger msgError" style="display: none"></span>
          <!-- <div class="form-group">
            <label class="form-label">Select Project Quotation</label>
            <select name="projectQuotationId" class="form-control" id="selectProjectQuotationEdit" data-live-search="true" required>

            </select>
          </div> -->
          
          <div class="form-group">
            <label class="form-label">Order No</label>
            <input name="orderNo" id="orderNoEditBudget" class="form-control" type="text" placeholder="Order No" disabled>
          </div>

          <div class="form-group">
            <label class="form-label">Budget Name</label>
            <input name="budgetName" id="budgetNameEdit" class="form-control" type="text" placeholder="Budget Name">
          </div>

          <div class="form-group">
            <label class="form-label">Budget Value</label>
            <input name="budget" id="budgetEdit" class="form-control" type="text" onkeyup="rupiah(this)">
          </div>

          <div class="form-group">
            <label class="form-label">Description</label>
            <textarea name="description" id="descriptionEditBudget" class="form-control" type="text" placeholder="Description"></textarea>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalBudgetDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Budget</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="deleteBudgetData">
        <div class="modal-body">
          <input type="hidden" name="budgetId" id="budgetIdDelete" value="">
          <p>Are you sure want to delete this data?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalBudgetApprove" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Approve Budget</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="approveBudgetData">
        <div class="modal-body">
          <input type="hidden" name="budgetId" id="budgetIdApprove" value="">
          <p>Are you sure want to Approve this data?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Approve</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- MODAL PROPOSED COST -->
<div class="modal fade" id="modalProposedCostAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Proposed Cost</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="saveProposedCostData">
        <div class="modal-body">
          <span class="text-danger msgError" style="display: none"></span>
          <div class="form-group">
            <label class="form-label">Proposed Cost Name</label>
            <input name="proposedCostName" id="proposedCostName" class="form-control" type="text" placeholder="Proposed Cost Name">
          </div>

          <div class="form-group">
            <label class="form-label">Proposed Value</label>
            <input name="proposedValue" id="proposedValue" class="form-control" type="text" onkeyup="rupiah(this)">
          </div>

          <div class="form-group">
            <label class="form-label">Description</label>
            <textarea name="detailDescription" id="detailDescription" class="form-control" type="text" placeholder="Description"></textarea>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalProposedCostEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Proposed Cost</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="updateProposedCostData">
        <div class="modal-body">
          <span class="text-danger msgError" style="display: none"></span>
          <div class="form-group">
            <label class="form-label">Proposed Cost Name</label>
            <input name="proposedCostName" id="proposedCostNameEdit" class="form-control" type="text" placeholder="Proposed Cost Name">
          </div>

          <div class="form-group">
            <label class="form-label">Proposed Value</label>
            <input name="proposedValue" id="proposedValueEdit" class="form-control" type="text" onkeyup="rupiah(this)">
          </div>

          <div class="form-group">
            <label class="form-label">Description</label>
            <textarea name="detailDescription" id="detailDescriptionEditPC" class="form-control" type="text" placeholder="Description"></textarea>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalProposedCostDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Proposed Cost</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="deleteProposedCostData">
        <div class="modal-body">
          <input type="hidden" name="proposedCostId" id="proposedCostIdDelete" value="">
          <p>Are you sure want to delete this data?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalProposedCostApprove" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Approve Proposed Cost</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="approveProposedCostData">
        <div class="modal-body">
          <span class="text-danger msgError" style="display: none"></span>

          <div class="form-group">
            <label class="form-label">Proposed Value</label>
            <input name="" id="proposedValueApprove" class="form-control" type="text" onkeyup="rupiah(this)" disabled>
          </div>

          <div class="form-group">
            <label class="form-label">Approve Description</label>
            <textarea name="approvedDescription" id="approvedDescriptionApprove" class="form-control" type="text" placeholder="Description"></textarea>
          </div>

          <div class="form-group">
            <label class="form-label">Approve Value</label>
            <input name="approvedValue" id="approvedValueApprove" class="form-control"  type="text" onkeyup="rupiah(this)">
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalProposedCostReject" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reject Proposed Cost</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="rejectProposedCostData">
        <div class="modal-body">
          <span class="text-danger msgError" style="display: none"></span>

          <div class="form-group">
            <label class="form-label">Reject Description</label>
            <textarea name="rejectedDescription" id="rejectedDescriptionReject" class="form-control" type="text" placeholder="Description"></textarea>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- MODAL DISTRIBUTION COST -->
<div class="modal fade" id="modalDistributionCostAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Distribution Cost</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="saveDistributionCostData">
        <div class="modal-body">
          <span class="text-danger msgError" style="display: none"></span>

          <div class="form-group">
            <label class="form-label">Select Proposed Cost</label>
            <select name="proposedCostId" class="form-control" id="selectProposedCostForDC" data-live-search="true" required>

            </select>
          </div>

          <div class="form-group">
            <label class="form-label">Remaining Value</label>
            <input id="remainingValue" class="form-control" type="text" onkeyup="rupiah(this)" disabled>
          </div>

          <div class="form-group">
            <label class="form-label">Select Holder</label>
            <select name="holder" class="form-control" id="selectUser" data-live-search="true" required>

            </select>
          </div>

          <div class="form-group">
            <label class="form-label">Value</label>
            <input name="value" id="value" class="form-control" type="text" onkeyup="rupiah(this)">
            <span class="text-danger msgErrorValue" style="display: none"></span>
          </div>

          <div class="form-group">
            <label class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" type="text" placeholder="Description"></textarea>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalDistributionCostEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Distribution Cost</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="updateDistributionCostData">
        <div class="modal-body">
          <span class="text-danger msgError" style="display: none"></span>

          <div class="form-group">
            <label class="form-label">Select Proposed Cost</label>
            <select name="proposedCostId" class="form-control" id="selectProposedCostForDCEdit" data-live-search="true" required>

            </select>
          </div>

          <div class="form-group">
            <label class="form-label">Remaining Value</label>
            <input id="remainingValueEdit" class="form-control" type="text" onkeyup="rupiah(this)" disabled>
          </div>

          <div class="form-group">
            <label class="form-label">Select Holder</label>
            <select name="holder" class="form-control" id="selectUserEdit" data-live-search="true" required>

            </select>
          </div>

          <div class="form-group">
            <label class="form-label">Value</label>
            <input name="value" id="valueEdit" class="form-control" type="text" onkeyup="rupiah(this)">
          </div>

          <div class="form-group">
            <label class="form-label">Description</label>
            <textarea name="description" id="descriptionDCEdit" class="form-control" type="text" placeholder="Description"></textarea>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalDistributionCostDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Distribution Cost</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="deleteDistributionCostData">
        <div class="modal-body">
          <input type="hidden" name="distributionCostId" id="distributionCostIdDelete" value="">
          <p>Are you sure want to delete this data?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- MODAL REPORT COST -->
<div class="modal fade" id="modalReportCostAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Report Cost</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="saveReportCostData" enctype="multipart/form-data">
        <div class="modal-body">
          <span class="text-danger msgError" style="display: none"></span>

          <div class="form-group">
            <label class="form-label">Select Distribution Cost</label>
            <select name="distributionCostId" class="form-control" id="selectDistributionCost" data-live-search="true" required>

            </select>
          </div>

          <div class="form-group">
            <label class="form-label">Remaining Cost Value</label>
            <input name="" id="remainingCostValue" class="form-control" disabled>
          </div>

          <div class="form-group">
            <label class="form-label">Report Cost Value</label>
            <input name="reportCostValue" id="reportCostValue" class="form-control" type="text" onkeyup="rupiah(this)">
            <span class="text-danger msgErrorValue" style="display: none"></span>
          </div>

          <div class="form-group">
            <label class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" type="text" placeholder="Description"></textarea>
          </div>

          <div class="form-group">
            <label class="form-label">Upload File</label>
            <input name="fileName" id="fileName" class="form-control" type="file" required>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalReportCostEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Report Cost</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="updateReportCostData">
        <div class="modal-body">
          <span class="text-danger msgError" style="display: none"></span>

          <div class="form-group">
            <label class="form-label">Select Distribution Cost</label>
            <select name="distributionCostId" class="form-control" id="selectDistributionCostEdit" data-live-search="true" required>

            </select>
          </div>

          <div class="form-group">
            <label class="form-label">Remaining Cost Value</label>
            <input name="" id="remainingCostValueEdit" class="form-control" disabled>
          </div>

          <div class="form-group">
            <label class="form-label">Report Cost Value</label>
            <input name="reportCostValue" id="reportCostValueEdit" class="form-control" type="text" onkeyup="rupiah(this)">
            <span class="text-danger msgErrorValue" style="display: none"></span>
          </div>

          <div class="form-group">
            <label class="form-label">Description</label>
            <textarea name="description" id="descriptionReportCostEdit" class="form-control" type="text" placeholder="Description"></textarea>
          </div>

          <div class="form-group">
            <label class="form-label">Upload File</label>
            <input name="fileNameOld" id="fileNameEdit" class="form-control" type="hidden" required>
            <input name="fileName" id="" class="form-control" type="file">
            <span class="text-danger">*) leave blank if you don't want to edit</span>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalReportCostDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Report Cost</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="deleteReportCostData">
        <div class="modal-body">
          <input type="hidden" name="reportCostId" id="reportCostIdDelete" value="">
          <p>Are you sure want to delete this data?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalReportCostDetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">File Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img class="img" id="reportCostFileName" style="width: 100%"/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- MODAL REPORT BUDGET -->
<div class="modal fade" id="modalReportBudgetSelectBudget" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Select Budget</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="updateReportBudgetData">
        <div class="modal-body">
          <span class="text-danger msgError" style="display: none"></span>

          <div class="form-group">
            <label class="form-label">Select Budget</label>
            <select name="budgetId" class="form-control" id="selectBudget" data-live-search="true" required>

            </select>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalReportBudgetCancel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cancel Report Budget</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="cancelReportBudgetData">
        <div class="modal-body">
          <input type="hidden" name="reportCostId" id="reportCostIdCancel" value="">
          <p>Are you sure want to cancel this data?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- MODAL NOTES -->
<div class="modal fade" id="modalNotesAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Notes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="saveNotesData">
        <div class="modal-body">
          <span class="text-danger msgError" style="display: none"></span>

          <div class="form-group">
            <label class="d-block">Notes Type</label>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="notesType" value="Khusus" id="notesType" >
              <label class="form-check-label" for="exampleRadios3">
                Khusus
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="notesType" value="Umum" id="notesType">
              <label class="form-check-label" for="exampleRadios4">
                Umum
              </label>
            </div>
          </div>

          <div class="form-group">
            <label class="form-label">Notes</label>
            <textarea name="notes" id="notes" class="form-control" type="text" placeholder="Notes"></textarea>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalNotesEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Notes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="updateNotesData">
        <div class="modal-body">
          <span class="text-danger msgError" style="display: none"></span>
          <div class="form-group">
            <label class="d-block">Notes Type</label>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="notesType" value="Khusus" id="notesTypeEdit" >
              <label class="form-check-label" for="exampleRadios3">
                Khusus
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="notesType" value="Umum" id="notesTypeEdit">
              <label class="form-check-label" for="exampleRadios4">
                Umum
              </label>
            </div>
          </div>

          <div class="form-group">
            <label class="form-label">Notes</label>
            <textarea name="notes" id="notesEdit" class="form-control" type="text" placeholder="Notes"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalNotesDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Notes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="deleteNotesData">
        <div class="modal-body">
          <input type="hidden" name="notesId" id="notesIdDelete" value="">
          <p>Are you sure want to delete this data?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>