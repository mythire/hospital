<div> 
  
    <div class="row m-0 p-0">
      <div class="col-lg-8 m-0 p-0">  
        <div class="input-group ">
          <select class="form-control " wire:model.defer="status">
            <option value="" >Select Status</option>            
            <option value="Cancelled">Cancel Appointment</option>
            <option>Incomplete</option>
            <option>Pending</option>
          </select>
          <button class="btn btn-primary text-white" type="button" wire:click.prevent="updateStatus">Update Status</button>
        </div>
      </div>
    </div>
  
</div>