<script>
    var committeeData = <?php echo json_encode($committeeList) ?>;
    var invitationData = <?php echo json_encode($invitationData) ?>;
    var trackedInfo = <?php echo json_encode($trackedInfo) ?>;
    var allCapstones = <?php echo json_encode($allCapstones) ?>;
    var facultyID = <?php echo json_encode($facID) ?>;
    var ajaxURLStart = "<?php echo base_url() ?>";
</script>

<div class="clearfix view-wrapper">
    <div class="alert alert-success alert-dismissible faculty-accept-invite-toast">
      <strong>Invitation Successful!</strong>
    </div>
    <div class="alert alert-success alert-dismissible faculty-decline-invite-toast">
      <strong>Declined Invitation!</strong>
    </div>
    <div class="alert alert-success alert-dismissible faculty-remove-from-committee-toast">
      <strong>Left Committee!</strong>
    </div>
    <div class="alert alert-success alert-dismissible faculty-remove-from-tracker-toast">
      <strong>Successfully Untracked Capstone!</strong>
    </div>
    <div class="alert alert-success alert-dismissible faculty-add-to-tracker-toast">
      <strong>Successfully Tracked Capstone!</strong>
    </div>
    <div class="col-sm-12">
        <div class="col-sm-12 no-padding">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <div class="view-header-wrapper clearfix">
                    <div class="view-header">
                        <h2>Hello, <span id="faculty-name-header"><?php echo $userData[0]["first_name"] . " " . $userData[0]["last_name"] ?></span></h2>
                    </div>
                </div>
            </div>
            <div class="col-sm-2"></div>
        </div>
        <div class="col-sm-12 no-padding">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <div class="project-title-wrapper clearfix">
                    <div class="project-title">
                        <h2 id="project-title-header">No Project Selected</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-2"></div>
        <div class="col-sm-12 section-spacer">
            <div class="col-sm-12">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    <label>Project Username: </label><input type="text" name="project-username-input">
                    <button onclick="faculty.getCapstone(this.parentElement.getElementsByTagName('input')[0].value); return false;" value="Search">Search</button>
                </div>
                <div class="col-sm-2"></div>
            </div>
            <div class="col-sm-2"></div>
            <div class="col-sm-4">
                <div class="invitations-wrapper section-border clearfix">
                    <div class="col-sm-12">
                        <div class="col-sm-12">
                            <div class="invitations-header">
                                <h2>Invitations</h2>
                            </div>
                        </div>
                        <div class="col-sm-12 no-padding">
                            <div class="invitations-body clearfix">
                                <div class="col-sm-12 no-padding">
                                    <div class="invitation-field clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="project-status-wrapper section-border clearfix">
                    <div class="col-sm-12">
                        <div class="project-status-wrapper">
                            <div class="col-sm-12">
                                <div class="col-sm-6 no-padding">
                                    <div class="project-status-header">
                                        <h2>Capstone Status</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 ">
                                <div class="project-status">
                                    <h2 id="cap-status">N/A</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 ">
                            <div class="col-sm-6 no-padding">
                                <div class="project-status">
                                    <button class="cap-status-grade-btn" type="button" name="cap-status-grade">Enter Grade</button>
                                </div>
                            </div>
                            <div class="col-sm-6 no-padding">
                                <div class="project-status" id="faculty-capstone-grade">
                                    <h4>Grade: <span id="cap-status-grade">N/A</span></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-2"></div>
        </div>
        <div class="col-sm-12 section-spacer">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <div class="faculty-committee-list-wrapper section-border clearfix">
                    <div class="col-sm-12">
                        <h2>Committee List</h2>
                    </div>
                    <div class="committee-list-field clearfix"></div>
                </div>
            </div>
            <div class="col-sm-2"></div>
        </div>
        <div class="col-sm-12 section-spacer">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <div class="faculty-tracking-list-wrapper section-border clearfix">
                    <div class="col-sm-12 no-padding">
                        <div class="col-sm-12 no-padding">
                            <div class="faculty-tracking-list-header">
                                <div class="col-sm-8">
                                    <h2>Tracking List</h2>
                                </div>
                                <div class="col-sm-4">
                                    <div class="tracking-add-btn-wrapper">
                                        <button type="button" name="faculty-add-tracker-btn">Add</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="tracking-list-body clearfix">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-2"></div>
        </div>
    </div>
    <div class="logout-btn-wrapper">
        <div class="logout-btn" onclick="window.location.assign('<?php echo base_url(); ?>login/logout/');">
            <h1>LOGOUT</h1>
        </div>
    </div>
</div>


<!--============================================================ MODALS BEGIN HERE-->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Faculty Members</h4>
      </div>
      <div class="modal-body clearfix">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<div id="grade-modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Enter a Grade</h4>
      </div>
      <div class="modal-body clearfix">
          <div class="grade-modal-error-div"></div>
          <input class="grade-modal-input-box" type="text" name="faculty-input-grade" pattern="^\d{5}(\d{3})?$">
          <button class="grade-modal-submit-button" type="button" name="button">Submit</button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!--================================================================MODALS END HERE-->
<script src="<?php echo base_url() . "assets/js/faculty.js"?>"></script>
