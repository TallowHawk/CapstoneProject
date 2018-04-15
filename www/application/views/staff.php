<div class="clearfix staff-wrapper">
    <div class="col-sm-12">
        <div class="col-sm-12 no-padding">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <div class="view-header-wrapper clearfix">
                    <div class="staff-name">
                        <h2>Hello, <span id="faculty-name-header">{Staff Name}</span></h2>
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
                        <h2 id="project-title-header">{Project Title Goes Here}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-2"></div>
        <div class="col-sm-12">
            <div class="col-sm-2"></div>
            <div class="col-sm-8 no-padding">
                <button class="staff-btn-options" type="button" name="staff-pending-prop">Pending Proposals</button>
                <button class="staff-btn-options" type="button" name="staff-rej-prop">Rejected Proposals</button>
                <button class="staff-btn-options" type="button" name="staff-acc-prop">Accepted Proposals</button>
                <button class="staff-btn-options" type="button" name="staff-prop-resub">Proposal Resubmissions</button>
                <button class="staff-btn-options" type="button" name="staff-defense-dates">Defense Dates</button>
            </div>
            <div class="col-sm-2"></div>
        </div>
        <div class="col-sm-12 section-spacer">
            <div class="col-sm-12">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    <form class="project-filter" action="" method="post">
                        <label>Project Username: </label><input type="text" name="project-username-input">
                        <input type="submit" name="project-search-submit-btn" value="Search"/>
                    </form>
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
                                    <p id="staff-proj-det-name">{Owners Name}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 no-padding">
                            <div class="project-details-body clearfix">
                                <div class="col-sm-6">
                                    <h4>Title:</h4>
                                </div>
                                <div class="col-sm-6">
                                    <p id="staff-proj-det-title">{Project Title}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 no-padding">
                            <div class="project-details-body clearfix">
                                <div class="col-sm-6">
                                    <h4>Description:</h4>
                                </div>
                                <div class="col-sm-6">
                                    <p id="staff-proj-det-description">{The project description about kittens and stuff}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 no-padding">
                            <div class="project-details-body clearfix">
                                <div class="col-sm-6">
                                    <h4>Defense Date:</h4>
                                </div>
                                <div class="col-sm-6">
                                    <p id="staff-proj-det-defense">{Date goes here}</p>
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
                                    <h2 id="staff-cap-status">{Project Status Here}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 ">
                            <div class="project-status">
                                <h4>Plagerism Score: <span id="staff-cap-status-plag-score">{Plag Score Here}<span></h4>
                            </div>
                        </div>
                        <div class="col-sm-12 ">
                            <div class="project-status">
                                <h4>Grade: <span id="staff-cap-status-grade">{Grade}</span></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-2"></div>
        </div>
    </div>
    <div class="logout-btn-wrapper">
        <div class="logout-btn">
            <h1>LOGOUT</h1>
        </div>
    </div>
</div>
