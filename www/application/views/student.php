
<div class="clearfix student-wrapper">
    <p id="proj-det-description"><?php print_r($studentCommittee)?></p>
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
                                    <p id="proj-det-title"><?php echo $capstone[0]['title']?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 no-padding">
                            <div class="project-details-body clearfix">
                                <div class="col-sm-6">
                                    <h4>Description:</h4>
                                </div>
                                <div class="col-sm-6">
                                    <p id="proj-det-description"><?php echo $capstone[0]['description']?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 no-padding">
                            <div class="project-details-body clearfix">
                                <div class="col-sm-6">
                                    <h4>Defense Date:</h4>
                                </div>
                                <div class="col-sm-6">
                                    <p id="proj-det-defense"><?php echo $capstone[0]['defense_date']?></p>
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
                                <h2 id="staff-cap-status"><?php echo $capStatus[0]["status_desc"] ?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 ">
                        <div class="project-status-field">
                            <h4>Grade: <span id="cap-status-grade"><?php echo $capstone[0]['grade']?>%</span></h4>
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
                                    <button type="button" name="committee-add-btn">ADD</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="committee-list-member clearfix">
                            <div class="col-sm-10">
                                <div class="commitee-list-name">
                                    <h3>{Faculty Name}</h3>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="commitee-list-delete-btn">
                                    <button type="button" name="committee-delete-btn">DELETE</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="committee-list-member clearfix">
                            <div class="col-sm-10">
                                <div class="commitee-list-name">
                                    <h3>{Faculty Name}</h3>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="committee-list-delete-btn">
                                    <button type="button" name="committee-delete-btn">DELETE</button>
                                </div>
                            </div>
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
