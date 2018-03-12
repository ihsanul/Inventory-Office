<?php
include 'header_user.php';
?>
    <section class="menu-section">
    	<div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="navbar-collapse">
                        <ul id="menu-top" class="nav navbar-nav navbar-left topnav">
                            <li><a href="index.php">Beranda</a></li>
                            <li><a class="menu-top-active" href="feedback.php">Feedback</a></li>
                            <li class="icon">
                              <a href="javascript:void(0);" onclick="myFunction()">☰</a>
                            </li>
                        </ul>
                    </div>
                </div>
	        </div>
	    </div>
    </section>
    <section>
	   	<div class="container">
    	<div class="row">
    		<div class="col-md-12">
    			 <div class="notice-board">
              <div class="panel panel-default">
                 <div class="panel-heading">
                  <div class="w-title">
                    <h2>Feedback</h2>
                  </div>
             		 </div>
             	</div>
             	<div class="panel-body">
                <div class="col-md-offset-1 col-md-10 datahead">
                 <!-- <div class="col-md-12 ">                -->
                 <div class="row">
                  <form class="form-validate" style="padding-top: 10px;" id="feedback_form" name="feedback_form" method="POST">
                    <div class="col-md-12" >
                      <label for="cnama" class="control-label text-left">Nama<span class="required">*</span></label>
                    </div>
                      <!-- <div class="col-lg-8"> -->
                    <div class="col-md-12" >
                          <input class="form-control" id="cname" name="nama" type="text" placeholder="Masukkan nama" required />
                      </div>
                    <!-- </div> -->
                    <div class="col-md-12" style="margin-top: 15px;">
                      <label for="calamat" class="control-label text-left">Kritik dan Saran<span class="required">*</span></label>
                    </div>
                    <div class="col-md-12" style="">
                      <!-- <div class="col-lg-8" > -->
                        <textarea class="form-control required" required="required" style="min-height: 200px;" id="keterangan" name="keterangan" placeholder="Masukkan kritik dan saran"></textarea>
                      <!-- </div> -->
                    </div>
                      <div class="col-md-12 text-right" style="margin-bottom: 20px;margin-top: 15px;">
                        <input type="submit" id="kirim" class="btn btn-success kirim" name="kirim" value="Send">
                      </div>
                  </form>
                </div>
                </div>
               </div>
              <!-- </div>  -->
               <script >
                $('.kirim').click(function kirim(e){
                  e.preventDefault();
                  var Data = $("#feedback_form").serialize();
                  // var tom = $(this).attr(
                  if (document.feedback_form.nama.value == "") {alert("Isikan Nama!");}
                  else if (document.feedback_form.keterangan.value == "") {alert("Isikan Kritik dan Saran!");}
                  else {
                  $.ajax({
                          url: "feedback_simpan.php",
                          type: "POST",
                          data: Data,
                          success: function(msg){
                          alert(msg);
                          // window.location.reload();
                          window.location = window.location.href;
                          },
                          error: function(msg){
                          alert(msg);
                          }
                        })
                }
              });
              </script>
              <script type="text/javascript">
                function myFunction() {
                 document.getElementsByClassName("topnav")[0].classList.toggle("responsive");
                }
              </script>
            <div class="panel-footer">
            </div>
          </div>	
  			</div>
   		</div>
   		</div>
    </section>
    <footer id="footer">
    	<div class="row">
                <div class="col-md-12">
                   <h5><strong> &copy; 2017 Inventaris Office | By : <a href="http://www.king-atreus.blogspot.co.id/" target="_blank">Muhamad Ihsanul Qamil</a></strong></h5>
                </div>
      </div>
    </footer>
	<script src="../assets/js/jquery-1.11.1.js"></script>
	<script src="../assets/bootstrap/js/bootstrap.js"></script>
    </div>
</body>
</html>

