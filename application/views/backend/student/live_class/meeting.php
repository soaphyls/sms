<!DOCTYPE html>

<head>
    <title><?php echo get_phrase('live_class'); ?> : <?php echo get_phrase($page_title); ?></title>
    <meta charset="utf-8" />
    <link type="text/css" rel="stylesheet" href="https://source.zoom.us/1.9.1/css/bootstrap.css" />
    <link type="text/css" rel="stylesheet" href="https://source.zoom.us/1.9.1/css/react-select.css" />
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link name="favicon" type="image/x-icon" href="<?php echo $this->settings_model->get_favicon(); ?>" rel="shortcut icon" />
</head>

<body>
    <style>
        body {
            padding-top: 50px;
        }

        .course_info {
            color: #999999;
            font-size: 11px;
            padding-bottom: 10px;
        }

        .btn-finish {
            background-color: #656565;
            border-color: #222222;
            color: #cacaca;
        }

        .btn-finish:hover,
        .btn-finish:focus,
        .btn-finish:active,
        .btn-finish.active,
        .open .dropdown-toggle.btn-finish {
            color: #cacaca;
        }

        .course_user_info {
            color: #989898;
            font-size: 12px;
            margin-right: 20px;
        }
    </style>
    <nav id="nav-tool" class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header" style="padding: 0px !important;">
                <a class="navbar-brand" href="#">
                    <img src="<?php echo $this->settings_model->get_favicon(); ?>" style="height: 25px;" />
                    <?php echo get_phrase('live_class'); ?> :
                    <?php echo get_phrase("class") . ' : ' . $class_details['name']; ?>,
                    <?php echo get_phrase("subject") . ' : ' . $subject_details['name']; ?>,
                    <button type="button" class="btn btn-finish btn-sm" style="padding : 1px 5px 1px 5px;" onclick="alert('<?php echo $live_class_details['topic'] ?>')">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512; margin-top: 5px;" xml:space="preserve" width="15px" height="15px" class="">
                            <g>
                                <g>
                                    <g>
                                        <path d="M437.02,74.98C388.667,26.629,324.38,0,256,0S123.333,26.629,74.98,74.98C26.629,123.333,0,187.62,0,256    s26.629,132.667,74.98,181.02C123.333,485.371,187.62,512,256,512s132.667-26.629,181.02-74.98    C485.371,388.667,512,324.38,512,256S485.371,123.333,437.02,74.98z M256,70c30.327,0,55,24.673,55,55c0,30.327-24.673,55-55,55    c-30.327,0-55-24.673-55-55C201,94.673,225.673,70,256,70z M326,420H186v-30h30V240h-30v-30h110v180h30V420z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#FFFFFF" />
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </button>
                </a>
            </div>
            <div id="navbar">
                <form class="navbar-form navbar-right" id="meeting_form">
                    <div class="form-group">
                        <div class="course_user_info">
                            <?php echo get_phrase('teacher'); ?> : <?php echo $teacher_details['name']; ?>
                        </div>
                        <div class="course_user_info">
                            <?php echo get_phrase('total_students'); ?> :
                            <?php
                            $enrolments = $this->db->get_where('enrols', array('class_id' => $live_class_details['class_id'], 'school_id' => school_id(), 'session' => active_session()));
                            echo $enrolments->num_rows();
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-finish" onclick="stop_zoom()">
                            <svg style="height:20px; vertical-align: middle;" aria-hidden="true" focusable="false" data-prefix="fal" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="svg-inline--fa fa-times fa-w-10 fa-3x">
                                <path fill="currentColor" d="M193.94 256L296.5 153.44l21.15-21.15c3.12-3.12 3.12-8.19 0-11.31l-22.63-22.63c-3.12-3.12-8.19-3.12-11.31 0L160 222.06 36.29 98.34c-3.12-3.12-8.19-3.12-11.31 0L2.34 120.97c-3.12 3.12-3.12 8.19 0 11.31L126.06 256 2.34 379.71c-3.12 3.12-3.12 8.19 0 11.31l22.63 22.63c3.12 3.12 8.19 3.12 11.31 0L160 289.94 262.56 392.5l21.15 21.15c3.12 3.12 8.19 3.12 11.31 0l22.63-22.63c3.12-3.12 3.12-8.19 0-11.31L193.94 256z" class=""></path>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
            <!--/.navbar-collapse -->
        </div>
    </nav>



    <script src="https://source.zoom.us/1.9.1/lib/vendor/react.min.js"></script>
    <script src="https://source.zoom.us/1.9.1/lib/vendor/react-dom.min.js"></script>
    <script src="https://source.zoom.us/1.9.1/lib/vendor/redux.min.js"></script>
    <script src="https://source.zoom.us/1.9.1/lib/vendor/redux-thunk.min.js"></script>
    <script src="https://source.zoom.us/1.7.9/lib/vendor/jquery.min.js"></script>
    <script src="https://source.zoom.us/1.9.1/lib/vendor/lodash.min.js"></script>
    <script src="https://source.zoom.us/zoom-meeting-1.9.1.min.js"></script>

    <script>
        function stop_zoom() {
            var r = confirm("<?php echo get_phrase('do_you_want_to_leave_the_live_video_class'); ?> ? <?php echo get_phrase('you_can_join_them_later_if_the_video_class_remains_ive'); ?>");
            if (r == true) {
                ZoomMtg.leaveMeeting();
            }

        }

        $(document).ready(function() {
            start_zoom();
        });

        function start_zoom() {

            ZoomMtg.preLoadWasm();
            ZoomMtg.prepareJssdk();

            var API_KEY = "<?php echo $live_class_settings['zoom_api_key']; ?>";
            var API_SECRET = "<?php echo $live_class_settings['zoom_secret_key']; ?>";
            var USER_NAME = "<?php echo $logged_user_details['name']; ?>";
            var MEETING_NUMBER = "<?php echo $live_class_details['zoom_meeting_id']; ?>";
            var PASSWORD = "<?php echo $live_class_details['zoom_meeting_password']; ?>";

            testTool = window.testTool;


            var meetConfig = {
                apiKey: API_KEY,
                apiSecret: API_SECRET,
                meetingNumber: MEETING_NUMBER,
                userName: USER_NAME,
                passWord: PASSWORD,
                leaveUrl: "<?php echo site_url('addons/live_class/'); ?>",
                role: 0
            };



            var signature = ZoomMtg.generateSignature({
                meetingNumber: meetConfig.meetingNumber,
                apiKey: meetConfig.apiKey,
                apiSecret: meetConfig.apiSecret,
                role: meetConfig.role,
                success: function(res) {
                    console.log(res.result);
                }
            });

            ZoomMtg.init({
                leaveUrl: "<?php echo site_url('addons/live_class/'); ?>",
                isSupportAV: true,
                success: function() {
                    ZoomMtg.join({
                        meetingNumber: meetConfig.meetingNumber,
                        userName: meetConfig.userName,
                        signature: signature,
                        apiKey: meetConfig.apiKey,
                        passWord: meetConfig.passWord,
                        success: function(res) {
                            console.log('join meeting success');
                        },
                        error: function(res) {
                            console.log(res);
                        }
                    });
                },
                error: function(res) {
                    console.log(res);
                }
            });
        }
    </script>
</body>

</html>