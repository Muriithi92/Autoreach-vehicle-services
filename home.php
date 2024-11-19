 <!-- Header-->
 <header class="bg-dark py-5" id="main-header">
    <div class="container h-100 d-flex align-items-end justify-content-center w-100">
        <div class="text-center text-white w-100">
            <h1 class="display-4 fw-bolder"><?php echo $_settings->info('name') ?></h1>
            <p class="lead fw-normal text-white-50 mb-0">We will take care of your vehicle</p>
            <div class="col-auto mt-2">
                <button class="btn btn-primary btn-lg rounded-0" id="send_request" type="button"> Service Request</button>
            </div>
        </div>
    </div>
</header>
<!-- Section-->
<section class="py-5" style= "background-color: #201e1e">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row">
            <div class="col-md-4">
                <h3 class="text-center">We Do Service For:</h3>
                <hr class="bg-primary opacity-100">
                <ul class="list-group">
                    <?php 
                    $category = $conn->query("SELECT * FROM `categories` where status = 1 order by `category` asc");
                    while($row=$category->fetch_assoc()):
                    ?>
                    <li class="list-group-item"><b><?php echo $row['category'] ?></b></li>
                    <?php endwhile; ?>
                </ul>
            </div>
            <div class="col-md-8">
                <h3 class="text-center" color="fffff">Our Services</h3>
                <hr class="bg-primary opacity-100">
                <div class="form-group">
                <div class="input-group mb-3">
                    <input type="search" id="search" class="form-control" placeholder="Search Service Here" aria-label="Search Service Here" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <span class="input-group-text bg-primary" id="basic-addon2"><i class="fa fa-search"></i></span>
                    </div>
                </div>
                </div>
                <div class="row gx-4 gx-lg-5 row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-xl-2" id="service_list">
                    <?php 
                    $services = $conn->query("SELECT * FROM `service_list` where status = 1 order by `service`");
                    while($row= $services->fetch_assoc()):
                        $row['description'] = strip_tags(html_entity_decode(stripslashes($row['description'])));
                    ?>
                    <a class="col item text-decoration-none text-dark view_service" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">
                        <div class="callout callout-primary border-primary rounded-0">
                            <dl>
                                <dt><?php echo $row['service'] ?></dt>
                                <dd class="truncate-3 text-muted lh-1"><small><?php echo $row['description'] ?></small></dd>
                            </dl>
                        </div>
                    </a>
                    <?php endwhile; ?>
                </div>
                <div id="noResult" style="display:none" class="text-center"><b>No Result</b></div>
            </div>
        </div>
    </div>
</section>
<script>
    $(function(){
        $('#search').on('input',function(){
            var _search = $(this).val().toLowerCase().trim()
            $('#service_list .item').each(function(){
                var _text = $(this).text().toLowerCase().trim()
                    _text = _text.replace(/\s+/g,' ')
                    console.log(_text)
                if((_text).includes(_search) == true){
                    $(this).toggle(true)
                }else{
                    $(this).toggle(false)
                }
            })
            if( $('#service_list .item:visible').length > 0){
                $('#noResult').hide('slow')
            }else{
                $('#noResult').show('slow')
            }
        })
        $('#service_list .item').hover(function(){
            $(this).find('.callout').addClass('shadow')
        })
        $('#service_list .view_service').click(function(){
            uni_modal("Service Details","view_service.php?id="+$(this).attr('data-id'),'mid-large')
        })
        $('#send_request').click(function(){
            uni_modal("Fill the Service Request Form","send_request.php",'large')
        })

    })
    $(document).scroll(function() { 
        $('#topNavBar').removeClass('bg-transparent navbar-dark bg-primary')
        if($(window).scrollTop() === 0) {
           $('#topNavBar').addClass('navbar-dark bg-transparent')
        }else{
           $('#topNavBar').addClass('navbar-dark bg-primary')
        }
    });
    $(function(){
        $(document).trigger('scroll')
    })
</script>
<section class="customisation" style="background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('uploads/customisation.jpg'); background-size: cover; background-position: center center; background-repeat: no-repeat;">
  <div class="section__container customisation__container" style="max-width: 1200px; margin: auto; padding: 5rem 1rem;">
    <p class="section__subheader" style="font-size: 1rem; font-weight: 500; color: #fff">OUR CUSTOMISATION</p>
    <h2 class="section__header" style="font-size: 2.5rem; font-weight: 700; line-height: 3.5rem; color: #fff; max-width: 750px; margin: auto;">Servicing and Towing Matched with Great Workmanship</h2>
    <p class="section__description" style="margin-bottom: 2rem; color: #fff; max-width: 750px; margin: auto;">Our dedicated team of skilled technicians and mechanics takes pride in delivering top-tier servicing for your beloved vehicle.</p>
    <div class="customisation__grid"  style=" margin-top: 4rem; display: grid; gap: 4rem 2rem; grid-template-columns: repeat(2, 1fr);  grid-template-columns: repeat(4, 1fr);">
      <div class="customisation__card">
        <h4 style="font-size: 3rem; font-weight: 700; color: var(--white);">50</h4>
        <p style="color: var(--white);">Total Projects</p>
      </div>
      <div class="customisation__card">
        <h4 style="font-size: 3rem; font-weight: 700; color: var(--white);">165</h4>
        <p style="color: var(--white);">Transparency</p>
      </div>
      <div class="customisation__card">
        <h4 style="font-size: 3rem; font-weight: 700; color: var(--white);">100</h4>
        <p style="color: var(--white);">Done Services</p>
      </div>
      <div class="customisation__card">
        <h4 style="font-size: 3rem; font-weight: 700; color: var(--white);">100</h4>
        <p style="color: var(--white);">Satisfied clients</p>
      </div>
    </div>
  </div>
