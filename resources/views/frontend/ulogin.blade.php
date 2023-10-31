@extends('frontend.layouts.app')
@section('content')
<style>
    h1 {
        font-size: 36px;
    }

    p {
        font-size: 18px;
    }
    img {
        width: 200px;
        height: 200px;
        margin-bottom: 20px;
    }
        .under-const {
         width: 100%;
         height: 20%;
        border: 1px solid #ccc;
        padding: 5px;
        }
        /* Styles for the image container */
.image-container {
  position: relative;
  display: inline-block;
}

/* Style for the overlay content */
.overlay-content {
  position: absolute;
  top: 50%; /* Align the content vertically in the middle */
  left: 50%; /* Align the content horizontally in the middle */
  transform: translate(-50%, -50%); /* Center the content exactly in the middle */
  background-color: rgba(255, 255, 255, 0.8); /* Add a semi-transparent background to the content */
  padding: 20px;
  text-align: center;
  max-width: 80%; /* Limit the maximum width of the overlay content */
}

/* Style for the h1 tag inside the overlay content */
.overlay-content h1 {
  font-size: 36px;
  color: #333;
  margin-bottom: 10px;
}

/* Style for the p tags inside the overlay content */
.overlay-content p {
  font-size: 18px;
  color: #555;
  margin-bottom: 15px;
}
</style>
<div class="image-container">
    <img src="{{ asset('front_assets/images/UnderConstr.jpg') }}" alt="Under Construction" class="under-const">
    <div class="overlay-content">
        <h1>Under Construction</h1>
        <p>We are currently working on our website and will be back soon!</p>
        <p>In the meantime, you can follow us on social media for updates:</p>
        <!-- Add your social media links here -->
        <p>Thank you for your patience.</p>
    </div>
</div>
@endsection