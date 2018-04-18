<script src="<?php echo base_url() . "assets/js/staff.js"?>"></script>
<script>let ajaxURLStart = "<?php echo base_url() ?>";</script>
<div class="clearfix staff-wrapper">
    <div class="col-sm-12">
        <div class="col-sm-12 no-padding">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <div class="view-header-wrapper clearfix">
                    <div class="staff-name">
                        <h2>Hello, <span id="faculty-name-header"><?php echo $userData[0]["first_name"] . " " . $userData[0]["last_name"] ?></span></h2>
                    </div>
                </div>
            </div>
            <div class="col-sm-2"></div>
        </div>
        <div class="col-sm-2"></div>
        <div class="col-sm-12">
            <div class="col-sm-2"></div>
            <div class="col-sm-8 no-padding">
                <button class="staff-btn-options" id="staff-pending-prop" type="button" name="staff-pending-prop">Pending Proposals</button>
                <button class="staff-btn-options" id="staff-rej-prop" type="button" name="staff-rej-prop">Rejected Proposals</button>
                <button class="staff-btn-options" id="staff-acc-prop" type="button" name="staff-acc-prop">Accepted Proposals</button>
                <button class="staff-btn-options" id="staff-prop-resub" type="button" name="staff-prop-resub">Proposal Resubmissions</button>
                <button class="staff-btn-options" id="staff-defense-prop" type="button" name="staff-defense-dates">Defense Dates</button>
            </div>
            <div class="col-sm-2"></div>
        </div>
        <div class="col-sm-12 section-spacer">
            <div class="col-sm-12">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    <label>Project Username: </label><input type="text" name="project-username-input">
                    <button onclick="staff.getCapstone(this.parentElement.getElementsByTagName('input')[0].value); return false;" value="Search">Search</button>
                </div>
                <div class="col-sm-2"></div>
            </div>
            <div class="col-sm-2"></div>
            <div class="col-sm-4">
                <div class="project-details-wrapper section-border clearfix">
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
                                    <p id="staff-proj-det-name"></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 no-padding">
                            <div class="project-details-body clearfix">
                                <div class="col-sm-6">
                                    <h4>Title:</h4>
                                </div>
                                <div class="col-sm-6">
                                    <p id="staff-proj-det-title"></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 no-padding">
                            <div class="project-details-body clearfix">
                                <div class="col-sm-6">
                                    <h4>Description:</h4>
                                </div>
                                <div class="col-sm-6">
                                    <p id="staff-proj-det-description"></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 no-padding">
                            <div class="project-details-body clearfix">
                                <div class="col-sm-6">
                                    <h4>Defense Date:</h4>
                                </div>
                                <div class="col-sm-6">
                                    <p id="staff-proj-det-defense"></p>
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
                                <div class="col-sm-12 no-padding">
                                    <div class="project-status-edit-btn">
                                        <button type="button" name="staff-edit-project-status">Edit Status</button>
                                    </div>
                                </div>
                                <div class="col-sm-12 no-padding">
                                    <div class="project-status-plag-btn">
                                        <button type="button" name="staff-enter-plag-score">Enter Plag Score</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 ">
                                <div class="project-status">
                                    <h2 id="staff-cap-status"></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 ">
                            <div class="project-status">
                                <h4>Plagerism Score: <span id="staff-cap-status-plag-score"><span></h4>
                            </div>
                        </div>
                        <div class="col-sm-12 ">
                            <div class="project-status">
                                <h4>Grade: <span id="staff-cap-status-grade"></span></h4>
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
                <h4 class="modal-title">Capstone Projects</h4>
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
