<footer class="container-fluid text-center text-lg-start su_footer_style shadow bg_blue">

    <section class="container container_padding bg_blue">

      <div class="row align-items-center">

        <div class="col-md-4 col-lg-4 text-md-start su_footer_padding1">

        <div>

            <span class="footer_text_clr2">

              <p><a class="su_conditions">Contact us at -</a> <a class="su_conditions" href="mailto:support@indiaexamjunction.com">support@indiaexamjunction.com</a></p>

              </span>

          </div>

        </div>

        <div class="col-md-4 col-lg-4 text-md-start su_footer_padding">

          <div class="footer_text_clr2  text-center">

            ©{{ date('Y') }} Copyright

         <span class="footer_text_clr2 text-center">indiaexamjunction.com</span>

          </div>

          <div class="text-center">

            <span class="footer_text_clr2">

              <a class="su_conditions" href="{{route('Terms_and_condition')}}">Terms and condition</a> & 

              <a class="su_conditions" href="{{route('Privacy_Policy')}}">Privacy Policy</a>

              </span>

          </div>

        </div>

        <div class="col-md-4 col-lg-4 ml-lg-0 text-center text-md-end">

          <a href="{{facebook_google_link()['facebook']}}" class="btn btn-outline-light btn-floating m-1 footer_text_clr rounded" class="text-white" role="button"><i

              class="fab fa-facebook-f su_icon_footer"></i></a>

          <a href="{{facebook_google_link()['youtube']}}" class="btn btn-outline-light btn-floating m-1 footer_text_clr rounded" class="text-white" role="button"><i

              class="fab fa-youtube su_icon_footer"></i></a>

          <a href="{{facebook_google_link()['google']}}" class="btn btn-outline-light btn-floating m-1 footer_text_clr rounded" class="text-white" role="button"><i

              class="fab fa-instagram su_icon_footer"></i></a>
              
          <a href="{{facebook_google_link()['telegram']}}" class="btn btn-outline-light btn-floating m-1 footer_text_clr rounded" class="text-white" role="button"><i

              class="fab fa-telegram su_icon_footer"></i></a>

        </div>

      </div>

    </section>

    </div>

  </footer>

  @section('script')

<script>

  $(document).ready(function(){

    var cat_id = $('#nav_cat'+"{{isset(request()->category1) ? request()->category1 : ''}}").attr('data-id');

    if(cat_id && cat_id == 1){

      $('.su_more_nav').addClass('active');

    }

  })

</script>

  @endsection