<script>
    var committeeData = <?php echo json_encode($studentCommittee) ?>;
    var facultyMembers = <?php echo json_encode($facultyMembers) ?>;
    var capstoneInfo = <?php echo json_encode($capstone) ?>;
    var ajaxURLStart = "<?php echo base_url() ?>";
</script>

<div class="clearfix student-wrapper">
    <div class="alert alert-success alert-dismissible invite-success-toast">
      <strong>Invitation Successful!</strong>
    </div>
    <div class="alert alert-success alert-dismissible delete-success-toast">
      <strong>Deletion Successful!</strong>
    </div>
    <div class="col-sm-12">
        <div class="col-sm-2"></div>
        <div class="col-sm-8 no-padding">
            <div class="view-header-wrapper">
                <div class="student-name">
                    <h2>Hello, <span><?php echo $userData[0]["first_name"] . " " . $userData[0]["last_name"]?></span></h2>
                </div>
            </div>
        </div>
        <div class="col-sm-2"></div>
    </div>
    <div class="col-sm-12 section-spacer">
        <div class="col-sm-2"></div>
        <div class="col-sm-4">
            <div class="project-details-wrapper section-border clearfix">
                <div class="col-sm-12">
                    <div class="col-sm-12">
                        <div class="col-sm-12">
                            <div class="project-details-header">
                                <h2>Capstone Details</h2>
                            </div>
                        </div>
                        <div class="col-sm-12 no-padding">
                            <div class="project-details-body clearfix">
                                <div class="col-sm-6">
                                    <h4>Student Name:</h4>
                                </div>
                                <div class="col-sm-6">
                                    <p id="proj-det-name"><?php echo $userData[0]["first_name"] . " " . $userData[0]["last_name"] ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 no-padding">
                            <div class="project-details-body clearfix">
                                <div class="col-sm-6">
                                    <h4>Title:</h4>
                                </div>
                                <div class="col-sm-6">
                                    <p id="proj-det-title"><?php echo $capstone['title']?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 no-padding">
                            <div class="project-details-body clearfix">
                                <div class="col-sm-6">
                                    <h4>Description:</h4>
                                </div>
                                <div class="col-sm-6">
                                    <p id="proj-det-description"><?php echo $capstone['description']?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 no-padding">
                            <div class="project-details-body clearfix">
                                <div class="col-sm-6">
                                    <h4>Defense Date:</h4>
                                </div>
                                <div class="col-sm-6">
                                    <p id="proj-det-defense"><?php echo $capstone['defense_date']?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="project-status-field-wrapper section-border clearfix">
                <div class="col-sm-12">
                    <div class="project-status-field-wrapper">
                        <div class="col-sm-12">
                            <div class="col-sm-6 no-padding">
                                <div class="project-status-field-header">
                                    <h2>Capstone Status</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 ">
                            <div class="project-status-field">
                                <h2 id="staff-cap-status"><?php echo $capStatus["status_desc"] ?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 ">
                        <div class="project-status-field">
                            <h4>Grade: <span id="cap-status-grade"><?php echo $capstone['grade']?>%</span></h4>
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
            <div class="col-sm-12 no-padding">
                <div class="committee-list-wrapper section-border clearfix">
                    <div class="col-sm-12">
                        <div class="committee-list-title-wrapper clearfix">
                            <div class="col-sm-10">
                                <div class="committee-list-title">
                                    <h2>Committee List</h2>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="committee-header-btn">
                                    <button type="button" name="committee-add-btn">INVITE FACULTY</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="committee-list-member-wrapper clearfix"></div>
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
<!--================================================================MODALS END HERE-->
<script src="<?php echo base_url(); ?>assets/js/student.js"></script>
