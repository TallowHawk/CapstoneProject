<div class="clearfix view-wrapper">
    <div class="col-sm-12">
        <div class="col-sm-12 no-padding">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <div class="view-header-wrapper clearfix">
                    <div class="view-header">
                        <h2>Hello, <span id="faculty-name-header">{Faculty Name}</span></h2>
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
                <div class="invitations-wrapper section-border clearfix">
                    <div class="col-sm-12">
                        <div class="col-sm-12">
                            <div class="invitations-header">
                                <h2>Invitations</h2>
                            </div>
                        </div>
                        <div class="col-sm-12 no-padding">
                            <div class="invitations-body clearfix">
                                <div class="col-sm-4">
                                    <h4 id="invitations-student-name">{Student Name}</h4>
                                </div>
                                <div class="col-sm-4">
                                    <p id="invitations-project-name">{Project Name}</p>
                                </div>
                                <div class="col-sm-4">
                                    <div class="invitation-choice-wrapper clearfix">
                                        <button type="button" name="accept-invite-btn">&#10004;</button>
                                        <button type="button" name="reject-invite-btn">X</button>
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
                                    <h2 id="cap-status">{Project Status Here}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 ">
                            <div class="project-status">
                                <button type="button" name="cap-status-grade">Enter Grade</button>
                            </div>
                            <div class="project-status">
                                <h4>Grade: <span id="cap-status-grade">{Grade}</span></h4>
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
