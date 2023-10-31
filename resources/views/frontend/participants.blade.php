<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<style>
  .cwcReportCat {
    padding: 5px;
    background-color: #EBEBEB;
    border-bottom: 1px solid #CCC;
    border-top: 1px solid #CCC;
    font-family: Tahoma, Verdana, Segoe, sans-serif;
    font-weight: bold;
    font-size: 1.0em;
    clear: both;
  }
  #cwcReportHeader {
    color: #FFF;
    font-family: Tahoma, Verdana, Segoe, sans-serif;
    font-size: 12pt;
    padding: 5px;
    background-color: #006699;
    text-align: center;
    font-weight: bold;
    border: 1px solid #4C4C4C;
  }

  /* Style for the container */
  .cwcReportCat span {
    display: flex;
    flex-direction: column;
    gap: 20px;
    margin: 20px;
  }

  /* Style for each school district block */
  .cwcReport {
    padding: 10px;
    border: 1px solid #efefef;
    border-radius: 4px;
    display: flex;
    border-left: 4px solid #006699;
  }

  /* Style for OrgID */
  .OrgID {
    font-weight: bold;
    min-width: 40px;
  }

  /* Style for Zipcode */
  .Zipcode {
    color: #555;
  }

  /* Style for links */
  .cwcReport a {
    text-decoration: none;
    color: #007BFF;
  }

  .cwcReport a:hover {
    text-decoration: underline;
  }

  .cwcReport a {
    padding-left: 10px;
    flex: 0 0 20%;
    border-left: 1px solid #999494;
    margin-left: 10px;
    color: #006699;
    font-weight: 500;
  }

  .sort-sound {
    /* float: left; */
    width: fit-content;
  }

  .sort-sound .sort a {
    font-weight: 500;
    color: #004467;
    text-decoration: none;
    border-bottom: 1px solid #CCC;
    padding: 4px;
  }

  #sound {
    cursor: pointer;
    margin: 6px 12px;
  }

  strong.rel-title a {
    text-decoration: none;
    color: #5e5656;
  }

  strong.rel-title a:hover {
    text-decoration: underline;
    color: #006699;
  }

  .rel-newz-date a {
    text-decoration: none;
  }

  .rel-newz-date a:hover {
    text-decoration: underline;
    color: #5e5656;
  }

  .cst-main-report {
    padding: 5px 10px 10px;
    border-bottom: 1px solid #dfdcdc;
  }

  .release-newz-block {
    display: none;
    font-family: Verdana, Geneva, sans-serif;
    margin-left: 5px;
    padding: 2px;
    margin-top: 10px;
    /* border-bottom: 1px solid #e1e1e1; */
  }

  .right-img-block {
    float: right;
    width: 220px;
    margin: 0 12px;
  }

  .min-h-30 {
    min-height: 10em;
  }

  .tab-particip li .nav-link {
    color: #006699;
    font-weight: 600;
    letter-spacing: 0.3px;
  }

  .tab-particip .nav-link.active {
    color: #006699;
    background-color: #00669933;
    border-bottom: 4px solid #069;
  }

  .border-y {
    border-top: 3px solid #9f9f9f;
    border-bottom: 3px solid #9f9f9f;
  }
