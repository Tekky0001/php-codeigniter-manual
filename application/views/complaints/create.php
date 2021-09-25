<h2><?=$title;?></h2>
<?php echo validation_errors();?>
<?php echo form_open_multipart('complaints/create/'.$posts[0]['id']);?>
  <div class="form-group">
    <label class="form-label"><?php echo $posts[0]['title'];?></label>
  </div>
  <div class="form-group">
    <label class="form-label">Body</label>
    <textarea id="editor1" class="form-control" name="description" placeholder="Add Body"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>