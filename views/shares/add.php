<div class="container mt-4">
<div class="card">
  <h5 class="card-header">Share something</h5>
  <div class="card-body">
      <form action="" method="POST">
          <div class="form-group">
              <label for="">Share Title</label>
              <input type="text" name="title" id="" class="form-control">
          </div>
          <div class="form-group">
              <label for="">Body</label>
              <textarea name="body" id=""  class="form-control"></textarea>
          </div>
          <div class="form-group">
              <label for="">Link</label>
              <input type="text" name="link" id="" class="form-control">
          </div>
          <input type="submit" value="Submit" name="submit" class="btn btn-primary">
        <a href="<?php echo ROOT_PATH; ?>shares" class="btn btn-danger">Cancel</a>

      </form>
  </div>
</div>
</div>