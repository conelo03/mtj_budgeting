<div class="modal fade" id="modalQuotationAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="saveQuotationData">
        <div class="modal-body">
          <span class="text-danger msgError" style="display: none"></span>
          <div class="form-group">
            <label class="form-label">Select Quotation Header</label>
            <select name="quotationHeaderId" class="form-control" id="selectQuotationHeader" data-live-search="true" required>

            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Order No</label>
            <input name="orderNo" id="orderNo" class="form-control" type="text" placeholder="Order No">
          </div>

          <div class="form-group">
            <label class="form-label">Project Quotation Name</label>
            <input name="projectQuotationName" id="projectQuotationName" class="form-control" type="text" placeholder="Project Quotation Name">
          </div>

          <div class="form-group">
            <label class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" type="text" placeholder="Description"></textarea>
          </div>

          <div class="form-group">
            <label class="form-label">Value</label>
            <input name="quoteValue" id="quoteValue" class="form-control" type="number">
          </div>

          <div class="form-group">
            <label class="form-label">Cost</label>
            <input name="estCost" id="estCost" class="form-control" type="number">
          </div>

          <div class="form-group">
            <label class="form-label">Detail Description</label>
            <textarea name="detailDescription" id="detailDescription" class="form-control" type="text" placeholder="Detail Description"></textarea>
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

<div class="modal fade" id="modalQuotationEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="updateQuotationData">
        <div class="modal-body">
          <span class="text-danger msgError" style="display: none"></span>
          <div class="form-group">
            <label class="form-label">Select Quotation Header</label>
            <select name="quotationHeaderId" class="form-control" id="selectQuotationHeaderEdit" data-live-search="true" required>

            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Order No</label>
            <input name="orderNo" id="orderNoEdit" class="form-control" type="text" placeholder="Order No">
          </div>

          <div class="form-group">
            <label class="form-label">Project Quotation Name</label>
            <input name="projectQuotationName" id="projectQuotationNameEdit" class="form-control" type="text" placeholder="Project Quotation Name">
          </div>

          <div class="form-group">
            <label class="form-label">Description</label>
            <textarea name="description" id="descriptionEdit" class="form-control" type="text" placeholder="Description"></textarea>
          </div>

          <div class="form-group">
            <label class="form-label">Value</label>
            <input name="quoteValue" id="quoteValueEdit" class="form-control" type="number">
          </div>

          <div class="form-group">
            <label class="form-label">Cost</label>
            <input name="estCost" id="estCostEdit" class="form-control" type="number">
          </div>

          <div class="form-group">
            <label class="form-label">Detail Description</label>
            <textarea name="detailDescription" id="detailDescriptionEdit" class="form-control" type="text" placeholder="Detail Description"></textarea>
          </div>

          <div class="form-group">
            <label class="d-block">Final</label>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="isFinal" value="1" id="isFinalEdit" >
              <label class="form-check-label" for="exampleRadios3">
                Yes
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="isFinal" value="0" id="isFinalEdit">
              <label class="form-check-label" for="exampleRadios4">
                No
              </label>
            </div>
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

<div class="modal fade" id="modalQuotationDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="deleteQuotationData">
        <div class="modal-body">
          <input type="hidden" name="projectQuotationId" id="projectQuotationIdDelete" value="">
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

<!-- MODAL BUDGET -->
<div class="modal fade" id="modalBudgetAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="saveBudgetData">
        <div class="modal-body">
          <span class="text-danger msgError" style="display: none"></span>
          <div class="form-group">
            <label class="form-label">Select Project Quotation</label>
            <select name="projectQuotationId" class="form-control" id="selectProjectQuotation" data-live-search="true" required>

            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Order No</label>
            <input name="orderNo" id="orderNo" class="form-control" type="text" placeholder="Order No">
          </div>

          <div class="form-group">
            <label class="form-label">Budget</label>
            <input name="budget" id="budget" class="form-control" type="number">
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
        <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="updateBudgetData">
        <div class="modal-body">
          <span class="text-danger msgError" style="display: none"></span>
          <div class="form-group">
            <label class="form-label">Select Project Quotation</label>
            <select name="projectQuotationId" class="form-control" id="selectProjectQuotationEdit" data-live-search="true" required>

            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Order No</label>
            <input name="orderNo" id="orderNoEditBudget" class="form-control" type="text" placeholder="Order No">
          </div>

          <div class="form-group">
            <label class="form-label">Budget</label>
            <input name="budget" id="budgetEdit" class="form-control" type="number">
          </div>

          <div class="form-group">
            <label class="form-label">Description</label>
            <textarea name="description" id="descriptionEditBudget" class="form-control" type="text" placeholder="Description"></textarea>
          </div>

          <div class="form-group">
            <label class="d-block">Final</label>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="isFinal" value="1" id="isFinalEdit" >
              <label class="form-check-label" for="exampleRadios3">
                Yes
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="isFinal" value="0" id="isFinalEdit">
              <label class="form-check-label" for="exampleRadios4">
                No
              </label>
            </div>
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
        <h5 class="modal-title" id="exampleModalLabel">Delete Data</h5>
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

