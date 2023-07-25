  <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  <footer class="footer py-5">
    <div class="container">
      <div class="row">
      <div class="col-lg-8 mb-4 mx-auto text-center">
          <a href="#" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
              Our Society
          </a>
          <a href="#" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
              About Us
          </a>
          <a href="#" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
              Our Team
          </a>
          <a href="#" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
              our services
          </a>
          <a href="#" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
              Blog about us
          </a>
          <a href="#" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
              contact us
          </a>
      </div>
        @if (!auth()->user() || \Request::is('static-sign-up')) 
          <div class="col-lg-8 mx-auto text-center mb-4 mt-2">
              <a href="#" target="_blank" class="text-secondary me-xl-4 me-4">
                  <span class="text-lg fab fa-dribbble" aria-hidden="true"></span>
              </a>
              <a href="#" target="_blank" class="text-secondary me-xl-4 me-4">
                  <span class="text-lg fab fa-twitter" aria-hidden="true"></span>
              </a>
              <a href="#" target="_blank" class="text-secondary me-xl-4 me-4">
                  <span class="text-lg fab fa-instagram" aria-hidden="true"></span>
              </a>
              <a href="#" target="_blank" class="text-secondary me-xl-4 me-4">
                  <span class="text-lg fab fa-pinterest" aria-hidden="true"></span>
              </a>
              <a href="#" target="_blank" class="text-secondary me-xl-4 me-4">
                  <span class="text-lg fab fa-github" aria-hidden="true"></span>
              </a>
          </div>
        @endif
      </div>
      
  </footer>
  <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
