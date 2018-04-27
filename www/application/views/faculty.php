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
                    <div class="col-sm-12 no-padding">
                        <div class="project-owner-div">
                            <h2>Owner: <span id="project-owner-header"></span></h2>
                        </div>
                    </div>
                    <div class="col-sm-12 no-padding">
                        <div class="project-title">
                            <h2>Capstone Title: <span id="project-title-header"></span></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="col-sm-2"></div>
            <div class="col-sm-8 no-padding">
                <h4 id="search-btn-error-msg">Student not found</h4>
            </div>
            <div class="col-sm-2"></div>
            </div>
        </div>
        <div class="col-sm-2"></div>
        <div class="col-sm-12 section-spacer">
            <div class="col-sm-12">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                  <div class="username-box-wrapper">
                    <label class="box-label">Project Username: </label><input type="text" name="project-username-input" class="faculty-bar">
                    <button onclick="faculty.checkInDatabase(this.parentElement.getElementsByTagName('input')[0].value); return false;" value="Search">Search</button>
                  </div>
                </div>
                <div class="col-sm-2"></div>
            </div>
            <div class="col-sm-12">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    <div class="col-sm-12">
                        <div class="col-sm-6 no-padding">
                            <div class="invitations-header">
                                <h2>Invitations</h2>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="project-status-header">
                                <h2>Capstone Information</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2"></div>
            </div>
            <div class="col-sm-12">
                <div class="col-sm-2"></div>
                <div class="col-sm-4">
                    <div class="invitations-wrapper section-border clearfix">
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
                <div class="col-sm-4">
                    <div class="project-status-wrapper section-border clearfix" style="margin-top: 15px;">
                        <div class="col-sm-12">
                            <div class="col-sm-12 ">
                                <div class="project-status">
                                    <h2 id="cap-status">N/A</h2>
                                </div>
                            </div>
                            <div class="col-sm-12 ">
                                <div class="col-sm-6 no-padding">
                                    <div class="project-status" id="faculty-capstone-grade">
                                        <h4>Grade: <span id="cap-status-grade">N/A</span></h4>
                                    </div>
                                </div>
                                <div class="col-sm-6 no-padding">
                                    <div class="project-status">
                                        <button class="cap-status-grade-btn" type="button" name="cap-status-grade">Enter Grade</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="project-status">
                                    <button class="cap-status-history-btn" type="button" name="cap-status-history">View History</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2"></div>
            </div>
        </div>
        <div class="col-sm-12 section-spacer">
            <div class="col-sm-12">
                <div class="col-sm-2"></div>
                <div class="col-sm-8" style="margin-bottom: 15px;">
                    <h2>Committee List</h2>
                </div>
                <div class="col-sm-2"></div>
            </div>
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <div class="faculty-committee-list-wrapper section-border clearfix committee-list-wrapper">
                    <div class="committee-list-field clearfix"></div>
                </div>
            </div>
            <div class="col-sm-2"></div>
        </div>
        <div class="col-sm-12 section-spacer">
            <div class="col-sm-12 no-padding">
                <div class="col-sm-12 no-padding">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8">
                        <div class="faculty-tracking-list-header">
                            <div class="col-sm-12">
                                <h2 id="tracking-list-header" style="margin-bottom: 15px; margin-right: 10px;">Tracking List</h2>
                                <div class="tracking-add-btn-wrapper">
                                    <button class='tracking-add-btn' type="button" name="faculty-add-tracker-btn">Add</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2"></div>
                </div>
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <div class="faculty-tracking-list-wrapper section-border clearfix">
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
            <p>Log Out</p>
        </div>
    </div>
</div>


<!--============================================================ MODALS BEGIN HERE-->
<!-- TRACKING STUDENT CAPSTONES MODAL -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Student Capstones</h4>
      </div>
      <div class="modal-body clearfix">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- GRADE MODAL -->
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
          <form class="grade-input-form" action="index.html" method="post">
              <select id='grade-input-selection' class="" name="">
                  <option value="">--SELECT--</option>
                  <option value="A">A</option>
                  <option value="A-">A-</option>
                  <option value="B">B</option>
                  <option value="B-">B-</option>
                  <option value="C">C</option>
                  <option value="C-">C-</option>
                  <option value="D">D</option>
                  <option value="D-">D-</option>
                  <option value="F">F</option>
              </select>
              <button class="grade-modal-submit-button" type="button" name="enter-grade-submit-btn">Submit</button>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<!-- HISTORY MODAL -->
<div id="history-modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Capstone Status History</h4>
      </div>
      <div class="history-modal-body clearfix">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!--================================================================MODALS END HERE-->
<script src="<?php echo base_url() . "assets/js/faculty.js"?>"></script>