<!-- MODAL PROPOSED COST -->
<div class="modal fade" id="modalProposedCostAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Data</h5>
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
            <input name="proposedValue" id="proposedValue" class="form-control" type="number">
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
        <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
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
            <input name="proposedValue" id="proposedValueEdit" class="form-control" type="number">
          </div>

          <div class="form-group">
            <label class="form-label">Description</label>
            <textarea name="detailDescription" id="detailDescriptionEditPC" class="form-control" type="text" placeholder="Description"></textarea>
          </div>

          <div class="form-group">
            <label class="d-block">Final</label>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="isFinal" value="1" id="isFinalEdit" >
              <label class="form-check-label" for="exampleRadios3">
                Yes
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="isFinal" value="0" id="isFinalEdit">
              <label class="form-check-label" for="exampleRadios4">
                No
              </label>
            </div>
          </div>

          <div class="form-group">
            <label class="form-label">Distribution Date</label>
            <input name="distributionDate" id="distributionDateEdit" class="form-control" type="date">
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
        <h5 class="modal-title" id="exampleModalLabel">Delete Data</h5>
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

<!-- MODAL PROPOSED BUDGET -->
<div class="modal fade" id="modalProposedBudgetAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="saveProposedBudgetData">
        <div class="modal-body">
          <span class="text-danger msgError" style="display: none"></span>

          <div class="form-group">
            <label class="form-label">Select Proposed Cost</label>
            <select name="proposedCostId" class="form-control" id="selectProposedCost" data-live-search="true" required>

            </select>
          </div>

          <div class="form-group">
            <label class="form-label">Select Budget</label>
            <select name="budgetId" class="form-control" id="selectBudget" data-live-search="true" required>

            </select>
          </div>

          <div class="form-group">
            <label class="form-label">Proposed Budget Description</label>
            <textarea name="proposedBudgetDescription" id="proposedBudgetDescription" class="form-control" type="text" placeholder="Description"></textarea>
          </div>

          <div class="form-group">
            <label class="form-label">Proposed Budget Value</label>
            <input name="proposedBudgetValue" id="proposedBudgetValue" class="form-control" type="number">
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

<div class="modal fade" id="modalProposedBudgetEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="updateProposedBudgetData">
        <div class="modal-body">
          <span class="text-danger msgError" style="display: none"></span>

          <div class="form-group">
            <label class="form-label">Select Proposed Cost</label>
            <select name="proposedCostId" class="form-control" id="selectProposedCostEdit" data-live-search="true" required>

            </select>
          </div>

          <div class="form-group">
            <label class="form-label">Select Budget</label>
            <select name="budgetId" class="form-control" id="selectBudgetEdit" data-live-search="true" required>

            </select>
          </div>

          <div class="form-group">
            <label class="form-label">Proposed Budget Description</label>
            <textarea name="proposedBudgetDescription" id="proposedBudgetDescriptionEdit" class="form-control" type="text" placeholder="Description"></textarea>
          </div>

          <div class="form-group">
            <label class="form-label">Proposed Budget Value</label>
            <input name="proposedBudgetValue" id="proposedBudgetValueEdit" class="form-control" type="number">
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

<div class="modal fade" id="modalProposedBudgetDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="deleteProposedBudgetData">
        <div class="modal-body">
          <input type="hidden" name="proposedBudgetId" id="proposedBudgetIdDelete" value="">
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

<div class="modal fade" id="modalProposedBudgetApprove" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Approve Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="approveProposedBudgetData">
        <div class="modal-body">
          <span class="text-danger msgError" style="display: none"></span>

          <div class="form-group">
            <label class="form-label">Approve Description</label>
            <textarea name="approvedDescription" id="approvedDescriptionApprove" class="form-control" type="text" placeholder="Description"></textarea>
          </div>

          <div class="form-group">
            <label class="form-label">Approve Value</label>
            <input name="approvedValue" id="approvedValueApprove" class="form-control" type="number">
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

<div class="modal fade" id="modalProposedBudgetReject" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reject Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="rejectProposedBudgetData">
        <div class="modal-body">
          <span class="text-danger msgError" style="display: none"></span>

          <div class="form-group">
            <label class="form-label">Reject Description</label>
            <textarea name="rejectedDescription" id="rejectedDescriptionReject" class="form-control" type="text" placeholder="Description"></textarea>
          </div>

          <div class="form-group">
            <label class="d-block">Final</label>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="isFinal" value="1" id="isFinalReject" >
              <label class="form-check-label" for="exampleRadios3">
                Yes
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="isFinal" value="0" id="isFinalReject">
              <label class="form-check-label" for="exampleRadios4">
                No
              </label>
            </div>
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