@extends('frontend.layouts.app')
@section('content')
<section>
    <div style="background: #c5e3ed">
        <div class="container d-flex justify-content-center align-items-center">
            <div class="intro-box ">
                <div class="intro-text d-flex justify-content-center align-items-center">
                    <h1>FLASHALERT REGIONS</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container bank-union my-4">
        <p>Choose your region below to start a new FlashAlert Messenger subscription, or search for the org here</p>
        <form class="log-input" method="post" action="your_action_url_here">
            <div class="row">
                <div class="col-lg-6">
                    <label for="RegionID" class="mb-2"><b>Select Region</b></label><br>
                    <select class="form-select form-select-lg mb-3" name="RegionID" id="" style="font-size: 16px;">
                        <option value="0" selected="selected">Any Region</option>
                        <option value="1">Portland/Vanc/Salem</option>
                        <option value="2">Eugene/Spring/Rose/Alb/Corv</option>
                        <option value="5">Colorado Springs/Pueblo</option>
                        <option value="7">Spokane/East. Wash/North Idaho</option>
                        <option value="8">~Test Region</option>
                        <option value="10">Bend/Central-Eastern Oregon</option>
                        <option value="12">Seattle/Western Wash.</option>
                        <option value="13">Columbia (Tri-Cities/Yakima/Pendleton)</option>
                        <option value="15">Boise/Southern Idaho</option>
                        <option value="25">Medford/Klamath Falls/Grants Pass</option>
                        <option value="26">National News Media (Major news of National Interest Only)</option>
                        <option value="29">CBtest</option>
                        <option value="30">testing</option>
                    </select>
                </div>
                <div class="col-lg-6">
                    <label for="" class="mb-2"><b>Organization Name</b></label>
                    <input placeholder="Organization Name" type="text" id="" minlength="4" class="srch-form mb-3" style="height: 35px;" required>
                </div>
                <div class="col-lg-12 my-2 text-end">
                    <button type="submit" class="srch-btn ">Submit</button>
                </div>
            </div>

            <!-- <br> -->
            <!-- <br> -->
            <!-- <input type="submit" name="Submit" value="Login" class="sub-btn srch-btn"> -->
        </form>
        <hr>

        <div id="regions_wrapper">
            <div class="regions">
                <ul>
                    <li>
                        <h4><a href="/regions/portland-vancouver-salem/">Portland/Vancouver/Salem</a></h4>
                    </li>
                    <li>
                        <h4><a href="/regions/eugene-springfield-roseberg-albany-corvallis/">Eugene/Springfield/Rose/Alb/Corv</a></h4>
                    </li>
                    <li>
                        <h4><a href="/regions/medford-klamath-falls-grants-pass/">Medford/Klamath Falls/Grants Pass</a></h4>
                    </li>
                    <li>
                        <h4><a href="/regions/bend-central-eastern-oregon/">Bend/Central-Eastern Ore.</a></h4>
                    </li>
                    <li>
                        <h4><a href="/regions/seattle-western-washington/">Seattle/Western Wash.</a></h4>
                    </li>
                    <li>
                        <h4><a href="/regions/columbia-tri-cities-yakima-pendleton/">Columbia (Tri-Cities/Yakima/Pendleton)</a></h4>
                    </li>
                    <li>
                        <h4><a href="/regions/spokane-eastern-washington-north-idaho/">Spokane/Eastern Wash./North Idaho</a></h4>
                    </li>
                    <li>
                        <h4><a href="/regions/boise-southern-idaho/">Boise/Southern Idaho</a></h4>
                    </li>
                    <li>
                        <h4><a href="/regions/colorado-springs-pueblo/">Colorado Springs/Pueblo</a></h4>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection