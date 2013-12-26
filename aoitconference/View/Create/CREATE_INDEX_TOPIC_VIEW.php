<form id="create_topic_form" class="form" role="form" action="index.php" method="#METHOD#">
  <input type="hidden" id="m" name="m" value="create_topic" /> 
  <input type="hidden" id="topic_identity" name="topic_identity" value="" /> 
  <input type="hidden" id="method" name="method" value="POST" /> 
  <div class="form-group">
    <label for="name" class="control-label">Topic Name</label>
    <input type="text" class="form-control" id="topic_name" name="topic_name" placeholder="Constitution" value="" required />
  </div>
  <div class="form-group">
    <div class="btn-controls">
      <button type="submit" class="btn btn-block btn-primary btn-topic-submit">#ACTION# Topic</button>
    </div>
  </div>
</form>