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

            <form action="{{ route('frontend-region') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <label for="RegionID" class="mb-2"><b>Region Name</b></label><br>
                        <select class="form-select form-select-lg mb-3" name="RegionID" style="font-size: 16px;">
                            <option value="" name="any selected" selected="selected">Any Region</option>
                            @foreach ($regionlist as $rl)
                                <option value="{{ $rl->id }}" name="{{ $rl->id }}"
                                    {{ old('RegionID') == $rl->id ? 'selected' : '' }}>
                                    {{ $rl->Description }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <label for="" class="mb-2"><b>Organization Name</b></label>
                        <input placeholder="Type organization name for search" type="text" name="organizationName"
                            id="" minlength="2" class="srch-form mb-3"
                            value="{{ !empty($orgName) ? $orgName : '' }}" style="height: 35px;" required>
                    </div>
                    <div class="col-lg-12 my-2 text-end">
                        <button type="submit" class="srch-btn" name="search">Search</button>
                    </div>
                </div>

                @if (isset($searchResults) && count($searchResults) > 0)
                    <div class="org-name">
                        @foreach ($searchResults as $result)
                            <span>{{ $result->regionDescription }}</span><br>
                            <span class="org-box d-flex flex-wrap"><a href="/id/{{ $result->URLName }}">{{ $result->Name }} *</a></span>
                        @endforeach
                    </div>
                @else
                    <div>No search results for '{{ !empty($orgName) ? $orgName : '' }}'. Try refining your search or
                        browsing the categories instead. </div>
                @endif
            </form>
            <hr>

            <div id="regions_wrapper">
                <div class="regions">
                    <ul>
                        <li>
                            <h4><a href="/regions/portland-vancouver-salem/">Portland/Vancouver/Salem</a></h4>
                        </li>
                        <li>
                            <h4><a
                                    href="/regions/eugene-springfield-roseberg-albany-corvallis/">Eugene/Springfield/Rose/Alb/Corv</a>
                            </h4>
                        </li>
                        <li>
                            <h4><a href="/regions/medford-klamath-falls-grants-pass/">Medford/Klamath Falls/Grants Pass</a>
                            </h4>
                        </li>
                        <li>
                            <h4><a href="/regions/bend-central-eastern-oregon/">Bend/Central-Eastern Ore.</a></h4>
                        </li>
                        <li>
                            <h4><a href="/regions/seattle-western-washington/">Seattle/Western Wash.</a></h4>
                        </li>
                        <li>
                            <h4><a href="/regions/columbia-tri-cities-yakima-pendleton/">Columbia
                                    (Tri-Cities/Yakima/Pendleton)</a></h4>
                        </li>
                        <li>
                            <h4><a href="/regions/spokane-eastern-washington-north-idaho/">Spokane/Eastern Wash./North
                                    Idaho</a></h4>
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