</style>
<div class="container-fluid my-3">
  <!-- <div class="sort-sound d-flex">
    <div class="sort">
      <p>Sort By :- <a href="">Date</a> | <a href="">Category</a></p>
    </div>
    <span id="sound">
      <i class="fa fa-bell">Sound Disabled </i>
    </span>
  </div> -->
  <ul class="nav nav-tabs justify-content-end mb-2 tab-particip" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link " id="emrg-tab" data-bs-toggle="tab" data-bs-target="#emergency-rep" type="button" role="tab" aria-controls="emergency-rep" aria-selected="true">Emergency Reports</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="news-tab" data-bs-toggle="tab" data-bs-target="#news-rel" type="button" role="tab" aria-controls="news-rel" aria-selected="false">News Releases</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="traffic-tab" data-bs-toggle="tab" data-bs-target="#traffic" type="button" role="tab" aria-controls="traffic" aria-selected="false">Traffic</button>
    </li>
    <li class="nav-item " role="presentation">
      <button class="nav-link active" id="participants-tab" data-bs-toggle="tab" data-bs-target="#participants_" type="button" role="tab" aria-controls="participants_" aria-selected="false">Participants</button>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade " id="emergency-rep" home role="tabpanel" aria-labelledby="emrg-tab">
      <div class="sort-sound d-flex">
        <div class="sort">
          <p>Sort By :- <a href="">Date</a> | <a href="">Category</a> | <a href="">Message</a> |</p>
        </div>
        <span id="sound">
            <i class="fa fa-bell-o"> <b class="mx-2">Sound Enable </b></i>
          </span>
      </div>
      <div id="cwcReportHeader">
        Portland/Vanc/Salem Emerg. Reports for Thu. Sep. 28 - 5:29 am
      </div>
      <div class="cst-main-report min-h-30">
        <a href="" class="float-end">
          <img src="http://www.flashalert.net/FANewswireLogo.jpg" class="img-fluid" alt="logo">
        </a>
        <p>
          There are no emergency messages to display currently.
        </p>
      </div>
    </div>
    <div class="tab-pane fade" id="news-rel" role="tabpanel" aria-labelledby="news-tab">
      <div class="sort-sound d-flex">
        <div class="sort">
          <p>Sort By :- <a href="">Date</a> | <a href="">Category</a></p>
        </div>

      </div>
      <div id="cwcReportHeader">
        Portland/Vanc/Salem News Releases for Thu. Sep. 28 - 5:36 am
      </div>
      <div id="cwcReportBody">
        <div class="cwcReportCat border-y">Police &amp; Fire</div>

        <div class="cst-main-report">
          <strong class="rel-title"><a href="javascript:toggleLayer('166680');">UPDATE: Deceased motorcyclist identified</a>
          </strong><br>
          <span class="rel-newz-date"><a href="" target="_blank">Bend Police Dept.</a> - 09/22/23 4:13 PM</span>
          <div id="" class="release-newz-block">
            <p><strong>UPDATE</strong>: The deceased motorcyclist has been identified as Ronald Michael Quinn.</p>
            <p> <span><strong>Date</strong>: Sept. 22, 2023</span></p>
            <p> <span><strong>Case #</strong>: 2023-00058543</span></p>
            <p> <span><strong>Incident</strong>: Motorcyclist dies in crash on Knott Road</span></p>
            <p> <span><strong>Date / Time of Incident</strong>: Sept. 22, 2023 / 9:45 a.m </span></p>
            <p> <span><strong>Location</strong>: Knott Road &amp; China Hat Road, Bend</span></p>
            <p> <span><strong>Driver</strong>: 67-year-old Bend resident</span></p>
            <p> <span><strong>Deceased</strong>: 74-year-old Central Oregon resident</span></p>
            <p> <span>A 74-year-old Central Oregon man died Friday after he crashed his motorcycle into another vehicle at the intersection of Knott and China Hat roads in Bend.</span></p>
            <p> <span>An initial investigation determined that the 74-year-old was riding a Harley Davidson motorcycle northwest on China Hat Road when he failed to stop at the stop sign and struck the passenger side of a blue Tesla sedan traveling northeast on Knott Road.</span></p>
            <p> <span>Witnesses to the crash, as well as Bend Fire &amp; Rescue medics, performed CPR on the motorcyclist, but he was declared dead at the scene at</span>approximately 9:56 a.m. The motorcyclist is not being identified pending next of kin notification.</p>
            <p>The Tesla’s driver, a 67-year-old Bend resident, called 911 to report the crash, stayed at the scene and cooperated with the investigation. The driver was not cited.</p>
            <p>Members of the Bend Police crash reconstruction team responded to the area to conduct an investigation, and the intersection of Knott Road and China Hat Road remained closed until approximately 1:25 p.m. </p>
            <div class="text-end">
              <a href="" class="Permalink" target="_blank" title="UPDATE: Deceased motorcyclist identified">Permalink</a>
            </div>
          </div>
        </div>

        <div class="cst-main-report">
          <strong class="rel-title"><a href="javascript:toggleLayer('166680');">Gresham Police Responding to Shooting</a>
          </strong><br>
          <span class="rel-newz-date"><a href="" target="_blank">Gresham Police Dept </a> - 09/24/23 2:41 PM</span>
          <div id="" class="release-newz-block">
            <div class="right-img-block">
              <a href="">
                <img src="http://www.flashalertnewswire.net/images/news/2023-09/1073/166641/DFR-logo-blue.jpg" class="img-fluid" alt="">
              </a>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum totam voluptatibus, sunt reprehenderit sit culpa.</p>
            </div>
            <p><strong>UPDATE</strong>: The deceased motorcyclist has been identified as Ronald Michael Quinn.</p>
            <p> <span><strong>Date</strong>: Sept. 22, 2023</span></p>
            <p> <span><strong>Case #</strong>: 2023-00058543</span></p>
            <p> <span><strong>Incident</strong>: Motorcyclist dies in crash on Knott Road</span></p>
            <p> <span>A 74-year-old Central Oregon man died Friday after he crashed his motorcycle into another vehicle at the intersection of Knott and China Hat roads in Bend.</span></p>
            <p> <span>An initial investigation determined that the 74-year-old was riding a Harley Davidson motorcycle northwest on China Hat Road when he failed to stop at the stop sign and struck the passenger side of a blue Tesla sedan traveling northeast on Knott Road.</span></p>
            <p> <span>Witnesses to the crash, as well as Bend Fire &amp; Rescue medics, performed CPR on the motorcyclist, but he was declared dead at the scene at</span>approximately 9:56 a.m. The motorcyclist is not being identified pending next of kin notification.</p>
            <p>The Tesla’s driver, a 67-year-old Bend resident, called 911 to report the crash, stayed at the scene and cooperated with the investigation. The driver was not cited.</p>
            <p>Members of the Bend Police crash reconstruction team responded to the area to conduct an investigation, and the intersection of Knott Road and China Hat Road remained closed until approximately 1:25 p.m. </p>
            <div class="text-end">
              <a href="" class="Permalink" target="_blank" title="Gresham Police Responding to Shooting">Permalink</a>
            </div>
          </div>
        </div>

        <div class="cst-main-report">
          <strong class="rel-title"><a href="javascript:toggleLayer('166680');">OSP Arrests Sexual Abuse Suspect- Asking Additional Victims to Report - Deschutes County</a>
          </strong><br>
          <span class="rel-newz-date"><a href="" target="_blank">Oregon State Police </a> - 09/22/23 2:50 PM</span>
          <div id="" class="release-newz-block">
            <p><strong>UPDATE</strong>: The deceased motorcyclist has been identified as Ronald Michael Quinn.</p>
            <p> <span><strong>Date</strong>: Sept. 22, 2023</span></p>
            <p> <span><strong>Case #</strong>: 2023-00058543</span></p>
            <p> <span><strong>Incident</strong>: Motorcyclist dies in crash on Knott Road</span></p>
            <p> <span>A 74-year-old Central Oregon man died Friday after he crashed his motorcycle into another vehicle at the intersection of Knott and China Hat roads in Bend.</span></p>
            <p> <span>An initial investigation determined that the 74-year-old was riding a Harley Davidson motorcycle northwest on China Hat Road when he failed to stop at the stop sign and struck the passenger side of a blue Tesla sedan traveling northeast on Knott Road.</span></p>
            <p> <span>Witnesses to the crash, as well as Bend Fire &amp; Rescue medics, performed CPR on the motorcyclist, but he was declared dead at the scene at</span>approximately 9:56 a.m. The motorcyclist is not being identified pending next of kin notification.</p>
            <p>The Tesla’s driver, a 67-year-old Bend resident, called 911 to report the crash, stayed at the scene and cooperated with the investigation. The driver was not cited.</p>
            <p>Members of the Bend Police crash reconstruction team responded to the area to conduct an investigation, and the intersection of Knott Road and China Hat Road remained closed until approximately 1:25 p.m. </p>
            <div class="text-end">
              <a href="" class="Permalink" target="_blank" title="OSP Arrests Sexual Abuse Suspect- Asking Additional Victims to Report - Deschutes County">Permalink</a>
            </div>
          </div>
        </div>

        <div class="cst-main-report">
          <strong class="rel-title"><a href="javascript:toggleLayer('166680');">Lebanon Fire District Begins New Agricultural and Slash Burn Permit Process</a>
          </strong><br>
          <span class="rel-newz-date"><a href="" target="_blank">Lebanon Fire District </a> - 09/20/23 4:37 PM</span>
          <div id="" class="release-newz-block">
            <p><strong>UPDATE</strong>: The deceased motorcyclist has been identified as Ronald Michael Quinn.</p>
            <p> <span>A 74-year-old Central Oregon man died Friday after he crashed his motorcycle into another vehicle at the intersection of Knott and China Hat roads in Bend.</span></p>
            <p> <span>An initial investigation determined that the 74-year-old was riding a Harley Davidson motorcycle northwest on China Hat Road when he failed to stop at the stop sign and struck the passenger side of a blue Tesla sedan traveling northeast on Knott Road.</span></p>
            <p> <span>Witnesses to the crash, as well as Bend Fire &amp; Rescue medics, performed CPR on the motorcyclist, but he was declared dead at the scene at</span>approximately 9:56 a.m. The motorcyclist is not being identified pending next of kin notification.</p>
            <p>The Tesla’s driver, a 67-year-old Bend resident, called 911 to report the crash, stayed at the scene and cooperated with the investigation. The driver was not cited.</p>
            <p>Members of the Bend Police crash reconstruction team responded to the area to conduct an investigation, and the intersection of Knott Road and China Hat Road remained closed until approximately 1:25 p.m. </p>
            <ul style="list-style-type:disc;">
              <li>Rubber products</li>
              <li>Plastic</li>
              <li>Wet garbage</li>
              <li>Food waste</li>
              <li>Petroleum and petroleum treated materials</li>
              <li>Asphalt and asbestos</li>
              <li>Wire insulation</li>
              <li>Automobile parts</li>
              <li>Animal remains</li>
              <li>Any material that produces dense smoke or noxious odors</li>
              <li>Commercial waste</li>
            </ul>
            <div class="text-end">
              <a href="" class="Permalink" target="_blank" title="Lebanon Fire District Begins New Agricultural and Slash Burn Permit Process">Permalink</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="tab-pane fade" id="traffic" role="tabpanel" aria-labelledby="traffic-tab">
      <div class="my-2">
        <span id="sound">
          <i class="fa fa-bell-o"> <b class="mx-2">Sound Enable </b></i>
        </span>
      </div>
      <div id="cwcReportHeader">
        Portland/Vanc/Salem Traffic Information for Thu. Sep. 28 - 5:35 am
      </div>
      <div class="cwcReportCat border-y">No information reported</div>
      <div class="cst-main-report min-h-30">
        <a href="" class="float-end">
          <img src="http://www.flashalert.net/FANewswireLogo.jpg" class="img-fluid" alt="logo">
        </a>
        <p>There are no emergency messages to display currently.</p>
      </div>
    </div>
    <div class="tab-pane fade show active" id="participants_" role="tabpanel" aria-labelledby="participants-tab">
      <div id="cwcReportHeader">Participating Organizations in {{ $region->Description }}</div>

      @foreach ($orgcats as $orgcat)
      <div class="cwcReportCat border-y">{{ $orgcat->orgcatname }}</div>
      <a href="" class="float-end">
        <img src="http://www.flashalert.net/FANewswireLogo.jpg" class="img-fluid" alt="logo">
      </a>
      <span>
        @foreach ($users as $participientdata)
        @if ($participientdata->orgcatname == $orgcat->orgcatname)
        <div class="cwcReport T1Sub">
          <span class="OrgID">{{ $participientdata->org_id }}</span>
          <a href="{{ $participientdata->url }}" target="_new">{{ $participientdata->name }}</a>
          <span class="Zipcode">{{ $participientdata->zipcode }}</span>
        </div>
        @endif
        @endforeach
      </span>
      @endforeach
    </div>
  </div>
