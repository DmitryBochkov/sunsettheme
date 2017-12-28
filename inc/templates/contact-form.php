<form id="sunsetContactForm" class="sunset-contact-form" action="#" method="post" data-url="<?php echo admin_url( 'admin-ajax.php' ); ?>">
  <div class="form-group">
    <input class="form-control sunset-form-control" type="text" placeholder="Your Name" id="name" name="name">
    <span class="text-danger form-control-msg">Your Name is Required</span>
  </div>
  <div class="form-group">
    <input class="form-control sunset-form-control" type="email" placeholder="Your Email" id="email" name="email">
    <span class="text-danger form-control-msg">Your Email is Required</span>
  </div>
  <div class="form-group">
    <textarea id="message" name="mesage" class="form-control sunset-form-control" placeholder="Your Message" ></textarea>
    <span class="text-danger form-control-msg">A Message is Required</span>
  </div>

  <div class="text-center">
    <button type="submit" class="btn btn-default btn-lg btn-sunset-form">Submit</button>
    <span class="text-info form-control-msg js-form-submission">Submission in process, please wait...</span>
    <span class="text-success form-control-msg js-form-success">Message succefully submitted!</span>
    <span class="text-danger form-control-msg js-form-error">There was a problem with a Contact Form, please try again.</span>
  </div>

</form>