</section>
<section class="section__container testimonial__container" id="client" style="max-width:  1200px; margin: auto; padding: 5rem 1rem; background-color: #dddada;">
        <p class="section__subheader" style="font-size: 2.5rem;  font-weight: 700; color:#0a0b0f; text-align:center;">CLIENT TESTIMONIALS</p>
        <h2 class="section__header" style=" font-size: 1rem; font-weight: 500; line-height: 3.5rem; color: #1b1c1d">Our services are 100% Approved By our Customers</h2>
        <!-- Slider main container -->
        <div class="swiper" style=" width: 100%; margin-top: 4rem; padding-bottom: 4rem;">
          <!-- Additional required wrapper -->
          <div class="swiper-wrapper" style=" display: flex;flex-wrap: nowrap; transition-property: transform;box-sizing: content-box;" >
            <!-- Slides -->
        
              <div class="testimonial__card" style="max-width: 600px; margin: auto;">
                <img src="https://imgs.search.brave.com/6_UCQqJxMU6NeCwREm_9Hz7QROp3I44LuO--4pDm_tI/rs:fit:500:0:0/g:ce/aHR0cHM6Ly9tZWRp/YS5nZXR0eWltYWdl/cy5jb20vaWQvMTI4/Mzg5NDM1NS9waG90/by9wb3J0cmFpdC1v/Zi1hLXNtaWxpbmct/eW91bmctYnVzaW5l/c3NtYW4uanBnP3M9/NjEyeDYxMiZ3PTAm/az0yMCZjPXJVNGFH/am5xSGJYYzVlUmVR/S1VjbmxzNF85emVy/ZUcxbWtZOFlOdVRI/VkE9" alt="testimonial" 
                style=" max-width: 100px; margin: auto; margin-bottom: 1rem; border-radius: 100%; box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.2);" />
                <p>
                  I couldn't believe my eyes when I got my car back from the
                  service. It looked and drove like it had just rolled off the
                  assembly line. The team did an incredible job, and I'm a
                  customer for life!
                </p>
                <h4>- Kelvin T.</h4>
              </div>
           
           
              <div class="testimonial__card" style="max-width: 600px; margin: auto;">
                <img src="https://imgs.search.brave.com/gwuFUAyC7zhKFWIIys65ITwryvvtC3YhheA1CzrUxAA/rs:fit:500:0:0/g:ce/aHR0cHM6Ly9tZWRp/YS5nZXR0eWltYWdl/cy5jb20vaWQvMTE0/MTUwODMwNC9waG90/by9wb3J0cmFpdC1v/Zi1zbWlsaW5nLXRh/dHRvb2VkLW1hbi13/aXRoLWFybXMtY3Jv/c3NlZC5qcGc_cz02/MTJ4NjEyJnc9MCZr/PTIwJmM9aFFJWjNC/dUNjbUp2MXRWQ2RJ/cEE3Ymhla0F0eE9T/TlRjTVFKZm1Odmwx/UT0" alt="testimonial"
                 style=" max-width: 100px; margin: auto; margin-bottom: 1rem; border-radius: 100%; box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.2);" />
                <p>
                  I've been bringing my car here for years, and they never
                  disappoint. Their attention to detail and commitment to quality
                  service is unmatched. My car always feels brand new after a
                  visit.
                </p>
                <h4>- John P.</h4>
              </div>
           
          
              <div class="testimonial__card" style="max-width: 600px; margin: auto;">
                <img src="https://imgs.search.brave.com/WyfZirCQtEEp1yT0pUZrIB4JsGgOOtzXYmqN0g3xduY/rs:fit:500:0:0/g:ce/aHR0cHM6Ly9tZWRp/YS5nZXR0eWltYWdl/cy5jb20vaWQvMTA2/NTQwMjA0MC9waG90/by9jbG9zZS11cC1w/b3J0cmFpdC1vZi1j/b25maWRlbnQteW91/bmctYnVzaW5lc3Nt/YW4uanBnP3M9NjEy/eDYxMiZ3PTAmaz0y/MCZjPU9jY0Npa2pI/dGNkSnQ0Mm9SOFNE/YjVidWRkYTNVUkNx/dTFuZmZsaldidEE9" alt="testimonial"
                style=" max-width: 100px; margin: auto; margin-bottom: 1rem; border-radius: 100%; box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.2);"  />
                <p>
                  As a car enthusiast, I'm extremely particular about who touches
                  my prized possession. Their team's expertise and passion for
                  cars truly shine through in their work. My car has never looked
                  better.
                </p>
                <h4>- David S.</h4>
              </div>
    
      </section>

     