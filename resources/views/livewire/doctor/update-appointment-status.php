<div> 
  <form wire:submit.prevent="updateStatus()">
    <div class="row m-0 p-0">
      <div class="col-lg-8 m-0 p-0">  
        <div class="input-group ">
          <select class="form-control " wire:model.defer="status">
            <option value="" >Select Status</option>       
            <option value="Started">Start Appointment</option>
            <option value="Completed">Appointment Completed</option>
            <option value="Cancelled">Cancel Appointment</option>
            <option>Incomplete</option>
            <option>Pending</option>
          </select>
          <button class="btn btn-primary text-white" type="submit">Update Status</button>
        </div>
      </div>
    </div>
  </form>
</div>