</div>
<script>
  const soundElement = document.querySelector("#sound");
  const soundIcon = soundElement.querySelector("i");

  soundElement.addEventListener("click", () => {
    soundIcon.classList.toggle("fa-bell-slash-o");
    soundIcon.classList.toggle("fa-bell-o");

    const soundText = soundElement.querySelector("i");
    if (soundIcon.classList.contains("fa-bell-slash-o")) {
      soundText.textContent = "Sound Disabled";
    } else {
      soundText.textContent = "Sound Enabled";
    }
  });


  jQuery(document).ready(function() {
    jQuery(".rel-title").click(function() {
      jQuery(".release-newz-block").slideToggle("fast");
    });
  });


  // jQuery(document).ready(function() {
  //   jQuery(".rel-title").click(function() {
  //     // Get the clicked `.release-newz-block` element
  //     const releaseNewzBlockElement = jQuery(this).closest(".release-newz-block");

  //     // Toggle the `open` class on the clicked element
  //     releaseNewzBlockElement.toggleClass("open");

  //     // Close all other `.release-newz-block` elements
  //     jQuery(".release-newz-block").not(releaseNewzBlockElement).removeClass("open");
  //   });
  // });

  //   document.addEventListener("DOMContentLoaded", function() {
  //   const relTitles = document.querySelectorAll(".rel-title");

  //   relTitles.forEach(function(title) {
  //     title.addEventListener("click", function() {
  //       const releaseBlock = this.nextElementSibling;
  //       if (releaseBlock.style.display === "" || releaseBlock.style.display === "none") {
  //         releaseBlock.style.display = "block";
  //       } else {
  //         releaseBlock.style.display = "none";
  //       }
  //     });
  //   });
  // });
</script>