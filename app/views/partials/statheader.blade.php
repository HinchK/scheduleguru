<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat blue-madison">
            <div class="visual">
                <i class="fa fa-user"></i>
            </div>
            <div class="details">
                <div class="number">
                    {{ count($tutorCals) }}
                </div>
                <div class="desc">
                    Tutors
                </div>
            </div>
            <a class="more" href="{{ URL::route('tutor_management') }}">
                View more <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat red-intense">
            <div class="visual">
                <i class="fa fa-pencil"></i>
            </div>
            <div class="details">
                <div class="number">
                    {{ count($studentCals) }}
                </div>
                <div class="desc">
                    Students
                </div>
            </div>
            <a class="more" href="{{ URL::route('student_management') }}">
                View more <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat green-haze">
            <div class="visual">
                <i class="fa fa-shopping-cart"></i>
            </div>
            <div class="details">
                <div class="number">
                    549
                </div>
                <div class="desc">
                    Special Events
                </div>
            </div>
            <a class="more" href="{{ URL::route('event_management') }}">
                View more <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat purple-plum">
            <div class="visual">
                <i class="fa fa-globe"></i>
            </div>
            <div class="details">
                <div class="number">
                    +89%
                </div>
                <div class="desc">
                    Brand Popularity
                </div>
            </div>
            <a class="more" href="#">
                View more <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
    </div>
</div>
